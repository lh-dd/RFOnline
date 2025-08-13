#include "crc.h"
#include <cstdio>
#include <cstdlib>
#include <cstring>

CCRC32::CCRC32() {
    Initialize();
}

CCRC32::~CCRC32() {
}

void CCRC32::Initialize() {
    unsigned int dwPolynomial = 0xEDB88320;
    memset(&dwLookupTable, 0, sizeof(dwLookupTable));

    for (int i = 0; i < 256; ++i) {
        int a = i >> 1;
        if (i & 1) a ^= dwPolynomial;
        int b = (a & 1) ? dwPolynomial ^ (a >> 1) : a >> 1;
        int c = (b & 1) ? dwPolynomial ^ (b >> 1) : b >> 1;
        int d = (c & 1) ? dwPolynomial ^ (c >> 1) : c >> 1;
        int e = (d & 1) ? dwPolynomial ^ (d >> 1) : d >> 1;
        int f = (e & 1) ? dwPolynomial ^ (e >> 1) : e >> 1;
        int g = (f & 1) ? dwPolynomial ^ (f >> 1) : f >> 1;
        int nresult = (g & 1) ? dwPolynomial ^ (g >> 1) : g >> 1;
        dwLookupTable[i] = nresult;
    }
}

void CCRC32::PartialCRC(unsigned int* dwCRC, const unsigned char* sData, size_t iDataLength) {
    while (iDataLength--) {
        *dwCRC = (*dwCRC >> 8) ^ dwLookupTable[(*dwCRC & 0xFF) ^ *sData++];
    }
}

bool CCRC32::FileCRC(const char* sFileName, unsigned int* dwOutCRC, size_t iBufferSize) {
    *dwOutCRC = 0xFFFFFFFF;

    FILE* fSource = nullptr;
    unsigned char* sBuf = nullptr;

    if (fopen_s(&fSource, sFileName, "rb") != 0 || !fSource)
        return false;

    sBuf = static_cast<unsigned char*>(malloc(iBufferSize));
    if (!sBuf) {
        fclose(fSource);
        return false;
    }

    size_t iBytesRead = 0;
    while ((iBytesRead = fread(sBuf, sizeof(char), iBufferSize, fSource))) {
        PartialCRC(dwOutCRC, sBuf, iBytesRead);
    }

    free(sBuf);
    fclose(fSource);

    *dwOutCRC ^= 0xFFFFFFFF;
    return true;
}

bool CCRC32::FileCRC(const char* sFileName, unsigned int* iOutCRC) {
    return FileCRC(sFileName, iOutCRC, 1048576); // 1MB buffer
}
