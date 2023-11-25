<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\CreateAddressRequest;
use App\Http\Requests\API\User\UpdateAddressRequest;
use App\Models\Address;
use App\Models\User;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $addressService;
    function __construct()
    {
        $this->addressService = new AddressService();
    }
    public function index(Request $request)
    {
        $address = $this->addressService->list($request->user()->id);

        return Helper::success(
            'User Address List',
            ['address' => $address ?? []]
        );
    }

    public function create(CreateAddressRequest $request)
    {
        $data = [
            'address' => $request->input('address'),
            'user_id' => auth()->user()->id,
        ];

        $res = $this->addressService->create($data);

        if (!$res) {
            return Helper::fail('Invalid request');
        }

        return Helper::success('Address added successfully');
    }

    public function update(UpdateAddressRequest $request, $id)
    {
        $data = [
            'address' => $request->input('address')
        ];

        $res = $this->addressService->update($data, $id);

        if (!$res) {
            return Helper::fail('Invalid request');
        }

        return Helper::success('Address updated successfully');
    }

    public function delete($id)
    {
        $res = $this->addressService->delete($id);

        if (!$res) {
            return Helper::fail('Invalid request');
        }

        return Helper::success('Address deleted successfully');
    }
}
