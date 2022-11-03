@extends('frontend.layout.master')
@section('title')
@section('content')
@php $p='home'; @endphp

<style>
    .notice {
        padding-top: 50px;
        height: 94vh;
    }
</style>
<!-- Slider Start -->
<section class="notice">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$notice->title}}</h2>
                <h6>{{bdDate($notice->date)}}</h6>
                <p>{{ $notice->notice }}</p>
            </div>
        </div>
    </div>
</section>

@endsection

