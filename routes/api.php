<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
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

Route::apiResource('projects',ProjectController::class)->only(['index','show']);
Route::get('category/{category_id}',[ProjectController::class, 'fliter_category']);
Route::get('tag/{tag_id}',[ProjectController::class, 'filter_tag']);
Route::get('user/{user_id}',[ProjectController::class, 'filter_user']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
