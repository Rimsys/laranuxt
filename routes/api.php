<?php

use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SkillController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', [Controller::class, 'routes'])
    ->name('route information')
    ->withoutMiddleware('api');
Route::get('/example', [Controller::class, 'example'])->name('example route');
Route::get('/error', [Controller::class, 'error'])->name('error route');


Route::group(['prefix' => 'experience'], function () {
    Route::get('/', [ExperienceController::class, 'index'])->name('experience.index');
    Route::post('/create', [ExperienceController::class, 'create'])->name('experience.create');
    Route::patch('/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');
});

Route::group(['prefix' => 'skill'], function () {
    Route::get('/', [SkillController::class, 'index'])->name('skill.index');
    Route::post('/create', [SkillController::class, 'create'])->name('skill.create');
    Route::patch('/update/{id}', [SkillController::class, 'update'])->name('skill.update');
});

Route::group(['prefix' => 'bioData'], function () {
    Route::get('/', [BiodataController::class, 'index'])->name('bioData.index');
    Route::post('/create', [BiodataController::class, 'create'])->name('bioData.create');
    Route::patch('/update/{id}', [BiodataController::class, 'update'])->name('bioData.update');
});
