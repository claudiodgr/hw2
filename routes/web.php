<?php

use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchContentController;
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

Route::get('/', function () {
    if (auth()->check()) {
        return view('home');
    } else {
        return view('welcome');
    }
})->name('home');

Route::get('/homelist', [HomeController::class, 'index']
)->middleware(['auth', 'verified'])->name('homelist');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', function () {
    return view('search');
})->middleware(['auth', 'verified'])->name('search');

Route::get('/people', function () {
    return view('people');
})->middleware(['auth', 'verified'])->name('people');

Route::get('/search-people', [FollowerController::class, 'search']
)->middleware('auth:sanctum');

Route::post('/search-people', [FollowerController::class, 'follow']
)->middleware('auth:sanctum');

Route::delete('/search-people', [FollowerController::class, 'unfollow']
)->middleware('auth:sanctum');

Route::get('/phpinfo', function () {
    return view('phpinfo');
})->name('phpinfo');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::apiResource(
    'playlists',
    PlaylistController::class
)->middleware('auth:sanctum');

Route::post('/like-playlist/{id}', [PlaylistController::class, 'like']
)->middleware('auth:sanctum');

Route::delete('/like-playlist/{id}', [PlaylistController::class, 'unlike']
)->middleware('auth:sanctum');

Route::post('/search-content', [SearchContentController::class, 'search']
)->middleware('auth:sanctum');

Route::get('/playlist', [SearchContentController::class, 'checkPlaylist']
)->middleware('auth:sanctum');

Route::post('/playlist', [SearchContentController::class, 'addPlaylist']
)->middleware('auth:sanctum');

Route::delete('/playlist', [SearchContentController::class, 'removePlaylist']
)->middleware('auth:sanctum');

Route::get('/library', [LibraryController::class, 'index']
)->middleware('auth:sanctum');

Route::get('/mylibrary', function () {
    return view('library');
})->middleware(['auth', 'verified'])->name('library');

require __DIR__.'/auth.php';
