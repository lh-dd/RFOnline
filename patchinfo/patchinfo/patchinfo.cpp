#include <windows.h>
#include <iostream>
#include <fstream>
#include <string>
#include <vector>
#include <filesystem>
#include <cstdlib>
#include "crc.h"

#define PATCHFOLDER "patch_folder\\"
#define XOR_KEY "Rf_Online!"

struct FileInfo {
    std::string m_sName;
};

class SADir {
public:
    void GetFiles(const std::string&) {
        files.clear();
        for (const auto& entry : std::filesystem::recursive_directory_iterator(".")) {
            if (!entry.is_directory()) {
                files.push_back({ entry.path().string() });
            }
        }
    }

    std::vector<FileInfo>& Files() { return files; }

private:
    std::vector<FileInfo> files;
};

int main() {
    SetCurrentDirectoryA(PATCHFOLDER);

    SADir dir;
    dir.GetFiles("*.*");

    SetCurrentDirectoryA("..\\");

    auto files = dir.Files();
    int fileCount = static_cast<int>(files.size());

    std::ofstream ofs("PatchInfo.txt", std::ios::trunc);
    if (!ofs.is_open()) {
        std::cerr << "Failed to open PatchInfo.txt for writing.\n";
        return 1;
    }

    ofs << fileCount << std::endl;

    std::string cryptdata;
    char buffer[16];

    srand(GetTickCount());

    int byXORA = rand() % 10000;
    int byXORB = rand() % 10000;
    _itoa_s(byXORA, buffer, 10); char sizeA = (char)strlen(buffer); cryptdata += buffer;
    _itoa_s(byXORB, buffer, 10); char sizeB = (char)strlen(buffer); cryptdata += buffer;
    _itoa_s(fileCount, buffer, 10); cryptdata += buffer;
    _itoa_s(sizeA, buffer, 10); cryptdata += buffer;
    _itoa_s(sizeB, buffer, 10); cryptdata += buffer;

    for (char& c : cryptdata) c ^= '\x5e';
    ofs << cryptdata << std::endl;

    // Obfuscation with XOR_KEY
    char original[11] = XOR_KEY;
    char xorBuf[11];

    for (int i = 0; i < 11; i++) {
        xorBuf[i] = (char)(rand() % 255);
        original[i] ^= xorBuf[i];
        original[i] += (char)byXORA;
        original[i] ^= (char)byXORB;
        original[i] += (char)byXORB;
        original[i] ^= (char)byXORA;
        xorBuf[i] += (char)byXORB;
        xorBuf[i] ^= (char)byXORA;
        xorBuf[i] += (char)byXORA;
        xorBuf[i] ^= (char)byXORB;
    }

    ofs.write(original, 11); ofs << std::endl;
    ofs.write(xorBuf, 11); ofs << std::endl;

    CCRC32 m_CRC32;

    for (const auto& file : files) {
        unsigned int dwCRCHASH = 0;
        std::string crcpath = PATCHFOLDER + file.m_sName;

        if (m_CRC32.FileCRC(crcpath.c_str(), &dwCRCHASH)) {
            ofs << file.m_sName << " " << dwCRCHASH << std::endl;
        }
        else {
            std::cerr << "CRC failed for: " << file.m_sName << std::endl;
        }
    }

    ofs.close();
    std::cout << "PatchInfo.txt created with " << fileCount << " files" << std::endl;
    return 0;
}
