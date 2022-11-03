@extends('admin.layout.master')
@section('title', 'Animal Information')
@php $p='animalRecord'; $sm="animalInfo"; @endphp
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Animal Information</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Animal Information</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                            @endif
                            <form action="{{ route('animal-info.update', $animalInfo->id)}}" method="post">
                                @csrf @method('PUT')
                                <p id="demo"></p>
                                <input type="hidden" class="lat" id="lat" name="lat">
                                <input type="hidden" id="long" name="lon">
                                <input type="hidden" id="animal_sub_cat_id" name="lon" value="{{$animalInfo->animal_sub_cat_id }}">
                                <input type="hidden" id="get_farm_id"  value="{{$animalInfo->farm_id }}">
                                <input type="hidden" id="get_community_id"  value="{{$animalInfo->community_id }}">
                                <div class="row">
                                    <div class="form-check">
										<label>Select <span class="t_r">*</span></label><br>
										<label class="form-radio-label" id="farm">
											<input class="form-radio-input" type="radio" name="optionsRadios" value="{{$animalInfo->farm_id}}" id="f" {{$animalInfo->farm_id!=''?'checked':''}}>
											<span class="form-radio-sign">Research Farm</span>
										</label>
										<label class="form-radio-label ml-3" id="community">
											<input class="form-radio-input" type="radio" name="optionsRadios" value="{{$animalInfo->community_cat_id}}" id="c" {{$animalInfo->community_cat_id !=''?'checked':''}}>
											<span class="form-radio-sign">Community Farm</span>
										</label>
									</div>

                                    <div class="form-group col-md-3" id="farmSelect" style="display: none">
                                        <label for="farm_id">Area <span class="t_r">*</span></label>
                                        <select name="farm_id" class="form-control @error('name') is-invalid @enderror farmOrComId" id="farm_id">
                                            <option value="">Select</option>
                                            @foreach ($farms as $farm)
                                            <option value="{{$farm->id}}" {{$farm->id==$animalInfo->farm_id?'selected':''}}>{{$farm->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('farm_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 community" style="display: none">
                                        <label for="community_id">Area <span class="t_r">*</span></label>
                                        <select name="community_cat_id" id="community_cat" class="form-control @error('community_cat_id') is-invalid @enderror farmOrComId">
                                            <option value="">Select</option>
                                            @foreach ($communityCats as $communityCat)
                                            <option value="{{$communityCat->id}}" {{$communityCat->id==$animalInfo->community_cat_id?'selected':''}}>{{$communityCat->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('community_cat_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- <div class="form-group col-md-3">
                                        <label for="animal_tag">Farm Id<span class="t_r">*</span></label>
                                        <select name="community_id" id="subFarm" class="form-control" ></select>
                                    </div> --}}

                                    <div class="form-group col-md-3">
                                        <label for="identification_no">Identification No <span class="t_r">*</span></label>
                                        <input name="identification_no" type="text" value="{{ $animalInfo->identification_no }}" class="form-control identificationNoFarm @error('identification_no') is-invalid @enderror" readonly required>
                                        @error('identification_no')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 farmIdArea" style="display:none">
                                        <label for="community_id" style="display: block">Farm Id<span class="t_r">*</span></label>
                                        <select name="community_id" id="subFarm" class="form-control select2" required></select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="buffalo_id">Buffalo ID <span class="t_r">*</span></label>
                                        <input name="buffalo_id" type="text" class="form-control @error('buffalo_id') is-invalid @enderror" id="buffaloId" value="{{ $animalInfo->buffalo_id }}" required>
                                        @error('buffalo_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="animal_tag">Tag no <span class="t_r">*</span></label>
                                        <input name="animal_tag" type="text" class="form-control @error('animal_tag') is-invalid @enderror" value="{{ $animalInfo->animal_tag }}">
                                        @error('animal_tag')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="tattoo_no">Tattoo No <span class="t_r">*</span></label>
                                        <input name="tattoo_no" type="text" class="form-control @error('tattoo_no') is-invalid @enderror" value="{{ $animalInfo->tattoo_no }}">
                                        @error('tattoo_no')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-check col-md-3">
										<label>Type <span class="t_r">*</span></label><br>
										<label class="form-radio-label" id="goat">
											<input class="form-radio-input" type="radio" name="type" value="1" required {{ $animalInfo->type == 1 ? 'checked' : '' }} >
											<span class="form-radio-sign">Swamp </span>
										</label>
										<label class="form-radio-label ml-3" id="sheep">
											<input class="form-radio-input" type="radio" name="type" value="2" required {{ $animalInfo->type == 2 ? 'checked' : '' }} >
											<span class="form-radio-sign">River</span>
										</label>
									</div>

                                    <div class="form-group col-md-3">
                                        <label for="animal_cat_id">Breed <span class="t_r">*</span></label>
                                        <select name="animal_cat_id" class="form-control animal_cat_id @error('animal_cat_id') is-invalid @enderror">
                                            {{-- <option >Select</option> --}}
                                            @foreach ($goatCats as $goatCat)
                                            <option value="{{$goatCat->id}}"{{ $animalInfo->animal_cat_id==$goatCat->id?'selected':'' }} >{{$goatCat->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('animal_cat_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3 breed_variate" style="display: none">
                                        <label for="animal_sub_cat_id">Breed variate</label>
                                        <select name="animal_sub_cat_id" class="form-control animalSub goat">
                                        </select>
                                    </div>
                                {{-- </div>

                                <div class="row"> --}}
                                    <div class="form-group col-md-3">
                                        <label for="d_o_b">Date of Birth/Purchase <span class="t_r">*</span></label>
                                        <input  name="d_o_b" id="d_o_b" type="date" class="form-control @error('d_o_b') is-invalid @enderror" value="{{ $animalInfo->d_o_b }}" required>
                                        @error('d_o_b')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="season_o_birth">Season of Birth </label>
                                        <input name="season_o_birth" id="season_o_birth" type="text" class="form-control @error('season_o_birth') is-invalid @enderror" readonly value="{{ $animalInfo->season_o_birth }}">
                                        @error('season_o_birth')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="age_distribution">Age Distribution <span class="t_r">*</span></label>
                                        <select name="age_distribution" class="form-control" id="age_distribution" required>
                                            {{-- <option>Select</option> --}}
                                            <option value="1" {{ $animalInfo->age_distribution==1?'checked':'' }}>Newborn calf</option>
                                            <option value="2" {{ $animalInfo->age_distribution==2?'checked':'' }}>Heifer</option>
                                            <option value="3" {{ $animalInfo->age_distribution==3?'checked':'' }}>Buffalo Cow</option>
                                        </select>
                                        @error('age_distribution')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="sex">Sex <span class="t_r">*</span></label>
                                        <select name="sex" id="sex" class="form-control @error('sex') is-invalid @enderror" required>
                                            {{-- <option  selected disabled>Select</option> --}}
                                            <option value="M" {{ $animalInfo->sex=='M'?'selected':'' }}>M</option>
                                            <option value="F" {{ $animalInfo->sex=='F'?'selected':'' }}>F</option>
                                        </select>
                                        @error('sex')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="color">Coat color </label>
                                        <select name="color" class="form-control">
                                            {{-- <option value="">Select</option> --}}
                                            <option value="Black" {{ $animalInfo->color=='Black'?'selected':'' }}>Black</option>
                                            <option value="Gray" {{ $animalInfo->color=='Gray'?'selected':'' }}>Gray</option>
                                        </select>
                                        @error('color')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="birth_wt" id="dis_msg">Select age distribution <span class="t_r">*</span></label>
                                        <input name="birth_wt" type="text" class="form-control @error('birth_wt') is-invalid @enderror" oninput="this.value = this.value.replace(/[a-zA-z\-*/]/g,'');" value="{{ $animalInfo->birth_wt }}" required>
                                        @error('birth_wt')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="generation">Generation <span class="t_r">*</span></label>
                                        <select name="generation" class="form-control" required>
                                            <option  {{ $animalInfo->generation==0?'selected':'' }}>0</option>
                                            <option value="1" {{ $animalInfo->generation==1?'selected':'' }}>1</option>
                                            <option value="2" {{ $animalInfo->generation==2?'selected':'' }}>2</option>
                                            <option value="3" {{ $animalInfo->generation==3?'selected':'' }}>3</option>
                                        </select>
                                        @error('generation')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="paity">Parity </label>
                                        <select name="paity" class="form-control">
                                            {{-- <option value="">Select</option> --}}
                                            @for($i=0; $i<=10; $i++)
                                                <option value="{{$i}}" {{ $animalInfo->paity==$i?'selected':'' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @error('paity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dam_milk">1<sup>st</sup> day dam milk yield (Kg) </label>
                                        <input  name="dam_milk" type="number" step="any" class="form-control @error('dam_milk') is-invalid @enderror" value="{{ $animalInfo->dam_milk }}">
                                        @error('dam_milk')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="sire">Sire Id</label>
                                        <input name="sire" type="text" class="form-control @error('sire') is-invalid @enderror" value="{{ $animalInfo->sire }}">
                                        @error('sire')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dam">Dam Id</label>
                                        <input name="dam" type="text" class="form-control @error('dam') is-invalid @enderror" value="{{ $animalInfo->dam }}" >
                                        @error('dam')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="remark">Remarks</label>
                                        <input name="remark" type="text" class="form-control @error('remark') is-invalid @enderror" value="{{ $animalInfo->remark }}">
                                        @error('remark')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div align="center" class="mr-auto card-action">
                                    <button type="submit" id="sub" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form>
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Go to settings and allow location</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ asset('files/images/loc/1.jpg') }}" alt="" width="100%" class="pb-3">
                                        <img src="{{ asset('files/images/loc/2.jpg') }}" alt="" width="100%" class="pb-3">
                                        <img src="{{ asset('files/images/loc/3.jpg') }}" alt="" width="100%" class="pb-3">
                                        <img src="{{ asset('files/images/loc/4.jpg') }}" alt="" width="100%" class="pb-3">
                                        <img src="{{ asset('files/images/loc/5.jpg') }}" alt="" width="100%" class="pb-3">
                                        <img src="{{ asset('files/images/loc/6.jpg') }}" alt="" width="100%" class="pb-3">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{-- Page Content End --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @isset($isAndroid)
    <input type="hidden" id="android" value="{{$isAndroid}}">
    @endisset

    @include('admin.layout.footer')
</div>
{{-- @include('sweetalert::alert') --}}
@push('custom_scripts')

<script>
    // farm
    $(document).ready(function () {
        if ($("#f").val() != '') {
            $('#farmSelect').fadeIn()
            $('.community').hide()
            // $('#community_cat').removeClass('farmOrComId')
            // $('#farm_id').attr('required', true)
            // $("[name='community_id']").attr('required', false)
            // $("[name='name']").attr('required', false)
            // $("#animal_tag").attr('readonly', false)
        } else {
            $('#farmSelect').fadeOut()
            // $('#farm_id').removeClass('farmOrComId')
            $('.community').show()
            // $('#farm_id').attr('required', false)
            // $("[name='community_id']").attr('required', true)
            // $("#comm").attr('required', true)
            $("#animal_tag").attr('readonly', true)
        }



        var get_farm_id = $("#get_farm_id").val();
        var get_community_id = $("#get_community_id").val();
        var farm_id = $("#farm_id").val();
        var community_cat = $("#community_cat").val();
        // var community_cat = $(this).val();
        // var farm_id = $(this).val();
        if (farm_id != '') {
            $.ajax({
                url: '{{ route("get.animal.farm") }}',
                type: "get",
                data: {
                    farm_id: farm_id,
                    get_farm_id: get_farm_id
                },
                success: function (res) {
                    res = $.parseJSON(res);
                    $('#subFarm').html(res.farmName);
                }
            })
        } else {
            $.ajax({
                url: '{{ route("get.animal.community") }}',
                type: "get",
                data: {
                    community_cat: community_cat,
                    get_community_id: get_community_id
                },
                success: function (res) {
                    res = $.parseJSON(res);
                    $('#subFarm').html(res.comName);
                }
            })
        }
    });


    $('#farm').click(function(){
        $('#farmSelect').fadeIn()
        $('.community').fadeOut()
        // $('#community_cat').removeClass('farmOrComId')
        $('#farm_id').attr('required', true)
        $("[name='community_id']").attr('required', false)
        $("[name='name']").attr('required', false)
        $("#animal_tag").attr('readonly', false)

    })
    $('#community').click(function(){
        $('#farmSelect').fadeOut()
        // $('#farm_id').removeClass('farmOrComId')
        $('.community').fadeIn()
        $('#farm_id').attr('required', false)
        $("[name='community_id']").attr('required', true)
        $("#comm").attr('required', true)
        $("#animal_tag").attr('readonly', true)
    })


    // Get sub farm start
    // $(function () {


    // });


    $('#farm_id').on('change',function(e) {
        var farm_id = $(this).val();
        // alert(farm_id);
        $.ajax({
            url:'{{ route("get.animal.farm") }}',
            type:"get",
            data: {
                farm_id: farm_id
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#subFarm').html(res.farmName);
            }
        })
    });

    // Identification No Start
    $('#farm_id').change(function () {
        $.ajax({
            url:"{{route('get.animal.identificationNoFarm')}}",
            data:{id:$(this).val()},
            method:'get',
            success:res=>{
                if(res.status == 200){
                    $(".identificationNoFarm").val(2105+' '+res.identificationNo.post)
                }else{
                    alert('error', 'No found')
                }
            },
            error:err=>{
                alert('error', 'No found')
            }
        });
    });
    $('#community_cat').change(function () {
        $.ajax({
            url:"{{route('get.animal.identificationNoCom')}}",
            data:{id:$(this).val()},
            method:'get',
            success:res=>{
                if(res.status == 200){
                    $(".identificationNoFarm").val(2105+' '+res.identificationNo.post)
                }else{
                    alert('error', 'No found')
                }
            },
            error:err=>{
                alert('error', 'No found')
            }
        });
    });
    // Identification No End

    $('#community_cat').on('change',function(e) {
        var community_cat = $(this).val();
        $.ajax({
            url:'{{ route("get.animal.community") }}',
            type:"get",
            data: {
                community_cat: community_cat
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#subFarm').html(res.comName);
            }
        })
    });
    // Get sub farm end

    // Tag no Start
    $("#farm").on("change", function(){
        $("#subFarm").on("change", function(){
            var get_animal_tag = $("#get_animal_tag").val()
            var farmText = $("#farm_id").find("option:selected").text();
            var getFarmText = farmText.slice(0,1);
            var subFarmText = $(this).find("option:selected").text();
            var getSubFarmText = subFarmText.slice(0,1);
            var farmSelect = $(this).val();
            $.ajax({
                url:'{{ route("getAnimalFarm") }}',
                type:"get",
                data: {
                    farmSelect: farmSelect
                    },
                success:function (res) {
                    res = $.parseJSON(res);
                    $("#animal_tag").val(getFarmText + getSubFarmText + res.animalId);
                }
            })
        });
    });

    $("#community_cat").on("change", function(){
        $("#subFarm").on("change", function(){
            var get_animal_tag = $("#get_animal_tag").val()
            var farmText = $("#community_cat").find("option:selected").text();
            var getFarmText = farmText.slice(0,1);
            var subFarmText = $(this).find("option:selected").text();
            var getSubFarmText = subFarmText.slice(0,1);
            var farmSelect = $(this).val();
            $.ajax({
                url:'{{ route("getAnimalFarm") }}',
                type:"get",
                data: {
                    farmSelect: farmSelect
                    },
                success:function (res) {
                    res = $.parseJSON(res);
                    $("#animal_tag").val(getFarmText + getSubFarmText + res.animalId);
                }
            })
        });

    });
    // Tag no End

    // Buffalo ID start
    $('#farm_id').change(function () {
        $.ajax({
            url:"{{route('get.animal.buffaloIdResearch')}}",
            data:{id:$(this).val()},
            method:'get',
            success:res=>{
                if(res.status == 200){
                    $("#buffaloId").val(res.buffaloId)
                }else{
                    alert('error', 'No found')
                }
            },
            error:err=>{
                alert('error', 'No found')
            }
        });
    });
    $('#subFarm').change(function () {
        $.ajax({
            url:"{{route('get.animal.buffaloId')}}",
            data:{id:$(this).val()},
            method:'get',
            success:res=>{
                if(res.status == 200){
                    $("#buffaloId").val(res.buffaloId)
                }else{
                    alert('error', 'No found')
                }
            },
            error:err=>{
                alert('error', 'No found')
            }
        });
    });
    // Buffalo ID End

    // Tag no Start
    // $("#farm").on("change", function(){
    //     $("#subFarm").on("change", function(){
    //         var get_animal_tag = $("#get_animal_tag").val()
    //         var farmText = $("#farm_id").find("option:selected").text();
    //         var getFarmText = farmText.slice(0,1);
    //         var subFarmText = $(this).find("option:selected").text();
    //         var getSubFarmText = subFarmText.slice(0,1);
    //         var farmSelect = $(this).val();
    //         $.ajax({
    //             url:'{{ route("getAnimalFarm") }}',
    //             type:"get",
    //             data: {
    //                 farmSelect: farmSelect
    //                 },
    //             success:function (res) {
    //                 res = $.parseJSON(res);
    //                 $("#animal_tag").val(getFarmText + getSubFarmText + res.animalId);
    //             }
    //         })
    //     });
    // });

    // $("#community_cat").on("change", function(){
    //     $("#subFarm").on("change", function(){
    //         var get_animal_tag = $("#get_animal_tag").val()
    //         var farmText = $("#community_cat").find("option:selected").text();
    //         var getFarmText = farmText.slice(0,1);
    //         var subFarmText = $(this).find("option:selected").text();
    //         var getSubFarmText = subFarmText.slice(0,1);
    //         var farmSelect = $(this).val();
    //         $.ajax({
    //             url:'{{ route("getAnimalFarm") }}',
    //             type:"get",
    //             data: {
    //                 farmSelect: farmSelect
    //                 },
    //             success:function (res) {
    //                 res = $.parseJSON(res);
    //                 $("#animal_tag").val(getFarmText + getSubFarmText + res.animalId);
    //             }
    //         })
    //     });
    // });
    // Tag no End

    $(document).ready(function () {
        if ($(".animal_cat_id").val() == '2') {
            var animalCatId = $(".animal_cat_id").val();
            var animal_sub_cat_id = $("#animal_sub_cat_id").val();
            console.log(animalCatId, animal_sub_cat_id);
            $.ajax({
                url: '{{ route("animalInfo.getAnimalCat") }}',
                type: "get",
                data: {
                    animalCatId: animalCatId,
                    animal_sub_cat_id: animal_sub_cat_id
                },
                success: function (res) {
                    res = $.parseJSON(res);
                    $('.animalSub').html(res.animal);
                }
            })
        }

        var breed = $(".animal_cat_id").val();
        if (breed == '2') {
            $(".breed_variate").css('display', 'block');
        } else {
            $(".breed_variate").css('display', 'none');
        }
    });

    $(document).ready(function () {
        $(".animal_cat_id").on('change', function () {
            var breed = $(this).val();
            if (breed == '2') {
                $(".breed_variate").css('display', 'block');
            } else {
                $(".breed_variate").css('display', 'none');
            }
        });
    });

    $('.animal_cat_id').on('change', function (e) {
        var animalCatId = $(this).val();
        $.ajax({
            url: '{{ route("animalInfo.getAnimalCat") }}',
            type: "get",
            data: {
                animalCatId: animalCatId
            },
            success: function (res) {
                res = $.parseJSON(res);
                $('.animalSub').html(res.animal);
            }
        })
    });

    // Session of birth Calculation
    $("#d_o_b").on('change', function () {
        var sessionBirthCal;
        var sessionBirth = new Date($("#d_o_b").val()).getMonth() + 1;
        if (sessionBirth == 3 || sessionBirth == 4 || sessionBirth == 5 || sessionBirth == 6) {
            sessionBirthCal = 'Summer';
        } else if (sessionBirth == 7 || sessionBirth == 8 || sessionBirth == 9 || sessionBirth == 10) {
            sessionBirthCal = 'Rainy';
        } else {
            sessionBirthCal = 'Winter';
        }
        $('#season_o_birth').val(sessionBirthCal);
    });

    $("#age_distribution").on("change", function () {
        var age_distribution = $(this).val()
        if (age_distribution == 1) {
            $("#dis_msg").text("Birth Wt (Kg)")
        } else {
            $("#dis_msg").text("Body Wt (Kg)")
        }
    })

</script>

{{-- Google map --}}
<script>

    $(document).ready(function() {
        var x = document.getElementById("demo");
        // var lat = document.getElementById("lat");
        var long = document.getElementById("long");


        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        function showPosition(position) {
            // lat.value = position.coords.latitude;
            long.value = position.coords.longitude;
            $("#lat").val(position.coords.latitude)
        };

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        };
    });

    $("#sub").on("click",function(){
        var android = $("#android").val();
        // alert({{$isAndroid}})
        var latt = $("#lat").val();
        if((android==1) && (latt == '')){
            $("#exampleModal").modal("show");
            return false;
        }else if(latt == ''){
        // alert('Please allow location');
            $("#exampleModal").modal("show");
            return false;
        }
    })
</script>
@endpush
@endsection

