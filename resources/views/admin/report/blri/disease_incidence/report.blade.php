@extends('admin.layout.master')
@section('title', 'Disease Incidence Report')
@section('content')
@php $p='report'; $sm="blriReport"; $ssm="blriDiseaseIn" @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Disease Incidence Report</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                {{-- <h4 class="card-title">Production Record</h4> --}}
                                {{-- <a href="{{route('production-record.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="m-auto" style="width: 800px !important">
                                <div class="text-center">
                                    @include('admin.report.title')
                                    <h4>Form: {{Carbon\Carbon::parse($form_date)->format('d/m/Y')}} To: {{Carbon\Carbon::parse($to_date)->format('d/m/Y')}}</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        {{-- <thead class="">
                                            <tr class="text-center">
                                                <th style="width: 35px">ক্রমিক নং</th>
                                                <th>গ্রুপ</th>
                                                <th></th>
                                                <th>ব্লাক বেঙ্গল</th>
                                                <th>যমুনাপাড়ি</th>
                                                <th>বোয়ার</th>
                                                <th>যমুনাপাড়ি × ব্লাক বেঙ্গল</th>
                                                <th>বোয়ার × যমুনাপাড়ি</th>
                                                <th>সর্বমোট</th>
                                            </tr>
                                        </thead> --}}
                                        <thead class="thw bg-secondary">
                                            <tr>
                                                <th>Breed</th>
                                                <th>Disease</th>
                                                <th>Infected</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($diseaseTreatments->groupBy('animal_cat_id') as $diseaseTreatment)
                                            <tr>
                                                <td style="background: #dfdffe" colspan="3" class="font-weight-bold">{{$diseaseTreatment->first()->animalCat->name}}</td>
                                            </tr>

                                            @foreach ($diseaseTreatment->groupBy('disease_id') as $diseaseTreatmentsub)
                                            <tr>
                                                <td></td>
                                                <td>{{$diseaseTreatmentsub->first()->disease->name}}</td>
                                                <td>{{ number_format((100*$diseaseTreatmentsub->count()) / $animals->count(),2) }} %</td>
                                            </tr>

                                            @endforeach
                                            @endforeach
                                        </tbody>






                                            {{-- @foreach ($diseaseTreatments as $diseaseTreatment)
                                            <tr>
                                                <td></td>
                                                <td>{{$diseaseTreatment->animalInfo->animalCat->name}}</td>
                                                <td>{{(100*$diseaseTreatments->count()) / $diseaseTreatment->first()->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>{{$diseaseTreatment->disease->name}}</td>
                                                <td>{{$diseaseTreatment->first()->count()}}</td>
                                            </tr>
                                            <tr>

                                            </tr> --}}



                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom_scripts') @include('admin.include.data_table')
@endpush

@endsection

