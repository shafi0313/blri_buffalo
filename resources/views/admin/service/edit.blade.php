@extends('admin.layout.master')
@section('title', 'Farm')
@section('content')
@php $p='animalForm'; $sm="serviceRec"; @endphp
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
                            <form action="{{ route('farm.update', $farm->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row justify-content-center">
                                    <div class="form-group col-6">
                                        <label for="size" class="col-sm-2 control-label">Farm Name <span class="t_r">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" value="{{$farm->name}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="contact_person">Contact Persone <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{$farm->contact_person}}" required>
                                        @error('contact_person')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone Number <span class="t_r">*</span></label>
                                        <input type="text" maxlength="11" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$farm->phone}}" required>
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nid">NID No. <span class="t_r">*</span></label>
                                        <input type="text" maxlength="20" class="form-control @error('nid') is-invalid @enderror" name="nid" value="{{$farm->nid}}" required>
                                        @error('nid')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="size" class="col-sm-2 control-label">Farm Address <span class="t_r">*</span></label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="address" value="{{$farm->address}}">
                                        </div>
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

