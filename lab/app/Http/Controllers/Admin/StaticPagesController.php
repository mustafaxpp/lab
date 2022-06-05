<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{

    public function index()
    {

        $static_pages = StaticPage::all();

        return view('admin.static_pages.create' , compact('static_pages'));
    }

    // store
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|numeric',
            'time_work_text' => 'required',
            'whatsapp' => 'required|numeric',
            'facebook' => 'required',
            'instagram' => 'required',
            'messanger' => 'required',
            'youtube' => 'required',
            'twitter' => 'required',
            'about_us' => 'required',
            'our_vision' => 'required',
            'why_choose_us' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // dd($request->all());
        $attr = $request->except('avatar');

        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $attr['image'] = $avatar->move('uploads/static-page-avatar/',rand(1111,9999).'.png');
        }

        foreach ($attr as $key => $value) {
            StaticPage::where('key' , $key)->update(['value' => $value]);
        }

        session()->flash('success','updated successfully');

        return redirect()->back();
    }
}
