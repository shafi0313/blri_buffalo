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
                            <form action="{{ route('service.update', $data)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <input type="hidden" id="get_bull_id" value="{{ $data->bull_id }}">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="community_id">Farm Id <span class="t_r">*</span></label>
                                        <select name="community_id" id="subFarm" class="form-control select2 @error('community_id') is-invalid @enderror">
                                            <option  disabled value>Select</option>
                                            @foreach ($communities as $community)
                                            <option value="{{$community->id}}" {{ $data->community_id==$community->id?'selected':'' }}>{{$community->no}}-{{$community->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('community_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name">Female Buffalo ID; <span class="t_r">*</span></label>
                                        <select name="animal_info_id" id="animal_info" class="form-control select2 @error('animal_info_id') is-invalid @enderror">

                                        </select>
                                        @error('animal_info_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name">Buffalo Bull ID <span class="t_r">*</span></label>
                                        <select name="bull_id" id="bull_id" class="form-control select2 @error('bull_id') is-invalid @enderror">

                                        </select>
                                        @error('bull_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_of_service">Date of Service</label>
                                        <input  name="date_of_service" type="date" id="date_of_service" class="form-control @error('date_of_service') is-invalid @enderror" value="{{ $data->date_of_service }}">
                                        @error('date_of_service')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="natural">Natural/AI</label>
                                        <select name="natural" class="form-control @error('natural') is-invalid @enderror">
                                            <option>Select</option>
                                            <option value="Natural" {{ $data->natural=='Natural'?'selected':''}}>Natural</option>
                                            <option value="AI" {{ $data->natural=='AI'?'selected':''}}>AI</option>
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
    var community_id = $('#get_community_id').val()
    var animal_info_id = $('#animal_info_id').val()
    var get_bull_id = $('#get_bull_id').val()
    $.ajax({
        url: '{{ route("get.animalM") }}',
        type: "get",
        data: {
            community_id: community_id,
            get_bull_id: get_bull_id
        },
        success: function (res) {
            res = $.parseJSON(res);
            $('#bull_id').html(res.name);
        }
    })

    $.ajax({
        url: '{{ route("get.animalF") }}',
        type: "get",
        data: {
            community_id: community_id,
            animal_info_id: animal_info_id
        },
        success: function (res) {
            res = $.parseJSON(res);
            $('#animal_info').html(res.name);
        }
    })



    $('#subFarm').on('change',function(e) {
        var community_id = $(this).val()
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

    $('#animalInfo').on('change',function(e) {
        var animalInfoId = $(this).val();
        $.ajax({
            url:'{{ route("get.getAnimalInfo") }}',
            type:"get",
            data: {
                animalInfoId: animalInfoId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#sex').val(res.sex);
                $('#animal_sl').val(res.animal_sl);
                $('#birth_wt').val(res.birth_wt);
                $('#color').val(res.color);
            }
        })
    });
</script>

<script>
    // var date_of_service = $("#date_of_service").val()
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
{{-- <script>
    $('#animalInfo').on('change',function(e) {
        var animalInfoId = $(this).val();
        $.ajax({
            url:'{{ route("get.getAnimalInfo") }}',
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
                $('#paity').val(res.paity);
                $('#litter_size').val(res.litter_size);
            }
        })
    });
</script> --}}
@endpush
@endsection

