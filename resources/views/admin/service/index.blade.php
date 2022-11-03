@extends('admin.layout.master')
@section('title', 'Service')
@section('content')
@php $p='animalRecord'; $sm="service"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Service</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Service</h4>
                                @if (request()->routeIs('service.index'))
                                <a href="{{route('service.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('service.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('service.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.service.pdf', [$services->first()->farm_id??0, $services->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.service.excel', [$services->first()->farm_id??0, $services->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Female Buffalo ID;</th>
                                            <th>Buffalo Bull ID</th>
                                            <th>Date of Service</th>
                                            <th>Expected Date of Birth</th>
                                            <th>Natural/AI</th>
                                            <th>Repeat Heat/not</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($services->groupBy('animal_info_id') as $servic)
                                        @php
                                            $service =$servic->first()
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $service->animalInfo->animal_tag }} </td>
                                            <td>{{ $service->bullId->animal_tag }} </td>
                                            <td>{{ \Carbon\Carbon::parse($service->date_of_service)->format('d/m/Y') }} </td>
                                            <td>{{ \Carbon\Carbon::parse($service->expected_d_o_b)->format('d/m/Y') }} </td>
                                            <td>{{ $service->natural }} </td>
                                            <td>{{ $service->repeat_heat }} </td>
                                            <td>
                                                <a href="{{route('service.show',$service->animal_info_id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                    show
                                                </a>
                                            </td>
                                            {{-- <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('service.edit', $service->id) }}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('farm.destroy', $service->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td> --}}
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
</div>

@push('custom_scripts') @include('admin.include.data_table')
@endpush

@endsection

