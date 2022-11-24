<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Upazila;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResearchFarmController extends Controller
{
    public function index()
    {
        $farms = Farm::all();
        return view('admin.research_farm.index', compact('farms'));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('admin.research_farm.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:80',
            'post' => 'required|numeric|max:9999',
            'contact_person' => 'required|max:100',
            'phone' => 'required|numeric',
            'nid' => 'required|numeric',
            'address' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ]);

        try{
            Farm::create($data);
            toast('Farm Added','success');
            // return redirect()->route('research-farm.index');
            return back();
        }catch(\Exception $ex){
            // return $ex->getMessage();
            toast('Farm Added Failed','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $farm = Farm::find($id);
        $districts = District::orderBy('name')->get();
        $upazilas = Upazila::all();
        return view('admin.research_farm.edit', compact('farm','districts','upazilas'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required|max:80',
            'post' => 'required|numeric|max:9999',
            'contact_person' => 'required|max:100',
            'phone' => 'required|numeric',
            'nid' => 'required|numeric',
            'address' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
        ]);

        try{
            Farm::find($id)->update($data);
            toast('Farm Updated','success');
            return redirect()->route('research-farm.index');
        }catch(\Exception $ex){
            // return $ex->getMessage();
            toast('Farm Update Failed','error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Farm::find($id)->delete();
        toast('Farm Successfully Deleted','success');
        return redirect()->back();
    }
}
