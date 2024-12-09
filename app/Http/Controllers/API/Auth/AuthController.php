<?php

namespace App\Http\Controllers\API\Auth;

use App\Enums\API\ResponseMethodEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\signInRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(SignInRequest $request)
    {

    }
}
