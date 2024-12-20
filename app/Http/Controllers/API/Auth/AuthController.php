<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\API\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\signInRequest;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('api_token')->plainTextToken;
        data_set($user, 'token', $token);

        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM_SINGLE,
            resource: UserResource::class,
            data_passed: $user,
            custom_message: __('User created successfully'
            ),
        );
    }
    public function signin(SignInRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::find(auth('api')->id());
            $token = $user->createToken('api_token')->plainTextToken;
            data_set($user, 'token', $token);
            return generalApiResponse(
                method: ResponseMethodEnum::CUSTOM_SINGLE,
                resource: UserResource::class,
                data_passed: $user,
                custom_message: __('success login')
            );
        }
        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM,
            custom_message: __('Incorrect username or password.'),
            custom_status_msg: 'fail',
            custom_status: 422
        );


    }

    public function logout()
    {
        auth('api')->user()->tokens()->delete();
        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM,
            custom_message: __('Logged out successfully'),
            custom_status_msg: 'success',
            custom_status: 200
        );
    }

    public function user()
    {
        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM_SINGLE,
            resource: UserResource::class,
            data_passed: auth('api')->user(),
            custom_message: __('User retrieved successfully')
        );
    }

    public function notifications(Request $request)
    {
        $user = User::where('id', auth('api')->id())->first();


        $notifications = $user->notifications()->latest()->get();

        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM,
            data_passed: $notifications,
            custom_message: __('Notifications retrieved successfully')
        );
    }

    public function markAsRead(Request $request)
    {
        $user = \auth('api')->user();

        $user->unreadNotifications->markAsRead();

        return generalApiResponse(
            method: ResponseMethodEnum::CUSTOM,
            custom_message: __('All notifications marked as read')
        );
    }
}
