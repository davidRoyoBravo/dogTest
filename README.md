# Test David Royo
## Dogs Formulary, Laravel Sail, Vite, Bootstrap 5, JQuery

## Features

- Show all the dogs in the database
- Add new Dog
- Validate information
- Unit Test for Store Dogs
- PHPStan test pass level 8

To install should have 
Docker installed
Composer installed

## Steps to local install

- Clone repository
- Go to the repository directory
- Exceute the commands:
```sh
composer install
npm install
```
- Copy the .env.example file and rename it as .env (for local development usage).
- Run sail up:
```sh
./vendor/bin/sail up
```
- Run the command to populate your private development Laravel keys:
```sh
./vendor/bin/sail artisan key:generate
```
- Run the command to start migrations using the predefined seeders config:
```sh
./vendor/bin/sail artisan migrate --seed
```
- Start development npm server
```sh
npm run dev
```
Commands for test.

Exceute Unit Tests:

```sh
./vendor/bin/sail artisan test
```

Runing PHPStan :

```sh
./vendor/bin/phpstan analyse --memory-limit=1G
```

## Go to the sail service URL, usually http://localhost/