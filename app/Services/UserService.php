<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Services;
use App\Models\User;
use Illuminate\Support\Fluent;

class UserService
{
    protected $userModel;
    protected $helper;
    public function __construct()
    {
        $this->userModel = new User();
        $this->helper = new Helper();
    }

    public function signup(array $data = []): ?Fluent
    {
        $user = $this->userModel->create($data);

        return $this->helper->hydrate($user);
    }
}