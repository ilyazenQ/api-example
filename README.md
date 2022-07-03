<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## CRUD API

Проект - пример реализации CRUD API. Технологии: сборка - docker, фреймворк - Laravel 9, документация - swagger, запросы - SpatieQueryBuilder, тесты - Pest, полнотекстовый поиск: Elastic.

## Разворот

1. `git clone git@github.com:ilyazenQ/api-example.git
   <new-repo-name>`
2. `docker-compose up -d`
3. `docker exec -it app_app bash`
4. `composer i`
5. `cp .env.example .env`
6. Указываем в .env доступы к БД<br>
DB_CONNECTION=mysql  <br>
   DB_HOST=db <br>
   DB_PORT=3306 <br>
   DB_DATABASE=app <br>
   DB_USERNAME=root<br>
   DB_PASSWORD=root<br>
и ElasticSearch: 
   ELASTICSEARCH_HOSTS=app_es01
   (Если проблема с доступом - chmod 777 -R ./)
7. `php artisan key:generate`
8. `php artisan storage:link`
9. `php artisan migrate`

## *Swagger & Pest

Swagger: директория ./storage/api-docs, доступен по url: http://localhost:8877/api/documentation#/posts. <br>
Тесты: директория ./tests/Feature, запуск тестов: ./vendor/bin/pest

