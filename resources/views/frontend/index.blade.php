@extends('frontend.layout.master')
@section('title')
@section('content')
    @php $p='home'; @endphp

    <!-- Slider Start -->
    <section class="slider_main">
        <div class="container-fluid">
            <div class="row slider_area">
                <div class=" header_logo">
                    <div class=" mojib">
                        <img src="{{ asset('files/images/icon/breeding_logo.png') }}" alt="" height="150px">
                    </div>
                    <div class=" blri" style="">
                        <img src="{{ asset('files/images/icon/gove-logo.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-12 slider">
                    <div class="owl-carousel owl-theme" id="owl_1">
                        @foreach ($sliders as $slider)
                            <div class="main_slider">
                                <img src="{{ asset('files/images/slider/' . $slider->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="slider_text">
                    <h1>মহিষ গবেষণার ডিজিটাল তথ্যভান্ডার</h1>
                    <h4>মহিষ গবেষণার ডিজিটাল তথ্যভান্ডার</h4>
                    <h4>বাংলাদেশ প্রাণিসম্পদ গবেষণা ইনস্টিটিউট</h4>
                    <h4>মৎস্য ও প্রাণিসম্পদ মন্ত্রণালয়</h4>
                </div>
                <div class="login_area">
                    <div class="login">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{-- @if (session()->has('message'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('message') }}
                            </div>
                        @endif --}}
                        <h4 class="text-center">Please sign in</h4>
                        <form method="POST" action="{{ route('loginProcess') }}">
                            @csrf
                            <div class="form-row align-items-center">
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup">Email</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-user" style="padding:4px 0"></i>
                                            </div>
                                        </div>
                                        <input type="email" name="email" required autofocus class="form-control"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup">Password</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-key" style="padding:4px 0"></i>
                                            </div>
                                        </div>
                                        <input type="password" name="password" required autocomplete="current-password"
                                            class="form-control" placeholder="Password">
                                    </div>
                                </div>
                                <div style="float:right" class="mb-2">
                                    <a style="text-decoration: none" href="{{ route('forgetPassword') }}">Forget
                                        Password?</a>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block mb-2" style="width: 100%;">Sign
                                        In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .notice a {
            margin-right: 10px;
            text-decoration: none;
        }
    </style>
    <section class="notice_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 title">
                    Notice:
                </div>
                <div class="col-md-10 notice">
                    <marquee onmouseover="stop()" onmouseout="start()" behavior="" direction="">
                        @foreach ($notices as $notice)
                            <a href="{{ route('notice', $notice->id) }}"><i class="fa-solid fa-flag"></i>
                                {{ $notice->title }}</a>
                        @endforeach
                    </marquee>
                </div>
            </div>
        </div>
    </section>

@endsection
