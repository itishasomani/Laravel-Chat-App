Description 
===================================
This app is useful for one to one chat.
i have added three user in this one is admin and other two are user for testing. 
All users are able to login with the provided credentials. 
This app is built with Laravel backend and Laravel reverb package uses for chat. and in frontend i choose Livewire. to built a perfect chat web.
======================================================================================

to create .env file follow the below steps :
1. cp .env.example .env
2. php artisan key:generate
3. php artisan optimize:clear

======================================================================================

Steps which need to follow for setup :
====================================================================
1. code download from github 
2. env configuration set 
3. already provided database file in this directory 
4. or you can migrate and seed for database 
5. after configuring the above steps change the database with your database.
6. run command "php artisan serve" for Laravel run 
7. run command in other terminal "php artisan reverb:start" for socket connection
8. run command in other terminal "npm run dev" for node 
