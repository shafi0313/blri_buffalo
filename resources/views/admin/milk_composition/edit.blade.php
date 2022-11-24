@extends('admin.layout.master')
@section('title', 'Milk Composition')
@section('content')
@php $p='animalRecord'; $sm="milkComposition"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('milk-composition.index')}}">Milk Composition</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Edit Milk Composition</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit New</h4>
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
                            <form action="{{ route('milk-composition.update', $milkComposition->id )}}" method="post">
                                @csrf @method('PUT')
                                <div class="row">
                                    {{-- <div class="form-check">
                                        <label>Milk Type</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="milk_type" value="ind" id="ind">
                                            <span class="form-radio-sign">Individual</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="milk_type" value="bulk" id="bulk">
                                            <span class="form-radio-sign">Bulk Milk</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-md-3 ind " style="display: none">
                                        <label for="community_cat_id">Area <span class="t_r">*</span></label>
                                        <select name="farmOrCommunityId" id="farm" class="form-control ind_val @error('community_cat_id') is-invalid @enderror select2">
                                            <option selected >Select</option>
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
                                        <select name="community_id" id="subFarm" class="form-control valReset select2"></select>
                                    </div>

                                    <div class="form-group col-md-3 ind" style="display: none">
                                        <label for="name">Tag no <span class="t_r">*</span></label>
                                        <select name="animal_info_id" id="animal_info" class="form-control valReset @error('animal_info_id') is-invalid @enderror select2"></select>
                                        @error('animal_info_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 ind" style="display: none">
                                        <label for="tattoo_no">Tattoo no <span class="t_r">*</span></label>
                                        <select name="tattoo_no" id="tattooNo" class="form-control valReset @error('tattoo_no') is-invalid @enderror select2"></select>
                                        @error('tattoo_no')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 bulk" style="display: none">
                                        <label for="community_cat_id">Area <span class="t_r">*</span></label>
                                        <select name="farmOrCommunityId" id="farm" class="form-control bulk_val select2 @error('community_cat_id') is-invalid @enderror">
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
                                    </div> --}}

                                    <div class="form-group col-md-3">
                                        <label for="date">Today's Date <span class="t_r">*</span></label>
                                        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{$milkComposition->date}}" required>
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="production">Milk Production (kg) <span class="t_r">*</span></label>
                                        <input name="production" type="number" step="any" class="form-control @error('production') is-invalid @enderror" value="{{$milkComposition->production}}" required>
                                        @error('production')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="fat">Milk Fat (%) <span class="t_r">*</span></label>
                                        <input name="fat" type="number" step="any" class="form-control @error('fat') is-invalid @enderror" value="{{$milkComposition->fat}}" required>
                                        @error('fat')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="density">Density <span class="t_r">*</span></label>
                                        <input name="density" type="number" step="any" class="form-control @error('density') is-invalid @enderror" value="{{$milkComposition->density}}" required>
                                        @error('density')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="lactose">Lactose <span class="t_r">*</span></label>
                                        <input name="lactose" type="number" step="any" class="form-control @error('lactose') is-invalid @enderror" value="{{$milkComposition->lactose}}" required>
                                        @error('lactose')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="snf">SNF <span class="t_r">*</span></label>
                                        <input name="snf" type="number" step="any" class="form-control @error('snf') is-invalid @enderror" value="{{$milkComposition->snf}}" required>
                                        @error('snf')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="protein">Milk Protein (%)<span class="t_r">*</span></label>
                                        <input name="protein" type="number" step="any" class="form-control @error('protein') is-invalid @enderror" value="{{$milkComposition->protein}}" required>
                                        @error('protein')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="water">Water <span class="t_r">*</span></label>
                                        <input name="water" type="number" step="any" class="form-control @error('water') is-invalid @enderror" value="{{$milkComposition->water}}" required>
                                        @error('water')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="temperature">Temperature<span class="t_r">*</span></label>
                                        <input name="temperature" type="number" step="any" class="form-control @error('temperature') is-invalid @enderror" value="{{$milkComposition->temperature}}" required>
                                        @error('temperature')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="freezing_point">Freezing Point <span class="t_r">*</span></label>
                                        <input name="freezing_point" type="number" step="any" class="form-control @error('freezing_point') is-invalid @enderror" value="{{$milkComposition->freezing_point}}" required>
                                        @error('freezing_point')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="salt">Salt <span class="t_r">*</span></label>
                                        <input name="salt" type="number" step="any" class="form-control @error('salt') is-invalid @enderror" value="{{$milkComposition->salt}}" required>
                                        @error('salt')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="remark">Remark </label>
                                        <input name="remark" type="text" class="form-control @error('remark') is-invalid @enderror" value="{{$milkComposition->remark}}">
                                        @error('remark')
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
    $('#animalInfo').on('change',function(e) {
        var animalInfoId = $(this).val();
        $.ajax({
            url:'{{ route("get.getMilkComposition") }}',
            type:"get",
            data: {
                animalInfoId: animalInfoId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#calving_date').val(res.calving_date);
            }
        })
    });

    $("#ind").on("click", function(){
        $(".ind").show();
        $("#calving_date_div").show();
        $(".bulk").hide();
        $(".bulk_val").val('');
        $(".bulk_val").prop('disabled', true);
        $(".ind_val").prop('disabled', false);
        let farm = $("#farm").val()
    $("form").on('submit', function(e){
            let farm = $("#farm").val()
            let animal_info = $("#animal_info").val()
            let tattooNo = $("#tattooNo").val()
            if(farm == null || farm == ""){
                Swal.fire(
                'Data Missing?',
                'Area Missing',
                'question'
                )
                return false;
            }
            if((animal_info == null || animal_info == 0) && (tattooNo == null || tattooNo == 0)){
                Swal.fire(
                'Data Missing?',
                'Tag No or Tattoo No Missing',
                'question'
                )
                return false;
            }
        });
    })
    $("#bulk").on("click", function(){
        $(".ind").hide();
        $(".subFarmDiv").hide();
        $(".ind_val").val('');
        $(".bulk").show();
        $("#calving_date_div").hide();
        $(".ind_val").prop('disabled', true);
        $(".bulk_val").prop('disabled', false);
        let farm = $("#farm").val()
    $("form").on('submit', function(e){
            let farm = $("#farm").val()
            let animal_info = $("#animal_info").val()
            let tattooNo = $("#tattooNo").val()
            if(farm == null || farm == ""){
                Swal.fire(
                'Data Missing?',
                'Area Missing',
                'question'
                )
                return false;
            }
        });
    })
</script>
<script>
    $('#farm').on('change',function() {
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
                    // url:'{{ route("get.tagNo") }}',
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
                $.ajax({
                    url:'{{ route("get.tattooNo") }}',
                    type:"get",
                    data: {
                        community_id: community_id
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#tattooNo').html(res.tattooNo);
                    }
                })
            });
        }else{
            $('.subFarmDiv').hide();
            // For research Farm
            // $('#farm').on('select2:select', function () {
                // Tag No
                let farm_id = $(this).val().slice(0,-1)
                $.ajax({
                    // url: '{{ route("get.tagNoResearch") }}',
                    url:'{{ route("get.animalF") }}',
                    type: "get",
                    data: {
                        farm_id: farm_id
                    },
                    success: function (res) {
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


    $('#animal_info').on('change',function(e) {
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
    $('#tattooNo').on('change',function(e) {
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
{{-- <script>
    $('#farm').on('change',function(e) {
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
    });

    $('#subFarm').on('change',function(e) {
        var community_id = $(this).val()
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

    $('#animal_info').on('change',function(e) {
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
</script> --}}
@endpush
@endsection

