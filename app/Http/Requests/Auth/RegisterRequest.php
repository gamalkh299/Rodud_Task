<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiMasterSingleMessageRequest;

class RegisterRequest extends ApiMasterSingleMessageRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:255|string',
            'email'         => 'nullable|email:dns|unique:users,email',
            'password'      => 'required|confirmed|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required'    => __('Full Name is required'),
            'password.required'     => __('Password is required'),
            'password.same'         => __('Password Confirmation should match the Password'),
            'email.email'           => __('Email is not correct'),
            'email.unique'          => __('This email already exists'),
        ];
    }
}
