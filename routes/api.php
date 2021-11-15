<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('users')->group(function (Router $router) {
    $router->post('/', [UserController::class, 'create']);
    $router->put('/', [UserController::class, 'update'])->middleware('auth:api');
    $router->delete('/',[UserController::class,'delete'])->middleware('auth:api');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/products', [ProductController::class, 'createProducts']);
    Route::put('/updateProducts', [ProductController::class, 'updateProducts']);
});


