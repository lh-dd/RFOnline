#include <windows.h>
#include <iostream>
#include "include/MinHook.h"
#include <time.h>

// Original function pointers
typedef unsigned int(WINAPIV* tGetKorLocalTime)();
typedef unsigned int(WINAPIV* tGetConnectTime_AddBySec)(int);

tGetKorLocalTime oGetKorLocalTime = nullptr;
tGetConnectTime_AddBySec oGetConnectTime_AddBySec = nullptr;

// Hooked function implementations
unsigned int WINAPIV hkGetKorLocalTime() {
    char szDate[32], szTime[32];
    _strdate(szDate);
    _strtime(szTime);

    char szLocalTime[32];
    // Year..(6, 7)
    szLocalTime[0] = szDate[6];
    szLocalTime[1] = szDate[7];

    // Month..(0, 1)
    szLocalTime[2] = szDate[0];
    szLocalTime[3] = szDate[1];

    // Day..(3, 4)
    szLocalTime[4] = szDate[3];
    szLocalTime[5] = szDate[4];

    // Second..(0, 1)
    szLocalTime[6] = szTime[0];
    szLocalTime[7] = szTime[1];

    // Minute..(3, 4)
    szLocalTime[8] = szTime[3];
    szLocalTime[9] = szTime[4];

    szLocalTime[10] = NULL;
    return (unsigned int)atoll(szLocalTime);
}

unsigned int WINAPIV hkGetConnectTime_AddBySec(int iSec) {
    struct tm* Tm;
    time_t origTime, afterTime;
    ::time(&origTime);
    Tm = ::localtime(&origTime);
    Tm->tm_sec += iSec;
    afterTime = mktime(Tm);

    char Dest[32];
    sprintf(Dest, "%01d%02d%02d%02d%02d",
        (unsigned int)(Tm->tm_year - 100),
        (unsigned int)(Tm->tm_mon + 1),
        (unsigned int)(Tm->tm_mday),
        (unsigned int)(Tm->tm_hour),
        (unsigned int)(Tm->tm_min));

    return (unsigned int)atoll(Dest);
}

// Hook setup function
void HookFunctions() {
    if (MH_Initialize() != MH_OK) {
        return;
    }

    // Hook GetKorLocalTime
    if (MH_CreateHook((LPVOID)0x140480680, &hkGetKorLocalTime, (LPVOID*)&oGetKorLocalTime) == MH_OK) {
        MH_EnableHook((LPVOID)0x140480680);
    }

    // Hook GetConnectTime_AddBySec
    if (MH_CreateHook((LPVOID)0x14043CB80, &hkGetConnectTime_AddBySec, (LPVOID*)&oGetConnectTime_AddBySec) == MH_OK) {
        MH_EnableHook((LPVOID)0x14043CB80);
    }
}

// Exported function for use with CFF Explorer Import Adder
extern "C" __declspec(dllexport) void datefix() {
    HookFunctions();
}

// DLL Entry Point
BOOL APIENTRY DllMain(HMODULE hModule, DWORD ul_reason_for_call, LPVOID lpReserved) {
    if (ul_reason_for_call == DLL_PROCESS_ATTACH) {
        DisableThreadLibraryCalls(hModule);
        HookFunctions();
    }
    return TRUE;
}
