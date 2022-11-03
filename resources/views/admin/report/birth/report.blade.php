@extends('admin.layout.master')
@section('title', 'Death Report')
@section('content')
    @php
        $p = 'report';
        $sm = 'community';
        $ssm = 'birthReport';
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
                        <li class="nav-item active">Death Report</li>
                    </ul>
                </div>
                <div class="divider1"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center"></div>
                            </div>
                            <div class="card-body">
                                <div class="m-auto" style="width: 800px !important">
                                    <div class="text-center">
                                        @include('admin.report.title')
                                        <h4>Form: {{ Carbon\Carbon::parse($form_date)->format('d/m/Y') }} To:
                                            {{ Carbon\Carbon::parse($to_date)->format('d/m/Y') }}</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead class="thw bg-secondary">
                                                <tr>
                                                    <th>Breed</th>
                                                    <th>Season</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($diseaseTreatments->groupBy('animal_cat_id') as $diseaseTreatment)
                                                    <tr>
                                                        <td style="background: #dfdffe" colspan="3"
                                                            class="font-weight-bold">
                                                            {{ $diseaseTreatment->first()->animalCat->name }}</td>
                                                    </tr>
                                                    @foreach ($diseaseTreatment->groupBy('season_o_birth') as $diseaseTreatmentsub)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $diseaseTreatmentsub->first()->season_o_birth }}</td>
                                                            <td>{{ number_format((100 * $diseaseTreatmentsub->count()) / $animals->count(), 2) }}
                                                                %</td>
                                                        </tr>
                                                    @endforeach
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

    @push('custom_scripts')
        @include('admin.include.data_table')
    @endpush

@endsection
