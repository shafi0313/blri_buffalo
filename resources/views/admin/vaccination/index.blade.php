@extends('admin.layout.master')
@section('title', 'Vaccination')
@section('content')
@php $p=''; $sm=""; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Vaccination</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Vaccination</h4>
                                @if (request()->routeIs('vaccination.*'))
                                <a href="{{route('vaccination.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('vaccination.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('vaccination.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.vaccination.pdf', [$vaccinations->first()->farm_id??0, $vaccinations->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.vaccination.excel', [$vaccinations->first()->farm_id??0, $vaccinations->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Name of Vaccine</th>
                                            <th>Date of Vaccination</th>
                                            <th>Dose</th>
                                            <th>Total animal vaccinated</th>
                                            <th class="no-sort" style="text-align:center;width:120px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($vaccinations->groupBy('group') as $vaccinatio)
                                        @php $vaccination =  $vaccinatio->first() @endphp
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $vaccination->vaccine_name }} </td>
                                            <td>{{ bdDate($vaccination->vaccine_date) }} </td>
                                            <td>{{ $vaccination->dose }} </td>
                                            <td>{{ $vaccination->total_vaccinated }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('vaccination.show',$vaccination->group)}}" title="Show Details">
                                                        Show Details
                                                    </a>
                                                    <form action="{{ route('vaccination.destroyGroup', $vaccination->group) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

