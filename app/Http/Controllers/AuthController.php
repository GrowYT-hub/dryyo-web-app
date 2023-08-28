<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;

class AuthController extends Controller
{


    public function sendOtp(Request $request)
    {
        $user = User::with('roles')->where('mobile', $request->input('mobile'))->first();
        if (!$user) {
            $faker = Faker::create();
            $user = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'mobile' => $request->input('mobile'),
                'password' => bcrypt('password'), // Hashed password
            ]);
            $user->assignRole('user'); // Assign admin role
        }
        if (!$user->hasRole('user')){
            return redirect()->back()->with('error','Only Customer login allowed');
        }
        $otp = (new Otp())->generate(json_encode(array(
            'id'=>$user->id,
            'name' => $user->name,
            'mobile'=> $user->mobile,
        )));
        // Send the OTP to the user via your preferred method (email, SMS, etc.)

        return redirect()->route('user.showVerifyOtp',['mobile'=>$request->input('mobile')]);
    }

    public function showVerifyOtp($mobile){
        return view('auth.user-verify-otp',['mobile' => $mobile]);
    }

    public function verifyOtp(Request $request)
    {
        $user = User::where('mobile', $request->input('mobile'))->first();

        if (!$user) {
            return redirect()->back()->with('error','User not found');
        }

        $otp = $request->input('otp');
        if (!(new Otp())->validate(json_encode(array(
            'id'=>$user->id,
            'name' => $user->name,
            'mobile'=> $user->mobile,
        )), $otp)) {
            return redirect()->back()->with('error','Invalid OTP');
        }

        Auth::guard('web')->login($user);

        return redirect()->route('home');
    }
}
