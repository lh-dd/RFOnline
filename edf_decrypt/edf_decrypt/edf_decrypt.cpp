#include <iostream>
#include <fstream>
#include <vector>
//#include <cstdint>
//#include <string>
//#include <algorithm>

constexpr size_t HEADER_LENGTH = 29;
constexpr size_t MAX_KEY_LENGTH = 256;

std::string get_output_path(const std::string& inputPath) {
    std::string outputPath = inputPath;
    size_t pos = outputPath.find_last_of('.');
    if (pos != std::string::npos && outputPath.substr(pos) == ".edf") {
        outputPath.replace(pos, 4, ".dat");
    }
    else {
        outputPath += ".dat";
    }
    return outputPath;
}

std::ifstream get_read_stream(const std::string& path) {
    std::ifstream file(path, std::ios::binary);
    if (!file) {
        std::cerr << "Failed to open file: " << path << std::endl;
        exit(EXIT_FAILURE);
    }
    return file;
}

int main(int argc, char* argv[]) {
    if (argc < 2) {
        std::cerr << "Usage: " << argv[0] << " <input_file.edf>" << std::endl;
        return 1;
    }

    std::string path = argv[1];
    std::string outputPath = get_output_path(path);

    uint32_t l_dwSourceStringLength;
    uint8_t m_pHeader[HEADER_LENGTH];
    uint8_t m_pKey[MAX_KEY_LENGTH];

    std::ifstream io_file = get_read_stream(path);
    io_file.read(reinterpret_cast<char*>(m_pHeader), sizeof(m_pHeader));
    io_file.read(reinterpret_cast<char*>(&l_dwSourceStringLength), sizeof(l_dwSourceStringLength));

    std::vector<uint8_t> vecData(l_dwSourceStringLength, uint8_t{ 0 });
    io_file.read(reinterpret_cast<char*>(vecData.data()), l_dwSourceStringLength);
    io_file.read(reinterpret_cast<char*>(m_pKey), sizeof(m_pKey));

    // Decrypt key
    {
        const uint8_t DIGIT[8] = { 1, 2, 4, 8, 16, 32, 64, 128 };
        bool l_bEven = true;

        for (size_t i = 0; i < MAX_KEY_LENGTH; ++i) {
            if (l_bEven) {
                m_pKey[i] -= DIGIT[(i + 1) % 8];
                l_bEven = false;
            }
            else {
                m_pKey[i] += DIGIT[(i + 1) % 8];
                l_bEven = true;
            }
        }

        for (size_t i = 0; i < MAX_KEY_LENGTH / 2; ++i) {
            std::swap(m_pKey[i], m_pKey[MAX_KEY_LENGTH - 1 - i]);
        }

        for (size_t i = 0; i + 1 < MAX_KEY_LENGTH; i += 2) {
            std::swap(m_pKey[i], m_pKey[i + 1]);
        }
    }

    // Decrypt body
    {
        bool l_bEven = true;
        for (size_t i = 0; i < vecData.size(); ++i) {
            if (l_bEven) {
                vecData[i] -= m_pKey[(i + 1) % MAX_KEY_LENGTH];
                l_bEven = false;
            }
            else {
                vecData[i] += m_pKey[(i + 1) % MAX_KEY_LENGTH];
                l_bEven = true;
            }
        }
    }

    std::ofstream outputFile(outputPath, std::ios::binary);
    if (!outputFile) {
        std::cerr << "Failed to write to: " << outputPath << std::endl;
        return 1;
    }
    outputFile.write(reinterpret_cast<char*>(vecData.data()), vecData.size());

    std::cout << "Decrypted data saved to: " << outputPath << std::endl;
    return 0;
}