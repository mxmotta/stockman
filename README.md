# Stockman

## About

The project has been developed using Laravel framework with Inertia.js and Vue.js

## Deploy

To deploy follow the steps below


1 - Copy the environment file and edit to your preference

```bash
cp .env.example .env
```

2 - Install php packages

```bash
composer install
```

3 - Generate security key

```bash
php artisan key:generate
```

4 - Install javascript packages

```bash
npm install 
```

5 - Compile javascript assets

```bash
npm run dev (or prod to production) 
```

6 - Run migrations to create database tables

```bash
php artisan migrate 
```

7 - Run seeds to create a default user

```bash
php artisan db:seed 
```

8 - Run the serve

```bash
php artisan serve
```

## Docker

To deploy in docker first run from 1 to 5 steps above and follow the steps below

1 - Install Laravel Sail

```bash
php artisan sail:install
```

2 - Up the containers stack

```bash
./vendor/bin/sail up
```

3 - Run migrations to create database tables

```bash
docker exec -it container-name php artisan migrate 
```

4 - Run seeds to create a default user

```bash
docker exec -it container-name php artisan db:seed 
```

## Default Login

```bash
username: user@user.com
password: user
```