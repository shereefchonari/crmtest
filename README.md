Installation

1. Clone the repository

2. Install dependencies
    composer install

3. Create .env file

4. Generate application key
    php artisan key:generate

5. Configure database in .env

Example:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm_test
DB_USERNAME=root
DB_PASSWORD=

6. Run migrations
php artisan migrate

Run all tests
php artisan test