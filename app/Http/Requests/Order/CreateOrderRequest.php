<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends ApiMasterSingleMessageRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'size' => 'required',
            'weight' => 'required',
            'weight_unit' => 'required',
            'loading_location' => 'required',
            'delivery_location' => 'required',
            'pickup_time' => 'required',
            'delivery_time' => 'required',
            'truck_type' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'size.required' => 'Size is required',
            'weight.required' => 'Weight is required',
            'weight_unit.required' => 'Weight unit is required',
            'loading_location.required' => 'Loading location is required',
            'delivery_location.required' => 'Delivery location is required',
            'pickup_time.required' => 'Pickup time is required',
            'delivery_time.required' => 'Delivery time is required',
            'truck_type.required' => 'Truck type is required'
        ];
    }

}
