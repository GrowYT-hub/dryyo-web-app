<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting();
        $setting->user_id = 1;
        $setting->logo = 'assets/user/img/logo.JPG';
        $setting->footer_logo = 'assets/user/img/logo.JPG';
        $setting->favicon_icon = 'assets/user/img/logo.JPG';
        $setting->facebook_link = 'https://www.facebook.com/';
        $setting->instagram_link = 'https://www.instagram.com/';
        $setting->youtube_link = 'https://www.youtube.com/';
        $setting->linkedin_link = 'https://www.linkedin.com/';
        $setting->save();
    }
}
