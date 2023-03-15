<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\DepartmentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Start Prof Controller
Route::get('/addProf',[ProfController::class,'create'])->name('createprof');
Route::get('/allProf',[ProfController::class,'showall'])->name('allprof');
Route::post('/storeProf',[ProfController::class,'store'])->name('storeprof');
Route::get('/editprof/{id}',[ProfController::class,'edit'])->name('editprof');
Route::put('/editprof/update/{id}', [ProfController::class, 'update'])->name('updateprof');
Route::delete('/deleteprof/{id}', [ProfController::class, 'destroy'])->name('deleteprof');
Route::get('/profileprof/{id}',[ProfController::class,'profile'])->name('profileprof');
// End Prof Controller
//Start departement controller
Route::get('/departement',[DepartmentController::class,'index']);
Route::get('/alldepartement',[DepartmentController::class,'create'])->name('alldepartement');
Route::post('/add_departement',[DepartmentController::class,'store'])->name('add_departement');
Route::get('/edit_departement/{id}',[DepartmentController::class,'edit']);
Route::put('/update_departement',[DepartmentController::class,'update']);
Route::delete('/delete_departement',[DepartmentController::class,'destroy']);
//End departement controller