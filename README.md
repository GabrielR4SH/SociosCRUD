<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Como rodar o projeto
- Configure seu .ENV para conexão com o banco [.ENV.example]
- abra um terminal no diretorio do projeto e digite:`composer install`
- abra outro terminal no diretorio do projeto digite: `npm install && npm run dev`
- Rode o comando das migrações junto com o Seeder: `php artisan migrate --seed` 
- php artisan test para rodar os testes unitarios do projeto (Fiz testes de autenticação e de recebimento de socios silvers apenas para usuarios silvers)

## O projeto
![lsllss](https://github.com/GabrielR4SH/SociosCrud/assets/59832080/dc78f949-d079-44c6-a7ab-d69b6b815d8e)

<hr>

- Quando o projeto estiver rodando você deve clickar em login ou em registrar no campo superior direito
- email: test@example.com password: 123pass <- Esse é um usuario tipo Gold que você pode fazer pra testar
