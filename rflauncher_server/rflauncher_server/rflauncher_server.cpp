#define _WINSOCK_DEPRECATED_NO_WARNINGS
#include <winsock2.h>
#include <iostream>
#include <string>
#include <thread>
#include <vector>
#include "include/json.hpp"
#include <fstream>
#include <filesystem>

#pragma comment(lib, "ws2_32.lib")

namespace fs = std::filesystem;

int PatchInfo_ver;
int LPServerInfo_ver;
int main_launcher_ver;

std::string main_launcher_file_path;
std::string LPServerInfo_file_path;
std::string PatchInfo_path;

const bool use_archive_three = true;
std::string main_launcher_host;
std::string LPServerInfo_host;
std::string PatchInfo_host;

using json = nlohmann::json;

void load_config() {
    std::ifstream config_file("config.json");
    if (!config_file) {
        std::cerr << "Unable to open config.json!\n";
        exit(1);
    }

    json config;
    config_file >> config;

    // Main Launcher
    main_launcher_ver = config["MainLauncher"]["Version"];
    main_launcher_file_path = config["MainLauncher"]["FilePath"];
    main_launcher_host = config["MainLauncher"]["Host"];

    // LPServerInfo
    LPServerInfo_ver = config["LPServerInfo"]["Version"];
    LPServerInfo_file_path = config["LPServerInfo"]["FilePath"];
    LPServerInfo_host = config["LPServerInfo"]["Host"];

    // PatchInfo
    PatchInfo_ver = config["PatchInfo"]["Version"];
    PatchInfo_path = config["PatchInfo"]["FilePath"];
    PatchInfo_host = config["PatchInfo"]["Host"];
}

std::string read_file_contents(const std::string& filepath) {
    std::ifstream file(filepath, std::ios::binary);
    if (!file) return "";
    return std::string((std::istreambuf_iterator<char>(file)), std::istreambuf_iterator<char>());
}

void handle_client(SOCKET client, int port) {
    char buffer[4096];
    memset(buffer, 0, sizeof(buffer));

    int bytesReceived = recv(client, buffer, sizeof(buffer) - 1, 0);
    if (bytesReceived <= 0) {
        std::cout << "[Port " << port << "] Client disconnected or error.\n";
        closesocket(client);
        return;
    }

    buffer[bytesReceived] = '\0';

    std::string request(buffer);
    std::cout << "[Port " << port << "] Received request:\n" << request << "\n";

    std::string response;
    std::string version_query;

    size_t get_pos = request.find("GET ");
    size_t http_pos = request.find("HTTP/", get_pos);

    if (get_pos == std::string::npos || http_pos == std::string::npos) {
        std::cout << "[Port " << port << "] Malformed request.\n";
        closesocket(client);
        return;
    }

    std::string url_path = request.substr(get_pos + 4, http_pos - get_pos - 5);
    std::cout << "[Port " << port << "] URL Path: " << url_path << "\n";

    if (url_path.find("..") != std::string::npos || url_path.find('\\') != std::string::npos) {
        std::string forbidden = "HTTP/1.1 403 Forbidden\r\nContent-Length: 0\r\nConnection: close\r\n\r\n";
        send(client, forbidden.c_str(), forbidden.length(), 0);
        std::cout << "[SECURITY] Detected directory traversal attempt: " << url_path << "\n";
        closesocket(client);
        return;
    }

    std::vector<std::string> allowed_files = {  //second safeguard
        "/" + LPServerInfo_file_path + std::to_string(LPServerInfo_ver) + "/LPServerInfo.dat",
        "/" + main_launcher_file_path + std::to_string(main_launcher_ver) + "/newRF.cab",
        "/" + PatchInfo_path + std::to_string(PatchInfo_ver) + "/PatchInfo.z"
        //"/Download/RF_Online.bin.tmp"   //todo: parse patchinfo.txt to create a dynamic whitelist, restrict to .tmp extension.
    };

    bool allowed = false;
    for (const auto& allowed_file : allowed_files) {
        if (url_path == allowed_file) {
            allowed = true;
            break;
        }
    }

    if (url_path.find("update.dll?") != std::string::npos) {
        size_t query_start = url_path.find("?");
        if (query_start != std::string::npos) {
            version_query = url_path.substr(query_start + 1);
        }

        int user_launcher_ver = atoi(version_query.c_str());

        if (user_launcher_ver < main_launcher_ver && user_launcher_ver > 0) {
            response += "[Update]\n";
            response += "NewVersion=" + std::to_string(main_launcher_ver) + "\n";
            response += "UpdateFileNumber=1\n";
            response += "UpdateFile1=" + main_launcher_file_path +
                (use_archive_three ? std::to_string(main_launcher_ver) + "/newRF.cab" : "/newRF.cab") + "\n";
            response += "ServerNumber=1\n";
            response += "Server1=http://" + main_launcher_host + "/\n";
            response += "[Launcher]\n";
            response += "LauncherVersion=" + std::to_string(main_launcher_ver) + "\n";
        }
        else if (user_launcher_ver >= main_launcher_ver) {
            response += "[Update]\nUpdateFileNumber=0\n";
        }
        else if (user_launcher_ver == 0) {
            if (port == 80) {
                response += "[Update]\n";
                response += "NewVersion=" + std::to_string(LPServerInfo_ver) + "\n";
                response += "UpdateFileNumber=1\n";
                response += "UpdateFile1=" + LPServerInfo_file_path +
                    (use_archive_three ? std::to_string(LPServerInfo_ver) + "/LPServerInfo.dat" : "/LPServerInfo.dat") + "\n";
                response += "ServerNumber=1\n";
                response += "Server1=http://" + LPServerInfo_host + "/\n";
            }
            else if (port == 10007) {
                response += "[Update]\n";
                response += "NewVersion=" + std::to_string(PatchInfo_ver) + "\n";
                response += "UpdateFileNumber=1\n";
                response += "UpdateFile1=" + PatchInfo_path +
                    (use_archive_three ? std::to_string(PatchInfo_ver) + "/PatchInfo.z" : "/PatchInfo.z") + "\n";
                response += "ServerNumber=1\n";
                response += "Server1=http://" + PatchInfo_host + "/\n";
            }
            else {
                closesocket(client);
                return;
            }
        }

        std::string headers = "HTTP/1.1 200 OK\r\nContent-Type: text/plain\r\nContent-Length: " +
            std::to_string(response.length()) + "\r\nConnection: close\r\n\r\n";
        send(client, (headers + response).c_str(), headers.length() + response.length(), 0);
        closesocket(client);
        return;
    }

    if (!allowed) {
        std::string forbidden = "HTTP/1.1 403 Forbidden\r\nContent-Length: 0\r\nConnection: close\r\n\r\n";
        send(client, forbidden.c_str(), forbidden.length(), 0);
        //std::cout << "[Debug] Attempted to access a non-existent or non-whitelisted file: " << url_path << "\n";
        closesocket(client);
        return;
    }

    try {
        fs::path base = fs::canonical(fs::current_path());  //third safeguard
        fs::path requested = fs::weakly_canonical(base / url_path.substr(1));

        if (requested.string().find(base.string()) != 0) {
            std::string forbidden = "HTTP/1.1 403 Forbidden\r\nContent-Length: 0\r\nConnection: close\r\n\r\n";
            send(client, forbidden.c_str(), forbidden.length(), 0);
            std::cout << "[SECURITY] Directory traversal attempt detected after canonicalization: " << requested << "\n";
            closesocket(client);
            return;
        }

        std::string file_content = read_file_contents(requested.string());

        if (!file_content.empty()) {
            std::string headers = "HTTP/1.1 200 OK\r\nContent-Type: application/octet-stream\r\nContent-Length: " +
                std::to_string(file_content.length()) + "\r\nConnection: close\r\n\r\n";
            send(client, headers.c_str(), headers.length(), 0);
            send(client, file_content.c_str(), file_content.length(), 0);
        }
        else {
            std::string not_found = "HTTP/1.1 404 Not Found\r\nContent-Length: 0\r\nConnection: close\r\n\r\n";
            send(client, not_found.c_str(), not_found.length(), 0);
            std::cout << "[Port " << port << "] File not found: " << requested << "\n";
        }

    }
    catch (const std::exception& ex) {
        std::cerr << "[ERROR] Exception while accessing file: " << ex.what() << "\n";
        std::string error = "HTTP/1.1 500 Internal Server Error\r\nContent-Length: 0\r\nConnection: close\r\n\r\n";
        send(client, error.c_str(), error.length(), 0);
    }

    closesocket(client);
}

void start_server(int port) {
    WSADATA wsaData;
    if (WSAStartup(MAKEWORD(2, 2), &wsaData) != 0) {
        std::cerr << "WSAStartup failed.\n";
        return;
    }

    SOCKET server = socket(AF_INET, SOCK_STREAM, 0);
    if (server == INVALID_SOCKET) {
        std::cerr << "Socket creation failed.\n";
        return;
    }

    SOCKADDR_IN serverAddr = {};
    serverAddr.sin_family = AF_INET;
    serverAddr.sin_addr.s_addr = INADDR_ANY;
    serverAddr.sin_port = htons(port);

    if (bind(server, (SOCKADDR*)&serverAddr, sizeof(serverAddr)) == SOCKET_ERROR) {
        std::cerr << "Bind failed on port " << port << "\n";
        closesocket(server);
        return;
    }

    if (listen(server, SOMAXCONN) == SOCKET_ERROR) {
        std::cerr << "Listen failed on port " << port << "\n";
        closesocket(server);
        return;
    }

    std::cout << "Listening on port " << port << "...\n";

    while (true) {
        SOCKET client = accept(server, nullptr, nullptr);
        if (client != INVALID_SOCKET) {
            std::thread(handle_client, client, port).detach();
        }
    }

    closesocket(server);
    WSACleanup();
}

int main() {
    load_config();

    std::thread server80(start_server, 80);
    std::thread server10007(start_server, 10007);

    server80.join();
    server10007.join();
    return 0;
}
