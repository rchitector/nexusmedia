## шаги запуска с нуля

1. composer install
2. cp .env.example .env
3. ./vendor/bin/sail up
4. ./vendor/bin/sail artisan key:generate
5. ./vendor/bin/sail artisan migrate
6. ./vendor/bin/sail npm install
7. ./vendor/bin/sail npm run build
8. ./vendor/bin/sail artisan queue:work
9. открыть http://0.0.0.0