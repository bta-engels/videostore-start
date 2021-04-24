@echo OFF
echo clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dumpautoload

echo "all DONE \360\237\230\216\r"
