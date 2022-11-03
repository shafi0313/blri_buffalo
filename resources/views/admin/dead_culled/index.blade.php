@extends('admin.layout.master')
@section('title', 'Culling')
@section('content')
@php $p='animalRecord'; $sm="deadCulled"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Culling</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Culling</h4>
                                @if (request()->routeIs('dead-culled.index'))
                                <a href="{{route('deadCulled.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('deadCulled.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('dead-culled.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.deadCulled.pdf', [$deadCulleds->first()->farm_id??0, $deadCulleds->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.deadCulled.excel', [$deadCulleds->first()->farm_id??0, $deadCulleds->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Tag No</th>
                                            <th>Sex</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($deadCulleds as $deadCulled)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{$deadCulled->animalInfo->animal_tag }} </td>
                                            <td>{{$deadCulled->animalInfo->sex }} </td>
                                            <td>{{$deadCulled->reason }}</td>
                                            <td>{{ bdDate($deadCulled->date_dead_culled) }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('dead-culled.edit',$deadCulled->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('dead-culled.destroy',$deadCulled->id) }}" method="POST">
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

