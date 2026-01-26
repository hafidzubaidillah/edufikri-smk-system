@echo off
echo Creating desktop shortcuts...

set "desktop=%USERPROFILE%\Desktop"
set "currentdir=%CD%"

REM Create shortcut for main launcher
echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\shortcut.vbs"
echo sLinkFile = "%desktop%\SMK IT Ihsanul Fikri - Start.lnk" >> "%temp%\shortcut.vbs"
echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\shortcut.vbs"
echo oLink.TargetPath = "%currentdir%\setup-and-run.bat" >> "%temp%\shortcut.vbs"
echo oLink.WorkingDirectory = "%currentdir%" >> "%temp%\shortcut.vbs"
echo oLink.Description = "Start SMK IT Ihsanul Fikri Web Application" >> "%temp%\shortcut.vbs"
echo oLink.Save >> "%temp%\shortcut.vbs"
cscript "%temp%\shortcut.vbs" >nul

REM Create shortcut for stop
echo Set oWS = WScript.CreateObject("WScript.Shell") > "%temp%\shortcut2.vbs"
echo sLinkFile = "%desktop%\SMK IT Ihsanul Fikri - Stop.lnk" >> "%temp%\shortcut2.vbs"
echo Set oLink = oWS.CreateShortcut(sLinkFile) >> "%temp%\shortcut2.vbs"
echo oLink.TargetPath = "%currentdir%\stop-all.bat" >> "%temp%\shortcut2.vbs"
echo oLink.WorkingDirectory = "%currentdir%" >> "%temp%\shortcut2.vbs"
echo oLink.Description = "Stop SMK IT Ihsanul Fikri Web Application" >> "%temp%\shortcut2.vbs"
echo oLink.Save >> "%temp%\shortcut2.vbs"
cscript "%temp%\shortcut2.vbs" >nul

del "%temp%\shortcut.vbs" 2>nul
del "%temp%\shortcut2.vbs" 2>nul

echo ✓ Desktop shortcuts created!
echo   - SMK IT Ihsanul Fikri - Start.lnk
echo   - SMK IT Ihsanul Fikri - Stop.lnk
pause