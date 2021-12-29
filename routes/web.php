<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PakageController;
use App\Http\Controllers\ConnectionController;

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




Route::group(['middleware'=>'auth'],function () {
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//    Route::namespace('App\Http\Controllers\PakageController')->group(function (){
//
//    });

    Route::get('/pakage-list',[PakageController::class, 'pakagelistview'])->name('pakage_list');
    Route::get('/add-pakage-view',[PakageController::class, 'addpakageview'])->name('add_pakage_view');
    Route::post('/add-pakage',[PakageController::class, 'addpakage'])->name('add_pakage');
    Route::delete('/delete-pakage/{id}',[PakageController::class, 'deletePakage'])->name('delete_pakage');
    Route::get('/edit-pakage-view/{id}',[PakageController::class, 'editPakageView'])->name('edit_pakage_view');
    Route::put('/update-pakage/{id}',[PakageController::class, 'updatePakage'])->name('update_pakage');

    Route::post('/purcahse-pakage/{id}',[PakageController::class, 'Pakagepurchased'])->name('purcahse_pakage');
    Route::get('/buy-connection-view/{id}',[PakageController::class, 'connectionview'])->name('buy_connction_view');


    Route::get('/connection-list',[ConnectionController::class,'index'])->name('conncetion_list');
    Route::get('/add-connection',[ConnectionController::class,'addconnection'])->name('add_connection');
    Route::Post('store/add-connection',[ConnectionController::class,'store'])->name('store_connection');
    Route::get('/get-pakage',[ConnectionController::class,'getpakage'])->name('get-pakage');

    Route::get('/customer-list',[ConnectionController::class,'getcustomer'])->name('customer_list');
    Route::get('/transaction-history/{id}',[ConnectionController::class,'transactionHistory'])->name('transaction_history');
    Route::get('/Connection_history/{id}',[ConnectionController::class,'connectionHistory'])->name('connection_history');
    Route::get('/connection-detail/{id}',[ConnectionController::class,'connectdetail'])->name('connection_detail');
    Route::get('/transaction-generate',[ConnectionController::class,'generateTransaction'])->name('transaction_generate');


});


Auth::routes();
