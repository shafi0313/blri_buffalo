<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Disease;
use App\Models\Community;
use App\Models\DiseaseSign;
use App\Models\ClinicalSign;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Models\DiseaseTreatment;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DiseaseTreatmentExport;

class DiseaseTreatmentController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new DiseaseTreatmentExport(), 'disease_treatment.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $diseaseTreatments = DiseaseTreatment::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $diseaseTreatments = DiseaseTreatment::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.disease_treatment.pdf', compact('diseaseTreatments'));
        return $pdf->download('disease_treatment.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $diseaseTreatments = DiseaseTreatment::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $diseaseTreatments = DiseaseTreatment::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.disease_treatment.index', compact('diseaseTreatments'));
    }


    public function create()
    {
        $diseases = Disease::all();
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.disease_treatment.create', compact('farms', 'communityCats', 'diseases'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.disease_treatment.create', compact('communities', 'diseases'));
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'disease_id' => 'required|max:155',
            'clinical_sign_id' => 'nullable|max:155',
            'medicine_prescribed' => 'nullable',
            'disease_date' => 'required|date',
            'recovered_dead' => 'required|max:155',
        ]);



        $diseaseTreatmentData = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            // 'animal_cat_id' => $request->animal_cat_id,
            // 'animal_sub_cat_id' => $request->animal_sub_cat_id,
            // 'type' => $request->type,
            'disease_id' => $request->disease_id,
            'clinical_sign_id' => $request->clinical_sign_id,
            'other' => $request->clinical_sign_input,
            'disease_season' => $request->disease_season,
            'medicine_prescribed' => $request->medicine_prescribed,
            'disease_date' => $request->disease_date,
            'symptom_date' => $request->symptom_date,
            'recovered_dead' => $request->recovered_dead,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if ($fOrC=='f') {
                $diseaseTreatmentData['farm_id'] = $farmOrComId;
                $diseaseTreatmentData['community_id'] = $request->community_id;
            } else {
                $diseaseTreatmentData['community_cat_id'] = $farmOrComId;
                $diseaseTreatmentData['community_id'] = $request->community_id;
            }
        } else {
            $diseaseTreatmentData['community_cat_id'] = $communityCat->id; // for community
            $diseaseTreatmentData['community_id'] = $request->community_id;
        }
        $diseaseTreatment = DiseaseTreatment::create($diseaseTreatmentData);

        if(isset($request->clinical_sign_id)){
            foreach ($request->clinical_sign_id as $key => $value) {
                $sign = [
                    'disease_treatment_id' =>  $diseaseTreatment->id,
                    'disease_id' => $request->disease_id,
                    'clinical_sign_id' => $request->clinical_sign_id[$key],
                ];
                DiseaseSign::create($sign);
            }
        }
        try {
            toast('Success', 'success');
            // return redirect()->route('disease-and-treatment.index');
            return back();
        } catch(\Exception $ex) {
            toast($ex->getMessage().'Failed', 'error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $diseases = Disease::all();
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = DiseaseTreatment::find($id);
            return view('admin.disease_treatment.edit', compact('farms', 'communityCats', 'diseases', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = DiseaseTreatment::find($id);
            return view('admin.disease_treatment.edit', compact('communities', 'diseases', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'disease_id' => 'required|max:155',
            'clinical_sign_id' => 'nullable|max:155',
            'medicine_prescribed' => 'nullable',
            'disease_date' => 'required|date',
            'recovered_dead' => 'required|max:155',
        ]);



        $diseaseTreatmentData = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            // 'animal_cat_id' => $request->animal_cat_id,
            // 'animal_sub_cat_id' => $request->animal_sub_cat_id,
            // 'type' => $request->type,
            'disease_id' => $request->disease_id,
            'clinical_sign_id' => $request->clinical_sign_id,
            'other' => $request->clinical_sign_input,
            'disease_season' => $request->disease_season,
            'medicine_prescribed' => $request->medicine_prescribed,
            'disease_date' => $request->disease_date,
            'symptom_date' => $request->symptom_date,
            'recovered_dead' => $request->recovered_dead,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        if (Auth::user()->permission == 1) {
            if ($fOrC=='f') {
                $diseaseTreatmentData['farm_id'] = $farmOrComId;
                $diseaseTreatmentData['community_id'] = $request->community_id;
            } else {
                $diseaseTreatmentData['community_cat_id'] = $farmOrComId;
                $diseaseTreatmentData['community_id'] = $request->community_id;
            }
        } else {
            $diseaseTreatmentData['community_cat_id'] = $communityCat->id; // for community
            $diseaseTreatmentData['community_id'] = $request->community_id;
        }
        $diseaseTreatment = DiseaseTreatment::find($id)->update($diseaseTreatmentData);

        foreach ($request->clinical_sign_id as $key => $value) {
            $sign = [
                'disease_treatment_id' =>  $id,
                'disease_id' => $request->disease_id,
                'clinical_sign_id' => $request->clinical_sign_id[$key],
            ];
            DiseaseSign::updateOrCreate($sign);
        }

        try {
            toast('Success', 'success');
            return redirect()->route('disease-and-treatment.index');
        } catch(\Exception $ex) {
            toast($ex->getMessage().'Failed', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        DiseaseTreatment::find($id)->delete();
        toast('Success', 'success');
        return redirect()->back();
    }

    public function clinicalSign(Request $request)
    {
        $diseases = ClinicalSign::where('disease_id', $request->diseaseId)->get();
        $name = '';
        $name .= '<div ></div>';
        foreach ($diseases as $disease) {
            $name .= '<label class="form-check-label clinical_sign"><input class="form-check-input" type="checkbox" name="clinical_sign_id[]" value="'.$disease->id.'"><span class="form-check-sign">'.$disease->name.'</span></label>';
            // $name .= '<label id="others" class="form-check-label"><input class="form-check-input" type="checkbox" value="-1"><span class="form-check-sign" >Others</span></label>';
        }
        return json_encode(['name'=>$name]);
    }
}
