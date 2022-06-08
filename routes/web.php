<?php

use App\Http\Controllers\Admin\HomeController;
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

Route::get('/', function () {
    return view('index');
});
Route::match(['get', 'post'], '/login', [HomeController::class, 'login'])->name('login');
Route::get('/api/key', [HomeController::class, 'getKey']);
Route::get('/api/list', [HomeController::class, 'showList']);
Route::get('/api/refresh', [HomeController::class, 'refreshKey']);
Route::group(['prefix' => 'admin', 'middleware' => 'auth'] ,function () {
    Route::get('/', [HomeController::class, 'list'])->name('admin.list');
    Route::post('/add', [HomeController::class, 'addKey']);
    Route::delete('/delete/{id}', [HomeController::class, 'deleteKey']);
});
