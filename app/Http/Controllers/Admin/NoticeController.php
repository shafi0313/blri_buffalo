<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        return view('admin.notice.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'notice' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|numeric',
        ]);

        try{
            Notice::create($data);
            toast('Inserted','success');
            // return redirect()->route('notice.index');
            return back();
        } catch(\Exception $ex) {
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('admin.notice.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'notice' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|numeric',
        ]);
        try {
            Notice::find($id)->update($data);
            toast('Updated','success');
            return redirect()->route('notice.index');
        } catch(\Exception $ex) {
            toast('Failed','error');
            return back();
        }
    }

    public function destroy($id)
    {
        Notice::find($id)->delete();
        try {
            Notice::find($id)->delete();
            toast('Success','success');
            return back();
        } catch(\Exception $ex) {
            toast('Failed','error');
            return back();
        }
    }
}
