<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('Login');
Route::get('/about', [PageController::class, 'about'])->name('About');

// Route::get('/home', function () {
//     return Inertia::render('Home');
// })->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/search', [PageController::class, 'search'])->name('search');
    Route::get('/query', [PageController::class, 'api_call'])->name('searchApi');
    Route::get('/pagination', [PageController::class, 'pagination'])->name('pagination');
    Route::get('/album-details', [PageController::class, 'show_album_details'])->name('album-details');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
