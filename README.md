<p align="center">
<a href="https://laravel.com" target="_blank">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
</a>
<a href="https://www.mongodb.com/" target="_blank">
<img src="https://webimages.mongodb.com/_com_assets/cms/kuyjf3vea2hg34taa-horizontal_default_slate_blue.svg?auto=format%252Ccompress" width="400">
</a>
</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


## MongoDB Crud With Laravel

For crud mongo database with laravel application we need follow few steps below:

1. Install mondodb local server on our system and check it's working fine.
2. Now take a fresh laravel project and check it's working fine.
3. Install mongodb package in our laravel project.
4. Add mongodb config info in our laravel project.
5. Create a migration for mongodb with proper mongo connection.
6. Create a model for mongodb collection access through laravel eloquent when we crud.
7. Build cruding apis.


## 1. Install MongoDB
Installation process of mongodb in ubuntu:

* **Execute below command in terminal**

    - sudo apt-get update

    - sudo apt-get install gnupg

    - sudo apt-get update

    - wget -qO - https://www.mongodb.org/static/pgp/server-6.0.asc | sudo apt-key add - apt-key list

    - echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu focal/mongodb-org/6.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-6.0.list

    - sudo apt-get update

    - sudo apt-get install -y mongodb-org

* **After successfully install mongodb check status and run server**

    - sudo systemctl status mongod

    - sudo systemctl start mongod.service

* **We can also run mongo shell on terminal**

    - mongosh


## 2. Make a laravel project

* **Execute below command in terminal**

    - composer create-project --prefer-dist laravel/laravel:^7.0 mongodb

    - cd mongodb

    - composer install

* **Run php server and check in browser laravel project run fine**

    - php artisan serve

    - http://127.0.0.1:8000/


## 3. MongoDB package install for laravel 

* **Configure php.ini file add extension for mongodb**

    - If configuration option "php_ini" is not set to php.ini location you should add "extension=mongodb.so" to php.ini **(check current version and add extension on current version php.ini file)**

* **Execute below command in terminal inside laravel project**

    - sudo apt-get install php-pear php7.4-dev **(if need install according to your php version demand)**

    - sudo pecl install mongodb

    - composer require jenssegers/mongodb "^3.7"

        Make sure that **("jenssegers/mongodb": "^3.7")** present in **composer.json** file in laravel project
