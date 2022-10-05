# Arch Market
Online store project based on <a href="https://tz.cutcode.ru">tz.cutcode.ru</a>

## Sail alias
`alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'`

## Install and Run
`composer install`

`cp .env.example .env`

`php artisan key:generate`

`sail up -d`

`sail yarn && sail yarn build`
