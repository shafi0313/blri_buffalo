@extends('admin.layout.master')
@section('title', 'Semen Analysis')
@section('content')
@php $p='animalRecord'; $sm="semenAnalysis"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Semen Analysis</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Semen Analysis</h4>
                                @if (request()->routeIs('semen-analysis.index'))
                                <a href="{{route('semenAnalysis.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('semenAnalysis.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('semen-analysis.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.semenAnalysis.pdf', [$semenAnalyses->first()->farm_id??0, $semenAnalyses->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.semenAnalysis.excel', [$semenAnalyses->first()->farm_id??0, $semenAnalyses->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
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
                                            <th>Semen collecting Date</th>
                                            <th>Semen Volume</th>
                                            <th>Semen color</th>
                                            <th>No. of Straw Prepared</th>
                                            <th>Total Motility %</th>
                                            <th>Progressive Motility %</th>
                                            <th>Sperm concentration m/ml</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($semenAnalyses as $semenAnalysis)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $semenAnalysis->animalInfo->animal_tag }} </td>
                                            <td>{{ bdDate($semenAnalysis->coll_date) }} </td>
                                            <td>{{ $semenAnalysis->volume }} </td>
                                            <td>{{ $semenAnalysis->semen_color }} </td>
                                            <td>{{ $semenAnalysis->straw_prepared }} </td>
                                            <td>{{ $semenAnalysis->total_mortality }} </td>
                                            <td>{{ $semenAnalysis->progressive_mortality }} </td>
                                            <td>{{ $semenAnalysis->sperm_concentration }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('semen-analysis.edit',$semenAnalysis->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('semen-analysis.destroy', $semenAnalysis->id) }}" method="POST">
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

