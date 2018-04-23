@echo off
echo Setting up SCR4-Projekt Database...
SET MYSQL_PATH=C:\XAMPP\mysql\bin
%MYSQL_PATH%\mysql.exe -u root --default-character-set=utf8 < setup.sql
echo Done!
pause