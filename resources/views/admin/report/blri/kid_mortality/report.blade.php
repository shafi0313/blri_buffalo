@extends('admin.layout.master')
@section('title', 'Kid Mortality Report')
@section('content')
@php $p='report'; $sm="blriReport"; $ssm="BlriKidMorReport" @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Kid Mortality Report</li>
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
                                        <thead class="thw bg-secondary text-center">
                                            <tr>
                                                <th rowspan="2">Breed</th>
                                                <th colspan="2">Kid</th>
                                            </tr>
                                            <tr>
                                                <th>M</th>
                                                <th>F</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($deaths->get()->groupBy('animal_cat_id') as $death)
                                            <tr class="text-center">
                                                <td>{{$death->first()->name}}</td>

                                                @if ($animals->where('sex','M')->whereIn('id',animalKid($to_date))->count() != 0)
                                                    <td>{{ 100 * $death->where('sex','M')->whereIn('animal_info_id',animalKid($to_date))->count() / $animals->where('sex','M')->whereIn('id',animalKid($to_date))->count() }}%</td>
                                                @else
                                                    <td>0%</td>
                                                @endif

                                                @if ($animals->where('sex','F')->whereIn('id',animalKid($to_date))->count() != 0)
                                                    <td>{{ 100 * $death->where('sex','F')->whereIn('animal_info_id',animalKid($to_date))->count() / $animals->where('sex','F')->whereIn('id',animalKid($to_date))->count() }}%</td>
                                                @else
                                                    <td>0%</td>
                                                @endif
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
    </div>
</div>

@push('custom_scripts') @include('admin.include.data_table')
@endpush

@endsection



