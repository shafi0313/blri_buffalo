@extends('admin.layout.master')
@section('title', 'Slider')
@php $p='admin'; $sm="slider"; @endphp
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('slider.index')}}">Slider</a></li>
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
                                <h4 class="card-title">Edit Image Slide</h4>
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
                            <form action="{{ route('slider.update', $slider->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-12">
                                        <label for="title" class="placeholder">Title</label>
                                        <input id="title" name="title" type="text" class="form-control" value="{{$slider->title}}" placeholder="Enter Title">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="sub_title" class="placeholder">Sub Title</label>
                                        <input id="sub_title" name="sub_title" type="text" class="form-control" value="{{$slider->sub_title}}" placeholder="Enter Sub Title">
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label for="link" class="placeholder">Link</label>
                                        <input id="link" name="link" type="text" class="form-control" value="{{$slider->link}}" placeholder="http://oasis-it-center.com/">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="link_name" class="placeholder">Link Name</label>
                                        <input id="link_name" name="link_name" type="text" class="form-control" value="{{$slider->link_name}}" placeholder="Click">
                                    </div>
                                    <div class="col-md-5">
                                        <img src="{{ asset('files/images/slider/'.$slider->image) }}" height="150" width="400" alt="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="image" class="placeholder">Image <span class="t_r">* Height:1200px Widht:450px</span></label>
                                        <input type="hidden" name="old_image" value="{{$slider->image}}">
                                        <input id="image" name="image" type="file" class="form-control" value="{{$slider->image}}">
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

