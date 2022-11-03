@extends('admin.layout.master')
@section('title', 'Disease and Health Record')
@section('content')
@php $p='animalForm'; $sm="DHRec"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('service-record.index')}}">Disease and Health Record</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Disease and Health Record</li>
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
                            <form action="{{ route('disease-and-health.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="name">Tag No <span class="t_r">*</span></label>
                                        <select name="animal_info_id" id="animalInfo" class="form-control @error('animal_info_id') is-invalid @enderror">
                                            <option value="">Select</option>
                                            @foreach ($animalInfos as $animalInfo)
                                            <option value="{{$animalInfo->id}}">{{$animalInfo->animal_tag}}</option>
                                            @endforeach
                                        </select>
                                        @error('animal_info_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Sex <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" id="sex"  value="" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Age <span class="t_r">*</span></label>
                                        <input type="text" class="form-control"  id="age" value="" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Body Wt. (Kg) <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" id="birth_wt" readonly>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="breed">Breed <span class="t_r">*</span></label>
                                        <input name="breed" type="text" class="form-control @error('breed') is-invalid @enderror" value="{{old('breed')}}">
                                        @error('breed')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="disease_name">Name of Disease <span class="t_r">*</span></label>
                                        <input name="disease_name" type="text" class="form-control @error('disease_name') is-invalid @enderror" value="{{old('disease_name')}}">
                                        @error('disease_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="clinical_sign">Clinical Sign <span class="t_r">*</span></label>
                                        <input name="clinical_sign" type="text" class="form-control @error('clinical_sign') is-invalid @enderror" value="{{old('clinical_sign')}}">
                                        @error('clinical_sign')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="disease_season">Season of Disease <span class="t_r">*</span></label>
                                        <input name="disease_season" type="text" class="form-control @error('disease_season') is-invalid @enderror" value="{{old('disease_season')}}">
                                        @error('disease_season')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="deworming_date">Date of Deworming <span class="t_r">*</span></label>
                                        <input name="deworming_date" type="date" class="form-control @error('deworming_date') is-invalid @enderror" value="{{old('deworming_date')}}">
                                        @error('deworming_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="dipping_date">Date of Dipping <span class="t_r">*</span></label>
                                        <input name="dipping_date" type="date" class="form-control @error('dipping_date') is-invalid @enderror" value="{{old('dipping_date')}}">
                                        @error('dipping_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="ppr_vac_date">Date of PPR Vaccination <span class="t_r">*</span></label>
                                        <input name="ppr_vac_date" type="date" class="form-control @error('ppr_vac_date') is-invalid @enderror" value="{{old('ppr_vac_date')}}">
                                        @error('ppr_vac_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="fmd_vac_date">Date of FMD Vaccination <span class="t_r">*</span></label>
                                        <input name="fmd_vac_date" type="date" class="form-control @error('fmd_vac_date') is-invalid @enderror" value="{{old('fmd_vac_date')}}">
                                        @error('fmd_vac_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="pox_vacn_date">Date of Goat Pox Vaccination<span class="t_r">*</span></label>
                                        <input name="pox_vacn_date" type="date" class="form-control @error('pox_vacn_date') is-invalid @enderror" value="{{old('pox_vacn_date')}}">
                                        @error('pox_vacn_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="contagious_vac_date">Date of Contagious Ecthyma Vaccination <span class="t_r">*</span></label>
                                        <input name="contagious_vac_date" type="date" class="form-control @error('contagious_vac_date') is-invalid @enderror" value="{{old('contagious_vac_date')}}">
                                        @error('contagious_vac_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="report">Recovered/ Dead <span class="t_r">*</span></label>
                                        <input name="report" type="text" class="form-control @error('report') is-invalid @enderror" value="{{old('report')}}">
                                        @error('report')
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
    // Form Production Record Blade and Controller
    $('#animalInfo').on('change',function(e) {
        var animalInfoId = $(this).val();
        $.ajax({
            url:'{{ route("animalInfo.getAnimalInfo") }}',
            type:"get",
            data: {
                animalInfoId: animalInfoId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#sex').val(res.sex);
                $('#color').val(res.color);
                $('#birth_wt').val(res.birth_wt);
                $('#type').val(res.type);
                // var d = res.d_o_b.replace(/-/g, '');

                dob = new Date(res.d_o_b);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#age').val(age);
            }
        })
    });
</script>
@endpush
@endsection

