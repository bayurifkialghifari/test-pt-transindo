<?php

namespace App\Models;

use App\Enums\Status;
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
        'delivery_date',
    ];

    protected function casts(): array {
        return [
            'status' => Status::class,
            'delivery_date' => 'date',
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function merchant() {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }
}
