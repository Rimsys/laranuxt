<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Resume\ResumeController;
use App\Http\Controllers\Resume\SkillController;
use Illuminate\Support\Facades\Route;

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

/* Resume routes */
Route::get('/profile', [ResumeController::class, 'index'])->name('profile.index');
Route::post('/profile', [ResumeController::class, 'store'])->name('profile.store');
Route::put('/profile', [ResumeController::class, 'update'])->name('profile.update');

/* skills */
Route::resource('skills', \App\Http\Controllers\SkillController::class)->only('index');

/* resume skills */
Route::get('/resume/{resume}/skill', [SkillController::class, 'index'])->name('resume.skill.index');
Route::post('/resume/{resume}/skill', [SkillController::class, 'store'])->name('resume.skill.store');
Route::put('/resume/{resume}/skill', [SkillController::class, 'update'])->name('resume.skill.update');
Route::delete('/resume/{resume}/skill', [SkillController::class, 'destroy'])->name('resume.skill.destroy');
