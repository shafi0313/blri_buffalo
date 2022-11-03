@extends('admin.layout.master')
@section('title', 'Animal Category')
@php $p='farmSett'; $sm='animalCat'; @endphp
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-cat.index')}}">Animal Category</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Animal Breed</li>
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
                            <form action="{{ route('animal-cat.update', $animalCat->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    {{-- <div class="form-check col-md-4">
                                        <label>Animal Type <span class="t_r">*</span></label><br>
                                        <label class="form-radio-label mr-5">
                                            <input class="form-radio-input " type="radio" name="type" value="1" required {{($animalCat->type==1)?'checked':''}}>
                                            <span class="form-radio-sign">Swamp</span>
                                        </label>
                                        <label class="form-radio-label ml-3" >
                                            <input class="form-radio-input " type="radio" name="type" value="2" required {{($animalCat->type==2)?'checked':''}}>
                                            <span class="form-radio-sign">River</span>
                                        </label>
                                    </div> --}}

                                    <div class="form-group col-md-8">
                                        <label for="name">Animal Breed <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$animalCat->name}}" required>
                                        @error('name')
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
    @include('admin.layout.footer')
</div>

@include('sweetalert::alert')
@push('custom_scripts')
@endpush
@endsection

