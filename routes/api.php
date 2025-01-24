<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------|
| API Routes                                                               |
|--------------------------------------------------------------------------|
| Here is where you can register API routes for your application. These    |
| routes are loaded by the RouteServiceProvider within a group which       |
| is assigned the "api" middleware group. Enjoy building your API!        |
|--------------------------------------------------------------------------|
*/


Route::post('/portfolio/personal-info', [PortfolioController::class, 'savePersonalInfo']);
Route::post('/portfolio/skills', [PortfolioController::class, 'saveSkills']);
Route::post('/portfolio/experiences', [PortfolioController::class, 'saveExperiences']);
Route::post('/portfolio/educations', [PortfolioController::class, 'saveEducations']);
Route::post('/portfolio/friends', [PortfolioController::class, 'saveFriends']);

// User authentication route
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
