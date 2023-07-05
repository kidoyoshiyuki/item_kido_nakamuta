<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//ホーム画面のルーティング
//一般ユーザー以上がアクセス可能な領域
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});



//商品一覧・登録・編集のルーティング
Route::prefix('items')->group(function () {
    //一般ユーザー以上がアクセス可能な領域
    Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
        Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
        //降順表示
        Route::get('/reverse', [App\Http\Controllers\ItemController::class, 'reverse']);
    });

    //管理者以上がアクセス可能な領域
    Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
        Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
        Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
        //商品編集画面の表示
        Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
        //商品編集処理の実行
        Route::post('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    });
});



//種別一覧・登録・編集のルーティング
Route::prefix('types')->group(function () {
    //一般ユーザー以上がアクセス可能な領域
    Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
        Route::get('/', [App\Http\Controllers\TypeController::class, 'index']);
        //降順表示
        Route::get('/reverse', [App\Http\Controllers\TypeController::class, 'reverse']);
    });

    // 管理者以上がアクセス可能な領域
    Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
        //種別登録画面の表示
        Route::get('/add', [App\Http\Controllers\TypeController::class, 'add']);
        //種別登録処理の実行
        Route::post('/add', [App\Http\Controllers\TypeController::class, 'add']);

        //種別編集画面の表示
        Route::get('/edit/{id}', [App\Http\Controllers\TypeController::class, 'edit']);
        //種別編集処理の実行
        Route::post('/edit/{id}', [App\Http\Controllers\TypeController::class, 'edit']);
    });
});


