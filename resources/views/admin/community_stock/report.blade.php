@extends('admin.layout.master')
@section('title', 'Production Record')
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
                    <li class="nav-item active">Production Record</li>
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
                                    <h2>ব্ল্যাক বেঙ্গল ছাগলের জাত সংরক্ষণ ও উন্নয়ন গবেষণা প্রকল্প</h2>
                                    <h4>বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট</h4>
                                    <h4>সাভার, ঢাকা</h4>
                                    <h4>প্রকল্প এলাকা :</h4>
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
                                                <th>ক্রসব্রীড ছাগল</th>
                                                <th>অন্যান্য</th>
                                                <th>সর্বমোট</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr style="margin-left: 10px">
                                                <td>১</td>
                                                <td>প্রজননক্ষম পাঁঠা</td>
                                                <td>{{ $pBlackBengalPatha }}</td>
                                                <td>{{ $pJamunapariPatha }}</td>
                                                <td>{{ $pBoerPatha + $pJCBPatha + $pBCJPatha}}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $pPthaTotal = $pBlackBengalPatha + $pJamunapariPatha + $pBoerPatha + $pJCBPatha + $pBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td>২</td>
                                                <td>বাড়ন্ত পাঁঠা</td>
                                                <td>{{ $bBlackBengalPatha }}</td>
                                                <td>{{ $bJamunapariPatha }}</td>
                                                <td>{{ $bBoerPatha + $bJCBPatha + $bBCJPatha }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $bPathaTotal = $bBlackBengalPatha + $bJamunapariPatha + $bBoerPatha + $bJCBPatha + $bBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td>৩</td>
                                                <td>খাঁসী</td>
                                                <td>{{ $blackBengalKhasi = $animals->where('animal_cat_id',1)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $jamunapariKhasi = $animals->where('animal_cat_id',7)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td>{{ $boerKhasi = $animals->where('animal_cat_id',8)->where('sex', 'M')->where('m_type',2)->count() + $jCBKhasi = $animals->where('animal_cat_id',9)->where('sex', 'M')->where('m_type',2)->count() + $bCJKhasi = $animals->where('animal_cat_id',10)->where('sex', 'M')->where('m_type',2)->count() }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $khasiTotal = $blackBengalKhasi + $jamunapariKhasi + $boerKhasi + $jCBKhasi + $bCJKhasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>৪</td>
                                                <td>পাঁঠা বাচ্চা</td>
                                                <td>{{ $babyBlackBengalPatha }}</td>
                                                <td>{{ $babyJamunapariPatha }}</td>
                                                <td>{{ $babyBoerPatha + $babyJCBPatha + $babyBCJPatha }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $babyPathaTotal = $babyBlackBengalPatha + $babyJamunapariPatha + $babyBoerPatha + $babyJCBPatha + $babyBCJPatha  }}</td>
                                            </tr>
                                            <tr>
                                                <td>৫</td>
                                                <td>প্রজননক্ষম ছাগী</td>
                                                <td>{{ $pBlackBengalGasi }}</td>
                                                <td>{{ $pJamunapariGasi }}</td>
                                                <td>{{ $pBoerGasi + $pJCBGasi + $pBCJGasi }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $pGasiTotal = $pBlackBengalGasi + $pJamunapariGasi + $pBoerGasi + $pJCBGasi + $pBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>৬</td>
                                                <td>বাড়ন্ত ছাগী</td>
                                                <td>{{ $bBlackBengalGasi }}</td>
                                                <td>{{ $bJamunapariGasi }}</td>
                                                <td>{{ $bBoerGasi + $bJCBGasi + $bBCJGasi }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $bGasiTotal = $bBlackBengalGasi + $bJamunapariGasi + $bBoerGasi + $bJCBGasi + $bBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td>৭</td>
                                                <td>ছাগী বাচ্চা</td>
                                                <td>{{ $babyBlackBengalGasi }}</td>
                                                <td>{{ $babyJamunapariGasi }}</td>
                                                <td>{{ $babyBoerGasi + $babyJCBGasi + $babyBCJGasi }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $babyGasiTotal = $babyBlackBengalGasi + $babyJamunapariGasi + $babyBoerGasi + $babyJCBGasi + $babyBCJGasi }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">সর্বমোট ছাগল</td>
                                                <td>{{ $totalBlackBengal = $pBlackBengalPatha + $bBlackBengalPatha + $blackBengalKhasi + $babyBlackBengalPatha + $totalGasiBlack = $pBlackBengalGasi + $bBlackBengalGasi + $babyBlackBengalGasi }}</td>
                                                <td>{{ $totalJamunapar = $totalJamunapariPatha = $pJamunapariPatha + $bJamunapariPatha + $jamunapariKhasi + $babyJamunapariPatha + $totalJamunapariGasi = $pJamunapariGasi + $bJamunapariGasi +  $babyJamunapariGasi }}</td>
                                                <td>{{ $totalCrossBrid = $pBoerPatha + $pJCBPatha + $pBCJPatha + $bBoerPatha + $bJCBPatha + $bBCJPatha + $boerKhasi + $jCBKhasi + $bCJKhasi + $babyBoerPatha + $babyJCBPatha + $babyBCJPatha + $pBoerGasi + $pJCBGasi + $pBCJGasi + $bBoerGasi + $bJCBGasi + $bBCJGasi + $babyBoerGasi + $babyJCBGasi + $babyBCJGasi }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $totalBlackBengal + $totalJamunapar + $totalCrossBrid }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">পূর্বের স্টক</td>
                                                <td>{{ $preTotalBcack = $preAnimalStocks->where('animal_cat_id',1)->count() }}</td>
                                                <td>{{ $preTotalJamunapari = $preAnimalStocks->where('animal_cat_id',7)->count() }}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $preTotalBcack + $preTotalJamunapari }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">চলতি মাসে মোট জন্ম (পাঁঠা + ছাগী)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">চলতি মাসে মোট মৃত্যু (পাঁঠা + ছাগী)</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="text-right font-weight-bold">চলতি মাসে মোট বিক্রি (পাঁঠা/ছাগী/খাঁসী)</td>
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
                                        <span>মাঠ সহকারী এর নাম ও স্বাক্ষর :</span>
                                    </div>
                                    <div class="col text-center">
                                        <span>উপজেলা প্রাণিসম্পদ কর্মকর্তার নাম ও স্বাক্ষর:</span>
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

