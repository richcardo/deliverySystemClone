<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RiderController;
use App\Http\Middleware\SetLanguageMiddleware;
use Illuminate\Support\Facades\Route;



Route::get('/', [PageController::class,'welcome'] )->name('welcome');
Route::get('/home', [Pagecontroller::class, 'home'])->name('home');

Route::get('/riders/menu', [PageController::class, 'menu'])->name('riders.menu')->middleware('auth');
Route::get('riders/menu/create', [PageController::class,'create'])->name('riders.create')->middleware('auth');
Route::get('riders/menu/index',[PageController::class, 'index'])->name('riders.index')->middleware('auth');
Route::get('/riders/menu/{rider}/edit' , [RiderController::class, 'edit'])->name('rider.edit')->middleware('auth');
Route::PUT('/riders/menu/{rider}/update', [RiderController::class, 'update'])->name('rider.update')->middleware('auth');
Route::DELETE('/riders/menu/{rider}/delete', [RiderController::class, 'destroy'])->name('rider.destroy')->middleware('auth');
Route::get('/riders/menu/profile/{rider}',[RiderController::class, 'profile'])->name('rider.profile')->middleware('auth');

Route::get('/deliveries/index', [DeliveryController::class, 'index'])->name('delivery.index')->middleware('auth');
Route::get('deliveries/search', [DeliveryController::class, 'search'])->name('delivery.search')->middleware('auth');
Route::get('/deliveries/create', [DeliveryController::class, 'create'])->name('delivery.create')->middleware('auth');
Route::get('/deliveries/create/{rider}', [DeliveryController::class, 'createDeliveryForRider'])->name('delivery.rider.create')->middleware('auth');
Route::POST('/deliveries/store/{condition}', [DeliveryController::class, 'store'])->name('delivery.store')->middleware('auth');
Route::get('/deliveries/{delivery}/edit/{condition}/{rider}', [DeliveryController::class, 'edit'])->name('delivery.edit')->middleware('auth');;
Route::PUT('deliveries/{delivery}/update/{condition}/{rider2}', [DeliveryController::class, 'update'])->name('delivery.update')->middleware('auth');;
Route::DELETE('deliveries/{delivery}/delete', [DeliveryController::class, 'destroy'])->name('delivery.destroy')->middleware('auth');;

Route::POST('language/{lang}', [PageController::class, 'setLanguage'])->name('set_language_locale')->middleware('setLanguage');

//route for searchables 
Route::get('/riders/research', [RiderController::class, 'research'])->name('riders.research');

//routes for admin
Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/create',[adminController::class, 'create'])->name('admin.create');
route::DELETE('admin/userDelete/{user}', [AdminController::class, 'destroy'])->name('admin.destroy');