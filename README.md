# Yowl_APP
Implémentation du projet YOWL avec VueJS



<!-- PROJECT LOGO -->
<br />
<p align="center">
  

  <h3 align="center">Yowl</h3>

  [![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](http://forthebadge.com)

  <p align="center">
    Lis ce README pour installer le projet
  </p>
</p>


## Créer avec

* [Laravel](https://laravel.com)
* [VueJs](https://vuejs.org/)
* [JQuery](https://jquery.com)
* [Bootstrap](https://getbootstrap.com)


<!-- GETTING STARTED -->
## Pour commencer

Suis les instructions suivantes pour installer le projet et l'utiliser.

### Pré-requis

* composer
    (https://getcomposer.org/)
* npm
  ```sh
  npm install npm@latest -g
  ```
* laravel 7
  ```sh
  composer global require laravel/installer
  ```
<!-- * [Optional] docker compose && docker
    (https://www.docker.com/get-started) -->

### Installation

1. Install composer packages
   ```sh
   composer install
   ```
2. Install NPM packages
   ```sh
   npm install && npm run dev
   ```
3. Crée et remplis ta base de données en la reliant au projet dans ton fichier `.env`
   ```JS
    DB_CONNECTION = mysql
    DB_HOST = 127.0.0.1
    DB_PORT = 3306
    DB_DATABASE = 'DB_NAME'
    DB_USERNAME = 'DB_USER'
    DB_PASSWORD = 'DB_PASSWORD'
   ```
 4. Run migrations and apply seeds
   ```sh
   php artisan migrate:fresh
   php artisan db:seeds
   ```
 4. Run the server
   ```sh
   php artisan serve
   ```
 3. Ouvre `localhost:8000` dans ton navigateur de recherche et fais toi plaisir.
