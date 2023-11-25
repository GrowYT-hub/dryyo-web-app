<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Http\Controllers\TwilioService;
use App\Models\Address;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Fluent;
use File;

class AddressService
{
    protected $addressModel;
    protected $helper;

    public function __construct()
    {
        $this->addressModel = new Address();
    }

    public function list(int $id = null)
    {
        return $this->addressModel->where("user_id", $id)->get()?->toArray();
    }

    public function create(array $data = [])
    {
        return $this->addressModel->create($data);
    }

    public function update(array $data = [], int $id = null)
    {
        return $this->addressModel->whereId($id)->update($data);
    }

    public function delete(int $id = null)
    {
        return $this->addressModel->where('id', $id)->delete();
    }
}