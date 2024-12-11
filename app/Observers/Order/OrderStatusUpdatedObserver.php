<?php

namespace App\Observers\Order;

class OrderStatusUpdatedObserver
{
    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(\App\Models\Order $order)
    {
        if ($order->isDirty('order_status')) {
            // Send notification to the user
            $order->user->notify(new \App\Notifications\OrderStatusUpdatedNotification($order));
        }
    }
}
