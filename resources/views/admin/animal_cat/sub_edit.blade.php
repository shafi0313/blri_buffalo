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
                    <li class="nav-item active">Edit</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Animal Category</h4>
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
                            <form action="{{ route('animalCat.subUpdate', $animalSubCat->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-check col-md-12">
                                        <label>Animal Type <span class="t_r">*</span></label><br>
                                        <label class="form-radio-label mr-5 type">
                                            <input class="form-radio-input" type="radio" name="type" value="1" {{($animalSubCat->type==1)?'checked':''}} required>
                                            <span class="form-radio-sign">Goat</span>
                                        </label>
                                        <label class="form-radio-label ml-3 type">
                                            <input class="form-radio-input " type="radio" name="type" value="2" {{($animalSubCat->type==2)?'checked':''}} required>
                                            <span class="form-radio-sign">Sheep</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Animal Category <span class="t_r">*</span></label>
                                        <select name="parent_id" id="" class="form-control">
                                            <option value="{{$animalSubCat->id}}">{{$animalSubCat->name}}</option>
                                            @if ($animalSubCat->type==1)
                                            @foreach ($goats as $goat)
                                            <option value="{{$goat->id}}">{{$goat->name}}</option>
                                            @endforeach
                                            @else
                                            @foreach ($sheeps as $sheep)
                                            <option value="{{$sheep->id}}">{{$sheep->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Animal Name <span class="t_r">*</span></label>
                                        <input name="name" type="text" class="form-control" value="{{$animalSubCat->name}}">
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

