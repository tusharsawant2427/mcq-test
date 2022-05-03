<p align="center">MCQ TEST </p>

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
