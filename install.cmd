@echo off
set "params=%*"
cd /d "%~dp0" && ( if exist "%temp%\getadmin.vbs" del "%temp%\getadmin.vbs" ) && fsutil dirty query %systemdrive% 1>nul 2>nul || (  echo Set UAC = CreateObject^("Shell.Application"^) : UAC.ShellExecute "cmd.exe", "/k cd ""%~sdp0"" && %~s0 %params%", "", "runas", 1 >> "%temp%\getadmin.vbs" && "%temp%\getadmin.vbs" && exit /B )
if /i "%PROCESSOR_ARCHITECTURE%" equ "X86" (
if /i "%PROCESSOR_ARCHITEW6432%" equ "AMD64" (
set OSARCH=x64
echo This is a 64-bit architecture running in 32-bit mode.
) else (
set OSARCH=x86
echo This is a 32-bit architecture running in 32-bit mode.
)
) else (
set OSARCH=x64
echo This is a 64-bit architecture running in 64-bit mode.
)
:begin
cls
echo A: Install Service
echo B: Edit Service
echo C: Remove Service
echo N: Exit
choice /C:ABCN /N /T 10 /D C /M:"Chose menu A:, B:, C: or None?"
if %errorlevel% equ 1 goto install
if %errorlevel% equ 2 goto edit
if %errorlevel% equ 3 goto remove
if %errorlevel% equ 4 goto exit
goto exit
:install
echo .
set /p SERVICE_NAME="Enter Install Service Name: "
choice /C:YN /M:"Confirm install service %SERVICE_NAME% ?? [YN]"
if %errorlevel% equ 2 goto begin
set PHP_HOME="%~dp0php"
set /p PORT="Enter %SERVICE_NAME% Port: "
echo .
.\service\x64\service install %SERVICE_NAME%
goto begin
:remove
echo .
set /p SERVICE_NAME="Enter Remove Service Name: "
choice /C:YN /M:"Confirm remove service %SERVICE_NAME% ?? [YN]"
if %errorlevel% equ 2 goto begin
service\%OSARCH%\service remove %SERVICE_NAME% confirm
goto begin
:edit
echo .
set /p SERVICE_NAME="Enter Edit Service Name: " 
choice /C:YN /M:"Confirm edit service %SERVICE_NAME% ?? [YN]"
if %errorlevel% equ 2 goto begin
service\%OSARCH%\service edit %SERVICE_NAME%
goto begin
:exit
pause