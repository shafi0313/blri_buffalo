@extends('admin.layout.master')
@section('title', 'Milk Production')
@section('content')
@php $p='animalRecord'; $sm="milkProduction"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('milk-production.index')}}">Milk Production</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Milk Production</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add New</h4>
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
                            <form action="{{ route('milk-production.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @php $animalExtraInfo=0 @endphp
                                    @if(Auth::user()->permission == 1)
                                        @include('admin.animal_tag.female.admin')
                                    @else
                                        @include('admin.animal_tag.female.user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="date_of_milking">Date of Milking <span class="t_r">*</span></label>
                                        <input name="date_of_milking" type="date" class="form-control @error('date_of_milking') is-invalid @enderror" value="{{old('date_of_milking')}}" required>
                                        @error('date_of_milking')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="milk_production">Milk yield (Kg) <span class="t_r">*</span></label>
                                        <input name="milk_production" type="number" step="any" class="form-control @error('milk_production') is-invalid @enderror" value="{{old('milk_production')}}" required>
                                        @error('milk_production')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group col-md-3">
                                        <label for="peak_milk_production">Peak Milk Production (Kg) </label>
                                        <input name="peak_milk_production" type="number" step="any" class="form-control @error('peak_milk_production') is-invalid @enderror" value="{{old('peak_milk_production')}}">
                                        @error('peak_milk_production')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                </div>

                                <div align="center" class="mr-auto card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>
                    {{-- Page Content End --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>

@push('custom_scripts')

@endpush
@endsection

