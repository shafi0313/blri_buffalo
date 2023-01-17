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
                            <form action="{{ route('animal-info.update', $animalInfo->id)}}" method="post">
                                @csrf @method('PUT')
                                <p id="demo"></p>
                                <input type="hidden" id="lat" name="lat">
                                <input type="hidden" id="long" name="lon">
                                <input type="hidden" id="animalId" name="animalId" value="{{$animalInfo->id}}">
                                <input type="hidden" id="animal_sub_cat_id" name="lon" value="{{$animalInfo->animal_sub_cat_id }}">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="identification_no">Identification No <span class="t_r">*</span></label>
                                        <input name="identification_no" type="text" class="form-control @error('identification_no') is-invalid @enderror" value="2105 {{$post}}" readonly required>
                                        @error('identification_no')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-check col-md-3">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" name="if_farm_change" value="1">
											<span class="form-check-sign">If you change farm id click here</span>
										</label>
									</div>
                                    <div class="form-group col-md-3">
                                        <label for="community_id">Farm Id<span class="t_r">*</span></label>
                                        <select name="community_id" class="form-control @error('community_id') is-invalid @enderror">
                                            <option >Select</option>
                                            @foreach ($communitys as $community)
                                            <option value="{{$community->id}}" {{$animalInfo->community_id==$community->id?'selected':''}}>{{$community->no}}</option>
                                            @endforeach
                                        </select>
                                        @error('community_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="animal_tag">Tag no <span class="t_r">*</span></label>
                                        {{-- <input  type="text" id="get_animal_tag" value="{{App\Models\AnimalInfo::where()->max('animal_tag')+1}}"> --}}
                                        <input name="animal_tag" type="text" class="form-control @error('animal_tag') is-invalid @enderror" value="{{ $animalInfo->animal_tag }}" id="animal_tagg" required>
                                        @error('animal_tag')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-check col-md-3">
										<label>Type <span class="t_r">*</span></label><br>
										<label class="form-radio-label" id="goat">
											<input class="form-radio-input" type="radio" name="type" value="1" required {{ $animalInfo->type==1?'checked':'' }} >
											<span class="form-radio-sign">Swamp </span>
										</label>
										<label class="form-radio-label ml-3" id="sheep">
											<input class="form-radio-input" type="radio" name="type" value="2" required {{ $animalInfo->type==2?'checked':'' }} >
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
                                        <select name="animal_sub_cat_id" id="" class="form-control animalSub goat">
                                        </select>
                                    </div>
                                {{-- </div>

                                <div class="row"> --}}
                                    <div class="form-group col-md-3">
                                        <label for="ear_tag">Ear Tag Id <span class="t_r">*</span></label>
                                        <input  name="ear_tag" id="ear_tag" type="text" class="form-control @error('ear_tag') is-invalid @enderror" value="{{ $animalInfo->ear_tag }}" required>
                                        @error('ear_tag')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="d_o_b">Date of Birth/Purchase <span class="t_r">*</span></label>
                                        <input  name="d_o_b" id="d_o_b" type="date" class="form-control @error('d_o_b') is-invalid @enderror" value="{{ $animalInfo->d_o_b }}" required>
                                        @error('d_o_b')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="season_o_birth">Season of Body </label>
                                        <input name="season_o_birth" id="season_o_birth" type="text" class="form-control @error('season_o_birth') is-invalid @enderror" readonly value="{{ $animalInfo->season_o_birth }}">
                                        @error('season_o_birth')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="age_distribution">Age Distribution <span class="t_r">*</span></label>
                                        <select name="age_distribution" class="form-control" id="age_distribution" required>
                                            {{-- <option>Select</option> --}}
                                            <option value="1" {{ $animalInfo->age_distribution==1?'selected':'' }}>Newborn calf</option>
                                            <option value="2" {{ $animalInfo->age_distribution==2?'selected':'' }}>Heifer</option>
                                            <option value="3" {{ $animalInfo->age_distribution==3?'selected':'' }}>Buffalo Cow</option>
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
                                        {{-- <input name="generation" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('generation')}}" required> --}}
                                        <select name="generation" class="form-control" required>
                                            {{-- <option value="">Select</option> --}}
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
                                        <label for="dam_milk">Fast Dam milk production (kg) </label>
                                        <input  name="dam_milk" type="text" class="form-control @error('dam_milk') is-invalid @enderror" oninput="this.value = this.value.replace(/[a-zA-z\-*/]/g,'');" value="{{$animalInfo->dam_milk}}">
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

    });
    $('#farm').click(function(){
        $('#farmSelect').fadeIn()
        $('.community').fadeOut()
        $('#farm_id').attr('required', true)
        $("[name='community_id']").attr('required', false)
        $("[name='name']").attr('required', false)
    })
    $('#community').click(function(){
        $('#farmSelect').fadeOut()
        $('.community').fadeIn()
        $('#farm_id').attr('required', false)
        $("[name='community_id']").attr('required', true)
        $("#comm").attr('required', true)
    })

    // $('#sex').on('change',function(e) {
    //     var sex = $(this).val();
    //     if(sex=='M'){
    //         $('#m_type').show()
    //     }else{
    //         $('#m_type').hide()
    //     }
    // })

    // $('#community_cat').on('change',function(e) {
    //     var communityCatId = $(this).val();
    //     $.ajax({
    //
    //         type:"get",
    //         data: {
    //             communityCatId: communityCatId
    //             },
    //         success:function (res) {
    //             res = $.parseJSON(res);
    //             $('#comm').html(res.com);
    //         }
    //     })
    // });

    $(document).ready(function(){
        // $(".animal_cat_id").on('change', function(){
            var breed = $(".animal_cat_id").val();
            if(breed == '2'){
                $(".breed_variate").css('display', 'block');
            } else {
                $(".breed_variate").css('display', 'none');
            }
        // });
    });
    // alert()

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

    // Animal Cat
    // $('#goat').click(function(){
    //     $('.sheep').val('')
    //     $('.goat').val('')
    // })
    // $('#goat').click(function(){
    //     $('.goatCat').fadeIn()
    //     $('.sheepCat').fadeOut()
    //     $('.sheep').attr('disabled', true)
    //     $('.goat').attr('disabled', false)
    //     $('.goat').attr('required', true)
    //     $('.sheep').attr('required', false)
    // })

    // $('#sheep').click(function(){
    //     $('.sheepCat').fadeIn()
    //     $('.goatCat').fadeOut()
    //     $('.goat').attr('disabled', true)
    //     $('.sheep').attr('disabled', false)
    //     $('.sheep').attr('required', true)
    //     $('.goat').attr('required', false)
    // })

    $('.animal_cat_id').on('change',function(e) {
        var animalCatId = $(this).val();
        $.ajax({
            url:'{{ route("animalInfo.getAnimalCat") }}',
            type:"get",
            data: {
                animalCatId: animalCatId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('.animalSub').html(res.animal);
            }
        })
    });

    // Session of birth Calculation
    $("#d_o_b").on('change', function(){
        var sessionBirthCal;
        var sessionBirth = new Date($("#d_o_b").val()).getMonth()+1;
        if(sessionBirth==3 || sessionBirth==4 || sessionBirth==5 || sessionBirth==6){
            sessionBirthCal = 'Summer';
        }else if(sessionBirth==7 || sessionBirth==8 || sessionBirth==9 || sessionBirth==10){
            sessionBirthCal = 'Rainy';
        }else{
            sessionBirthCal = 'Winter';
        }
        $('#season_o_birth').val(sessionBirthCal);
    });

    $("#farm_id").on("change", function(){
        // $("#animal_tag").val('')
        var get_animal_tag = $("#get_animal_tag").val()
        var farmText = $(this).find("option:selected").text();
        var getFarmText = farmText.slice(0,1);
        var farmSelect = $(this).val();
        $.ajax({
            url:'{{ route("getAnimalFarm") }}',
            type:"get",
            data: {
                farmSelect: farmSelect
                },
            success:function (res) {
                res = $.parseJSON(res);
                $("#animal_tag").val(getFarmText + res.animalId);
            }
        })
    });

    $("#community_cat").on("change", function(){
        // $("#animal_tag").val('')
        var get_animal_tag = $("#community_cat").val()
        var farmText = $(this).find("option:selected").text();
        var getFarmText = farmText.slice(0,1);
        var farmCommunity = $(this).val();
        $.ajax({
            url:'{{ route("getAnimalCommunity") }}',
            type:"get",
            data: {
                farmCommunity: farmCommunity
                },
            success:function (res) {
                res = $.parseJSON(res);
                $("#animal_tag").val(getFarmText + res.animalId);
            }
        })
    });

    $("#age_distribution").on("change", function () {
        var age_distribution = $(this).val()
        if(age_distribution==1){
            $("#dis_msg").text("Birth Wt (Kg)")
        }else{
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
        var latt = $("#lat").val();
        if((android == 1) && latt == ''){
            $("#exampleModal").modal("show");
            return false;
        }else if(latt == ''){
            $("#exampleModal").modal("show");
            return false;
        }
    })


</script>
@endpush
@endsection

