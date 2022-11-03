<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Community;
use App\Models\AnimalInfo;
use App\Models\CommunityCat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityStockController extends Controller
{
    public function selectDate()
    {
        $communityCats = CommunityCat::all();
        return view('admin.community_stock.select_date', compact('communityCats'));
    }

    public function researchStock(Request $request)
    {

        $form_date = $request->get('form_date');
        $to_date = $request->get('to_date');
        $form_date_month = Carbon::parse($form_date)->format('m');
        $community_cat_id = $request->get('community_cat_id');

        $animals = AnimalInfo::whereBetween('created_at',[$form_date,$to_date])->where('sex','M')->where('community_cat_id', $community_cat_id)->get();

        // প্রজননক্ষম পাঁঠা Start ________________________________________________________________________
        $pBlackBengalPathaGets = $animals->where('animal_cat_id',1)->where('sex', 'M')->where('m_type',1);
        $pBlackBengalPatha = 0;
        foreach($pBlackBengalPathaGets as $pBlackBengalPathaGet){
            $data = \Carbon\Carbon::parse($pBlackBengalPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBlackBengalPatha++;
            };
        }
        $pBlackBengalPatha;

        // Jamuna piri
        $pJamunapariPathaGets = $animals->where('animal_cat_id',7)->where('sex', 'M')->where('m_type',1);
        $pJamunapariPatha = 0;
        foreach($pJamunapariPathaGets as $pJamunapariPathaGet){
            $data = \Carbon\Carbon::parse($pJamunapariPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pJamunapariPatha++;
            };
        }
        $pJamunapariPatha;

        // Boar
        $pBoerPathaGets = $animals->where('animal_cat_id',8)->where('sex', 'M')->where('m_type',1);
        $pBoerPatha = 0;
        foreach($pBoerPathaGets as $pBoerPathaGet){
            $data = \Carbon\Carbon::parse($pBoerPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBoerPatha++;
            };
        }
        $pBoerPatha;

        // 	Jamunapari cross Black Bengal
        $pJCBPathaGets = $animals->where('animal_cat_id',9)->where('sex', 'M')->where('m_type',1);
        $pJCBPatha = 0;
        foreach($pJCBPathaGets as $pJCBPathaGet){
            $data = \Carbon\Carbon::parse($pJCBPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pJCBPatha++;
            };
        }
        $pJCBPatha;

        // Boer cross Jamunapari
        $pBCJPathaGets = $animals->where('animal_cat_id',10)->where('sex', 'M')->where('m_type',1);
        $pBCJPatha = 0;
        foreach($pBCJPathaGets as $pBCJPathaGet){
            $data = \Carbon\Carbon::parse($pBCJPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBCJPatha++;
            };
        }
        $pBCJPatha;
        // প্রজননক্ষম পাঁঠা End ________________________________________________________________________


        // বাড়ন্ত পাঁঠা Start ___________________________________________________________________________________
        $bBlackBengalPathaGets = $animals->where('animal_cat_id',1)->where('sex', 'M')->where('m_type',1);
        $bBlackBengalPatha = 0;
        foreach($bBlackBengalPathaGets as $bBlackBengalPathaGet){
            $data = \Carbon\Carbon::parse($bBlackBengalPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBlackBengalPatha++;
            };
        }
        $bBlackBengalPatha;

        // Jamuna piri
        $bJamunapariPathaGets = $animals->where('animal_cat_id',7)->where('sex', 'M')->where('m_type',1);
        $bJamunapariPatha = 0;
        foreach($bJamunapariPathaGets as $bJamunapariPathaGet){
            $data = \Carbon\Carbon::parse($bJamunapariPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bJamunapariPatha++;
            };
        }
        $bJamunapariPatha;

        // Boar
        $bBoerPathaGets = $animals->where('animal_cat_id',8)->where('sex', 'M')->where('m_type',1);
        $bBoerPatha = 0;
        foreach($bBoerPathaGets as $bBoerPathaGet){
            $data = \Carbon\Carbon::parse($bBoerPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBoerPatha++;
            };
        }
        $bBoerPatha;

        // 	Jamunapari cross Black Bengal
        $bJCBPathaGets = $animals->where('animal_cat_id',9)->where('sex', 'M')->where('m_type',1);
        $bJCBPatha = 0;
        foreach($bJCBPathaGets as $bJCBPathaGet){
            $data = \Carbon\Carbon::parse($bJCBPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bJCBPatha++;
            };
        }
        $bJCBPatha;

        // Boer cross Jamunapari
        $bBCJPathaGets = $animals->where('animal_cat_id',10)->where('sex', 'M')->where('m_type',1);
        $bBCJPatha = 0;
        foreach($bBCJPathaGets as $bBCJPathaGet){
            $data = \Carbon\Carbon::parse($bBCJPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBCJPatha++;
            };
        }
        $bBCJPatha;
        // বাড়ন্ত পাঁঠা End ___________________________________________________________________________________



        // Baby Start ________________________________________________________________________________________
        $babyBlackBengalPathaGets = $animals->where('animal_cat_id',1)->where('sex', 'M')->where('m_type',1);
        $babyBlackBengalPatha = 0;
        foreach($babyBlackBengalPathaGets as $babyBlackBengalPathaGet){
            $data = \Carbon\Carbon::parse($babyBlackBengalPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBlackBengalPatha++;
            };
        }
        $babyBlackBengalPatha;

        // Jamuna piri
        $babyJamunapariPathaGets = $animals->where('animal_cat_id',7)->where('sex', 'M')->where('m_type',1);
        $babyJamunapariPatha = 0;
        foreach($babyJamunapariPathaGets as $babyJamunapariPathaGet){
            $data = \Carbon\Carbon::parse($babyJamunapariPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyJamunapariPatha++;
            };
        }
        $babyJamunapariPatha;

        // Boar
        $babyBoerPathaGets = $animals->where('animal_cat_id',8)->where('sex', 'M')->where('m_type',1);
        $babyBoerPatha = 0;
        foreach($babyBoerPathaGets as $babyBoerPathaGet){
            $data = \Carbon\Carbon::parse($babyBoerPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBoerPatha++;
            };
        }
        $babyBoerPatha;

        // 	Jamunapari cross Black Bengal
        $babyJCBPathaGets = $animals->where('animal_cat_id',9)->where('sex', 'M')->where('m_type',1);
        $babyJCBPatha = 0;
        foreach($babyJCBPathaGets as $babyJCBPathaGet){
            $data = \Carbon\Carbon::parse($babyJCBPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyJCBPatha++;
            };
        }
        $babyJCBPatha;

        // Boer cross Jamunapari
        $babyBCJPathaGets = $animals->where('animal_cat_id',10)->where('sex', 'M')->where('m_type',1);
        $babyBCJPatha = 0;
        foreach($babyBCJPathaGets as $babyBCJPathaGet){
            $data = \Carbon\Carbon::parse($babyBCJPathaGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBCJPatha++;
            };
        }
        $babyBCJPatha;
        // Baby End ________________________________________________________________________________________

        // ছাগী
        // Adult Start __________________________________________________________________________________
        $pBlackBengalGasiGets = $animals->where('animal_cat_id',1)->where('sex', 'F')->whereNull('m_type');
        $pBlackBengalGasi = 0;
        foreach($pBlackBengalGasiGets as $pBlackBengalGasiGet){
            $data = \Carbon\Carbon::parse($pBlackBengalGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBlackBengalGasi++;
            };
        }
        $pBlackBengalGasi;

        $pJamunapariGasiGets = $animals->where('animal_cat_id', 7)->where('sex', 'F')->whereNull('m_type');
        $pJamunapariGasi = 0;
        foreach($pJamunapariGasiGets as $pJamunapariGasiGet){
            $data = \Carbon\Carbon::parse($pJamunapariGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pJamunapariGasi++;
            };
        }
        $pJamunapariGasi;

        $pBoerGasiGets = $animals->where('animal_cat_id', 8)->where('sex', 'F')->whereNull('m_type');
        $pBoerGasi = 0;
        foreach($pBoerGasiGets as $pBoerGasiGet){
            $data = \Carbon\Carbon::parse($pBoerGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBoerGasi++;
            };
        }
        $pBoerGasi;

        // 	Jamunapari cross Black Bengal
        $pJCBGasiGets = $animals->where('animal_cat_id',9)->where('sex', 'F')->whereNull('m_type');
        $pJCBGasi = 0;
        foreach($pJCBGasiGets as $pJCBGasiGet){
            $data = \Carbon\Carbon::parse($pJCBGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pJCBGasi++;
            };
        }
        $pJCBGasi;

        // Boer cross Jamunapari
        $pBCJGasiGets = $animals->where('animal_cat_id',10)->where('sex', 'F')->whereNull('m_type');
        $pBCJGasi = 0;
        foreach($pBCJGasiGets as $pBCJGasiGet){
            $data = \Carbon\Carbon::parse($pBCJGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 7){
                $pBCJGasi++;
            };
        }
        $pBCJGasi;
        // Adult End __________________________________________________________________________________



        // বাড়ন্ত ছাগী Start ____________________________________________________________________________________
        $bBlackBengalGasiGets = $animals->where('animal_cat_id',1)->where('sex', 'F')->whereNull('m_type');
        $bBlackBengalGasi = 0;
        foreach($bBlackBengalGasiGets as $bBlackBengalGasiGet){
            $data = \Carbon\Carbon::parse($bBlackBengalGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBlackBengalGasi++;
            };
        }
        $bBlackBengalGasi;

        $bJamunapariGasiGets = $animals->where('animal_cat_id', 7)->where('sex', 'F')->whereNull('m_type');
        $bJamunapariGasi = 0;
        foreach($bJamunapariGasiGets as $bJamunapariGasiGet){
            $data = \Carbon\Carbon::parse($bJamunapariGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bJamunapariGasi++;
            };
        }
        $bJamunapariGasi;

        $bBoerGasiGets = $animals->where('animal_cat_id', 8)->where('sex', 'F')->whereNull('m_type');
        $bBoerGasi = 0;
        foreach($bBoerGasiGets as $bBoerGasiGet){
            $data = \Carbon\Carbon::parse($bBoerGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBoerGasi++;
            };
        }
        $bBoerGasi;

        // 	Jamunapari cross Black Bengal
        $bJCBGasiGets = $animals->where('animal_cat_id',9)->where('sex', 'F')->whereNull('m_type');
        $bJCBGasi = 0;
        foreach($bJCBGasiGets as $bJCBGasiGet){
            $data = \Carbon\Carbon::parse($bJCBGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bJCBGasi++;
            };
        }
        $bJCBGasi;

        // Boer cross Jamunapari
        $bBCJGasiGets = $animals->where('animal_cat_id',10)->where('sex', 'F')->whereNull('m_type');
        $bBCJGasi = 0;
        foreach($bBCJGasiGets as $bBCJGasiGet){
            $data = \Carbon\Carbon::parse($bBCJGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data > 3 && $data < 8){
                $bBCJGasi++;
            };
        }
        $bBCJGasi;
        // বাড়ন্ত ছাগী End ____________________________________________________________________________________

        // Baby ছাগী Start ____________________________________________________________________________________
        $babyBlackBengalGasiGets = $animals->where('animal_cat_id',1)->where('sex', 'F')->whereNull('m_type');
        $babyBlackBengalGasi = 0;
        foreach($babyBlackBengalGasiGets as $babyBlackBengalGasiGet){
            $data = \Carbon\Carbon::parse($babyBlackBengalGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBlackBengalGasi++;
            };
        }
        $babyBlackBengalGasi;

        $babyJamunapariGasiGets = $animals->where('animal_cat_id', 7)->where('sex', 'F')->whereNull('m_type');
        $babyJamunapariGasi = 0;
        foreach($babyJamunapariGasiGets as $babyJamunapariGasiGet){
            $data = \Carbon\Carbon::parse($babyJamunapariGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyJamunapariGasi++;
            };
        }
        $babyJamunapariGasi;

        $babyBoerGasiGets = $animals->where('animal_cat_id', 8)->where('sex', 'F')->whereNull('m_type');
        $babyBoerGasi = 0;
        foreach($babyBoerGasiGets as $babyBoerGasiGet){
            $data = \Carbon\Carbon::parse($babyBoerGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBoerGasi++;
            };
        }
        $babyBoerGasi;

        // 	Jamunapari cross Black Bengal
        $babyJCBGasiGets = $animals->where('animal_cat_id',9)->where('sex', 'F')->whereNull('m_type');
        $babyJCBGasi = 0;
        foreach($babyJCBGasiGets as $babyJCBGasiGet){
            $data = \Carbon\Carbon::parse($babyJCBGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyJCBGasi++;
            };
        }
        $babyJCBGasi;

        // Boer cross Jamunapari
        $babyBCJGasiGets = $animals->where('animal_cat_id',10)->where('sex', 'F')->whereNull('m_type');
        $babyBCJGasi = 0;
        foreach($babyBCJGasiGets as $babyBCJGasiGet){
            $data = \Carbon\Carbon::parse($babyBCJGasiGet->d_o_b)->diff(\Carbon\Carbon::now())->format('%y%m');
            if($data < 4){
                $babyBCJGasi++;
            };
        }
        $babyBCJGasi;
        // Baby ছাগী End ____________________________________________________________________________________


        // পূর্বের স্টক ____________________________________________________________
        $preAnimalStocks = AnimalInfo::where('created_at', '<', $form_date)->get();


        $bornThisMonth = AnimalInfo::whereMonth('d_o_b', $form_date_month)->get();

        $deathThisMonth = AnimalInfo::whereMonth('death_date', $form_date_month)->get();


        return view('admin.community_stock.report', compact(
            [
                'form_date','to_date','animals',
                'pBlackBengalPatha','pJamunapariPatha','pBoerPatha','pJCBPatha','pBCJPatha',
                'bBlackBengalPatha','bJamunapariPatha','bBoerPatha','bJCBPatha','bBCJPatha',
                'babyBlackBengalPatha','babyJamunapariPatha','babyBoerPatha','babyJCBPatha','babyBCJPatha',

                'pBlackBengalGasi','pJamunapariGasi','pBoerGasi','pJCBGasi','pBCJGasi',
                'bBlackBengalGasi','bJamunapariGasi','bBoerGasi','bJCBGasi','bBCJGasi',
                'babyBlackBengalGasi','babyJamunapariGasi','babyBoerGasi', 'babyJCBGasi','babyBCJGasi',
                'preAnimalStocks',
                'bornThisMonth',
                'deathThisMonth'
            ]
        ));





        // $supplierChallans = $getChallan->groupBy('invoice_no');
        // return view('admin.community_stock.report', compact('form_date','to_date'));
    }
}
