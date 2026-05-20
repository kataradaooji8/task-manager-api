<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Task Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Create Task
    Route::post('/tasks', [TaskController::class, 'store']);

    // List All Tasks
    Route::get('/tasks', [TaskController::class, 'index']);

    // Single Task
    Route::get('/tasks/{task}', [TaskController::class, 'show']);

    // Update Task
    Route::put('/tasks/{task}', [TaskController::class, 'update']);

    // Delete Task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Task Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Create Task
    Route::post('/tasks', [TaskController::class, 'store']);

    // List All Tasks
    Route::get('/tasks', [TaskController::class, 'index']);

    // Single Task
    Route::get('/tasks/{task}', [TaskController::class, 'show']);

    // Update Task
    Route::put('/tasks/{task}', [TaskController::class, 'update']);

    // Delete Task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});