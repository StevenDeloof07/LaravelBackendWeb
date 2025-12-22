<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [WelcomeController::class, "index"])->name("home");

Route::get('/login', function () {
    return view("account.login");
})->name("login");
Route::post('/login', [WelcomeController::class, "findUser"])->name("loginAction");

Route::get("/register", [WelcomeController::class, "register"])->name('registerPage');
Route::post("/register", [AccountController::class, "store"])->name('registerAction');
Route::post('/logout', [AccountController::class, "logout"])->name('logout');

Route::get("/manage", [AdminController::class, "index"])->name("adminManagement");
Route::post("/manage", [AdminController::class, "create"])->name("makeAdmin");
Route::delete("/manage/{id}", [AdminController::class, "remove"])->name("removeAdmin");
?>