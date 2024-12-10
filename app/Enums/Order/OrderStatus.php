<?php

namespace App\Enums\Order;

enum OrderStatus : string
{
    case Pending = 'Pending';
    case InProgress = 'In Progress';
    case Shipped = 'Shipped';
    case Delivered = 'Delivered';
    case Canceled = 'Canceled';
    case Returned = 'Returned';



    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::InProgress => 'info',
            self::Shipped => 'success',
            self::Delivered => 'success',
            self::Canceled => 'danger',
            self::Returned => 'danger',
        };
    }



    /**
     * Return an array of all order statuses with their respective colors.
     *
     * @return array
     */
    public static function getStatusesWithColors(): array
    {
        return [
            self::Pending->value => self::Pending->color(),
            self::InProgress->value => self::InProgress->color(),
            self::Shipped->value => self::Shipped->color(),
            self::Delivered->value => self::Delivered->color(),
            self::Canceled->value => self::Canceled->color(),
            self::Returned->value => self::Returned->color(),
        ];
    }

}
