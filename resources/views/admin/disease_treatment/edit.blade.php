@extends('admin.layout.master')
@section('title', 'Disease and Treatment')
@section('content')
@php $p='healthM'; $sm="diseaseTreatment"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Disease and Treatment</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Edit</li>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('disease-and-treatment.update', $data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">

                                <input type="hidden" name="animal_cat_id" id="animal_cat_id">
                                <input type="hidden" name="animal_sub_cat_id" id="animal_sub_cat_id">
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.edit_admin')
                                    @else
                                    @include('admin.animal_tag.edit_user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="disease_name">Disease <span class="t_r">*</span></label>
                                        <select name="disease_id" id="disease" class="form-control @error('disease_name') is-invalid @enderror">
                                            <option value disabled>Select Disease Name</option>
                                            @foreach ($diseases as $disease)
                                                <option value="{{ $disease->id }}" {{$data->disease_id==$disease->id?'selected':''}}>{{ $disease->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('disease_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="disease_name">Clinical Sign <span class="t_r">*</span></label>
                                        <div class="form-check" id="clinical_sign"></div>
                                    </div>

                                    <div class="form-group col-md-12" style="display:none" id="clinical_sing_cust_div">
                                        <label for="clinical_sign_input">Other </label>
                                        <input type="text" id="" class="form-control @error('clinical_sign_input') is-invalid @enderror" name="clinical_sign_input" value="{{$data->clinical_sign_input}}">
                                    </div>

                                   <div class="form-group col-md-3">
                                        <label for="symptom_date">Symptom/Sign Visible Date <span class="t_r">*</span></label>
                                        <input type="date" id="symptom_date" class="form-control @error('symptom_date') is-invalid @enderror" name="symptom_date" value="{{$data->symptom_date}}">
                                        @error('symptom_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                   <div class="form-group col-md-3">
                                        <label for="disease_date">Treatment Starting Date <span class="t_r">*</span></label>
                                        <input type="date" id="disease_date" class="form-control @error('disease_date') is-invalid @enderror" name="disease_date" value="{{$data->disease_date}}">
                                        @error('disease_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="recovered_dead">Recovered/ Dead <span class="t_r">*</span></label>
                                        <select name="recovered_dead"  class="form-control @error('recovered_dead') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="Recovered" {{$data->recovered_dead=='Recovered'?'selected':''}}>Recovered</option>
                                            <option value="Dead" {{$data->recovered_dead=='Dead'?'selected':''}}>Dead</option>
                                        </select>
                                        @error('recovered_dead')
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
    // $('#animalInfo').on('change',function(e) {
    //     var animalInfoId = $(this).val();
    //     $.ajax({
    //         url:'{{ route("get.getAnimalInfo") }}',
    //         type:"get",
    //         data: {
    //             animalInfoId: animalInfoId
    //             },
    //         success:function (res) {
    //             res = $.parseJSON(res);
    //             $('#sex').val(res.sex);
    //             $('#d_o_b').val(res.d_o_b);
    //             $('#breed').val(res.breed);
    //             $('#animal_cat_id').val(res.animal_cat_id);
    //             $('#animal_sub_cat_id').val(res.animal_sub_cat_id);
    //             $('#type').val(res.type);

    //             var userinput = res.d_o_b;
    //             var dob = new Date(userinput);

    //             // var dob = new Date(userinput);

    //             //check user provide input or not
    //             if(userinput==null || userinput==''){
    //             document.getElementById("message").innerHTML = "**Choose a date please!";
    //             return false;
    //             }

    //             //execute if user entered a date
    //             else {
    //                 //extract and collect only date from date-time string
    //                 var mdate = userinput.toString();
    //                 var dobYear = parseInt(mdate.substring(0,4), 10);
    //                 var dobMonth = parseInt(mdate.substring(5,7), 10);
    //                 var dobDate = parseInt(mdate.substring(8,10), 10);

    //                 //get the current date from system
    //                 var today = new Date();
    //                 //date string after broking
    //                 var birthday = new Date(dobYear, dobMonth-1, dobDate);

    //                 //calculate the difference of dates
    //                 var diffInMillisecond = today.valueOf() - birthday.valueOf();

    //                 //convert the difference in milliseconds and store in day and year variable
    //                 var year_age = Math.floor(diffInMillisecond / 31536000000);
    //                 var day_age = Math.floor((diffInMillisecond % 31536000000) / 86400000);

    //                 //when birth date and month is same as today's date
    //                 if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
    //                         alert("Happy Birthday!");
    //                     }

    //                 var month_age = Math.floor(day_age/30);
    //                 day_ageday_age = day_age % 30;

    //                 var tMnt= (month_age + (year_age*12));
    //                 var tDays =(tMnt*30) + day_age;

    //                 //DOB is greater than today's date, generate an error: Invalid date
    //                 if (dob>today) {
    //                     document.getElementById("result").innerHTML = ("Invalid date input - Please try again!");
    //                 }
    //                 else {
    //                     document.getElementById("result").innerHTML = year_age + " years " + month_age + " months "
    //                     // document.getElementById("result").innerHTML = year_age + " years " + month_age + " months " + day_age + " days"
    //                 }
    //             }
    //         }
    //     })
    // });


    // Session of birth Calculation
    $("#disease_date").on('change', function(){
        var sessionBirthCal;
        var sessionBirth = new Date($("#disease_date").val()).getMonth()+1;
        if(sessionBirth==3 || sessionBirth==4 || sessionBirth==5 || sessionBirth==6){
            sessionBirthCal = 'Summer';
        }else if(sessionBirth==7 || sessionBirth==8 || sessionBirth==9 || sessionBirth==10){
            sessionBirthCal = 'Rainy';
        }else{
            sessionBirthCal = 'Winter';
        }
        $('#season_o_birth').val(sessionBirthCal);
    });

     $('#clinical_sing_cust_div').show();
        var diseaseId = $("#disease").val();
        $.ajax({
            url:'{{ route("get.clinicalSign") }}',
            type:"get",
            data: {
                diseaseId: diseaseId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#clinical_sign').html(res.name);
            }
        })


    $('#disease').on('change',function(e) {
        $('#clinical_sing_cust_div').show();
        var diseaseId = $(this).val();
        $.ajax({
            url:'{{ route("get.clinicalSign") }}',
            type:"get",
            data: {
                diseaseId: diseaseId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#clinical_sign').html(res.name);
            }
        })
    });


    $('.clinical_sign').on('click',function() {
        // alert('input')
        // var input = $(this).val();

        // if(input=='ডিগ্রী ফাররনহাইট শারীররক তাপমাত্রা'){
        //     alert('asdf')
        // }
        // $('#clinical_sing_cust_div').show();

    })
</script>


@endpush
@endsection

