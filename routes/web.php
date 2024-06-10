<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RiderController;
use App\Http\Middleware\SetLanguageMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class,'welcome'] )->name('welcome');
Route::get('/home', [Pagecontroller::class, 'home'])->name('home');

Route::get('/riders/menu', [PageController::class, 'menu'])->name('riders.menu');
Route::get('riders/menu/create', [PageController::class,'create'])->name('riders.create');
Route::get('riders/menu/index',[PageController::class, 'index'])->name('riders.index');
Route::get('/riders/menu/{rider}/edit' , [RiderController::class, 'edit'])->name('rider.edit');
Route::PUT('/riders/menu/{rider}/update', [RiderController::class, 'update'])->name('rider.update');
Route::DELETE('/riders/menu/{rider}/delete', [RiderController::class, 'destroy'])->name('rider.destroy');
Route::get('/riders/menu/profile/{rider}',[RiderController::class, 'profile'])->name('rider.profile');

Route::get('/deliveries/index', [DeliveryController::class, 'index'])->name('delivery.index');
Route::get('deliveries/search', [DeliveryController::class, 'search'])->name('delivery.search');
Route::get('/deliveries/create', [DeliveryController::class, 'create'])->name('delivery.create');
Route::get('/deliveries/create/{rider}', [DeliveryController::class, 'createDeliveryForRider'])->name('delivery.rider.create');
Route::POST('/deliveries/store', [DeliveryController::class, 'store'])->name('delivery.store');
Route::get('/deliveries/{delivery}/edit/{condition}/{rider}', [DeliveryController::class, 'edit'])->name('delivery.edit');
Route::PUT('deliveries/{delivery}/update/{condition}/{rider2}', [DeliveryController::class, 'update'])->name('delivery.update');
Route::DELETE('deliveries/{delivery}/delete', [DeliveryController::class, 'destroy'])->name('delivery.destroy');

Route::POST('language/{lang}', [PageController::class, 'setLanguage'])->name('set_language_locale')->middleware('setLanguage');

//route for searchables 
Route::get('/riders/research', [RiderController::class, 'research'])->name('riders.research');