copy .env.example .env
call composer install
call php artisan key:generate --ansi
php artisan migrate --seed