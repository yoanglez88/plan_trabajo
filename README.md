# plan_trabajo

Módulo que permite crear planes de trabajo a partir de usuario y contraseña alojado en MySQL.

Para instalar los componenetes que se utiliza para la gestión de eventos en el calendario se debe instalar:

Primero ejecutar en una consola para descargar e instalar composer: php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" php composer-setup.php

Luego en un archivo de comandos: setlocal disabledelayedexpansion php "%~dp0composer.phar" %*

Instalar los componentes a utilizar: composer require lincanbin/php-pdo-mysql-class composer require phpoffice/phpspreadsheet composer require twbs/bootstrap:4.5.3
