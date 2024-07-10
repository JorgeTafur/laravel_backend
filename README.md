
## Prerequisitos

- Xampp, Composer, Nodejs, Npm
- IDE recomendado: Visual Studio Code
- Extensiones recomendadas: Thunder client, Sqlite viewer

## Instalación

- composer install
- php artisan migrate (si desea usar sqlite, sino cambiar datos de BD en .env)

## Correr proyecto

- php artisan serve

## Endpoints

- http://localhost:8000/students
- http://localhost:8000/students/{id}
- http://localhost:8000/teachers
- http://localhost:8000/teachers/{id}