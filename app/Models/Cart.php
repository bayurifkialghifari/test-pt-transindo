<?php

namespace App\Models;

use App\Enums\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'active',
    ];

    protected function casts(): array {
        return [
            'active' => Active::class,
        ];
    }

    public function details() {
        return $this->hasMany(CartDetail::class);
    }

    public function merchant() {
        return $this->belongsTo(User::class, 'merchant_id');
    }
}
