@echo OFF

echo install vendor/node_modules packages
call composer install
call npm install
call npm run dev

if NOT exist .env (
    echo create .env file
    copy .env.example .env
)
if NOT exist .htaccess (
    echo create .htaccess file
    copy htaccess-tpl .htaccess
)

echo generate app key
php artisan key:generate

echo migrate database tables
php artisan migrate

echo seed database data
php artisan db:seed

echo clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "all DONE :-) \360\237\230\216\r"
echo "Dont forget to make entries for the hostname in C:\Window\System32\drivers\etc\hosts"
echo "and in your apache httpd-vhosts.conf file"
