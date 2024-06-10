
laravel-admin installation
1_ composer require encore/laravel-admin
2_ php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
3_ php artisan admin:install

Prepare the db
1_ php artisan migrate
2_ php artisan admin:install
3_ php artisan db:seed
