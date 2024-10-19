<?php

namespace App\Models;

use App\Enums\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Checkout extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'cart_id',
        'total',
        'status',
        'status_delivery',
    ];

    protected function casts(): array {
        return [
            'status' => Active::class,
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function merchant() {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
