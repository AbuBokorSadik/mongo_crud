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


## 4. Configure laravel project for mongodb connection

* Now go to **config/database.php** file for mongodb connection, add bellow code in **('connections')** array,

    **#Code:**

        'mongodb' => [
                    'driver'   => 'mongodb',
                    'host'     => env('MONGO_DB_HOST', 'localhost'),
                    'port'     => env('MONGO_DB_PORT', 27017),
                    'database' => env('MONGO_DB_DATABASE'),
                    'username' => env('MONGO_DB_USERNAME'),
                    'password' => env('MONGO_DB_PASSWORD'),
                    'options'  => []
                ],


* Add veriables in **.env** file

    **#Code:**

        MONGO_DB_CONNECTION=mongodb	#mongo connection
        MONGO_DB_HOST=127.0.0.1	#localhost
        MONGO_DB_PORT=27017		#default mongo server port
        MONGO_DB_DATABASE=bookstore	#your database name
        MONGO_DB_USERNAME=		#add if need
        MONGO_DB_PASSWORD=		#add if need


## 5. Create migration file for create mongodb collection in database

* **Execute below command in terminal inside laravel project**

    - php artisan make:migration create_books_table

* **Edit your migration file and make your collection like bellow**

    **#Code:**

        public function up()
            {
                Schema::connection('mongodb')->create('books', function (Blueprint $collection) {
                    $collection->string('title');
                    $collection->string('author');
                    $collection->integer('pages');
                    $collection->integer('rating');
                    $collection->array('genres');
                    $collection->timestamps();
                });
            }

            ***Don't forget to add connection with mongodb and migrate the collection.

* **Migrate command for migration mongodb collection**

    - php artisan migrate

* **Now check mongo shell to ensure that migration is done**

    - show dbs

    - use bookstore

    - show collections


## 6. Create a model to get elaquent facility when make cruding

* **Create model**

    - php artisan make:model Model/MongoDb/Book

* **Add connection and collection veriables in Book model class**

    **#Code:**

        <?php

        namespace App\Model\MongoDb;

        use Jenssegers\Mongodb\Eloquent\Model;

        class Book extends Model
        {
            protected $connection = 'mongodb';
            protected $collection = 'books';
        }


## 7. Api cruding

* **Create controller and make cruding function's**

    **#Command:**

        - php artisan make:controller BookController

    **#Code:**

        <?php

        namespace App\Http\Controllers;

        use App\Model\MongoDb\Book;
        use Illuminate\Http\Request;

        class BookController extends Controller
        {
            public function index()
            {
                $books = Book::get();

                return $books;
            }

            public function store(Request $request)
            {
                $book = new Book();
                $book->title = $request->title;
                $book->author = $request->author;
                $book->pages = $request->pages;
                $book->rating = $request->rating;
                $book->genres = $request->genres;
                $book->save();

                return $book;
            }

            public function update(Request $request)
            {
                $book = Book::find($request->id);
                $book->title = $request->title;
                $book->author = $request->author;
                $book->pages = $request->pages;
                $book->rating = $request->rating;
                $book->genres = $request->genres;
                $book->save();

                return $book;
            }

            public function delete(Request $request)
            {
                $book = Book::find($request->id);
                $book->delete();

                return $book;
            }
        }


* **Cruding api's (routes/api.php)**

    **#Code:**

        <?php

        use Illuminate\Support\Facades\Route;

        /*
        |--------------------------------------------------------------------------
        | API Routes
        |--------------------------------------------------------------------------
        |
        | Here is where you can register API routes for your application. These
        | routes are loaded by the RouteServiceProvider within a group which
        | is assigned the "api" middleware group. Enjoy building your API!
        |
        */

        Route::get('/list', 'BookController@index');
        Route::post('/store', 'BookController@store');
        Route::post('/update', 'BookController@update');
        Route::post('/delete', 'BookController@delete');

    Now goto **Postman** create requests and test api's or goto **postman_json_link.txt** file  (attach with the project) copy json link and inport collection on your postman.

    Check api's are working fine.<br>
    **Don't forget** to run your laravel project on local server,<br>
    And run your mongodb server.




