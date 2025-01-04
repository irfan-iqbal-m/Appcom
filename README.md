
# Install dependencies
composer install

# Install Node.js dependencies
npm install

# Link storage
php artisan storage:link

# Migrate database 
php artisan migrate:fresh --seed

# Run the project
php artisan serve
npm run dev 



# Login
username: admin@gmail.com
password: 12345678