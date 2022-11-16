@extends('admin.layout.master')
@section('title', 'Reproduction Record')
@section('content')
@php $p='animalRecord'; $sm="reProRecord"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Reproduction Record</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Reproduction Record</li>
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
                            <form action="{{ route('reproduction-record.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @php $animalExtraInfo=0 @endphp
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.female.admin')
                                    @else
                                    @include('admin.animal_tag.female.user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="puberty_age">Age at Puberty	(Months)</label>
                                        <input name="puberty_age" type="number" class="form-control @error('puberty_age') is-invalid @enderror" value="{{old('puberty_age')}}">
                                        @error('puberty_age')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3" id="calving_date_div">
                                        <label for="calving_date">Calving Date <span class="t_r">*</span></label>
                                        <input name="calving_date" type="date" class="form-control @error('calving_date') is-invalid @enderror" id="calving_date" value="{{old('calving_date')}}">
                                        @error('calving_date')
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

