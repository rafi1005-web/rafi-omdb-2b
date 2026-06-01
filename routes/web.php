<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');


Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('signin');
    Route::post('/register', [AuthController::class, 'register_process'])->name('signup');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/all', [MovieController::class, 'allMovies'])->name('movies.all');
    Route::get('/movies/detail/{id}', [MovieController::class, 'detail'])->name('movies.detail');
    Route::get('/favorites', [MovieController::class, 'listFavorites'])->name('movies.favorite');
    Route::post('/favorites', [MovieController::class, 'storeFavorite'])->name('movies.store_favorite');
    Route::delete('/favorites/{id}', [MovieController::class, 'destroyFavorite'])->name('favorites.destroy');
});
