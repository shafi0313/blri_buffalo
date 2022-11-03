<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function edit($id)
    {
        $about = About::find($id);
        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->get('title'),
            'texts' => $request->get('texts'),
        ];

        try {
            About::where('id', 1)->update($data);
            toast('About Successfully Updated', 'success');
            return redirect()->back();
        } catch (\Exception $ex) {
            toast('About Update Failed', 'error');
            return redirect()->back();
        }
    }
}
