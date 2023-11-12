<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\ChangePasswordRequest;
use App\Http\Requests\API\User\LoginRequest;
use App\Http\Requests\API\User\SendOtpRequest;
use App\Http\Requests\API\User\SignupRequest;
use App\Http\Requests\API\User\UpdateProfileRequest;
use App\Http\Requests\API\User\VerifyOtpRequest;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;
    function __construct()
    {
        $this->userService = new UserService();
    }
    public function signup(SignupRequest $request)
    {
        if (!$request->input('send_otp')) {
            $user_data = [
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'password' => bcrypt($request->input('password')),
            ];

            $user = $this->userService->signup($user_data);

            return response()->json(['success' => true, 'message' => 'User registered successfully'], 201);
        } else {
            $otp = rand(1000, 9999);
            $res = $this->userService->sendOtp($request->all(), $otp);

            return response()->json(['success' => true, 'message' => 'Otp sent'], 200);
        }

    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(['success' => true, 'data' => ['user' => $user, 'token' => $token]], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function profile()
    {
        $user = Auth::user();

        return response()->json(['success' => true, 'data' => ['user' => $user]], 200);
    }

    public function verifyOtp(VerifyOtpRequest $request)
    {
        return response()->json(['success' => true, 'message' => 'The selected otp is valid.'], 200);
    }

    public function sendOtp(SendOtpRequest $request)
    {
        $otp = rand(1000, 9999);
        $res = $this->userService->sendOtp($request->all(), $otp);

        return response()->json(['success' => true, 'message' => 'Otp sent'], 200);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $res = $this->userService->changePassword($request->all());

        if (!$res) {
            return response()->json(['success' => false, 'message' => 'Invalid request'], 400);
        }

        return response()->json(['success' => true, 'message' => "Password changed"], 200);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $res = $this->userService->updateProfile($request);

        if (!$res) {
            return response()->json(['success' => false, 'message' => "Invalid request"], 400);
        }

        return response()->json(['success' => true, 'message' => "Profile updated"], 200);
    }
}
