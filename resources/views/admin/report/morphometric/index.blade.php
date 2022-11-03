@extends('admin.layout.master')
@section('title', 'Morphometric')
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
                    <li class="nav-item active">Morphometric</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Morphometric</h4>
                                <a href="{{route('report.morphometric.pdf', [$morphometrics->first()->farm_id??0, $morphometrics->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.morphometric.excel', [$morphometrics->first()->farm_id??0, $morphometrics->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                {{-- <a href="{{route('morphometric.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a> --}}
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
                                            <th>Date</th>
                                            <th>Body length (inch)</th>
                                            <th>Heart girth (inch)</th>
                                            <th>Body wt. (Pound)</th>
                                            <th>Body wt. (Kg)</th>
                                            <th class="no-sort" style="text-align:center;width:80px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($morphometrics as $morphometric)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $morphometric->animalInfo->animal_tag }} </td>
                                            <td>{{ $morphometric->animalInfo->sex }} </td>
                                            <td>{{ bdDate($morphometric->age) }} </td>
                                            <td>{{ $morphometric->body_lenght }} </td>
                                            <td>{{ $morphometric->heart_girth }} </td>
                                            <td>{{ number_format(pow($morphometric->body_lenght * $morphometric->heart_girth ,2)/300 ,2) }}</td>
                                            <td>{{ number_format(pow($morphometric->body_lenght * $morphometric->heart_girth ,2)/300/2.2046 ,2) }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('morphometric.edit',$morphometric->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('morphometric.destroy', $morphometric->id) }}" method="POST">
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

