<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\GestionController;

Route::get('/', [LayoutController::class, 'home'])->name('home');
Route::get('/portfolio', [LayoutController::class, 'portfolio'])->name('portfolio');
Route::get('/fiche_projet/{id}', [LayoutController::class, 'indexProjet']);
Route::get('/fiche_competence/{id}', [LayoutController::class, 'indexCompetence']);
Route::get('/cv', [GestionController::class, 'indexCv']);
Route::get('/veille', [GestionController::class, 'indexVeille']);
Route::get('/securedashboard', [GestionController::class, 'indexSecureDashboard']);
Route::get('/dashboard', [GestionController::class, 'indexDashboard']);

// Gestion des projets
Route::prefix('gestion/projets')->group(function () {
    Route::get('/get', [GestionController::class, 'getProjets']);
    Route::post('/create', [GestionController::class, 'saveProjets']);
    Route::put('/save', [GestionController::class, 'saveProjets']);
    Route::delete('/delete/{id}', [GestionController::class, 'deleteProjets']);
});

// Gestion "À propos"
Route::prefix('gestion/propos')->group(function () {
    Route::get('/get', [GestionController::class, 'getPropos']);
    Route::put('/save', [GestionController::class, 'savePropos']);
});

// Gestion des formations
Route::prefix('gestion/formations')->group(function () {
    Route::get('/get', [GestionController::class, 'getFormations']);
    Route::post('/create', [GestionController::class, 'saveFormations']);
    Route::put('/save', [GestionController::class, 'saveFormations']);
    Route::delete('/delete', [GestionController::class, 'deleteFormations']);
});

// Gestion des compétences
Route::prefix('gestion/competences')->group(function () {
    Route::get('/get', [GestionController::class, 'getCompetences']);
    Route::put('/save', [GestionController::class, 'saveCompetence']);
});

Route::get('/securedashboard', [GestionController::class, 'indexSecureDashboard']);
Route::post('/securedashboard', [GestionController::class, 'checkLogin']);
Route::get('/logout', [GestionController::class, 'logout']);
