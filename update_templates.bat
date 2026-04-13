@echo off
REM تحديث جميع ملفات Blade لاستخدام layout موحد
REM هذا الـ script سيحدث جميع الملفات التي تستخدم @extends('layout.header')

setlocal enabledelayedexpansion

set "views_path=resources\views"
set "count=0"

echo.
echo ====================================
echo تحديث Blade Templates
echo ====================================
echo.

for /r "%views_path%" %%F in (*.blade.php) do (
    findstr /M "layout.header" "%%F" >nul
    if !ERRORLEVEL! equ 0 (
        echo تحديث: %%F
        powershell -Command "& {(Get-Content '%%F' -Raw) -replace '@extends\(.[^)]*layout\.header[^)]*\)','@extends(''layout'')' | Set-Content '%%F'}"
        set /a count=!count!+1
    )
)

echo.
echo ====================================
echo تم تحديث %count% ملف
echo ====================================
echo.
pause
