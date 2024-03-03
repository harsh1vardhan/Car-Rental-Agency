<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\userAuthController;
use App\Http\Controllers\VendorAuthController;
use App\Http\Controllers\Vendors\VendorDashboard;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/home', [WebsiteController::class, 'index']);



Route::middleware('guest')->group(function () {
    //Inscriptions
    Route::get('/register', [userAuthController::class, 'register'])->name('user.register');
    Route::post('/register', [userAuthController::class, 'handleRegister'])->name('handleUserRegister');
    //Connexion
    Route::get('/login', [userAuthController::class, 'login'])->name('user.login');
    Route::post('/login', [userAuthController::class, 'handleLogin'])->name('handleUserLogin');
});




//Route pour les utilisateurs connecté

Route::middleware('auth')->group(function () {
    //Déconnexion
    Route::get('/logout', [userAuthController::class, 'handleLogout'])->name('user.logout');
});


//Route pour les vendeurs

//Vendeur GUEST [AUTH]



Route::prefix('agencies/accounts')->group(function () {

    Route::get('/', [VendorAuthController::class, 'login']);
    Route::get('/login', [VendorAuthController::class, 'login'])->name('vendors.login');
    Route::get('/register', [VendorAuthController::class, 'register'])->name('vendors.register');

    Route::post('/login', [VendorAuthController::class, 'handleLogin'])->name('vendors.handleLogin');
    Route::post('/register', [VendorAuthController::class, 'handleRegister'])->name('vendors.handleRegister');
});




Route::middleware('vendor_middleware')->prefix('vendors/dashboard')->group(function () {
    Route::get('/', [VendorDashboard::class, 'index'])->name('vendors.dashboard');



    Route::prefix('articles')->group(function () {

        Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

        Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');

        Route::post('/create', [ArticleController::class, 'handleCreate'])->name('articles.handleCreate');
    });


    Route::get('/logout', [VendorDashboard::class, 'logout'])->name('vendors.logout');
});
