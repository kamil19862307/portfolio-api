<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Portfolio API

Backend portfolio приложение для фронта.


### Установка

- Склонировать репозиторий из гитхаба


- Перейти в репозирорий с проектом


- Команды для докера настроены для работы из корня каталога проекта, в директорию src (там находится laravel)
  переключаться не надо, разве что когда файл окружения создавать будете .env


- Поднять контейнеры докера (в репозитории уже есть docker-compose.yml с nginx, MySQL и composer)
```bash

docker compose up -d
```

- Установить PHP-зависимости (Composer)
```bash

docker compose exec app composer install
```

- Скопировать (создать) файл окружения в директории src
```bash

cd src
```
```bash

cp .env.example .env
```

- Вернуться в корневой каталог
```bash

cd ..
```

- Сгенерировать ключ laravel
```bash

docker compose exec app php artisan key:generate
```

- Выполнить миграцию и заполнить базу данных тестовыми данными
```bash

docker compose exec app php artisan migrate --seed
```

- Если всё прошло успешно, то проект будет доступен по адресу (порт 8080) http://localhost:8080.

### Конечные точки API / Доступные маршруты

Проект предоставляет **RESTful API** для управления постами. 

Для примера, ниже приведена таблица с основными доступными маршрутами и их назначением.

| **Verb** | **URI** | **Action** | **Route Name** |
| :--- | :--- | :--- | :--- |
| GET | /posts | index | posts.index |
| GET | /posts/create | create | posts.create |
| POST | /posts | store | posts.store |
| GET | /posts/{post} | show | posts.show |
| GET | /posts/{post}/edit | edit | posts.edit |
| PUT/PATCH | /posts/{post} | update | posts.update |
| DELETE | /posts/{post} | destroy | posts.destroy |

- **{post}** в URI обозначает идентификатор конкретного поста.
- Например, хотим изменить пост с id 3, выбираем метод PUT/PATCH и адрес будет такой: http://localhost:8080/api/posts/3



### Какие могут возникнуть проблемы при устаовке:

- Если комп достаточно старый, то может не "подняться" контейнер с базой данных, проверить можно командой:
```bash

docker ps
```

В таком случае можно понизить версию дазы данных на более старую. В корневой директории находим
docker-compose.yml и меняем строку **image: mysql:8.0** на **image: mysql:5.7**

### Как обращаться к сервисам в докере

Обращаться к сервисам из корневой директории проекта через:

docker compose exec app

Например установить зависимости:

docker compose exec app composer install

Или сгенерировать ключ ларавель:

docker compose exec app php artisan key:generate

Или хотим создать контроллер:

docker compose exec app php artisan make:controller CustomerController

Или поработать с композером:

docker compose exec app composer require laravel/sanctum
