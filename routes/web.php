<?php

use App\Http\Controllers\ResultController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/report', function () {
    return Inertia::render('Report');
})->name('report');
// Route::inertia('/post', 'Post');

Route::resource('/post', ResultController::class)->only(['index', 'store']);
Route::get('/resultapi', [ResultController::class, 'getResult']);
Route::get('/partyapi', [ResultController::class, 'testParty']);

require __DIR__.'/auth.php';
