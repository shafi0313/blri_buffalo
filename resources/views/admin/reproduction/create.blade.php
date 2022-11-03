@extends('admin.layout.master')
@section('title', 'Reproduction Record')
@section('content')
@php $p='animalRecord'; $sm="reProRecord"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Reproduction Record</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Reproduction Record</li>
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
                            <form action="{{ route('reproduction-record.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @php $animalExtraInfo=0 @endphp
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.female.admin')
                                    @else
                                    @include('admin.animal_tag.female.user')
                                    @endif


                                    {{-- <div class="form-group col-md-3">
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
                                        <label for="">Coat Color <span class="t_r">*</span></label>
                                        <input type="text" class="form-control"  id="color" value="" readonly>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="">Body Wt. (Kg) <span class="t_r">*</span></label>
                                        <input type="text" class="form-control" id="birth_wt" readonly>
                                    </div> --}}


                                    <div class="form-group col-md-3">
                                        <label for="puberty_age">Age at Puberty	(Months)</label>
                                        <input name="puberty_age" type="number" class="form-control @error('puberty_age') is-invalid @enderror" value="{{old('puberty_age')}}">
                                        @error('puberty_age')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3" id="calving_date_div">
                                        <label for="calving_date">Calving Date <span class="t_r">*</span></label>
                                        <input name="calving_date" type="date" class="form-control @error('calving_date') is-invalid @enderror" id="calving_date" value="{{old('calving_date')}}">
                                        @error('calving_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group col-md-3">
                                        <label for="service_1st_date">Date at 1st service <span class="t_r">*</span></label>
                                        <input name="service_1st_date" type="date" class="form-control @error('service_1st_date') is-invalid @enderror" value="{{old('service_1st_date')}}">
                                        @error('service_1st_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_1st_date">Date of 1st kidding <span class="t_r">*</span></label>
                                        <input name="kidding_1st_date" type="date" class="form-control @error('kidding_1st_date') is-invalid @enderror" value="{{old('kidding_1st_date')}}">
                                        @error('kidding_1st_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="ges_lenght_1st_kidding">Gestation length at 1st kidding <span class="t_r">*</span></label>
                                        <input name="ges_lenght_1st_kidding" type="date" class="form-control @error('ges_lenght_1st_kidding') is-invalid @enderror" value="{{old('ges_lenght_1st_kidding')}}">
                                        @error('ges_lenght_1st_kidding')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="ges_lenght_1st_kidding">Gestation length at 1st kidding <span class="t_r">*</span></label>
                                        <input name="ges_lenght_1st_kidding" type="date" class="form-control @error('ges_lenght_1st_kidding') is-invalid @enderror" value="{{old('ges_lenght_1st_kidding')}}">
                                        @error('ges_lenght_1st_kidding')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="age_1st_kidding">Age at 1st kidding <span class="t_r">*</span></label>
                                        <input name="age_1st_kidding" max="3" type="number" class="form-control @error('age_1st_kidding') is-invalid @enderror" value="{{old('age_1st_kidding')}}">
                                        @error('age_1st_kidding')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="litter_size_1st_kidding">Litter size at 1st kidding <span class="t_r">*</span></label>
                                        <input name="litter_size_1st_kidding" type="number" class="form-control @error('litter_size_1st_kidding') is-invalid @enderror" value="{{old('litter_size_1st_kidding')}}">
                                        @error('litter_size_1st_kidding')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="milk_production">Milk production (ml) <span class="t_r">*</span></label>
                                        <input name="milk_production" type="number" class="form-control @error('milk_production') is-invalid @enderror" value="{{old('milk_production')}}">
                                        @error('milk_production')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="service_2nd_date">Date at 2nd service <span class="t_r">*</span></label>
                                        <input name="service_2nd_date" type="date" class="form-control @error('service_2nd_date') is-invalid @enderror" value="{{old('service_2nd_date')}}">
                                        @error('service_2nd_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_2nd_date">Date of 2nd kidding <span class="t_r">*</span></label>
                                        <input name="kidding_2nd_date" type="date" class="form-control @error('kidding_2nd_date') is-invalid @enderror" value="{{old('kidding_2nd_date')}}">
                                        @error('kidding_2nd_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_2nd_liter">Litter size at 2nd kidding <span class="t_r">*</span></label>
                                        <input name="kidding_2nd_liter" type="number" class="form-control @error('kidding_2nd_liter') is-invalid @enderror" value="{{old('kidding_2nd_liter')}}">
                                        @error('kidding_2nd_liter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="service_3rd_date">Date at 3rd service <span class="t_r">*</span></label>
                                        <input name="service_3rd_date" type="date" class="form-control @error('service_3rd_date') is-invalid @enderror" value="{{old('service_3rd_date')}}">
                                        @error('service_3rd_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_3rd_date">Date of 3rd kidding <span class="t_r">*</span></label>
                                        <input name="kidding_3rd_date" type="date" class="form-control @error('kidding_3rd_date') is-invalid @enderror" value="{{old('kidding_3rd_date')}}">
                                        @error('kidding_3rd_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_3rd_liter">Litter size at 3rd kidding <span class="t_r">*</span></label>
                                        <input name="kidding_3rd_liter" type="number" class="form-control @error('kidding_3rd_liter') is-invalid @enderror" value="{{old('kidding_3rd_liter')}}">
                                        @error('kidding_3rd_liter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="service_4th_date">Date at 4th service <span class="t_r">*</span></label>
                                        <input name="service_4th_date" type="date" class="form-control @error('service_4th_date') is-invalid @enderror" value="{{old('service_4th_date')}}">
                                        @error('service_4th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_4th_date">Date of 4th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_4th_date" type="date" class="form-control @error('kidding_4th_date') is-invalid @enderror" value="{{old('kidding_4th_date')}}">
                                        @error('kidding_4th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_4th_liter">Litter size at 4th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_4th_liter" type="number" class="form-control @error('kidding_4th_liter') is-invalid @enderror" value="{{old('kidding_4th_liter')}}">
                                        @error('kidding_4th_liter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="service_5th_date">Date at 5th service <span class="t_r">*</span></label>
                                        <input name="service_5th_date" type="date" class="form-control @error('service_5th_date') is-invalid @enderror" value="{{old('service_5th_date')}}">
                                        @error('service_5th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_5th_date">Date of 5th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_5th_date" type="date" class="form-control @error('kidding_5th_date') is-invalid @enderror" value="{{old('kidding_5th_date')}}">
                                        @error('kidding_5th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_5th_liter">Litter size at 5th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_5th_liter" type="number" class="form-control @error('kidding_5th_liter') is-invalid @enderror" value="{{old('kidding_5th_liter')}}">
                                        @error('kidding_5th_liter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="service_6th_date">Date at 6th service <span class="t_r">*</span></label>
                                        <input name="service_6th_date" type="date" class="form-control @error('service_6th_date') is-invalid @enderror" value="{{old('service_6th_date')}}">
                                        @error('service_6th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_6th_date">Date of 6th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_6th_date" type="date" class="form-control @error('kidding_6th_date') is-invalid @enderror" value="{{old('kidding_6th_date')}}">
                                        @error('kidding_6th_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="kidding_6th_liter">Litter size at 6th kidding <span class="t_r">*</span></label>
                                        <input name="kidding_6th_liter" type="number" class="form-control @error('kidding_6th_liter') is-invalid @enderror" value="{{old('kidding_6th_liter')}}">
                                        @error('kidding_6th_liter')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="form-group col-md-3">
                                        <label for="remarks">Date of Culling/ Death <span class="t_r">*</span></label>
                                        <input name="remarks" type="text" class="form-control @error('remarks') is-invalid @enderror" value="{{old('remarks')}}">
                                        @error('remarks')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
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
{{-- <script>
    $('#farm').on('change',function() {
        // $(".valReset").empty().trigger('change')
        let farm = $(this).val().slice(-1);
        if(farm == 'c'){
            $('.subFarmDiv').show();
            // $('#farm').on('change',function(e) {
                var farmOrComId = $(this).val()
                $.ajax({
                    url:'{{ route("get.subFarm") }}',
                    type:"get",
                    data: {
                        farmOrComId: farmOrComId
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#subFarm').html(res.name);
                    }
                })
            // });

            // For community Farm
            $('#subFarm').on('change',function(e) {
                // Tag No
                let community_id = $(this).val()
                $.ajax({
                    url:'{{ route("get.animalM") }}',
                    type:"get",
                    data: {
                        community_id: community_id
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#bull_id').html(res.name);
                    }
                })

                $.ajax({
                    url:'{{ route("get.animalF") }}',
                    type:"get",
                    data: {
                        community_id: community_id
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#animal_info').html(res.name);
                    }
                })
                // tattoo No
                // $.ajax({
                //     url:'{{ route("get.tattooNo") }}',
                //     type:"get",
                //     data: {
                //         community_id: community_id
                //         },
                //     success:function (res) {
                //         res = $.parseJSON(res);
                //         $('#tattooNo').html(res.tattooNo);
                //     }
                // })
            });
        }else{
            $('.subFarmDiv').hide();
            // For research Farm
            // $('#farm').on('select2:select', function () {
                // Tag No
                let farm_id = $(this).val().slice(0,-1)
                // var community_id = $(this).val()
                $.ajax({
                    url:'{{ route("get.animalM") }}',
                    type:"get",
                    data: {
                        farm_id: farm_id
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#bull_id').html(res.name);
                    }
                })

                $.ajax({
                    url:'{{ route("get.animalF") }}',
                    type:"get",
                    data: {
                        farm_id: farm_id
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#animal_info').html(res.name);
                    }
                })
                // tattoo No
                $.ajax({
                    url: '{{ route("get.tattooNoResearch") }}',
                    type: "get",
                    data: {
                        farm_id: farm_id
                    },
                    success: function (res) {
                        res = $.parseJSON(res);
                        $('#tattooNo').html(res.tattooNo);
                    }
                })
            // });
        }
    })
</script> --}}
@endpush
@endsection

