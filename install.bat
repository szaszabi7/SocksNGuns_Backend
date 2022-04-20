copy .env.example .env
composer install
php artisan key:generate --ansi
php artisan migrate --seed