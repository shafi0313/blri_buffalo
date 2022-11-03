@extends('admin.layout.master')
@section('title', 'Farm')
@section('content')
@php $p='animalForm'; $sm="proRecord"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('farm.index')}}">Farm</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Edit</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit License Farm</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('production-record.update', $productionRecord->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <label for="">Tag No <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" value="{{$productionRecord->animalInfo->animal_tag}}" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Sex <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" value="{{$productionRecord->animalInfo->sex}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Goat Color <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" value="{{$productionRecord->animalInfo->color}}" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Body Wt. (Kg) <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" value="{{$productionRecord->animalInfo->color}}" readonly>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="month_1">1 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_1') is-invalid @enderror" name="month_1" value="{{$productionRecord->month_1}}">
                                        @error('month_1')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="month_2">2 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_2') is-invalid @enderror" name="month_2" value="{{$productionRecord->month_2}}">
                                        @error('month_2')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="month_3">3 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_3') is-invalid @enderror" name="month_3" value="{{$productionRecord->month_3}}">
                                        @error('month_3')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="month_4">4 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_4') is-invalid @enderror" name="month_4" value="{{$productionRecord->month_4}}">
                                        @error('month_4')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="month_5">5 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_5') is-invalid @enderror" name="month_5" value="{{$productionRecord->month_5}}">
                                        @error('month_5')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="month_6">6 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_6') is-invalid @enderror" name="month_6" value="{{$productionRecord->month_6}}">
                                        @error('month_6')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="g_rate_month_3">Growth rate at 3 months (g/d)</label>
                                        <input type="number" class="form-control @error('g_rate_month_3') is-invalid @enderror" name="g_rate_month_3" value="{{$productionRecord->g_rate_month_3}}">
                                        @error('g_rate_month_3')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="g_rate_month_6">Growth rate at 6 months (g/d)</label>
                                        <input type="number" class="form-control @error('g_rate_month_6') is-invalid @enderror" name="g_rate_month_6" value="{{$productionRecord->g_rate_month_6}}">
                                        @error('g_rate_month_6')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div align="center" class="mr-auto card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@push('custom_scripts')
@endpush
@endsection

