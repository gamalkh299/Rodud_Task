<?php

namespace App\Nova;

use App\Enums\Order\OrderStatus;
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
    public static $title = 'id';

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
            ID::make()->sortable(),

            Text::make('Weight', function () {
                return $this->weight . ' ' . $this->weight_unit;
            }),
            Text::make('Size', 'size'),
            Text::make('Loading Location', 'loading_location')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Delivery Location', 'delivery_location'),
            DateTime::make('Pickup Time', 'pickup_time')
                ->onlyOnDetail()
                ->sortable()
                ->rules('required'),

            DateTime::make('Delivery Time', 'delivery_time')
                ->onlyOnDetail()
                ->sortable()
                ->rules('required'),

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
                ->rules('required', 'max:255'),

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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
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
        return [];
    }
}
