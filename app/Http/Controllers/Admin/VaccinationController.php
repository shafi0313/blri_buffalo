<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\Vaccination;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Exports\VaccinationExport;
use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class VaccinationController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new VaccinationExport(), 'vaccination.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $vaccinations = Vaccination::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $vaccinations = Vaccination::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.vaccination.pdf', compact('vaccinations'));
        return $pdf->download('vaccination.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $vaccinations = Vaccination::whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $vaccinations = Vaccination::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        return view('admin.vaccination.index', compact('vaccinations'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.vaccination.create', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.vaccination.create', compact('communities'));
        }
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'vaccine_name' => 'required|max:155',
            'vaccine_date' => 'required|date',
            'dose' => 'nullable|max:155',
            'total_vaccinated' => 'nullable|max:155',
        ]);

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

        $getGroup = Vaccination::max('group') + 1;
        if ($request->vac_type == 'single') {
            $data = [
                'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
                'user_id' => Auth::user()->id,
                'group' => $getGroup,
                'vaccine_name' => $request->vaccine_name,
                'vaccine_date' => $request->vaccine_date,
                'dose' => $request->dose,
                'total_vaccinated' => 1,
            ];
            if (Auth::user()->permission == 1) {
                if ($fOrC=='f') {
                    $data['farm_id'] = $farmOrComId;
                    $data['community_id'] = $request->community_id;
                } else {
                    $data['community_cat_id'] = $farmOrComId;
                    $data['community_id'] = $request->community_id;
                }
            } else {
                $data['community_cat_id'] = $communityCat->id; // for community
                $data['community_id'] = $request->community_id;
            }
            // return $data;
            Vaccination::create($data);
        } else {
            if (Auth::user()->permission == 1) {
                if ($fOrC=='f') {
                    $animals = AnimalInfo::where('farm_id', $farmOrComId)->whereNull('community_cat_id')->get()->pluck('id');
                } else {
                    $animals = AnimalInfo::where('community_cat_id', $farmOrComId)->whereNull('farm_id')->whereCommunity_id($request->community_id)->get()->pluck('id');
                }
            } else {
                $animals = AnimalInfo::where('community_cat_id', $communityCat->id)->whereCommunity_id($request->community_id)->get()->pluck('id');
            }

            foreach ($animals as $key => $value) {
                $data = [
                    'animal_info_id' => $animals[$key],
                    'user_id' => Auth::user()->id,
                    'group' => $getGroup,
                    'vaccine_name' => $request->vaccine_name,
                    'vaccine_date' => $request->vaccine_date,
                    'dose' => $request->dose,
                ];
                $data['total_vaccinated'] = count($animals);
                if (Auth::user()->permission == 1) {
                    if ($fOrC=='f') {
                        $data['farm_id'] = $farmOrComId;
                        $data['community_id'] = $request->community_id;
                    } else {
                        $data['community_cat_id'] = $farmOrComId;
                        $data['community_id'] = $request->community_id;
                    }
                } else {
                    $data['community_cat_id'] = $communityCat->id; // for community
                    $data['community_id'] = $request->community_id;
                }
                Vaccination::create($data);
            }
        }

        try {
            toast('Success', 'success');
            // return redirect()->route('vaccination.index');
            return back();
        } catch(\Exception $ex) {
            toast('Failed', 'error');
            return redirect()->back();
        }
    }

    public function show($group)
    {
        $vaccinations = Vaccination::whereGroup($group)->get();
        return view('admin.vaccination.report', compact('vaccinations'));
    }

    public function destroy($id)
    {
        Vaccination::find($id)->delete();
        toast('Success', 'success');
        return redirect()->back();
    }
}
