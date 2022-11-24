<?php

namespace App\Http\Controllers\Admin;

use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Models\CastrationRecord;
use App\Http\Controllers\Controller;

class CastrationRecordController extends Controller
{
    public function index()
    {
        $castrationRecords = CastrationRecord::all();
        return view('admin.castration_record.index', compact('castrationRecords'));
    }


    public function create()
    {
        $animalInfos = AnimalInfo::all();
        return view('admin.castration_record.create', compact('animalInfos'));
    }


    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'date'  => 'required|date',
        ]);


        try{
            CastrationRecord::create($data);
            toast('Success','success');
            // return redirect()->route('castration-record.index');
            return back();
        }catch(\Exception $ex){
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        CastrationRecord::find($id)->delete();
        toast('Success','success');
        return redirect()->back();
    }
}
