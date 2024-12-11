<?php

namespace App\Nova;

use App\Enums\Order\OrderStatus;
use App\Enums\Order\Size;
use App\Enums\Order\WeightUnit;
use App\Nova\Actions\Order\MarkOrderAsCanceled;
use App\Nova\Actions\Order\MarkOrderAsDelivered;
use App\Nova\Actions\Order\MarkOrderAsInProgress;
use App\Nova\Actions\Order\MarkOrderAsShipped;
use App\Nova\Metrics\Orders\TotalOrders;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Order>
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'loading_location';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'loading_location',
        'delivery_location',
        'pickup_time',
        'delivery_time',
        'order_status',
        'truck_type',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable('desc'),

            Text::make('Weight', function () {
                return $this->weight . ' ' . $this->weight_unit->label();

            })
                ->sortable()
                ->rules('required', 'max:255'),

            //to add weight field
            Text::make('Weight', 'weight')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->hideFromDetail(),

            //to add weight_unit field
            Select::make('Weight Unit', 'weight_unit')
                ->options(WeightUnit::toArray())
                ->displayUsingLabels()
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->hideFromDetail(),

            Select::make('Size', 'size')
                ->options(Size::toArray())
                ->displayUsingLabels()
                ->sortable()
                ->hideFromIndex()
                ->hideFromDetail()
                ->rules('required'),

            Text::make('Loading Location', 'loading_location')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Delivery Location', 'delivery_location'),
            DateTime::make('Pickup Time', 'pickup_time')
                ->onlyOnDetail()
                ->sortable()
                ->rules('required'),

            DateTime::make('Delivery Time', 'delivery_time')
                ->hideFromIndex()
                ->sortable()
                ->rules('required')
            ,

            Badge::make('Order Status','order_status')
                ->map(OrderStatus::getStatusesWithColors())
                ->withIcons(),

            Select::make('Order Status', 'order_status')
                ->options(OrderStatus::getSelectOptions())
                ->displayUsingLabels()
                ->sortable()
                ->rules('required')
                ->hideFromDetail()
                ->hideFromIndex(),

            Text::make('Truck Type', 'truck_type')
                ->sortable()
                ->rules('required', 'max:255')
                ->onlyOnDetail(),

            //Relationships
            BelongsTo::make('User', 'user', User::class)
                ->rules('required')
                ->searchable()
                ->sortable()
                ->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            (new TotalOrders())->width('1/3'),
            (new Metrics\Orders\AvarageOfOrders)->width('1/3'),
            (new Metrics\Orders\OrdersStatus)->width('1/3'),

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new Filters\Order\OrderStatusFilter(),
            new Filters\Order\FilterByDate('pickup_time'),
            new Filters\Order\FilterByDate('delivery_time'),

        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new MarkOrderAsInProgress())
                ->showInline(),
            (new MarkOrderAsShipped())
                ->showInline(),
            (new MarkOrderAsDelivered())
                ->showInline(),
            (new MarkOrderAsCanceled())
                ->showInline(),
        ];
    }
}
