@extends('admin.layout.master')
@section('title', 'Milk Production')
@section('content')
@php $p='animalRecord'; $sm="milkProduction"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
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
                                <a href="{{route('milk-production.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Tag No</th>
                                            <th>Tattoo No</th>
                                            <th>Date of Milking</th>
                                            <th>Milk Production (kg)</th>
                                            <th>Peak Milk Production (kg)</th>
                                            <th>Lactation length</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($milkProductions as $milkProduction)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $milkProduction->animalInfo->animal_tag }} </td>
                                            <td>{{ $milkProduction->animalInfo->tattoo_no }} </td>
                                            <td>{{ \Carbon\Carbon::parse($milkProduction->date_of_milking)->format('d/m/Y') }} </td>
                                            <td>{{ $milkProduction->milk_production }} </td>
                                            <td></td>
                                            {{-- <td>{{$milkProductions->where('animal_info_id',$milkProduction->animal_info_id)->sum('milk_production')/$milkProduction->count()}}</td> --}}
                                            <td>{{ $milkProduction->lactation_length }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('milk-production.edit',$milkProduction->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('milk-production.destroy', $milkProduction->id) }}" method="POST">
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

                                        <tr>
                                            <th class="text-right" colspan="3">Average milk production (Kg)</th>
                                            <th class="text-center">{{ number_format($milkProductions->sum('milk_production')/$milkProductions->count(),2) }}</th>
                                            <td class="text-center">{{ $milkProductions->max('milk_production') }} </td>
                                        </tr>
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

