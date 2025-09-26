//#define DATEFIX_ENABLE_LOG

#include <windows.h>
#include "include/MinHook.h"
#include <time.h>

#ifdef DATEFIX_ENABLE_LOG
#include <fstream>
#include <mutex>
#include <string>
#endif

typedef unsigned int(WINAPI* tGetKorLocalTime)();
typedef unsigned int(WINAPI* tGetConnectTime_AddBySec)(int);

tGetKorLocalTime oGetKorLocalTime = nullptr;
tGetConnectTime_AddBySec oGetConnectTime_AddBySec = nullptr;

#ifdef DATEFIX_ENABLE_LOG
static std::ofstream g_LogFile;
static std::mutex g_LogMutex;

void Log(const std::string& msg) {
    std::lock_guard<std::mutex> lock(g_LogMutex);
    if (g_LogFile.is_open()) {
        g_LogFile << msg << std::endl;
        g_LogFile.flush();
    }
}
#else
#define Log(x) ((void)0)
#endif

unsigned int WINAPI hkGetKorLocalTime() {
    time_t now = time(nullptr);
    struct tm tm {};

    if (localtime_s(&tm, &now) != 0) {
        Log("[datefix] hkGetKorLocalTime: localtime_s failed");
        return 0;
    }

    unsigned long long result =
        (tm.tm_year % 100) * 100000000ULL +
        (tm.tm_mon + 1) * 1000000ULL +
        tm.tm_mday * 10000ULL +
        tm.tm_hour * 100ULL +
        tm.tm_min;

    unsigned int finalResult = (result > UINT_MAX) ? 0 : static_cast<unsigned int>(result);

    Log("[datefix] hkGetKorLocalTime called -> " + std::to_string(finalResult));
    return finalResult;
}

unsigned int WINAPI hkGetConnectTime_AddBySec(int iSec) {
    time_t origTime;
    time(&origTime);

    struct tm tm {};
    if (localtime_s(&tm, &origTime) != 0) {
        Log("[datefix] hkGetConnectTime_AddBySec: localtime_s failed");
        return 0;
    }

    tm.tm_sec += iSec;
    time_t adjusted = mktime(&tm);
    if (adjusted == -1) {
        Log("[datefix] hkGetConnectTime_AddBySec: mktime failed");
        return 0;
    }
    if (localtime_s(&tm, &adjusted) != 0) {
        Log("[datefix] hkGetConnectTime_AddBySec: localtime_s failed");
        return 0;
    }

    unsigned long long result =
        (tm.tm_year % 100) * 100000000ULL +
        (tm.tm_mon + 1) * 1000000ULL +
        tm.tm_mday * 10000ULL +
        tm.tm_hour * 100ULL +
        tm.tm_min;

    unsigned int finalResult = (result > UINT_MAX) ? 0 : static_cast<unsigned int>(result);

    Log("[datefix] hkGetConnectTime_AddBySec called (" + std::to_string(iSec) + "s) -> " + std::to_string(finalResult));
    return finalResult;
}

static bool g_HooksInitialized = false;

void HookFunctions() {
    if (g_HooksInitialized) return;

    if (MH_Initialize() != MH_OK) {
        Log("[datefix] MH_Initialize failed");
        return;
    }

    if (MH_CreateHook((LPVOID)0x140480680, &hkGetKorLocalTime, (LPVOID*)&oGetKorLocalTime) == MH_OK) {
        MH_EnableHook((LPVOID)0x140480680);
        Log("[datefix] Hooked GetKorLocalTime successfully");
    }
    else {
        Log("[datefix] Failed to hook GetKorLocalTime");
    }

    if (MH_CreateHook((LPVOID)0x14043CB80, &hkGetConnectTime_AddBySec, (LPVOID*)&oGetConnectTime_AddBySec) == MH_OK) {
        MH_EnableHook((LPVOID)0x14043CB80);
        Log("[datefix] Hooked GetConnectTime_AddBySec successfully");
    }
    else {
        Log("[datefix] Failed to hook GetConnectTime_AddBySec");
    }

    g_HooksInitialized = true;
    Log("[datefix] Hooks initialized");
}

extern "C" __declspec(dllexport) void datefix() {
    HookFunctions();
    Log("[datefix] datefix() called");
}

BOOL APIENTRY DllMain(HMODULE hModule, DWORD ul_reason_for_call, LPVOID lpReserved) {
    if (ul_reason_for_call == DLL_PROCESS_ATTACH) {
        DisableThreadLibraryCalls(hModule);

#ifdef DATEFIX_ENABLE_LOG
        char path[MAX_PATH];
        GetModuleFileNameA(hModule, path, MAX_PATH);
        std::string logPath = std::string(path) + ".log";

        g_LogFile.open(logPath, std::ios::out | std::ios::app);
        if (g_LogFile.is_open()) {
            Log("[datefix] Log file opened: " + logPath);
        }
#endif

        HookFunctions();
        Log("[datefix] DLL_PROCESS_ATTACH -> hooks set");
    }
    else if (ul_reason_for_call == DLL_PROCESS_DETACH) {
        Log("[datefix] DLL_PROCESS_DETACH -> cleaning up");
		
#ifdef DATEFIX_ENABLE_LOG
        if (g_LogFile.is_open()) {
            g_LogFile.close();
        }
#endif
    }
    return TRUE;
}
