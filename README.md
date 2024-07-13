# Настройка  


первым делом настраиваем локальную базу данных
это можно сделать в файле .env

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=bookup  
    DB_USERNAME=user  
    DB_PASSWORD=local   

дальше нужно сделать 

    npm i
    vite build
После этого вызываем миграциии

    php artisan migrate

И наконец запускаем серв

    php artisan serve
