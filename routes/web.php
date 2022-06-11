<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Register\InitialSettingController;
use App\Http\Controllers\Register\ConditionInputController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\SettingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// ホーム画面
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// 体調入力画面
Route::get('/conditionInput',[ConditionInputController::class, 'index']) 
            ->middleware(['auth'])
            ->name('conditionInput');

Route::post('/conditionInput', [ConditionInputController::class, 'create'])
            ->middleware(['auth'])
            ->name('conditionInput.create');

Route::post('/conditionInput', [ConditionInputController::class, 'store'])
            ->middleware(['auth'])
            ->name('conditionInput.store');

// 初期設定
Route::get('/initialSetting', [InitialSettingController::class, 'index'])
            ->middleware(['auth'])
            ->name('initialSetting');

Route::post('/initialSetting', [InitialSettingController::class, 'store'])
            ->middleware(['auth'])
            ->name('initialSetting.store');


// レポート画面
Route::get('/report',  [ReportController::class, 'index']) 
            ->middleware(['auth'])
            ->name('report');

// グラフ画面

Route::get('/graph',  [GraphController::class, 'index'])
            ->middleware(['auth'])
            ->name('graph');

// 設定画面
Route::get('/setting', [SettingController::class, 'index']) 
            ->middleware(['auth'])
            ->name('setting');

Route::post('/setting', [SettingController::class, 'store']) 
            ->middleware(['auth'])
            ->name('setting.store');


require __DIR__.'/auth.php';
