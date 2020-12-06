# Laravel PHP Framework for Eset with   Docker container

### Work with (php-fpm7.1, Nginx,  Mysql5.7.*, docker)

- Clone your fork into the ~/Sites/laravel folder
 `git clone git@github.com:esetnod32-russia/eset-laravel.git .`

- Install Docker on the local machine (Windows - https://docs.docker.com/compose/install/) for (MacOs - https://docs.docker.com/compose/install/) for (Linux - https://docs.docker.com/compose/install/)

- Move to 
 `cd eset-laravel` 

- Then running the following command 
 `сp .env.example .env` 

- If it works on successfully, running following command 
 `composer install`

- Then running the following command 
 `docker-compose` 

- If doesn't work on `docker-compose` check your local Docker else running the following command 
 `docker-compose up -d` 
 
- If is ok, running the following command
 `docker ps` 
- You should see three Docker containers, it means You are on your way xxD

- Then running the migrations `php artisan migrate` 

- Please check your local-host  http://127.0.0.1/ as usual port-80
