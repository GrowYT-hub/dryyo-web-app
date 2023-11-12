<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Http\Controllers\TwilioService;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Fluent;
use File;

class UserService
{
    protected $userModel;
    protected $helper;
    protected $twilioService;
    protected $userOtpModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->helper = new Helper();
        $this->twilioService = new TwilioService();
        $this->userOtpModel = new UserOtp();
    }

    public function signup(array $data = []): ?Fluent
    {
        $user = $this->userModel->create($data);

        return $this->helper->hydrate($user);
    }

    public function sendOtp(array $data = [], int $otp = null)
    {
        $message = "Your Dryyo code is: " . $otp;
        $res = $this->twilioService->sendSMS("+91" . $data['mobile'], $message);
        $this->storeOtp($data, $otp);

        return $res;
    }

    public function storeOtp(array $data = [], int $otp = null)
    {
        $this->userOtpModel->where('mobile', $data['mobile'])->delete();

        $input = [
            'mobile' => $data['mobile'],
            'otp' => $otp,
            'input_log' => json_encode($data),
        ];

        $this->userOtpModel->create($input);
    }

    public function changePassword(array $data = [])
    {
        $user = $this->userModel->where('mobile', $data['mobile'])->first();

        if ($user) {
            $this->userOtpModel->where('mobile', $data['mobile'])->delete();

            $user->password = bcrypt($data['password']);
            $user->save();

            return true;
        }

        return false;
    }

    public function updateProfile($request)
    {
        $data = [];

        if (@$request->name) {
            $data['name'] = $request->name;
        }

        if (@$request->hasFile('profile_image')) {

            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
            $data['profile_image'] = "profile_images/" . $imageName;

            $oldImage = $request->user()->profile_image;

            // Delete old profile image
            if ($oldImage && File::exists(public_path('profile_images/' . $oldImage))) {
                File::delete(public_path('profile_images/' . $oldImage));
            }
        }

        if (count($data)) {
            return $this->userModel->whereId(auth()->user()->id)->update($data);
        }

        return false;
    }
}