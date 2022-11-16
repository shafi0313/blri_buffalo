@extends('admin.layout.master')
@section('title', 'Animal Information')
@section('content')
    @php
        $p = '';
        $sm = '';
    @endphp
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a>
                        </li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Report</li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item active">Animal's Information</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Animal Information</h4>
                                    <a href="{{ route('report.animalInfo.pdf', [$animalInfos->first()->farm_id ?? 0, $animalInfos->first()->community_cat_id ?? 0]) }}"
                                        class="btn btn-round ml-auto"><img src="{{ asset('files/images/icon/pdf.png') }}"
                                            alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('report.animalInfo.excel', [$animalInfos->first()->farm_id ?? 0, $animalInfos->first()->community_cat_id ?? 0]) }}"
                                        class="btn btn-round"><img src="{{ asset('files/images/icon/excel.png') }}"
                                            alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @php
                                        $editable = 0;
                                    @endphp
                                    @include('admin.semen_analysis.table')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>

    @push('custom_scripts')
        @include('admin.include.data_table')
    @endpush
@endsection
