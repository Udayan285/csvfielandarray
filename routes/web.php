<?php

use App\Http\Controllers\InsertCsvController;
use App\Http\Controllers\ParseDataController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//filter data from an array with status and greater time...
Route::get('/filter-data', [ParseDataController::class, 'ParseData'])->name('filter');

//remove data from an array where status failed or cancelled...
Route::get('/remove-data', [ParseDataController::class, 'removeData'])->name('remove');

//paid data from an array where status paid ...
Route::get('/paid-data', [ParseDataController::class, 'paiddata'])->name('paid');


//csv insert
Route::get('/insert-csv',[InsertCsvController::class,'insertFromCsv'])->name('insertcsv');

//insert data.php file into works db
Route::get('/insert-data',[ParseDataController::class,'worksInsert'])->name('works');