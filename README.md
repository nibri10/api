### Installation
   
   ##### Requirements
* [Node JS](https://nodejs.org/en/download/)  
* [Composer](https://getcomposer.org/)
* [Laravel Installation](https://laravel.com/docs/6.x#installation)


### Procedures

   * Open in root folder prompt Command 
  ###### **Steps**:
  * Run the commands 
  * 1.Composer install:
 
       ```
          composer install
       ```
   
   * 2.Php Artisan key:generate
     ```
     php artisan key:generate
     ```
   * 3.Create database base with name ``api`` in Mysql
      ```
      create database  api
      ```
      
   * 4.Open archive .env adding
       ```
        DB_DATABASE=api
        DB_USERNAME=username
        DB_PASSWORD=password
       ```
   * 6.Run php artisan migrate
      ```
      php artisan migrate
      ```
   * 7.Run Database seed 
     ```
      php artisan db:seed
     ```
      
   * 8.Run server
     ```
     php artisan serve
     ```
     
   * 9.Testing application
        * [Postman](https://www.getpostman.com/)
     ##### our
        
      ##### RUN UNIT TEST CASE
      `` test/Feature``
 ##
     
   ### Available Tests
         LoginTest.php
         PostTest.php
         RegisterTest.php
           

 
  #
  
      
  
  * 10.Token settings can be changed in ``config/jwt.php``
  
  * 11.User Model
      ```
        name'
       'email' 
       'password'
      ```
    
  * 11.Post Model
       ```
           'title'
           'description'
           'category'
       ```
#    
  ### Routes
#
  ```
  +--------+----------------------------------------+---------------------------------------+----------------------------------+---------------------------------------------------------------------------------------------------+-------------------------------------------------+
  | Domain | Method                                 | URI                                   | Name                             | Action                                                                                            | Middleware                                      |
  +--------+----------------------------------------+---------------------------------------+----------------------------------+---------------------------------------------------------------------------------------------------+-------------------------------------------------+
  |        | GET|HEAD                               | /                                     |                                  | Closure                                                                                           | web              |                                                                              | web              |                              
  |        | DELETE                                 | api/posts                             |posts.destroy                     | App\Http\Controllers\PostController@destroy                                                       | api,jwt.auth     |
  |        | PUT|HEAD                               | api/posts                             |posts.update                      | App\Http\Controllers\PostController@update                                                        | api,jwt.auth     |
  |        | POST                                   | api/register                          |                                  | App\Http\Controllers\AuthController@register                                                      | api              |
  |        | POST                                   | api/login                             |                                  | App\Http\Controllers\AuthController@login                                                         | api              |
  |        | GET                                    | api/logout                            |                                  | App\Http\Controllers\AuthController@logout                                                        | api,jwt.auth     |
  |        | GET|HEAD                               | api/posts                             | posts.index                      | App\Http\Controllers\PostController@index                                                         | api,jwt.auth     |
  |        | POST                                   | api/posts                             | posts.store                      | App\Http\Controllers\PostController@store                                                         | api,jwt.auth     |
  |        | POST                                   | api/posts                             | posts.create                     | App\Http\Controllers\PostController@create                                                        | api,jwt.auth     |
  +--------+----------------------------------------+---------------------------------------+----------------------------------+---------------------------------------------------------------------------------------------------+-------------------------------------------------+
  ```
   
  
  
  ## Usage in project 
  
  * [JSON Web Token Authentication for Laravel & Lumen](https://github.com/tymondesigns/jwt-auth)
  * [JWT Json Web Token Authentication](https://jwt.io/)
  * [Laravel Framework](https://laravel.com)
   
