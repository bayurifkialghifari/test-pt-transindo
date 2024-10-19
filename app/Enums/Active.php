<?php

namespace App\Enums;

enum Active : int
{
    case Active = 1;
    case Inactive = 0;

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }

    public function class() {
        return match ($this) {
            self::Active => 'badge bg-success',
            self::Inactive => 'badge bg-danger',
        };
    }
}
