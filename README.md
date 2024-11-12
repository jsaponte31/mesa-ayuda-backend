<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Mesa de Ayuda - Documentación

## Sobre la aplicación

Esta es una aplicación que permite el manejo de solicitudes y peticiones en una mesa de ayuda para actividades de la empresa, proporcionando una herramienta útil para el manejo administrativo de los movimientos que se realicen.

## Requisitos

Para poder instalar el proyecto, asegúrate de tener instalado:

- **PHP** 8.2 o superior
- **Laravel** 5.7.1 o superior
- **Composer** 2.7.2 o superior
*** 
## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:

1. **Clonar el repositorio**
~~~
git clone https://github.com/jsaponte31/mesa-ayuda-backend.git
~~~
luego crear un archivo .env con las variables de entorno de ejemplo en .env.example modificando su base de datos y sus respectivos requerimientos

2. **ejecutar el comando para instalar composer**
~~~
composer install 
~~~
**ejecutar**
~~~ 
php artisan migrate:refresh --seed
~~~
**ejecutar**
~~~
php artisan serve
~~~
