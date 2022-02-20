<?php

use App\Http\Controllers\CicloController;
use App\Http\Controllers\CursoController;
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
    return view('plantilla.index');
});


/*
|--------------------------------------------------------------------------
| CICLOS
|--------------------------------------------------------------------------
*/

//INDEX
Route::get('/ciclos', [CicloController::class, 'index']);

//ELIMINAR CICLO A PARTIR DE ID
Route::delete('/ciclos/{id}', [CicloController::class, 'destroy']);

//CREAR CICLO
Route::get('/ciclos/create', [CicloController::class, 'create']);

//GUARDAR DATOS CICLO
Route::post('/ciclos', [CicloController::class, 'store']);


/*
|--------------------------------------------------------------------------
| CURSOS
|--------------------------------------------------------------------------
*/

//INDEX
Route::get('/cursos', [CursoController::class, 'index']);

Route::resource('cursos',CursoController::class);
