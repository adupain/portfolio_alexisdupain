<?php

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
    return view('home');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\LayoutController::class, 'home'])->name('home');

//Route pour accèder au dashboard
Route::get('/dashboard', [App\Http\Controllers\GestionController::class, 'indexDashboard']);

//Route pour Portfolio
Route::get('/portfolio', [App\Http\Controllers\LayoutController::class, 'portfolio'])->name('portfolio');
Route::put('/gestion/projet/save', [App\Http\Controllers\GestionController::class, 'saveProjets']);
Route::delete('/gestion/projet/delete', [App\Http\Controllers\GestionController::class, 'deleteProjets']);
Route::get('/gestion/projets/get' , [App\Http\Controllers\GestionController::class, 'getProjets']);
Route::get('/gestion/competence/get' , [App\Http\Controllers\GestionController::class, 'getCompetences']);
Route::post('gestion/projet/create', [App\Http\Controllers\GestionController::class, 'saveProjets']);

//Route pour Propos
Route::put('/gestion/propos/save', [App\Http\Controllers\GestionController::class, 'savePropos']);
Route::get('/gestion/propos/get' , [App\Http\Controllers\GestionController::class, 'getPropos']);

//Route pour Formations
Route::put('/gestion/formation/save', [App\Http\Controllers\GestionController::class, 'saveFormations']);
Route::delete('/gestion/formation/delete', [App\Http\Controllers\GestionController::class, 'deleteFormations']);
Route::get('/gestion/formations/get' , [App\Http\Controllers\GestionController::class, 'getFormations']);
Route::post('/gestion/formation/create', [App\Http\Controllers\GestionController::class, 'saveFormations']);