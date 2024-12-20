<?php

namespace App\Enums\Order;

enum Size : string
{
    case Small = 'Small';
    case Medium = 'Medium';
    case Large = 'Large';
    case ExtraLarge = 'Extra Large';

    public static function toArray(): array
    {
        return [
            self::Small->name => 'Small',
            self::Medium->name => 'Medium',
            self::Large->name => 'Large',
            self::ExtraLarge->name => 'Extra Large',
        ];
    }









}



