<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\UpdateSocialMediaLink;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('setting.index');
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
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSettingRequest $request)
    {
        //$logoPath = $request->file('logo')->store('uploads');
        
        $file = $request->file('logo');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $logoPath = 'uploads/'.$fileName; 
        
        
       # $footerLogoPath = $request->file('footer_logo')->store('uploads');
       $file = $request->file('footer_logo');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $footerLogoPath = 'uploads/'.$fileName;
       
       
        #$faviconIconPath = $request->file('favicon_icon')->store('uploads');
         $file = $request->file('favicon_icon');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $faviconIconPath = 'uploads/'.$fileName;
        
        $setting = Setting::where('user_id',Auth::guard()->user()->id)->first();
        if (!$setting){
            $setting = new Setting();
            $setting->user_id = Auth::guard()->user()->id;
        }
        $setting->logo = $logoPath;
        $setting->footer_logo = $footerLogoPath;
        $setting->favicon_icon = $faviconIconPath;
        $setting->save();

        return back()->with('success', 'Files uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSocialMediaLink  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSocialMediaLink(UpdateSocialMediaLink $request)
    {
        $setting = Setting::where('user_id',Auth::guard()->user()->id)->first();
        if (!$setting){
            $setting = new Setting();
            $setting->user_id = Auth::guard()->user()->id;
        }
        $setting->facebook_link = $request->facebook_link;
        $setting->instagram_link = $request->instagram_link;
        $setting->youtube_link = $request->youtube_link;
        $setting->linkedin_link = $request->linkedin_link;
        $setting->save();

        return back()->with('success', 'Files uploaded successfully!');
    }
}
