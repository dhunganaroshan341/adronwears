<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';

    /**
     * For validation / forms
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
