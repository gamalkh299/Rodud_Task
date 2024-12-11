<?php

namespace App\Models;

use App\Enums\Order\OrderStatus;
use App\Enums\Order\TruckType;
use App\Enums\Order\WeightUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'user_id',
        'size',
        'weight',
        'weight_unit',
        'loading_location',
        'delivery_location',
        'pickup_time',
        'delivery_time',
        'order_status',
        'truck_type'
    ];

    protected $casts = [
        'order_status' => OrderStatus::class,
        'truck_type' => TruckType::class,
        'weight_unit' => WeightUnit::class,
        'pickup_time' => 'datetime',
        'delivery_time' => 'datetime'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
