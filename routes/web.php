<?php

use App\Http\Controllers\WebCrawlerController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [WebCrawlerController::class, 'show']);
Route::get('search/rightmove', [WebCrawlerController::class, 'search'])
    ->name('search');
