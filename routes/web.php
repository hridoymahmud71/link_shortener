<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\LinkController;

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

Route::get('/link-generator', [LinkController::class, 'show_link_generator']);
Route::get('/{slug}', [LinkController::class, 'go_to_link']);


