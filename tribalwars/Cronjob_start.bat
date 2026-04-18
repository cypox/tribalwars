@echo off
:loop
php.exe -f "C:\AppServ\www\tribalwars\wereld1\daemons\event.php"
timeout /t 1 /nobreak >nul
goto loop
