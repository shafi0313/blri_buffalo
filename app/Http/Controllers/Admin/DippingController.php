<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dipping;
use App\Models\AnimalInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DippingController extends Controller
{
    public function index()
    {
        if(Auth::user()->permission == 1){
            $dippings = Dipping::all();
        }else{
            $dippings = Dipping::where('user_id', Auth::user()->id)->get();
        }

        return view('admin.dipping.index', compact('dippings'));
    }


    public function create()
    {
        if(Auth::user()->permission == 1){
            $animalInfos = AnimalInfo::all();
        }else{
            $animalInfos = AnimalInfo::where('user_id', Auth::user()->id)->get();
        }
        return view('admin.dipping.create', compact('animalInfos'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'medicine_name'  => 'required|max:100',
            'dipping_date'  => 'required|date',
        ]);

        $animals = AnimalInfo::whereBetween('id',[$request->to, $request->from])->get()->pluck('id');
        foreach($animals as $key => $value){
            $data = [
                'animal_info_id' => $animals[$key],
                'user_id' => Auth::user()->id,
                'medicine_name' => $request->medicine_name,
                'dipping_date' => $request->dipping_date,
            ];
            Dipping::create($data);
        }

        try{
            Dipping::create($data);
            toast('Success','success');
            return redirect()->route('dipping.index');
        }catch(\Exception $ex){
            toast('Failed','error');
            return redirect()->back();
        }
    }

    public function show($dipping_date)
    {
        $dippings = Dipping::wheredipping_date($dipping_date)->get();
        return view('admin.dipping.report', compact('dippings'));
    }

    public function destroy($id)
    {
        Dipping::find($id)->delete();
        toast('Success','success');
        return redirect()->back();
    }
}
