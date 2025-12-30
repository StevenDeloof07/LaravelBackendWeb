Welcome to my simple Laravel project!

Here, I will show off my knowledge of the framework in a simple site.
As I'm a computer science student, I obviously made mine a tweakers like forum, focussing on computers

### installation

To install this project, you need to have the following packages installed

php 
php-xml
composer
npm 


#### Afterwards, you can use the following commands:

~~~

git clone https://github.com/StevenDeloof07/LaravelBackendWeb

cd LaravelBackendWeb

cp .env.example .env

~~~


Afterwards, you should fill in the .env file with database and mail server information.
Ensure you have a working database, and that the .env file gives the correct information for connecting to the database.
Alternatively, you can leave it on sqlite, and a sqlite database will be generated in database/database.sqlite

#### If you want to generate a sqlite database, you should use

php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"

#### Finally, you can install the server and migrate the database with 
~~~
composer run setup
php artisan migrate:fresh seed
~~~


#### The server can the be ran with

~~~ 
php artisan serve
~~~

If you want to test this site without use of a local mailserver, you can use the mailpit command:
https://mailpit.axllent.org/docs/install/


### Sources used:

#### password reset logic: 

https://1v0.net/blog/implementing-password-reset-in-laravel-12-without-packages/


#### Faq.js:

https://www.delftstack.com/howto/javascript/prevent-form-submit-javascript/

https://www.w3schools.com/jsref/met_win_confirm.asp

#### OrderShipped:

https://techsolutionstuff.com/post/laravel-12-send-email-tutphporial-step-by-step-guide


#### AccountController:

https://kritimyantra.com/blogs/laravel-12-upload-images

https://laravel.com/docs/12.x/authentication

#### WelcomeController.php:

https://gemini.google.com/share/2ed45321701b


#### deviceSeeder

https://laracasts.com/discuss/channels/laravel/how-to-seed-a-date-field

#### DeviceController

https://gemini.google.com/share/ea9c377d9f8d

#### composer.json

AI used to make sure that a sqlite database file is created when the project is setup with a sqlite connection 
https://gemini.google.com/share/e39b9abf5557 