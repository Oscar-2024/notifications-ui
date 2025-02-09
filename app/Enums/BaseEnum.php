<?php

namespace App\Enums;

trait BaseEnum
{
    public static function forMigration(): array
    {
        return collect(self::cases())
            ->map(fn ($enum) => $enum->value)
            ->values()
            ->toArray();
    }
}
