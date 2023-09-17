<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recentUsers = User::whereHas('roles', function ($q){
            $q->where('name','user');
        })->get();
        $confirmedCount = Services::where('status', 'Confirm')->count();
        $processingCount = Services::where('status', 'Processing')->count();
        $pendingCount = Services::where('status', 'Pending')->count();
        $assignedCount = Services::where('status', 'Assigned')->count();
        $completedCount = Services::where('status', 'Completed')->count();
        return view('dashboard', compact('recentUsers','completedCount','assignedCount','confirmedCount','pendingCount', 'processingCount'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $feedbacks = Feedback::with('user')->latest()->take(5)->get();
        $response = $feedbacks->map(function ($feedback) {
            return [
                'photo' => 'url("https://cdn.pixabay.com/photo/2018/03/06/22/57/portrait-3204843_960_720.jpg")',
                'name' => $feedback->user->name,
                'profession' => "WEB DEVELOPER",
                'description' => $feedback->feedback,
            ];
        });
        $feedbacks = $response->toArray();
        return view('home', compact('feedbacks'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function captainHome()
    {
        $currentOrder = Services::with('user')->where(['status'=>'Assigned'])->whereDate('created_at', Carbon::today())->get();
        $placeOrder = Services::with('user')->where(['status'=>'Confirm'])->get();
        $completeOrder = Services::with('user')->where(['status'=>'Completed'])->get();
        return view('captain.home', compact('currentOrder','placeOrder','completeOrder'));
    }
}
