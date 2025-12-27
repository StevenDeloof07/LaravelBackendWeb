<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\returnArgument;

Route::get("/", [WelcomeController::class, "index"])->name("home");

Route::get('/login', [WelcomeController::class, "login"])->name("login");
Route::post('/login', [WelcomeController::class, "findUser"])->name("loginAction");

Route::get("/register", [WelcomeController::class, "register"])->name('registerPage');
Route::post("/register", [AccountController::class, "store"])->name('registerAction');

Route::post('/logout', [AccountController::class, "logout"])->name('logout');

Route::get("/account/{id}", [AccountController::class, "index"])->name("getAccountInfo");
Route::patch('/account/{id}', [AccountController::class, "changeInfo"])->name("changeProfile");

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
            Route::get('/', function () {
                return view("account.admin.news");
            })->name("newsManagement");
        });
    });
})

?>