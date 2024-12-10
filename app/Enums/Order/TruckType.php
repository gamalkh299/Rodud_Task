<?php

namespace App\Enums\Order;

enum TruckType : string
{
    case Small = 'Small';
    case Medium = 'Medium';
    case Large = 'Large';
    case ExtraLarge = 'Extra Large';
}
