<?php

namespace App\Enums\Order;

enum WeightUnit : string
{
    case Kilogram = 'KG';
    case Gram = 'G';
    case Pound = 'LB';
    case Ounce = 'OZ';

    case Tonne = 'T';

    public static function toArray(): array
    {
        return [
            self::Gram->name => self::Gram->value,
            self::Kilogram->name => self::Kilogram->value,
            self::Tonne->name => self::Tonne->value,
            self::Pound->name => self::Pound->value,
            self::Ounce->name => self::Ounce->value,

        ];
    }

    public function label()
    {
        return match($this) {
            self::Kilogram => 'KG',
            self::Gram => 'G',
            self::Pound => 'LB',
            self::Ounce => 'OZ',
            self::Tonne => 'T',

        };
    }
}
