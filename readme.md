<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention
1. copy composer to C:\ProgramData\ComposerSetup\bin 👉 optional
2. install php up to 8
3. remove ";" extention pgsql & pdo_pgsql in php.ini

## Instalation
1. move project in directory xampp/htdoc or laragon/www
2. copy .env.example .env if .env not exists
3. configuration database in file .env
4. run in cmd project 👉 php artisan storage:link
5. run in cmd project 👉 php artisan config:cache
5. run in cmd project 👉 php artisan config:clear
5. run in cmd project 👉 php artisan migrate:fresh --seed
6. run install.cmd for install service 👉 optional
7. aplication ready for use, open localhost/boilerplate
