<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\LoginRequest;
use App\Http\Requests\API\User\SignupRequest;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function __construct()
    {
        $this->userService = new UserService();
    }
    public function signup(SignupRequest $request)
    {
        $user_data = [
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'password' => bcrypt($request->input('password')),
        ];

        $user = $this->userService->signup($user_data);

        return response()->json(['success' => true, 'message' => 'User registered successfully'], 201);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['success' => true, ['data' => ['user' => $user]], 'token' => $token], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function profile()
    {
        $user = Auth::user();

        return response()->json(['success' => true, 'data' => ['user' => $user]], 200);
    }

}
