@extends('admin.layout.master')
@section('title', 'Dipping')
@section('content')
@php $p='healthM'; $sm="dipping"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Dipping</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Dipping</h4>
                                <a href="{{route('dipping.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            {{-- <th>Tag No</th>
                                            <th>Sex</th>
                                            <th>Breed</th> --}}
                                            <th>Name of Medicine</th>
                                            <th>Date of Dipping</th>
                                            {{-- <th>Dose</th> --}}
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($dippings->groupBy('dipping_date') as $dippin)
                                        @php $dipping =  $dippin->first() @endphp
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            {{-- <td>{{ $dipping->animalInfo->animal_tag }} </td>
                                            <td>{{ $dipping->animalInfo->sex }} </td>
                                            <td>{{ $dipping->animalInfo->breed }} </td> --}}
                                            <td>{{ $dipping->medicine_name }}</td>
                                            <td>{{ $dipping->dipping_date }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('dipping.show',$dipping->dipping_date)}}" title="Show Details">
                                                        Show Details
                                                    </a>
                                                    {{-- <form action="{{ route('dipping.destroy', $dipping->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form> --}}
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

