<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Disease;
use App\Models\ClinicalSign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiseaseController extends Controller
{
    public function index()
    {
        $diseases = Disease::all();

        return view('admin.category.disease.index', compact('diseases'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required'
        ]);

        try{
            Disease::create($data);
            toast('Success','success');
            return back();
        }catch(\Exception $ex){
            toast('Failed','error');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        try {
            Disease::find($id)->update($data);
            toast('Success', 'success');
            return redirect()->back();
        } catch (\Exception $ex) {
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if ($error = $this->sendPermissionError('delete')) {
            return $error;
        }
        Disease::find($id)->delete();
        toast('Successfully Deleted', 'success');
        return redirect()->back();
    }


    public function subCatStore(Request $request)
    {
       $data = $this->validate($request, [
            'disease_id' => 'required',
            'name' => 'required',
        ]);
        try {
            ClinicalSign::create($data);
            toast('Success', 'success');
            return redirect()->back();
        } catch (\Exception $ex) {
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function subCatUpdate(Request $request, $id)
    {
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $parent_id = preg_replace('/[^0-9]/', '', $request->parent_id);

        if(!empty($parent_id)){
            $data['parent_id'] = $request->parent_id;
        }
        // return $data;

        try {
            ClinicalSign::find($id)->update($data);
            toast('Success', 'success');
            return redirect()->back();
        } catch (\Exception $ex) {
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function destroyClinicalSign($id)
    {
        // if ($error = $this->sendPermissionError('delete')) {
        //     return $error;
        // }
        ClinicalSign::find($id)->delete();
        toast('Successfully Deleted', 'success');
        return redirect()->back();
    }
}
