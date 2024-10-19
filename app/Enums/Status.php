<?php

namespace App\Enums;

enum Status : int
{
    case Verified = 1;
    case Unverified = 2;
    case Pending = 0;

    public function label(): string
    {
        return match ($this) {
            self::Verified => 'Verified',
            self::Unverified => 'Unverified',
            self::Pending => 'Pending',
        };
    }

    public function class() {
        return match ($this) {
            self::Verified => 'badge bg-success',
            self::Unverified => 'badge bg-danger',
            self::Pending => 'badge bg-warning',
        };
    }
}
