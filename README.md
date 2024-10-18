## шаги запуска с нуля

composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
./vendor/bin/sail artisan queue:work

открыть http://0.0.0.0