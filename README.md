склонировать преокт на локальный сервер(в моем случае был OS panel, но можно любой)<br>
cp .env.example .env<br>
composer install<br>
php artisan key:generate<br>
в файле .env добавить свои данные для подключения к БД<br>
в папке dump есть дамп БД<br>
php artisan migrate<br>
