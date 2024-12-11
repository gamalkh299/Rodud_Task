<?php

namespace App\Http\Controllers\API\Order;

use App\Enums\API\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Admin;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Admin\Order\OrderCreatedNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return all orders of the authenticated user
       $orders = Order::where('user_id', auth('api')->id())->get();
        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM_COLLECTION,
            resource: OrderResource::class,
            data_passed: $orders,
            custom_message: __('Orders retrieved successfully')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {

        //Create Order
        $order = Order::create(array_merge($request->validated(), ['user_id' => auth('api')->id()]));

        //Notify Admin
        Admin::all()->each->notify(new OrderCreatedNotification($order));

        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM_SINGLE,
            resource: OrderResource::class,
            data_passed: $order,
            custom_message: __('Order created successfully')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM_SINGLE,
            resource: OrderResource::class,
            data_passed: $order,
            custom_message: __('Order retrieved successfully')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


    }
}
