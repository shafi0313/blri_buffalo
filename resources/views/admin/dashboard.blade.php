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
                                        @foreach ($animalInfo->groupBy('animal_info_id') as $milkYield)
                                            @php $milkYie += $milkYield->first()->milkYields->count(); @endphp
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
                                        @foreach ($animalInfo->groupBy('animal_info_id') as $milkYieldss)
                                            @php $milkYie2 += $milkYieldss->first()->milkYields->count(); @endphp
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
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
    @push('custom_scripts')
    @endpush
@endsection
