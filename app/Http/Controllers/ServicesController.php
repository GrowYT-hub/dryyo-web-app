<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRequestCaptain;
use App\Http\Requests\StoreServicesRequest;
use App\Http\Requests\UpdateServicesRequest;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Services::with(['user','assign'])->get();
        $captainUsers = User::whereHas('roles', function ($q){
            $q->where('name', 'captain');
        })->get();
        return view('services.index', compact('orders','captainUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.request-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServicesRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreServicesRequest $request)
    {
        try {
            $user = User::where(['mobile'=>$request->to])->first();
            if (!$user){
                $user = new User();
                $user->mobile = $request->to;
                $user->name = $request->name;
                $user->password = bcrypt('password');
                $user->assignRole('user');
                $user->save();
            }
            $services = new Services();
            $services->user_id = $user->id;
            $services->name = $request->name;
            $services->mobile = $request->to;
            $services->subject = $request->message;
            $services->address = $request->address;
            if ($services->save()){
                $to = $request->to; // Recipient phone number
                $message =   'Hello '.$request->name.', Your Order is created successfully.
Your Order Details are below
Order ID : '.$services->id.'
Name : '.$services->name.'
Subject : '.$services->subject.'
Address : '.$services->address;
                $this->twilioService->sendSMS($to, $message);
                return response()->json(['message' => 'Your request has been sent successfully'], 200);
            }
            return response()->json(['message' => 'Something Went Wrong'],422);
        }catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Services $services
     * @return \Illuminate\Http\Response
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Services $services
     * @return \Illuminate\Http\Response
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServicesRequest  $request
     * @param Services $services
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServicesRequest $request, Services $services)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Services $services
     * @return \Illuminate\Http\Response
     */
    public function destroy(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param \App\Http\Requests\AssignRequestCaptain $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRequest(AssignRequestCaptain $request){
        $services = Services::with(['assign','user'])->find($request->request_id);
        if ($services){
            $messages = 'Hello, Your Order('.$request->request_id.') Status has been changed '.$services->status. ' to Assigned';

            $services->assigned_id = $request->captain_id;
            $services->status = 'Assigned';
            if ($services->save()){
                $customer_to = $services->user->mobile;
                $assign_to = $services->assign->mobile;
                $this->twilioService->sendSMS($customer_to, $messages);
                $this->twilioService->sendSMS($assign_to, $messages);
                return response()->json(['message' => 'Your request has been assigned successfully'], 200);
            }

        }
        return response()->json(['message' => 'Something Went Wrong'],422);
    }

    public function orderDetailChart(Request $request){
        $confirmedCount = Services::where('status', 'Confirm')->whereDate('created_at', Carbon::create($request->date)->format('Y-m-d'))->count();
        $processingCount = Services::where('status', 'Processing')->whereDate('created_at', Carbon::create($request->date)->format('Y-m-d'))->count();
        $pendingCount = Services::where('status', 'Pending')->whereDate('created_at', Carbon::create($request->date)->format('Y-m-d'))->count();
        $assignedCount = Services::where('status', 'Assigned')->whereDate('created_at', Carbon::create($request->date)->format('Y-m-d'))->count();
        $completedCount = Services::where('status', 'Completed')->whereDate('created_at', Carbon::create($request->date)->format('Y-m-d'))->count();
        return response()->json([
            'message' => 'Your charts',
            'data' => [
                'confirm'=>$confirmedCount,
                'processing'=>$processingCount,
                'pending'=>$pendingCount,
                'assigned'=>$assignedCount,
                'completed'=>$completedCount,
                ]], 200);
    }
}
