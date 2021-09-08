<?php

use Illuminate\Support\Facades\Route;
use App\Actions\Remates\ImportarRemates;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware(['auth:sanctum', 'verified'])->get('/lugares', function () {
    return view('lugares');
})->name('lugares');

Route::middleware(['auth:sanctum', 'verified'])->get('/importar', function () 
{
    ImportarRemates::do();

    // return view('lugares');

})->name('lugares');
