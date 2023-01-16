<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Farm;
use App\Models\Service;
use App\Models\Community;
use App\Models\CommunityCat;
use App\Models\Reproduction;
use Illuminate\Http\Request;
use App\Exports\ServiceExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class ServiceController extends Controller
{
    public function exportIntoExcel()
    {
        return Excel::download(new ServiceExport(), 'service.xlsx');
    }

    public function exportIntoPdf()
    {
        if (Auth::user()->permission == 1) {
            $services = Service::latest()->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $services = Service::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }

        $pdf = PDF::loadView('admin.service.pdf', compact('services'));
        return $pdf->download('service.pdf');
    }

    public function index()
    {
        if (Auth::user()->permission == 1) {
            $services = Service::latest()->whereNotIn('animal_info_id', isCulling())->get();
        } else {
            $services = Service::where('user_id', Auth::user()->id)->whereNotIn('animal_info_id', isCullingUser())->get();
        }
        return view('admin.service.index', compact('services'));
    }

    public function create()
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            return view('admin.service.create_admin', compact('farms', 'communityCats'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            return view('admin.service.create_user', compact('communities'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'bull_id' => 'required',
            'date_of_service' => 'required',
        ]);

        $animal_info_id = $request->animal_info_id;
        $expected_d_o_b = Carbon::parse($request->date_of_service)->addDays(150)->format('Y-m-d');
        $service = Service::where('animal_info_id', $animal_info_id)->latest()->whereDate('expected_d_o_b', '>=', $request->date_of_service)->first();

        if ($service) {
            $repeat_heat = 'Heat';
        } else {
            $repeat_heat = 'Not';
        }

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'bull_id' => $request->bull_id,
            'date_of_service' => $request->date_of_service,
            'expected_d_o_b' => $expected_d_o_b,
            'natural' => $request->natural,
            'repeat_heat' => $repeat_heat,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

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

        DB::beginTransaction();
        $getReproduction = Reproduction::where('animal_info_id', $animal_info_id)->first();
        if ($getReproduction==null || $getReproduction->count() < 1) {
            $reproduction = [
                'user_id' => Auth::user()->id,
                'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
                'service_1st_date' => $request->date_of_service,
            ];
            if (Auth::user()->permission == 1) {
                if ($fOrC=='f') {
                    $reproduction['farm_id'] = $farmOrComId;
                    $reproduction['community_id'] = $request->community_id;
                } else {
                    $reproduction['community_cat_id'] = $farmOrComId;
                    $reproduction['community_id'] = $request->community_id;
                }
            } else {
                $reproduction['community_cat_id'] = $communityCat->id; // for community
                $reproduction['community_id'] = $request->community_id;
            }

            Reproduction::create($reproduction);
        } else {
            if ($getReproduction->service_1st_date == null) {
                $reproduction['service_1st_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_2nd_date == null) {
                $reproduction['service_2nd_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_3rd_date == null) {
                $reproduction['service_3rd_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_4th_date == null) {
                $reproduction['service_4th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_5th_date == null) {
                $reproduction['service_5th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_6th_date == null) {
                $reproduction['service_6th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_7th_date == null) {
                $reproduction['service_7th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_8th_date == null) {
                $reproduction['service_8th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_9th_date == null) {
                $reproduction['service_9th_date'] = $request->date_of_service;
            } elseif ($getReproduction->service_10th_date == null) {
                $reproduction['service_10th_date'] = $request->date_of_service;
            }
            Reproduction::where('id', $getReproduction->id)->update($reproduction);
        }

        try {
            $service = Service::create($data);
            Service::where('animal_info_id', $animal_info_id)->where('id', '!=', $service->id)->update(['is_pregnant' => 0]);
            DB::commit();
            toast('Success', 'success');
            // return redirect()->route('service.index');
            return back();
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $services = Service::where('animal_info_id', $id)->get();
        return view('admin.service.report', compact('services'));
    }

    public function edit($id)
    {
        if (Auth::user()->permission == 1) {
            $farms = Farm::all(['id','name']);
            $communityCats = CommunityCat::select(['id','name'])->get();
            $data = Service::find($id);
            return view('admin.service.edit_admin', compact('farms', 'communityCats', 'data'));
        } else {
            $communities = Community::whereCommunity_cat_id(CommunityCat::whereUser_id(Auth::user()->id)->first('id')->id)->get(['id','no','name']);
            $data = Service::find($id);
            return view('admin.service.edit_user', compact('communities', 'data'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'animal_info_id' => 'required_if:tattoo_no,==,NULL',
            'bull_id' => 'required',
            'date_of_service' => 'required',
        ]);

        $animal_info_id = $request->animal_info_id;
        $expected_d_o_b = Carbon::parse($request->date_of_service)->addDays(150)->format('Y-m-d');
        $service = Service::where('animal_info_id', $animal_info_id)->latest()->whereDate('expected_d_o_b', '>=', $request->date_of_service)->first();

        if ($service) {
            $repeat_heat = 'Heat';
        } else {
            $repeat_heat = 'Not';
        }

        $data = [
            'user_id' => Auth::user()->id,
            'animal_info_id' => $request->animal_info_id ?? $request->tattoo_no,
            'bull_id' => $request->bull_id,
            'date_of_service' => $request->date_of_service,
            'expected_d_o_b' => $expected_d_o_b,
            'natural' => $request->natural,
            'repeat_heat' => $repeat_heat,
        ];

        $fOrC = preg_replace('/[^a-z A-Z]/', '', $request->farmOrCommunityId);
        $farmOrComId = preg_replace('/[^0-9]/', '', $request->farmOrCommunityId);
        $communityCat = CommunityCat::where('user_id', Auth::user()->id)->first();

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

        DB::beginTransaction();


        try {
            $service = Service::find($id)->update($data);
            // Service::where('animal_info_id', $animal_info_id)->where('id','!=',$id)->update(['is_pregnant' => 0]);
            DB::commit();
            toast('Success', 'success');
            return redirect()->route('service.index');
        } catch(\Exception $ex) {
            // return $ex->getMessage();
            DB::rollBack();
            toast('Error'. $ex->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            Reproduction::whereAnimal_info_id(Service::find($id)->animal_info_id)->delete();
            Service::find($id)->delete();
            Alert::success('Success', 'Successfully Deleted');
            return redirect()->route('service.index');
        } catch (\Exception $ex) {
            return $ex->getMessage();
            Alert::error('Oops...', 'Delete Failed');
            return back();
        }
    }
}
