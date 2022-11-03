<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\ClinicalSign;
use Illuminate\Http\Request;

class ClinicalSignController extends Controller
{
    public function index()
    {
        $clinicalSigns = ClinicalSign::all();
        return view('admin.category.clinical_sign.index', compact('clinicalSigns'));
    }

    public function create()
    {
        return view('admin.animal_cat.create');
    }

    public function store(Request $request)
    {
        // $data = $this->validate($request, [
        //     'type' => 'required',
        //     'name' => 'required',
        // ]);

        $data = [
            'type' => $request->type,
            'name' => $request->name,
            'parent_id' => 0
        ];


        try{
            AnimalCat::create($data);
            toast('Animal Category Added','success');
            return redirect()->back();
        }catch(\Exception $ex){
            toast('Animal Category Add Failed','error');
            return redirect()->back();
        }
    }

    public function SubCatStore(Request $request)
    {
        // $data = $this->validate($request, [
        //     'type' => 'required',
        //     'name' => 'required',
        // ]);

        $data = [
            'type' => $request->type,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ];


        try{
            AnimalCat::create($data);
            toast('Animal Category Added','success');
            return redirect()->back();
        }catch(\Exception $ex){
            toast('Animal Category Add Failed','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $animalCat = AnimalCat::find($id);
        return view('admin.animal_cat.edit', compact('animalCat'));
    }



    public function update(Request $request, $id)
    {
        $data = [
            'type' => $request->type,
            'name' => $request->name,
            'parent_id' => 0
        ];

        try{
            AnimalCat::find($id)->update($data);
            toast('Animal Category Updated','success');
            return redirect()->route('animal-cat.index');
        }catch(\Exception $ex){
            toast('Animal Category Update Failed','error');
            return redirect()->back();
        }
    }

    // Animal Sub Category _________________________________________
    public function subEdit($id)
    {
        $animalSubCat = AnimalCat::find($id);
        $goats = AnimalCat::where('type', 1)->where('parent_id','!=', 0)->get();
        $sheeps = AnimalCat::where('type', 2)->where('parent_id','!=', 0)->get();
        return view('admin.animal_cat.sub_edit', compact('animalSubCat','goats','sheeps'));
    }

    public function subUpdate(Request $request, $id)
    {
        $data = [
            'type' => $request->type,
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ];

        try{
            AnimalCat::find($id)->update($data);
            toast('Animal Category Updated','success');
            return redirect()->route('animal-cat.index');
        }catch(\Exception $ex){
            toast('Animal Category Update Failed','error');
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        AnimalCat::find($id)->delete();
        toast('Farm Successfully Deleted','success');
        return redirect()->back();
    }

    public function getAnimalCat(Request $request)
    {
        $type = $request->type;
        $animalCats = AnimalCat::where('type', $type)->where('parent_id', 0)->get();
        $cat = '';
        $cat .= '<option value="">Select</option>';
        foreach($animalCats as $animalCat){
            $cat .= '<option value="'.$animalCat->id.'">'.$animalCat->name.'</option>';
        }
        return json_encode(['cat'=>$cat]);
    }
}

