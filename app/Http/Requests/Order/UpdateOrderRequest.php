<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends ApiMasterSingleMessageRequest
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
            'truck_type' => 'required|string|in:Small,Medium,Large,Extra Large',
            'size' => 'required|string',
            'loading_location' => 'required|string',
            'delivery_location' => 'required|string',
            'pickup_time' => 'required|date',
            'delivery_time' => 'required|string',
        ];
    }
}
