@extends('admin.layout.master')
@section('title', 'BLRI Research Farm Stock Report')
@section('content')
@php $p='animalForm'; $sm="proRecord"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">BLRI Research Farm Stock Report</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                {{-- <h4 class="card-title">Production Record</h4> --}}
                                {{-- <a href="{{route('production-record.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-auto" style="width: 800px !important">
                                <div class="text-center">
                                    <h3>ছাগল ও ভেড়া উৎপাদন গবেষণা বিভাগ</h3>
                                    <h4>বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট</h4>
                                    <h4>সাভার, ঢাকা</h4>
                                    <h4>Form: {{Carbon\Carbon::parse($form_date)->format('d/m/Y')}} To: {{Carbon\Carbon::parse($to_date)->format('d/m/Y')}}</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th style="width: 35px">ক্রমিক নং</th>
                                                <th>গ্রুপ</th>
                                                <th>ব্লাক বেঙ্গল</th>
                                                <th>যমুনাপাড়ি</th>
                                                <th>বোয়ার</th>
                                                <th>যমুনাপাড়ি × ব্লাক বেঙ্গল</th>
                                                <th>বোয়ার × যমুনাপাড়ি</th>
                                                <th>সর্বমোট</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td colspan="8">১. পাঠাঁ</td>
                                            </tr>
                                            <tr style="margin-left: 10px">
                                                <td>১.১</td>
                                                <td>প্রজননক্ষম পাঁঠা</td>
                                                <td>{{ $pBlackBengalPatha }}</td>
                                                <td>{{ $pJamunapariPatha }}</td>
                                                <td>{{ $pBoerPatha}}</td>
                                                <td>{{ $pJCBPatha }}</td>
                                                <td>{{ $pBCJPatha }}</td>
                                                <td>{{ $pPthaTotal = $pBlackBengalPatha + $pJamunapariPatha + $pBoerPatha + $pJCBPatha + $pBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td>১.২</td>
                                                <td>বাড়ন্ত পাঁঠা</td>
                                                <td>{{ $bBlackBengalPatha }}</td>
                                                <td>{{ $bJamunapariPatha }}</td>
                                                <td>{{ $bBoerPatha}}</td>
                                                <td>{{ $bJCBPatha }}</td>
                                                <td>{{ $bBCJPatha }}</td>
                                                <td>{{ $bPathaTotal = $bBlackBengalPatha + $bJamunapariPatha + $bBoerPatha + $bJCBPatha + $bBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td>১.৩</td>
                                                <td>খাঁসী</td>
                                                <td>{{ $blackBengalKhasi = $animals->where('animal_cat_id',1)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $jamunapariKhasi = $animals->where('animal_cat_id',7)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $boerKhasi = $animals->where('animal_cat_id',8)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $jCBKhasi = $animals->where('animal_cat_id',9)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $bCJKhasi = $animals->where('animal_cat_id',10)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $khasiTotal = $blackBengalKhasi + $jamunapariKhasi + $boerKhasi + $jCBKhasi + $bCJKhasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>১.৪</td>
                                                <td>পাঁঠা বাচ্চা</td>
                                                <td>{{ $babyBlackBengalPatha }}</td>
                                                <td>{{ $babyJamunapariPatha }}</td>
                                                <td>{{ $babyBoerPatha}}</td>
                                                <td>{{ $babyJCBPatha }}</td>
                                                <td>{{ $babyBCJPatha }}</td>
                                                <td>{{ $babyPathaTotal = $babyBlackBengalPatha + $babyJamunapariPatha + $babyBoerPatha + $babyJCBPatha + $babyBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">মোট: </td>
                                                <td>{{ $totalPathaBlack = $pBlackBengalPatha + $bBlackBengalPatha + $blackBengalKhasi + $babyBlackBengalPatha}}</td>
                                                <td>{{ $totalJamunapariPatha = $pJamunapariPatha + $bJamunapariPatha + $jamunapariKhasi + $babyJamunapariPatha }}</td>
                                                <td>{{ $totalBoerPatha = $pBoerPatha + $bBoerPatha + $boerKhasi + $babyBoerPatha }}</td>
                                                <td>{{ $totalJCBPatha = $pJCBPatha + $bJCBPatha + $jCBKhasi + $babyJCBPatha }}</td>
                                                <td>{{ $totalBCJPatha = $pBCJPatha + $bBCJPatha + $bCJKhasi + $babyBCJPatha }}</td>
                                                <td>{{ $pPthaTotal + $bPathaTotal +  $khasiTotal + $babyPathaTotal }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"></td>
                                            </tr>
                                            <tr>
                                                <td>২.১</td>
                                                <td>প্রজননক্ষম ছাগী</td>
                                                <td>{{ $pBlackBengalGasi }}</td>
                                                <td>{{ $pJamunapariGasi }}</td>
                                                <td>{{ $pBoerGasi }}</td>
                                                <td>{{ $pJCBGasi }}</td>
                                                <td>{{ $pBCJGasi }}</td>
                                                <td>{{ $pGasiTotal = $pBlackBengalGasi + $pJamunapariGasi + $pBoerGasi + $pJCBGasi + $pBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>২.২</td>
                                                <td>বাড়ন্ত ছাগী</td>
                                                <td>{{ $bBlackBengalGasi }}</td>
                                                <td>{{ $bJamunapariGasi }}</td>
                                                <td>{{ $bBoerGasi }}</td>
                                                <td>{{ $bJCBGasi }}</td>
                                                <td>{{ $bBCJGasi }}</td>
                                                <td>{{ $bGasiTotal = $bBlackBengalGasi + $bJamunapariGasi + $bBoerGasi + $bJCBGasi + $bBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>২.৩</td>
                                                <td>ছাগী বাচ্চা</td>
                                                <td>{{ $babyBlackBengalGasi }}</td>
                                                <td>{{ $babyJamunapariGasi }}</td>
                                                <td>{{ $babyBoerGasi }}</td>
                                                <td>{{ $babyJCBGasi }}</td>
                                                <td>{{ $babyBCJGasi }}</td>
                                                <td>{{ $babyGasiTotal = $babyBlackBengalGasi + $babyJamunapariGasi + $babyBoerGasi + $babyJCBGasi + $babyBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">মোট: </td>
                                                <td>{{ $totalGasiBlack = $pBlackBengalGasi + $bBlackBengalGasi + $babyBlackBengalGasi}}</td>
                                                <td>{{ $totalJamunapariGasi = $pJamunapariGasi + $bJamunapariGasi +  $babyJamunapariGasi }}</td>
                                                <td>{{ $totalBoerGasi = $pBoerGasi + $bBoerGasi +  $babyBoerGasi }}</td>
                                                <td>{{ $totalJCBGasi = $pJCBGasi + $bJCBGasi +  $babyJCBGasi }}</td>
                                                <td>{{ $totalBCJGasi = $pBCJGasi + $bBCJGasi +  $babyBCJGasi }}</td>
                                                <td>{{ $pGasiTotal + $bGasiTotal + $babyGasiTotal }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">সর্বমোট: </td>
                                                <td>{{ $totalPathaBlack + $totalGasiBlack }}</td>
                                                <td>{{ $totalJamunapariPatha + $totalJamunapariGasi }}</td>
                                                <td>{{ $totalBoerPatha + $totalBoerGasi }}</td>
                                                <td>{{ $totalJCBPatha + $totalJCBGasi }}</td>
                                                <td>{{ $totalBCJPatha +  $totalBCJGasi}}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">পূর্বের স্টক: </td>
                                                <td>{{ $preTotalBcack = $preAnimalStocks->where('animal_cat_id',1)->count() }}</td>
                                                <td>{{ $preTotalJamunapari = $preAnimalStocks->where('animal_cat_id',7)->count() }}</td>
                                                <td>{{ $preTotalBoer = $preAnimalStocks->where('animal_cat_id',8)->count() }}</td>
                                                <td>{{ $preTotalJCB = $preAnimalStocks->where('animal_cat_id',9)->count() }}</td>
                                                <td>{{ $preTotalBCJ = $preAnimalStocks->where('animal_cat_id',10)->count() }}</td>
                                                <td>{{ $preTotalBcack + $preTotalJamunapari + $preTotalBoer + $preTotalJCB + $preTotalBCJ }}</td>
                                            </tr>
                                            <tr>
                                                <td>৩.</td>
                                                <td>চলতি মাসে মোট জন্ম (পাঁঠা + ছাগী)</td>
                                                <td>{{ $bornThisMonthBlack = $bornThisMonth->where('animal_cat_id',1)->count() }}</td>
                                                <td>{{ $bornThisMonthJamunapari = $bornThisMonth->where('animal_cat_id',7)->count() }}</td>
                                                <td>{{ $bornThisMonthBoer = $bornThisMonth->where('animal_cat_id',8)->count() }}</td>
                                                <td>{{ $bornThisMonthJCB = $bornThisMonth->where('animal_cat_id',9)->count() }}</td>
                                                <td>{{ $bornThisMonthBCJ = $bornThisMonth->where('animal_cat_id',10)->count() }}</td>
                                                <td>{{ $bornThisMonthBlack + $bornThisMonthJamunapari + $bornThisMonthBoer + $bornThisMonthJCB + $bornThisMonthBCJ }}</td>
                                            </tr>
                                            <tr>
                                                <td>৪.</td>
                                                <td>চলতি মাসে মোট মৃত্যু (পাঁঠা + ছাগী)</td>
                                                <td>{{ $deathThisMonthBlack = $deathThisMonth->where('animal_cat_id',1)->count() }}</td>
                                                <td>{{ $deathThisMonthJamunapari = $deathThisMonth->where('animal_cat_id',7)->count() }}</td>
                                                <td>{{ $deathThisMonthBoer = $deathThisMonth->where('animal_cat_id',8)->count() }}</td>
                                                <td>{{ $deathThisMonthJCB = $deathThisMonth->where('animal_cat_id',9)->count() }}</td>
                                                <td>{{ $deathThisMonthBCJ = $deathThisMonth->where('animal_cat_id',10)->count() }}</td>
                                                <td>{{ $deathThisMonthBlack + $deathThisMonthJamunapari + $deathThisMonthBoer + $deathThisMonthJCB + $deathThisMonthBCJ }}</td>
                                            </tr>
                                            <tr>
                                                <td>৫.</td>
                                                <td>চলতি মাসে মোট ছাটাই (পাঁঠা + ছাগী)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="row mb-5">
                                    <div class="col text-center">
                                        {{-- <span>মো: জাহাংগীর হোসেন</span><br> --}}
                                        <span>ল্যাবরেটরী  টেকনিশিয়ান</span>
                                    </div>
                                    <div class="col text-center">
                                        {{-- <span>নূরে হাছনি দিশা</span><br> --}}
                                        <span>বৈজ্ঞানিক কর্মকর্তা</span>
                                    </div>
                                    <div class="col text-center">
                                        {{-- <span>মো: আবু হেমায়েত</span><br> --}}
                                        <span>বৈজ্ঞানিক কর্মকর্তা</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom_scripts') @include('admin.include.data_table')
@endpush

@endsection

