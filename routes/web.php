<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\GestionController;


Route::get('/', [LayoutController::class, 'home'])->name('home');
Route::get('/portfolio', [LayoutController::class, 'portfolio'])->name('portfolio');
Route::get('/cv', [GestionController::class, 'indexCv']);
Route::get('/veille', [GestionController::class, 'indexVeille']);


Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', [GestionController::class, 'indexDashboard']);
});

Route::get('/logout', [GestionController::class, 'logout']);

Route::get('/securedashboard', [GestionController::class, 'indexSecureDashboard']);
Route::post('/securedashboard', [GestionController::class, 'checkLogin']);


Route::get('/gestion/competences/get', [GestionController::class, 'getCompetences']);

Route::prefix('gestion/projets')->group(function () {
    Route::get('/get', [GestionController::class, 'getProjets']);
    Route::post('/create', [GestionController::class, 'saveProjets']);
    Route::put('/save', [GestionController::class, 'saveProjets']);
    Route::delete('/delete/{id}', [GestionController::class, 'deleteProjets']);
});
Route::prefix('gestion/propos')->group(function () {
    Route::get('/get', [GestionController::class, 'getPropos']);
    Route::put('/save', [GestionController::class, 'savePropos']);
});
Route::prefix('gestion/formations')->group(function () {
    Route::get('/get', [GestionController::class, 'getFormations']);
    Route::post('/create', [GestionController::class, 'saveFormations']);
    Route::put('/save', [GestionController::class, 'saveFormations']);
    Route::delete('/delete', [GestionController::class, 'deleteFormations']);
});
Route::prefix('gestion/competence')->group(function () {
    Route::get('/get', [GestionController::class, 'getCompetences']);
    Route::put('/save', [GestionController::class, 'saveCompetence']);
});
Route::get('/fiche_projet/{id}', [LayoutController::class, 'indexProjet']);
Route::get('/fiche_competence/{id}', [LayoutController::class, 'indexCompetence']);
