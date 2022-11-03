<?php

namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Notice;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $notices = Notice::whereStatus(1)->get(['id','title']);
        return view('frontend.index', compact('sliders','notices'));
    }

    public function notice($id)
    {
        $notice = Notice::find($id);
        return view('frontend.notice', compact('notice'));
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
