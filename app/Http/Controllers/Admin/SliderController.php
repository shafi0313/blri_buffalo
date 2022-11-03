<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = "slider_".rand(0, 10000).'.'.$image->getClientOriginalExtension();
            $request->image->move('files/images/slider/', $image_name);
        }

        $user = auth()->user()->id;
        $data = [
            'user_id' => $user,
            'title' => $request->get('title'),
            'sub_title' => $request->get('sub_title'),
            'link' => $request->get('link'),
            'image' => $image_name,
        ];

        try{
            Slider::create($data);
            toast('Inserted','success');
            return redirect()->route('slider.index');
        } catch(\Exception $ex) {
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = "slider_".rand(0,1000).'.'.$image->getClientOriginalExtension();
            $request->image->move('files/images/slider/',$image_name);
        }else{
            $image_name = $request->get('old_image');
        }

        $user = auth()->user()->id;
        $data = [
            'user_id' => $user,
            'title' => $request->get('title'),
            'sub_title' => $request->get('sub_title'),
            'link' => $request->get('link'),
            'link_name' => $request->get('link_name'),
            'image' => $image_name,
        ];

        try {
            $update  = Slider::find($id);
            $update->update($data);
            toast('Updated','success');
            return redirect()->route('slider.index');
        } catch(\Exception $ex) {
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $path =  public_path('files/images/slider/'.$slider->image);
        if(file_exists($path)){
            unlink($path);
            $slider->delete();
            return redirect()->back();
        }else{
            $slider->delete();
            return redirect()->back();
        }
    }
}
