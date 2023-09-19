<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Models\User;
use Faker\Factory as Faker;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('feedback.index',compact('feedbacks'));
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
     * @param  \App\Http\Requests\StoreFeedbackRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFeedbackRequest $request)
    {
        $users = User::where('mobile',$request->to)->first();
        if (!$users){
            $faker = Faker::create();
            $users = User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'mobile' => $request->input('to'),
                'password' => bcrypt('password'), // Hashed password
            ]);
            $users->assignRole('user'); // Assign admin role
        }
        $feedback = new Feedback();
        $feedback->user_id = $users->id;
        $feedback->feedback = $request->subject;
        if ($feedback->save()){
            return redirect()->back()->with('error','Feedback Added Successfully');
        }
        return redirect()->back()->with('error','Something Went Wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedbackRequest  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Feedback $feedback)
    {
        if ($feedback){
            $feedback->delete();
        }
        return redirect()->route(   'feedback.index')->with('success', 'Feedback deleted successfully.');
    }
}
