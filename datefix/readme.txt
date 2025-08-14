Stand-alone date fix for 2232.

- Does not require any guard.

Compile:

Visual Studio 2022
Windows 10 SDK
Compile as 'Release x64'

Usage:

1. Use CFF Explorer to add the datefix.dll to the ZoneServerUD_x64.exe
2. Hex the values specified in the 'zone hex.txt'
3. Place the datefix.dll in the same folder as the ZoneServerUD_x64.exe
4. Run the database update 'datefix.sql'