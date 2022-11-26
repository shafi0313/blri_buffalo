@extends('admin.layout.master')
@section('title', 'Deworming')
@section('content')
@php $p='healthM'; $sm="deworming"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Deworming</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Edit Deworming</li>
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
                            <form action="{{ route('deworming.update', $deworming->id)}}" method="post">
                                @csrf @method('PUT')
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    {{-- <div class="form-check col-md-3">
                                        <label>Deworming Type <span class="t_r">*</span></label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="dew_type" value="single" id="single" required>
                                            <span class="form-radio-sign">Single</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="dew_type" value="group" id="group" required>
                                            <span class="form-radio-sign">Group</span>
                                        </label>
                                    </div>

                                    @php $animalExtraInfo=1 @endphp
                                    @if(Auth::user()->permission == 1)
                                        @include('admin.animal_tag.group.admin')
                                    @else
                                        @include('admin.animal_tag.group.user')
                                    @endif --}}

                                    <div class="form-group col-md-3">
                                        <label for="medicine_name">Name of Medicine <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" name="medicine_name" value="{{$deworming->medicine_name}}">
                                        @error('medicine_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="deworming_date">Date of Deworming</label>
                                        <input type="date" class="form-control @error('deworming_date') is-invalid @enderror" name="deworming_date" value="{{$deworming->deworming_date}}">
                                        @error('deworming_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dose">Dose <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('dose') is-invalid @enderror" name="dose" value="{{$deworming->dose}}">
                                        @error('dose')
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
            url:'{{ route("get.getAnimalInfo") }}',
            type:"get",
            data: {
                animalInfoId: animalInfoId
                },
            success:function (res) {
                res = $.parseJSON(res);
                $('#sex').val(res.sex);
                $('#d_o_b').val(res.d_o_b);
                $('#breed').val(res.breed);

                var userinput = res.d_o_b;
                var dob = new Date(userinput);

                // var dob = new Date(userinput);

                //check user provide input or not
                if(userinput==null || userinput==''){
                document.getElementById("message").innerHTML = "**Choose a date please!";
                return false;
                }

                //execute if user entered a date
                else {
                    //extract and collect only date from date-time string
                    var mdate = userinput.toString();
                    var dobYear = parseInt(mdate.substring(0,4), 10);
                    var dobMonth = parseInt(mdate.substring(5,7), 10);
                    var dobDate = parseInt(mdate.substring(8,10), 10);

                    //get the current date from system
                    var today = new Date();
                    //date string after broking
                    var birthday = new Date(dobYear, dobMonth-1, dobDate);

                    //calculate the difference of dates
                    var diffInMillisecond = today.valueOf() - birthday.valueOf();

                    //convert the difference in milliseconds and store in day and year variable
                    var year_age = Math.floor(diffInMillisecond / 31536000000);
                    var day_age = Math.floor((diffInMillisecond % 31536000000) / 86400000);

                    //when birth date and month is same as today's date
                    if ((today.getMonth() == birthday.getMonth()) && (today.getDate() == birthday.getDate())) {
                            alert("Happy Birthday!");
                        }

                    var month_age = Math.floor(day_age/30);
                    day_ageday_age = day_age % 30;

                    var tMnt= (month_age + (year_age*12));
                    var tDays =(tMnt*30) + day_age;

                    //DOB is greater than today's date, generate an error: Invalid date
                    if (dob>today) {
                        document.getElementById("result").innerHTML = ("Invalid date input - Please try again!");
                    }
                    else {
                        document.getElementById("result").innerHTML = year_age + " years " + month_age + " months "
                        // document.getElementById("result").innerHTML = year_age + " years " + month_age + " months " + day_age + " days"
                    }
                }
            }
        })
    });
</script>
@endpush
@endsection

