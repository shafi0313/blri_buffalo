@extends('admin.layout.master')
@section('title', 'Dashboard')
@section('content')
    @php
        $p = 'da';
        $sm = '';
    @endphp

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header mb-4">
                    <h4 class="page-title" style="font-size: 25px">Buffalo Research and Development Project</h4>
                </div>
                <style>
                    thead tr th {
                        color: #002060 !important;
                        font-weight: bold !important
                    }

                    tbody tr:nth-child(odd) {
                        color: #0070C4;
                    }

                    tbody tr:nth-child(even) {
                        color: #D64318;
                    }

                    tfoot tr td {
                        background: #FFE599;
                        font-weight: bold;
                        color: #002060;
                    }
                </style>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2">SL No</th>
                                    <th rowspan="2">Project Area</th>
                                    <th rowspan="2">No. of Farmer</th>
                                    <th colspan="3">Buffalo statistics</th>
                                    <th rowspan="2">Milk yield ≥ 4L</th>
                                </tr>
                                <tr style="background: #B4C6E7">
                                    <th>Male</th>
                                    <th>Female</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $x = 1;
                                    $milkYie = 0;
                                @endphp
                                @foreach ($animalInfos->whereNotNull('farm_id')->groupBy('farm_id') as $animalInfo)
                                    <tr>
                                        <td style="color: #002060 !important; font-weight:bold">{{ $x++ }}.</td>
                                        <td class="text-left">{{ $animalInfo->first()->getFarmInfo->name }},
                                            {{ $animalInfo->first()->getFarmInfo->upazila->name }}</td>
                                        <td>{{ $animalInfo->groupBy('community_id')->count() }}</td>
                                        <td>{{ $animalInfo->where('sex', 'M')->count() }}</td>
                                        <td>{{ $animalInfo->where('sex', 'F')->count() }}</td>
                                        <td>{{ $animalInfo->count() }}</td>
                                        @foreach ($animalInfo as $milkYield)
                                            @php $milkYie += $milkYield->milkYields->count(); @endphp
                                            {{-- @foreach ($milkYield->milkYields as $milkYiel)
                                            @if ($milkYiel->milk_production >= 4)
                                                @php $milkYie++ @endphp
                                            @endif
                                        @endforeach --}}
                                        @endforeach
                                        <td>{{ $milkYie }}</td>
                                    </tr>
                                @endforeach

                                @foreach ($animalInfos->whereNotNull('community_cat_id')->groupBy('community_cat_id') as $animalInfo)
                                    <tr>
                                        <td style="color: #002060 !important; font-weight:bold">{{ $x++ }}.</td>
                                        <td class="text-left">{{ $animalInfo->first()->getCommunityInfo->name }},
                                            {{ $animalInfo->first()->getCommunityInfo->district->name }}</td>
                                        <td>{{ $animalInfo->groupBy('community_id')->count() }}</td>
                                        <td>{{ $animalInfo->where('sex', 'M')->count() }}</td>
                                        <td>{{ $animalInfo->where('sex', 'F')->count() }}</td>
                                        <td>{{ $animalInfo->count() }}</td>
                                        @php $milkYie2 = 0; @endphp
                                        @foreach ($animalInfo as $milkYieldss)
                                            @php $milkYie2 += $milkYieldss->milkYields->count(); @endphp
                                        @endforeach
                                        <td>{{ $milkYie2 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total</td>
                                    <td>{{ $animalInfos->groupBy('community_id')->count() }}</td>
                                    <td>{{ $animalInfos->where('sex', 'M')->count() }}</td>
                                    <td>{{ $animalInfos->where('sex', 'F')->count() }}</td>
                                    <td>{{ $animalInfos->count() }}</td>
                                    <td>{{ $milkProduction }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>


                {{-- <div class="row">
                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Buffalo</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Farm Name</th>
                            <th>Buffalo</th>
                        </tr>
                        @foreach ($animalInfos->where('farm_id', '!=', null)->groupBy('farm_id') as $animalInfo)
                        <tr>
                            <td>{{ $animalInfo->first()->getFarmInfo->name }}</td>
                            <td>{{ $animalInfo->count() }}</td>
                        </tr>
                        @endforeach
                        @foreach ($animalInfos->where('community_cat_id', '!=', null)->groupBy('community_cat_id') as $animalInfo)
                        <tr>
                            <td>{{ $animalInfo->first()->getCommunityInfo->name }}</td>
                            <td>{{ $animalInfo->count() }}</td>
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold">
                            <td class="text-right">Total:</td>
                            <td>{{$animalInfos->count()}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Calves Average Body Weight</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Tag no</th>
                            <th>Body Weight</th>
                        </tr>
                        @isset($calvesAvgBWts)
                        @foreach ($calvesAvgBWts as $calvesAvgBWt)
                        <tr>
                            <td>{{ $calvesAvgBWt->animalInfo->animal_tag }}</td>
                            <td>{{ number_format($calvesAvgBWt->day_0 - ($calvesAvgBWt->animalInfo->birth_wt*1000),2) }}</td>
                        </tr>
                        @endforeach
                        @endisset


                        <tr style="font-weight: bold">
                            <td class="text-right">Total:</td>
                            <td>{{$animalInfos->count()}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Pregnant</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Farm Name</th>
                            <th>Buffalo</th>
                        </tr>
                        @foreach ($pregnants->where('farm_id', '!=', null)->groupBy(['farm_id', 'animal_info_id']) as $pregnant)
                        <tr>
                            <td>{{ $pregnant->first()->first()->getFarmInfo->name }}</td>
                            <td>{{ $pregnant->count() }}</td>
                        </tr>
                        @endforeach
                        @foreach ($pregnants->where('community_cat_id', '!=', null)->groupBy(['community_cat_id', 'animal_info_id']) as $pregnant)
                        <tr>
                            <td>{{ $pregnant->first()->first()->getCommunityInfo->name }}</td>
                            <td>{{ $pregnant->count() }}</td>
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold">
                            <td class="text-right">Total:</td>
                            <td>{{$pregnants->count()}}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Semen Analysis</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Tag no</th>
                            <th>No of straw</th>
                        </tr>
                        @isset($semenAnalysis)
                        @foreach ($semenAnalysis as $semenAnalysi)
                        <tr>
                            <td>{{ $semenAnalysi->animalInfo->animal_tag }}</td>
                            <td>{{ $semenAnalysi->straw_prepared }}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </table>
                </div>
                @if (auth()->user()->permission == 1)
                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Crossbred</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Farm Name</th>
                            <th>Buffalo</th>
                        </tr>
                        @isset($crossbreds)
                        @foreach ($crossbreds->where('farm_id', '!=', null)->groupBy('farm_id') as $crossbred)
                        <tr>
                            <td>{{ $crossbred->first()->getFarmInfo->name }}</td>
                            <td>{{ $crossbred->count() }}</td>
                        </tr>
                        @endforeach
                        @foreach ($crossbreds->where('community_cat_id', '!=', null)->groupBy('community_cat_id') as $crossbred)
                        <tr>
                            <td>{{ $crossbred->first()->getCommunityInfo->name }}</td>
                            <td>{{ $crossbred->count() }}</td>
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold">
                            <td class="text-right">Total:</td>
                            <td>{{$crossbreds->count()}}</td>
                        </tr>
                        @endisset
                    </table>
                </div>
                @endif
            </div> --}}

                {{-- <div class="row">
                <div class="col-sm-6 col-md-3">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="bg-secondary text-light text-center">
                            <th colspan="2">Milk Production</th>
                        </tr>
                        <tr class="bg-primary text-light">
                            <th>Tag no</th>
                            <th>Buffalo</th>
                        </tr>
                        @isset($milkProductions)
                        @foreach ($milkProductions as $milkProduction)
                        <tr>
                            <td>{{ $milkProduction->first()->animal_tag }}</td>
                            <td>{{ $animalInfo->sum('milk_production') }}</td>
                        </tr>
                        @endforeach
                        @endisset
                    </table>
                </div>
            </div> --}}
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
    @push('custom_scripts')
    @endpush
@endsection
