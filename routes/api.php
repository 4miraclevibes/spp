<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('student/index', [StudentController::class, 'index']);
Route::get('teacher/index', [TeacherController::class, 'index']);
Route::get('transaction/index', [TransactionController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('transaction/store/{id}', [TransactionController::class, 'store']);
    Route::put('transaction/cancel/{id}', [TransactionController::class, 'cancel']);
    Route::post('logout', [UserController::class, 'logout']);

    // Payment API routes
    Route::get('payments', [PaymentController::class, 'index']);
    Route::get('payments/create', [PaymentController::class, 'create']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::get('payments/{payment}/edit', [PaymentController::class, 'edit']);
    Route::put('payments/{payment}', [PaymentController::class, 'update']);
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy']);

    // Payment Details API routes
    Route::get('payments/{payment}/details', [PaymentController::class, 'detailsIndex']);
    Route::get('payments/{payment}/details/create', [PaymentController::class, 'detailsCreate']);
    Route::post('payments/{payment}/details', [PaymentController::class, 'detailsStore']);
    Route::get('payments/details/{paymentDetail}/edit', [PaymentController::class, 'detailsEdit']);
    Route::put('payments/details/{paymentDetail}', [PaymentController::class, 'detailsUpdate']);
    Route::delete('payments/details/{paymentDetail}', [PaymentController::class, 'detailsDestroy']);
});