@extends('admin.layout.master')
@section('title', 'Milk Composition')
@section('content')
@php $p='animalRecord'; $sm="milkComposition"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Milk Composition</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Milk Composition</h4>
                                @if (request()->routeIs('milk-composition.index'))
                                <a href="{{route('milkComposition.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('milkComposition.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('milk-composition.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.milkComposition.pdf', [$milkCompositions->first()->farm_id??0, $milkCompositions->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.milkComposition.excel', [$milkCompositions->first()->farm_id??0, $milkCompositions->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Tag No</th>
                                            <th>Tattoo No</th>
                                            <th>Calving Date</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($milkCompositions->groupBy('animal_info_id') as $milkCompositio)
                                        @php
                                            $milkComposition = $milkCompositio->first()
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $milkComposition->animalInfo->animal_tag }} </td>
                                            <td>{{ $milkComposition->animalInfo->tattoo_no }} </td>
                                            <td>{{ \Carbon\Carbon::parse($milkComposition->calving_date)->format('d/m/Y') }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('milk-composition.show', $milkComposition->animal_info_id)}}" title="Show" class="btn btn-link btn-primary btn-lg">
                                                        show
                                                    </a>
                                                    ||
                                                    <form action="{{ route('milkComposition.destroyGroup', $milkComposition->animal_info_id) }}" method="POST">
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

@push('custom_scripts')
@include('admin.include.data_table')
@endpush

@endsection

