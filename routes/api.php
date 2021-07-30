<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalyticsController;


Route::get('/countries', [AnalyticsController::class, 'getCountries']);
Route::get('/entries', [AnalyticsController::class, 'getEntries']);
Route::get('/regions', [AnalyticsController::class, 'getRegions']);
Route::get('/territories', [AnalyticsController::class, 'getTerritories']);

Route::get('/regions/{id}/nombre/{nombre}', [AnalyticsController::class, 'getRegion']);

Route::get('/regions/{idRegion}/{continentExp}/', [AnalyticsController::class, 'getRegion']);
Route::get('/entries/{day}/{month}/{year}/', [AnalyticsController::class, 'getEntriesPorFecha']);
Route::get('/entries/{day}/{month}/{year}/{countries}/', [AnalyticsController::class, 'getEntriesPorFechayCountries']);
Route::get('/entries', [AnalyticsController::class, 'getSumDatos']);
//Route::get('/entries/{countriesAndterritories'}, [AnalyticsController::class, 'getSumaDatosPais']);