@extends('admin.layout.master')
@section('title', 'Disease and Treatment')
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
                    <li class="nav-item active">Disease and Treatment</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Disease and Treatment</h4>
                                @if (request()->routeIs('disease-and-treatment.*'))
                                <a href="{{route('diseaseTreatment.exportIntoPdf')}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('diseaseTreatment.exportIntoExcel')}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
                                <a href="{{route('disease-and-treatment.create')}}" class="btn btn-primary btn-round text-light"><i class="fa fa-plus"></i> Add New</a>
                                @else
                                <a href="{{route('report.diseaseTreatment.pdf', [$diseaseTreatments->first()->farm_id??0, $diseaseTreatments->first()->community_cat_id??0])}}" class="btn btn-round ml-auto"><img src="{{asset('files/images/icon/pdf.png')}}" alt="PDF Logo"> PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="{{route('report.diseaseTreatment.excel', [$diseaseTreatments->first()->farm_id??0, $diseaseTreatments->first()->community_cat_id??0])}}" class="btn btn-round"><img src="{{asset('files/images/icon/excel.png')}}" alt="Excel Logo"> Excel</a>&nbsp;&nbsp;
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
                                            <th>Breed</th>
                                            <th>Name of Disease</th>
                                            <th>Clinical Sign</th>
                                            {{-- <th>Season of Disease</th> --}}
                                            {{-- <th>Medicine Prescribed</th> --}}
                                            <th>Symptom/Sign Visible Date</th>
                                            <th>Treatment Starting Date</th>
                                            <th>Recovered/ Dead</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($diseaseTreatments as $diseaseTreatment)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $diseaseTreatment->animalInfo->animal_tag }} </td>
                                            <td>{{ $diseaseTreatment->animalInfo->sex }} </td>
                                            <td>{{ $diseaseTreatment->animalInfo->breed }} </td>
                                            <td>{{ $diseaseTreatment->diseaseSign->disease->name }} </td>
                                            <td>
                                                <table>
                                                    @foreach ($diseaseTreatment->diseaseSigns as $clinicalSign)
                                                    <tr>
                                                        <td>{{ $clinicalSign->clinicalSign->name }}, </td>
                                                    </tr>
                                                    @endforeach
                                                    @isset($diseaseTreatment->other)
                                                    <td>{{ $diseaseTreatment->other }}</td>
                                                    @endisset
                                                </table>
                                            </td>
                                            {{-- <td>{{ $diseaseTreatment->clinicalSign->name }} </td> --}}
                                            {{-- <td>{{ $diseaseTreatment->disease_season }} </td> --}}
                                            {{-- <td>{{ $diseaseTreatment->medicine_prescribed }} </td> --}}
                                            <td>{{ bdDate($diseaseTreatment->symptom_date) }} </td>
                                            <td>{{ bdDate($diseaseTreatment->disease_date) }} </td>
                                            <td>{{ $diseaseTreatment->recovered_dead }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{route('disease-and-treatment.edit',$diseaseTreatment->id)}}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('disease-and-treatment.destroy', $diseaseTreatment->id) }}" method="POST">
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

