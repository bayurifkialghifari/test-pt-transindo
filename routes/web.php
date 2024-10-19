<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Home::class)->name('home');
Route::get('/merchant/{id}', App\Livewire\ListMenuMerchant::class)->name('menu-merchant');
Route::get('/carts', App\Livewire\Cart::class)->name('cart');
Route::get('/checkout/{id}', App\Livewire\Checkout::class)->name('checkout');
Route::get('/history', App\Livewire\HistoryPayment::class)->name('history');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/cms.php';
require __DIR__.'/auth.php';
