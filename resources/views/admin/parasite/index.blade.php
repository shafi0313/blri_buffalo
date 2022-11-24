@extends('admin.layout.master')
@section('title', 'Parasite')
@section('content')
@php $p='healthM'; $sm="parasite"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Parasite</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Parasite</h4>
                                {{-- <a href="{{route('parasite.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('parasite.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('parasite.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a> --}}
                                @if (request()->routeIs('parasite.index'))
                                        <a href="{{ route('parasite.exportIntoPdf') }}"
                                            class="btn btn-round ml-auto"><img
                                                src="{{ asset('files/images/icon/pdf.png') }}" alt="PDF Logo">
                                            PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('parasite.exportIntoExcel') }}" class="btn btn-round"><img
                                                src="{{ asset('files/images/icon/excel.png') }}" alt="Excel Logo">
                                            Excel</a>&nbsp;&nbsp;
                                        <a href="{{ route('parasite.create') }}"
                                            class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add
                                            New</a>
                                    @else
                                        <a href="{{ route('report.parasite.pdf', [$parasites->first()->farm_id ?? 0, $parasites->first()->community_cat_id ?? 0]) }}"
                                            class="btn btn-round ml-auto"><img
                                                src="{{ asset('files/images/icon/pdf.png') }}" alt="PDF Logo">
                                            PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('report.parasite.excel', [$parasites->first()->farm_id ?? 0, $parasites->first()->community_cat_id ?? 0]) }}"
                                            class="btn btn-round"><img src="{{ asset('files/images/icon/excel.png') }}"
                                                alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                    @endif
                            </div>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @php
                                    $editable = 1;
                                @endphp
                                @include('admin.parasite.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>

@push('custom_scripts') @include('admin.include.data_table')
@endpush

@endsection

