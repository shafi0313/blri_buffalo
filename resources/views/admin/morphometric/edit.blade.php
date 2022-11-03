@extends('admin.layout.master')
@section('title', 'Morphometric')
@section('content')
@php $p='animalRecord'; $sm="morphometric"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('morphometric.index')}}">Morphometric</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Morphometric</li>
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
                            <form action="{{ route('morphometric.update',$data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <div class="row">
                                    @php $animalExtraInfo=1 @endphp
                                    @if(Auth::user()->permission == 1)
                                        @include('admin.animal_tag.edit_admin')
                                    @else
                                        @include('admin.animal_tag.edit_user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="age">Age <span class="t_r">*</span></label>
                                        <input name="age" type="date" class="form-control @error('age') is-invalid @enderror" value="{{$data->age}}">
                                        @error('age')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="body_lenght">Body length (inch) <span class="t_r">*</span></label>
                                        <input name="body_lenght" type="number" step="any" class="form-control body_lenght @error('body_lenght') is-invalid @enderror" value="{{$data->body_lenght}}" required>
                                        @error('body_lenght')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="heart_girth">Heart girth (inch) <span class="t_r">*</span></label>
                                        <input name="heart_girth" type="number" step="any" class="form-control heart_girth @error('heart_girth') is-invalid @enderror" value="{{$data->heart_girth}}" required>
                                        @error('heart_girth')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Body Wt. (Kg) <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" id="birth_wt" readonly>
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
<script>
    $('.heart_girth,.body_lenght').keyup(function(){
        let bodyLength = $('.body_lenght').val();
        let heartGirth = $('.heart_girth').val();
        let bodyWt = (bodyLength * (heartGirth*heartGirth)/300) * 0.45;
        $('#birth_wt').val(bodyWt.toFixed(2));
    })
</script>
@endpush
@endsection

