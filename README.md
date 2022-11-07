# amc-reporter


Steps are below:

1. Create .env file
	add database name in your phpmyadmin below is phpmyadmin link
    http://localhost/phpmyadmin

2. run below commands

    composer update
    php artisan key:generate
    php artisan migrate

    php artisan db:seed --class=PermissionTableSeeder
    php artisan db:seed --class=RoleSeeder
    php artisan db:seed --class=CreateAdminUserSeeder
