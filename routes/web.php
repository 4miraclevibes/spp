<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\TaController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //User
    Route::get('user/index', [UserController::class, 'index'])->name('user.index');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    //Parent
    Route::get('parent/index', [ParentController::class, 'index'])->name('parent.index');
    Route::get('parent/create', [ParentController::class, 'create'])->name('parent.create');
    Route::get('parent/edit/{id}', [ParentController::class, 'edit'])->name('parent.edit');
    Route::post('parent/store', [ParentController::class, 'store'])->name('parent.store');
    Route::put('parent/update/{id}', [ParentController::class, 'update'])->name('parent.update');
    Route::delete('parent/destroy/{id}', [ParentController::class, 'destroy'])->name('parent.destroy');
    Route::get('parent/show/{id}', [ParentController::class, 'show'])->name('parent.show');
    //TA Siswa
    Route::get('ta/index', [TaController::class, 'index'])->name('ta.index');
    Route::get('ta/edit/{id}', [TaController::class, 'edit'])->name('ta.edit');
    Route::post('ta/store', [TaController::class, 'store'])->name('ta.store');
    Route::put('ta/update/{id}', [TaController::class, 'update'])->name('ta.update');
    Route::delete('ta/destroy/{id}', [TaController::class, 'destroy'])->name('ta.destroy');
    //Grade
    Route::get('grade/index', [GradeController::class, 'index'])->name('grade.index');
    Route::get('grade/edit/{id}', [GradeController::class, 'edit'])->name('grade.edit');
    Route::put('grade/update/{id}', [GradeController::class, 'update'])->name('grade.update');
    Route::post('grade/store', [GradeController::class, 'store'])->name('grade.store');
    Route::delete('grade/destroy/{id}', [GradeController::class, 'destroy'])->name('grade.destroy');
    //Student
    Route::get('student/index', [StudentController::class, 'index'])->name('student.index');
    Route::get('student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('student/{student}', [StudentController::class, 'show'])->name('student.show');
    Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('student/update/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
    Route::delete('student/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
    //SPP
    Route::get('spp/index', [SppController::class, 'index'])->name('spp.index');
    Route::get('spp/create', [SppController::class, 'create'])->name('spp.create');
    Route::get('spp/edit/{id}', [SppController::class, 'edit'])->name('spp.edit');
    Route::put('spp/update/{id}', [SppController::class, 'update'])->name('spp.update');
    Route::post('spp/store', [SppController::class, 'store'])->name('spp.store');
    Route::delete('spp/destroy/{id}', [SppController::class, 'destroy'])->name('spp.destroy');
    //MASTER SPP
    Route::get('spp/student/index', [StudentFeeController::class, 'index'])->name('spp/student.index');
    Route::get('spp/student/edit/{id}', [StudentFeeController::class, 'edit'])->name('spp/student.edit');
    Route::post('spp/student/store', [StudentFeeController::class, 'store'])->name('spp/student.store');
    Route::put('spp/student/update/{id}', [StudentFeeController::class, 'update'])->name('spp/student.update');
    Route::delete('spp/student/destroy/{id}', [StudentFeeController::class, 'destroy'])->name('spp/student.destroy');
    //Transaction
    Route::get('transaction/index', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transaction/terima/{id}', [TransactionController::class, 'terima'])->name('transaction.terima');
    Route::get('transaction/tolak/{id}', [TransactionController::class, 'tolak'])->name('transaction.tolak');
    Route::post('transaction/store/{id}', [TransactionController::class, 'store'])->name('transaction.store');
    Route::put('transaction/update/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('transaction/destroy/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    //Fee
    Route::get('fee/index', [FeeController::class, 'index'])->name('fees.index');
    Route::post('fee/store', [FeeController::class, 'store'])->name('fees.store');
    Route::delete('fee/destroy/{id}', [FeeController::class, 'destroy'])->name('fees.destroy');
    //Payment
    Route::get('payments/index', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::get('payments/edit/{payment}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::put('payments/update/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('payments/destroy/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    //Payment Detail
    Route::get('payments/details/index/{payment}', [PaymentController::class, 'detailsIndex'])->name('payments.details.index');
    Route::get('payments/details/create/{payment}', [PaymentController::class, 'detailsCreate'])->name('payments.details.create');
    Route::post('payments/details/store/{payment}', [PaymentController::class, 'detailsStore'])->name('payments.details.store');
    Route::get('payments/details/edit/{paymentDetail}', [PaymentController::class, 'detailsEdit'])->name('payments.details.edit');
    Route::put('payments/details/update/{paymentDetail}', [PaymentController::class, 'detailsUpdate'])->name('payments.details.update');
    Route::delete('payments/details/destroy/{paymentDetail}', [PaymentController::class, 'detailsDestroy'])->name('payments.details.destroy');
    //Teacher
    Route::get('teacher/index', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('teacher/edit/{id}', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::post('teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::put('teacher/update/{id}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('teacher/destroy/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
});

Route::get('spp/show/{id}', [SppController::class, 'show'])->name('spp.show');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/report/keuangan', [ReportController::class, 'laporanKeuangan'])->name('report.keuangan');
Route::get('generate-dummy-data', [ReportController::class, 'generateDummyData']);

require __DIR__.'/auth.php';
