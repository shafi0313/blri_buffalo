@extends('admin.layout.master')
@section('title', 'Castration Record')
@section('content')
@php $p='animalRecord'; $sm="castrationRecord"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Castration Record</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Castration Record</h4>
                                <a href="{{route('castration-record.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a>
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
                                            <th>Breed</th>
                                            {{-- <th>Dead/Culled</th>
                                            <th>Reason</th> --}}
                                            <th>Date</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($castrationRecords as $castrationRecord)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $castrationRecord->animalInfo->animal_tag }} </td>
                                            <td>{{ $castrationRecord->animalInfo->sex }} </td>
                                            <td>{{ $castrationRecord->animalInfo->breed }} </td>
                                            {{-- <td>{{ $castrationRecord->dead_culled }}</td>
                                            <td>{{ $castrationRecord->reason }}</td> --}}
                                            <td>{{ $castrationRecord->date }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    {{-- <a href="{{route('disease-and-treatment.edit',$diseaseTreatment->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    <form action="{{ route('castration-record.destroy', $castrationRecord->id) }}" method="POST">
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

