@extends('admin.layout.master')
@section('title', 'Milk Production')
@section('content')
    @php
        $p = 'animalRecord';
        $sm = 'milkProduction';
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
                        <li class="nav-item active">Milk Production</li>
                    </ul>
                </div>
                <div class="divider1"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Milk Production</h4>
                                    @if (request()->routeIs('milk-production.index'))
                                        <a href="{{ route('milkProduction.exportIntoPdf') }}"
                                            class="btn btn-round ml-auto"><img
                                                src="{{ asset('files/images/icon/pdf.png') }}" alt="PDF Logo">
                                            PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('milkProduction.exportIntoExcel') }}" class="btn btn-round"><img
                                                src="{{ asset('files/images/icon/excel.png') }}" alt="Excel Logo">
                                            Excel</a>&nbsp;&nbsp;
                                        <a href="{{ route('milk-production.create') }}"
                                            class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add
                                            New</a>
                                    @else
                                        <a href="{{ route('report.milkProduction.pdf', [$milkProductions->first()->farm_id ?? 0, $milkProductions->first()->community_cat_id ?? 0]) }}"
                                            class="btn btn-round ml-auto"><img
                                                src="{{ asset('files/images/icon/pdf.png') }}" alt="PDF Logo">
                                            PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="{{ route('report.milkProduction.excel', [$milkProductions->first()->farm_id ?? 0, $milkProductions->first()->community_cat_id ?? 0]) }}"
                                            class="btn btn-round"><img src="{{ asset('files/images/icon/excel.png') }}"
                                                alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
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
                                                <th>Date of Milking</th>
                                                <th>Milk Production (kg)</th>
                                                <th>Peak Milk Production (kg)</th>
                                                <th>Average milk production (Kg)</th>
                                                <th>Lactation length</th>
                                                <th class="no-sort" style="text-align:center;width:100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $x=1; @endphp
                                            @foreach ($milkProductions->groupBy('animal_info_id') as $milkProducti)
                                                @php
                                                    $milkProduction = $milkProducti->first();
                                                @endphp
                                                <tr class="text-center">
                                                    <td>{{ $x++ }} </td>
                                                    <td>{{ $milkProduction->animalInfo->animal_tag }} </td>
                                                    <td>{{ $milkProduction->animalInfo->tattoo_no }} </td>
                                                    <td>{{ bdDate($milkProduction->date_of_milking) }} </td>
                                                    <td>{{ $milkProduction->milk_production }} </td>
                                                    <td>{{ $milkProducti->max('milk_production') }} </td>
                                                    {{-- <td>{{ $milkProducti->max('milk_production') }} --}}
                                                    <td>{{ number_format($milkProductions->where('animal_info_id', $milkProduction->animal_info_id)->sum('milk_production') / $milkProducti->count(), 2) }}
                                                    </td>
                                                    <td>{{ $milkProduction->lactation_length }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('milk-production.show', $milkProduction->animal_info_id) }}"
                                                                title="Edit" class="btn btn-link btn-primary btn-lg">
                                                                show
                                                            </a>
                                                            ||
                                                            <form
                                                                action="{{ route('milkProduction.destroyGroup', $milkProduction->animal_info_id) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" title="Delete"
                                                                    class="btn btn-link btn-danger"
                                                                    onclick="return confirm('Are you sure?')">
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
