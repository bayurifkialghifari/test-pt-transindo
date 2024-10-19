<?php

use Illuminate\Support\Facades\Route;

Route::get('/merchant/profile', App\Livewire\Cms\Merchant\Profile::class)->name('merchant.profile');
Route::get('/merchant/product', App\Livewire\Cms\Merchant\Product::class)->name('merchant.product');
