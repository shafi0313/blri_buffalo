@extends('admin.layout.master')
@section('title', 'Distribution')
@section('content')
@php $p='animalRecord'; $sm="distribution"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Distribution</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Distribution</h4>
                                @if (request()->routeIs('distribution.index'))
                                <a href="{{route('distribution.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('distribution.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('distribution.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.distribution.pdf', [$distributions->first()->farm_id??0, $distributions->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.distribution.excel', [$distributions->first()->farm_id??0, $distributions->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Tag no</th>
                                            <th>Sex</th>
                                            <th>Distribution type</th>
                                            <th>Distribution to</th>
                                            <th>Organization name</th>
                                            <th>Distribution date</th>
                                            <th>Number of straw</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($distributions as $distribution)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $distribution->animalInfo->animal_tag }} </td>
                                            <td>{{ $distribution->animalInfo->sex }} </td>
                                            <td>{{ $distribution->dis_type }} </td>
                                            <td>{{ $distribution->dis_to }} </td>
                                            <td>{{ $distribution->org_name }} </td>
                                            <td>{{ \Carbon\Carbon::parse($distribution->dis_date)->format('d/m/Y') }} </td>
                                            <td>{{ $distribution->straw }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('distribution.edit',$distribution->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('distribution.destroy', $distribution->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
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

