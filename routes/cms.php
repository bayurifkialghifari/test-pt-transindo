<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => ['auth', 'validate-role-permission'],
], function () {

    Route::get('/', App\Livewire\Cms\Dashboard::class)->name('dashboard');

    // Product type
    Route::get('/product-type', App\Livewire\Cms\Product\Type::class)->name('product.type');

    // Merchant
    require_once __DIR__ . '/cms/merchant.php';

    // Management
    require_once __DIR__ . '/cms/management.php';

    // Logs
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});
