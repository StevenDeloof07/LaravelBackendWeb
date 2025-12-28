<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\returnArgument;

Route::get("/", [WelcomeController::class, "index"])->name("home");

Route::get('/login', [WelcomeController::class, "login"])->name("login");
Route::post('/login', [WelcomeController::class, "findUser"])->name("loginAction");

Route::get("/register", [WelcomeController::class, "register"])->name('registerPage');
Route::post("/register", [AccountController::class, "store"])->name('registerAction');

Route::post('/logout', [AccountController::class, "logout"])->name('logout');

Route::prefix('/contact')->controller(ContactController::class)->group(function () {
    route::get('/', 'index');
    route::post('/', 'contact')->name('contactAdmin');
});

Route::prefix("FAQ",)->group(function () {
    Route::controller(QuestionController::class)->group(function () {
        Route::get('/', "index");
        Route::middleware(['auth', 'admin'])->prefix("manage")->group(function () {
            Route::get('/', 'manage')->name('questionManagement');
            Route::post('/', 'addQuestion')->name('addQuestion');
            Route::put('/', 'changeQuestion')->name('changeQuestion');
            Route::delete('/', 'removeQuestion')->name('removeQuestion');

            Route::prefix('category')->group(function () {
                Route::post('/', 'addCategory')->name('addCategory');
                route::put('/', 'changeCategory')->name('changeCategory');
                route::delete('/', 'removeCategory')->name('removeCategory');
            });
        });
    });
    
});

Route::get("/account/{id}", [AccountController::class, "index"])->name("getAccountInfo");
Route::middleware('auth')->group(function () {
    Route::patch('/account/{id}', [AccountController::class, "changeInfo"])->name("changeProfile");
});

//Gemini used for middleware, and prefix logic. Routes were written without ai.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('manage')->group(function () {
        Route::controller(AdminController::class)->prefix("users")->group(function() {
            Route::get("/", "index")->name("userManagement");
            Route::post("/", "createAdmin")->name("makeAdmin");
            Route::delete("/{id}",  "remove")->name("removeAdmin");
            Route::post('/create', "createUser")->name("admin.createUser");
        });

        Route::controller(NewsController::class)->prefix("news")->group(function () {
            Route::get('/', 'getView')->name("newsManagement");
            Route::post('/', 'addItem')->name('addNewsItem');
            Route::patch('/', 'change')->name('changeNewsItem');
            Route::delete('/{id}', "remove")->name("removeNewsItem");
        });
    });
})

?>