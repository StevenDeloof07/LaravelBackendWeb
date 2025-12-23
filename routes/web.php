<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [WelcomeController::class, "index"])->name("home");

Route::get('/login', [WelcomeController::class, "login"])->name("login");
Route::post('/login', [WelcomeController::class, "findUser"])->name("loginAction");

Route::get("/register", [WelcomeController::class, "register"])->name('registerPage');
Route::post("/register", [AccountController::class, "store"])->name('registerAction');

Route::post('/logout', [AccountController::class, "logout"])->name('logout');

Route::get("/account/{id}", [AccountController::class, "index"])->name("getAccountInfo");

//Gemini used for middleware, and prefix logic. Routes were written without ai.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('manage')->group(function () {
        Route::get("/", [AdminController::class, "index"])->name("adminManagement");
        Route::post("/", [AdminController::class, "createAdmin"])->name("makeAdmin");
        Route::delete("/{id}", [AdminController::class, "remove"])->name("removeAdmin");
        Route::post('/create', [AdminController::class, "createUser"])->name("admin.createUser");
    });
})

?>