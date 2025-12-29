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

~~~git clone https://github.com/StevenDeloof07/LaravelBackendWeb

cd LaravelBackendWeb

cp .env.example .env

composer install

npm install

npm run build
~~~

Afterwards, you should fill in the .env file with database and mail server information.
Ensure you have a working database, and that the .env file gives the correct information for connecting to the database.

#### Finally, you can migrate the database with 
~~~
php artisan key:generate

php artisan storage:link

php artisan migrate:fresh --seed
~~~
#### The server can the be ran with

~~~php artisan serve~~~

If you want to test this site without use of a local mailserver, you can use the mailpit command:
https://mailpit.axllent.org/docs/install/


### Sources used:

Faq.js
https://www.delftstack.com/howto/javascript/prevent-form-submit-javascript/
https://www.w3schools.com/jsref/met_win_confirm.asp

OrderShipped
https://techsolutionstuff.com/post/laravel-12-send-email-tutphporial-step-by-step-guide


AccountController
https://kritimyantra.com/blogs/laravel-12-upload-images
https://laravel.com/docs/12.x/authentication

WelcomeController.php:
https://gemini.google.com/share/2ed45321701b
