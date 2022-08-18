<?php

use App\Http\Controllers\api\Auth\LogoutController;
use App\Http\Controllers\api\Auth\RegisterController;
use App\Http\Controllers\api\UserController as V1UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\LanguageController;
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

Route::middleware('auth:api')->group(function () {
    Route::resource('/skills', SkillController::class)->except([
    'create', 'edit'
    ]);
    Route::resource('/experiences', ExperienceController::class)->except([
    'create', 'edit'
    ]);
    Route::resource('/educations', EducationController::class)->except([
    'create', 'edit'
    ]);
    Route::resource('/languages', LanguageController::class)->except([
    'create', 'edit'
    ]);
    Route::resource('/hobbies', HobbyController::class)->except([
    'create', 'edit'
    ]);
});

Route::prefix('api/v1')->group(function () {
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::get('user', [V1UserController::class, 'show']);
    Route::patch('user', [V1UserController::class, 'update']);
    Route::delete('user', [V1UserController::class, 'destroy']);
});

Route::middleware('auth:api')->get('/test_jwt', function () {
    return response()->json([ 'valid' => auth()->check() ]);
});