#pragma once

#include <cstddef>

class CCRC32
{
public:
    CCRC32();
    ~CCRC32();

    void Initialize();
    void PartialCRC(unsigned int* iCRC, const unsigned char* sData, size_t iDataLength);
    bool FileCRC(const char* sFileName, unsigned int* iOutCRC);
    bool FileCRC(const char* sFileName, unsigned int* iOutCRC, size_t iBufferSize);

private:
    unsigned int dwLookupTable[256];
};
