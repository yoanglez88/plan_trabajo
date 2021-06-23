# Plan de Trabajo

Módulo que permite crear planes de trabajo a partir de usuario y contraseña alojado en MySQL.

Se debe descargar NodeJS y Composer para utilizar los componentes que necesita el proyecto para su ejecución.

## Utilizar NodeJS:
Descargar e instalar el binario desde https://nodejs.org/es/download/

### Instalar los componentes a utilizar con NodeJS:
* npm
```sh
npm i fullcalendar@5.8.0
npm i jquery@3.6.0
npm i bootstrap@5.0.2
```
Si estas detrás de un proxy:
```sh
npm config set proxy http://[user]:[pass]@[server]:[port]
```

## Utilizar Composer:
Ejecutar en una consola para descargar e instalar composer:
```sh 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 
php composer-setup.php
```
Si estas detrás de un proxy, utiliza curl donde el binario se encuentra en https://curl.se/windows/, y ejecutas los siguientes comandos:
```sh 
curl --proxy "http://[user]:[pass]@[server]:[port]" https://getcomposer.org/installer > composer-setup.php
php composer-setup.php
```
En un archivo de comandos con nombre "composer" escribe las siguientes lineas:
```sh
@echo off
setlocal disabledelayedexpansion
php "%~dp0composer.phar" %*
```

### Instalar los componentes a utilizar con composer:
Si estas detrás de un proxy, ejecutar el comando:
```sh
set http_proxy=http://[user]:[pass]@[server]:[port]
```
Se ejecuta el archivo de comandos con nombre "composer" con  parametros de los nombres de componentes:
* composer
```sh
composer require lincanbin/php-pdo-mysql-class:2.2
composer require phpoffice/phpspreadsheet:1.18
```
