<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $captainUsers = User::whereHas('roles', function ($q){
            $q->where('name', 'captain');
        }); // Select the necessary columns

        // Perform any filtering, sorting, and paging here if required
        // For example:
        if ($request->has('search')) {
            $captainUsers->where('name', 'like', '%' . $request->input('search.value') . '%');
        }
        // Prepare the data for response
        $captainUsersList = $captainUsers->paginate($request->input('length'));


        $users = User::whereHas('roles', function ($q){
            $q->where('name', 'user');
        }); // Select the necessary columns

        // Perform any filtering, sorting, and paging here if required
        // For example:
        if ($request->has('search')) {
            $users->where('name', 'like', '%' . $request->input('search.value') . '%');
        }
        // Prepare the data for response
        $usersList = $users->paginate($request->input('length'));
        return view('user.index', compact('captainUsersList','usersList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddUserRequest $request)
    {
        $user = new User();
        $user->name = $request->first_name.' '.$request->last_name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->alternative_mobile = $request->alternative_mobile;
        $user->password = bcrypt('password'); // Hashed password
        if ($user->save()){
            $user->assignRole($request->role);
            return response()->json([
                'status'=> true,
                'message'=> 'User Added Successfully',
                'data'=> $user
            ],200);
        }
        return response()->json([
            'status'=> false,
            'message'=> 'Something Went Wrong!'
        ],422);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
