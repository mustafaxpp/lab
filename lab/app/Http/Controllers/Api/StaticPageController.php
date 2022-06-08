<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    
    // index
    public function index()
    {

        $phone = StaticPage::where('key','phone')->first();
        $time_work_text = StaticPage::where('key','time_work_text')->first();
        $whatsapp = StaticPage::where('key','whatsapp')->first();
        $youtube = StaticPage::where('key','youtube')->first();
        $instagram = StaticPage::where('key','instagram')->first();
        $facebook = StaticPage::where('key','facebook')->first();
        $twitter = StaticPage::where('key','twitter')->first();
        $about_us = StaticPage::where('key','about_us')->first();
        $our_vision = StaticPage::where('key','our_vision')->first();
        $why_choose_us = StaticPage::where('key','why_choose_us')->first();
        $image = StaticPage::where('key','image')->first();



        $static_pages = [
            'phone' => $phone,
            'time_work_text' => $time_work_text,
            'whatsapp' => $whatsapp,
            'youtube' => $youtube,
            'instagram' => $instagram,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'about_us' => $about_us,
            'our_vision' => $our_vision,
            'why_choose_us' => $why_choose_us,
            'image' => $image,
        ];


        return Response::response(200,'success',['static_pages' => $static_pages ]);

    }

}
