<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiMasterSingleMessageRequest;
use Illuminate\Foundation\Http\FormRequest;

class signInRequest extends ApiMasterSingleMessageRequest
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
            'email' => ['required','exists:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=> __('Phone number is required'),
            'email.exists'  => __('Phone number does not exist'),
            'password.required'    => __('Password is required'),
        ];
    }
}
