<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About MCQ TEST

There should be two kinds of the Users into the system. Admin & Guest.

- Guests will only visit the created portal and appear for MCQ Test.
- Admin can view all the candidates applied for the test.
- The question and answer should be fetched using the API provided [opentdb api](https://opentdb.com/api.php?amount=10).
- after all questions are done the score will be display to the candidate.
## Requirements
PHP 7.3+

## Installation
Clone The Current Project
```sh
    git clone https://github.com/tusharsawant2427/mcq-test.git 
```

Run the following Command
```sh
    php artisan composer:install
```

Setup env file

Run the following Command
```sh
    php artisan migrate:refresh --seed
```

## Getting started

Admin Login URL: `http://localhost:8000/admin/login`
Email: `admin@gmail.com`
Password: `12345678`

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
