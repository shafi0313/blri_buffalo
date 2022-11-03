@extends('admin.layout.master')
@section('title', 'Notice')
@php $p='admin'; $sm="notice"; @endphp
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('slider.index')}}">Notice</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Create</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add New Notice</h4>
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
                            <form action="{{ route('notice.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="title">Title <span class="t_r">*</span></label>
                                        <input name="title" type="text" class="form-control" value="{{old('title')}}">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="notice">Notice <span class="t_r">*</span></label>
                                        <textarea name="notice" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="date">Date <span class="t_r">*</span></label>
                                        <input name="date" type="date" class="form-control" value="{{old('date')}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status">Status <span class="t_r">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1">Published</option>
                                            <option >Unpublished</option>
                                        </select>
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

