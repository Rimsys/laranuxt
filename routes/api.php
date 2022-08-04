<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
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

Route::post('login', [ApiAuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

    Route::get('/users/get-personal-info', [UserController::class, 'getPersonalInfo']);

    Route::resource('experiences', ExperienceController::class)->only([
        'index', 'store', 'update', 'destroy',
    ]);

    Route::resource('skills', SkillController::class)->only([
        'index', 'store', 'update', 'destroy',
    ]);

    Route::resource('education', EducationController::class)->only([
        'index', 'store', 'update', 'destroy',
    ]);

    Route::get('/countries', [CountryController::class, 'index']);

});
