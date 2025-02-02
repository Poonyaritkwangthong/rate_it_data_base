<?php

use App\Http\Controllers\AboveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\FurtherController;
use App\Http\Controllers\HeadShip01Controller;
use App\Http\Controllers\HeadShip02Controller;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RateItController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SelfController;
use App\Http\Controllers\SummarizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/page/capacity_rate_it/indicators/index', [IndicatorController::class, 'index'])->name('page.capacity_rate_it.indicators.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('page/user/index', [ChartController::class, 'index'])->name('page.user.index');

    Route::get('/page/rate_it/index', [RateItController::class, 'index'])->name('page.rate_it.index');
    Route::get('/page/rate_it/create/{id}', [RateItController::class, 'create'])->name('page.rate_it.create');
    Route::post('/page/rate_it/store', [RateItController::class, 'store'])->name('page.rate_it.store');

    Route::get('/page/capacity_rate_it/assessment_01/index', [HeadShip01Controller::class, 'index'])->name('page.capacity_rate_it.assessment_01.index');
    Route::get('/page/capacity_rate_it/assessment_01/create/{id}', [HeadShip01Controller::class, 'create'])->name('page.capacity_rate_it.assessment_01.create');
    Route::post('/page/capacity_rate_it/assessment_01/store', [HeadShip01Controller::class, 'store'])->name('page.capacity_rate_it.assessment_01.store');

    Route::get('/page/capacity_rate_it/assessment_02/index', [HeadShip02Controller::class, 'index'])->name('page.capacity_rate_it.assessment_02.index');
    Route::get('/page/capacity_rate_it/assessment_02/create/{id}', [HeadShip02Controller::class, 'create'])->name('page.capacity_rate_it.assessment_02.create');
    Route::post('/page/capacity_rate_it/assessment_02/store', [HeadShip02Controller::class, 'store'])->name('page.capacity_rate_it.assessment_02.store');

    Route::get('/page/capacity_rate_it/summarize/index', [SummarizeController::class, 'index'])->name('page.capacity_rate_it.summarize.index');
    Route::get('/page/capacity_rate_it/summarize/create/{id}', [SummarizeController::class, 'create'])->name('page.capacity_rate_it.summarize.create');
    Route::post('/page/capacity_rate_it/summarize/store', [SummarizeController::class, 'store'])->name('page.capacity_rate_it.summarize.store');

    Route::get('/page/capacity_rate_it/above/index', [AboveController::class, 'index'])->name('page.capacity_rate_it.above.index');
    Route::get('/page/capacity_rate_it/above/create/{id}', [AboveController::class, 'create'])->name('page.capacity_rate_it.above.create');
    Route::post('/page/capacity_rate_it/above/store', [AboveController::class, 'store'])->name('page.capacity_rate_it.above.store');

    Route::get('/page/capacity_rate_it/further/index', [FurtherController::class, 'index'])->name('page.capacity_rate_it.further.index');
    Route::get('/page/capacity_rate_it/further/create/{id}', [FurtherController::class, 'create'])->name('page.capacity_rate_it.further.create');
    Route::post('/page/capacity_rate_it/further/store', [FurtherController::class, 'store'])->name('page.capacity_rate_it.further.store');

    Route::get('/page/capacity_rate_it/self_rate_it/index', [SelfController::class, 'index'])->name('page.capacity_rate_it.self_rate_it.index');
    Route::get('/page/capacity_rate_it/self_rate_it/create/{id}', [SelfController::class, 'create'])->name('page.capacity_rate_it.self_rate_it.create');
    Route::post('/page/capacity_rate_it/self_rate_it/store', [SelfController::class, 'store'])->name('page.capacity_rate_it.self_rate_it.store');

    Route::get('/page/result/index', [ResultController::class, 'index'])->name('page.result.index');
    Route::get('/page/result/show/{id}', [ResultController::class, 'show'])->name('page.result.show');
});


Route::middleware('admin')->group(function () {
    Route::get('/admin/question/index', [QuestionController::class, 'index'])->name('admin.question.index');
    Route::get('/admin/personal/index', [PersonalController::class, 'index'])->name('admin.personal.index');
    Route::post('/admin/personal/index', [PersonalController::class, 'updateRound'])->name('update.round');
});
