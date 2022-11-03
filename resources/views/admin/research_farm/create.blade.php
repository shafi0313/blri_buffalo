@extends('admin.layout.master')
@section('title', 'Research Farm')
@section('content')
@php $p='farmSett'; $sm="farm"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('research-farm.index')}}">Research Farm</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Research Farm</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Research Farm</h4>
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
                            <form action="{{ route('research-farm.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Research Farm Name <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">District <span class="t_r">*</span></label>
                                        <select name="district_id" id="district_id" class="form-control select2">
                                            <option value="">Select</option>
                                            @foreach ($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Upazila <span class="t_r">*</span></label>
                                        <select name="upazila_id" id="upazila" class="form-control select2">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="post">Post Code <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('post') is-invalid @enderror" name="post" value="{{old('post')}}" required>
                                        @error('post')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="contact_person">Contact Persona <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{old('contact_person')}}" required>
                                        @error('contact_person')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone">Phone Number <span class="t_r">*</span></label>
                                        <input type="text" maxlength="11" class="form-control @error('phone') is-invalid @enderror" name="phone" oninput="this.value = this.value.replace(/[a-zA-z\-*/]/g,'');" value="{{old('phone')}}" required>
                                        @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nid">NID No. <span class="t_r">*</span></label>
                                        <input type="text" maxlength="20" class="form-control @error('nid') is-invalid @enderror" name="nid" value="{{old('nid')}}" required>
                                        @error('nid')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Research Farm Address <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" required>
                                        @error('address')
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
<script>
     $('#district_id').on('change',function(e) {
            let district_id = $('#district_id').val();
            $.ajax({
                url:'{{ route("get.upazila") }}',
                type:"get",
                data: {district_id: district_id},
                success:function (res) {
                    res = $.parseJSON(res);
                    $('#upazila').html(res.dis);
                }
            })
        });
</script>
@endpush
@endsection

