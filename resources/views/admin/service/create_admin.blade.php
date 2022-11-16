@extends('admin.layout.master')
@section('title', 'Service')
@section('content')
@php $p='animalRecord'; $sm="service"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('service.index')}}">Service</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Service</li>
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
                            <form action="{{ route('service.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="community_cat_id">Area <span class="t_r">*</span></label>
                                        <select name="farmOrCommunityId" id="farm" class="form-control select2 @error('community_cat_id') is-invalid @enderror">
                                            <option selected disabled value>Select</option>
                                            @foreach ($farms as $farm)
                                            <option value="{{$farm->id}}f">{{$farm->name}}</option>
                                            @endforeach
                                            @foreach ($communityCats as $communityCat)
                                            <option value="{{$communityCat->id}}c">{{$communityCat->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('community_cat_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 subFarmDiv" style="display: none">
                                        <label for="">Farm Id <span class="t_r">*</span></label>
                                        <select name="community_id" id="subFarm" class="form-control select2"></select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name">Female Buffalo ID <span class="t_r">*</span></label>
                                        <select name="animal_info_id" id="animal_info" class="form-control valReset select2 @error('animal_info_id') is-invalid @enderror"></select>
                                        @error('animal_info_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name">Buffalo Bull ID <span class="t_r">*</span></label>
                                        <select name="bull_id" id="bull_id" class="form-control valReset select2 @error('bull_id') is-invalid @enderror"></select>
                                        @error('bull_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_of_service">Date of Service</label>
                                        <input  name="date_of_service" type="date" id="date_of_service" class="form-control @error('date_of_service') is-invalid @enderror" value="{{old('date_of_service')}}">
                                        @error('date_of_service')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="natural">Natural/AI</label>
                                        <select name="natural" class="form-control @error('natural') is-invalid @enderror">
                                            <option>Select</option>
                                            <option value="Natural">Natural</option>
                                            <option value="AI">AI</option>
                                        </select>
                                        @error('natural')
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
</div>


@push('custom_scripts')
<script>
    $('#farm').on('change',function() {
        let farm = $(this).val().slice(-1);
        if(farm == 'c'){
            $('.subFarmDiv').show();
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
            });
        }else{
            $('.subFarmDiv').hide();
            // For research Farm
                let farm_id = $(this).val().slice(0,-1)
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
</script>
<script>
    $(document).ready(function () {
            $("#date_of_service").change(function () {
                var addDays = 145;
                var startDateVal = $("#date_of_service").val();
                var ModifyInDate = new Date(setDateFormat(startDateVal));
                var NewDate = ModifyInDate.setDate(ModifyInDate.getDate() + parseInt(addDays));
                NewDate = new Date(NewDate);
                if (NewDate != "Invalid Date")
                    $("#expected_d_o_b").val(setDateFormat(NewDate));
            });
        });
        //This function is used for set date formate
        function setDateFormat(date) {
            DateObj = new Date(date);
            var day = DateObj.getDate() ;
            var month = DateObj.getMonth();
            var fullYear = DateObj.getFullYear().toString();
            var setformattedDate = '';
            setformattedDate = getDigitToFormat(day) + '/' +  getDigitToFormat(month) + '/' + fullYear;
            return setformattedDate;
        }
        function getDigitToFormat(val) {
            if (val < 10) {
                val = '0' + val;
            }
            return val.toString();
        }

    $("#date_of_service").on('change', function(){
        var date_of_service = $.datepicker.formatDate('yy/mm/dd', new Date($("#date_of_service").val()))+50;
        $("#expected_d_o_b").val(date_of_service)
        // alert();
        // alert(sessionBirth)
    });
</script>
<script>
    let farm = $("#farm").val()
    $("form").on('submit', function(e){
            let farm = $("#farm").val()
            let animal_info = $("#animal_info").val()
            let bull_id = $("#bull_id").val()
            if(farm == null || farm == ""){
                Swal.fire(
                'Data Missing?',
                'Area Missing',
                'question'
                )
                return false;
            }
            if(animal_info == null || animal_info == 0){
                Swal.fire(
                'Data Missing?',
                'Female Buffalo ID Missing',
                'question'
                )
                return false;
            }
            if(bull_id == null || bull_id == 0){
                Swal.fire(
                'Data Missing?',
                'Buffalo Bull ID Missing',
                'question'
                )
                return false;
            }
        });
</script>
@endpush
@endsection

