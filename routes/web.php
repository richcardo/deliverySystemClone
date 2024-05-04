<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\RiderController;

Route::get('/', [PageController::class,'welcome'] )->name('welcome');
Route::get('/home', [Pagecontroller::class, 'home'])->name('home');

Route::get('/riders/menu', [PageController::class, 'menu'])->name('riders.menu');
Route::get('riders/menu/create', [PageController::class,'create'])->name('riders.create');
Route::get('riders/menu/index',[PageController::class, 'index'])->name('riders.index');
Route::get('/riders/menu/{rider}/edit' , [RiderController::class, 'edit'])->name('rider.edit');
Route::PUT('/riders/menu/{rider}/update', [RiderController::class, 'update'])->name('rider.update');
Route::DELETE('/riders/menu/{rider}/delete', [RiderController::class, 'destroy'])->name('rider.destroy');

Route::get('/deliveries/index', [DeliveryController::class, 'index'])->name('delivery.index');
Route::get('/deliveries/create', [DeliveryController::Class, 'create'])->name('delivery.create');
Route::POST('/deliveries/store', [DeliveryController::class, 'store'])->name('delivery.store');