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
                                <a href="{{route('parasite.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('parasite.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('parasite.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Tag No</th>
                                            {{-- <th>Breed</th> --}}
                                            <th>Sex</th>
                                            <th>Age</th>
                                            <th>Date of Feces collection</th>
                                            <th>fecal egg count (FEC)</th>
                                            <th>Season</th>
                                            <th>Parasite name</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($parasites as $parasite)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $parasite->animalInfo->animal_tag }} </td>
                                            {{-- <td>{{ $parasite->animalInfo->breed }} </td> --}}
                                            <td>{{ $parasite->animalInfo->sex }} </td>
                                            <td>{{ \Carbon\Carbon::parse($parasite->animalInfo->d_o_b)->diff(\Carbon\Carbon::now())->format('%y years, %m months') }} </td>
                                            <td>{{ \Carbon\Carbon::parse($parasite->feces_collection_date)->format('d/m/Y') }} </td>
                                            <td>{{ $parasite->fecal_egg_count }} </td>
                                            <td>{{ $parasite->season }} </td>
                                            <td>{{ $parasite->parasite_name }} </td>

                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('parasite.edit',$parasite->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('parasite.destroy', $parasite->id) }}" method="POST">
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

