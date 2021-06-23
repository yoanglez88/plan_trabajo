# Plan de Trabajo

Módulo que permite crear planes de trabajo a partir de usuario y contraseña alojado en MySQL.

Se debe descargar NodeJS y Composer para utilizar los componentes que necesita el proyecto para su ejecución.

## Utilizar NodeJS:
Descargar e instalar el binario desde https://nodejs.org/es/download/

### Instalar los componentes a utilizar con NodeJS:
* npm
```sh
npm i fullcalendar@5.8.0
```
```sh
npm i jquery@3.6.0
```
```sh
npm i bootstrap@5.0.2
```

## Utilizar Composer:
Ejecutar en una consola para descargar e instalar composer:
```sh 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" 
php composer-setup.php
```

Luego en un archivo de comandos:
```sh
@echo off
setlocal disabledelayedexpansion
php "%~dp0composer.phar" %*
```
Agregar al path la ruta donde se encuentra el archivo de comandos.

### Instalar los componentes a utilizar con composer:
Estos componentes son necesario para el funcionamiento del proyecto.
* composer
```sh
composer require lincanbin/php-pdo-mysql-class:1.18
```
```sh
composer require phpoffice/phpspreadsheet:2.2
```
