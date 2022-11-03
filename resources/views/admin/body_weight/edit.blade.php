@extends('admin.layout.master')
@section('title', 'Body Weight')
@section('content')
@php $p='animalRecord'; $sm="production"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-info.index')}}">Body Weight</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Body Weight</li>
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
                            <form action="{{ route('body-weight.update',$data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <div class="row">
                                    @php $animalExtraInfo=0 @endphp
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.edit_admin')
                                    @else
                                    @include('admin.animal_tag.edit_user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="date_d_0">Date at 0 day</label>
                                        <input type="date" class="form-control @error('date_d_0') is-invalid @enderror" name="date_d_0" id="date_d_0" value="{{ $data->date_d_0 }}">
                                        @error('date_d_0')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="day_0">0 day body wt. (kg)</label>
                                        <input type="number" class="form-control @error('day_0') is-invalid @enderror" name="day_0" id="day_0" value="{{ $data->day_0 }}">
                                        @error('day_0')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date_d_15">Date at 15 days</label>
                                        <input type="date" class="form-control @error('date_d_15') is-invalid @enderror" name="date_d_15" id="date_d_15" readonly>
                                        @error('date_d_15')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="day_15">15 days body wt. (kg)</label>
                                        <input type="number" class="form-control @error('day_15') is-invalid @enderror" name="day_15" id="day_15" value="{{ $data->day_15 }}">
                                        @error('day_15')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_1">Date at 1 month</label>
                                        <input type="date" class="form-control @error('date_m_1') is-invalid @enderror" name="date_m_1" id="date_m_1" readonly>
                                        @error('date_m_1')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_1">1 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_1') is-invalid @enderror" name="month_1" id="month_1" value="{{ $data->month_1 }}">
                                        @error('month_1')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_2">Date at 2 months</label>
                                        <input type="date" class="form-control @error('date_m_2') is-invalid @enderror" name="date_m_2" id="date_m_2" readonly>
                                        @error('date_m_2')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_2">2 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_2') is-invalid @enderror" name="month_2" id="month_2" value="{{ $data->month_2 }}">
                                        @error('month_2')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="date_m_3">Date at 3 months</label>
                                        <input type="date" class="form-control @error('date_m_3') is-invalid @enderror" name="date_m_3" id="date_m_3" readonly>
                                        @error('date_m_3')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_3">3 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_3') is-invalid @enderror" name="month_3" id="month_3" value="{{ $data->month_3 }}">
                                        @error('month_3')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_6">Date at 6 months</label>
                                        <input type="date" class="form-control @error('date_m_6') is-invalid @enderror" name="date_m_6" id="date_m_6" readonly>
                                        @error('date_m_6')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_6">6 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_6') is-invalid @enderror" name="month_6" id="month_6" value="{{ $data->month_6 }}">
                                        @error('month_6')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_12">Date at 12 months</label>
                                        <input type="date" class="form-control @error('date_m_12') is-invalid @enderror" name="date_m_12" id="date_m_12" readonly>
                                        @error('date_m_3')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_12">12 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_12') is-invalid @enderror" name="month_12" id="month_12" value="{{ $data->month_12 }}">
                                        @error('month_12')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_18">Date at 18 months</label>
                                        <input type="date" class="form-control @error('date_m_18') is-invalid @enderror" name="date_m_18" id="date_m_18" readonly>
                                        @error('date_m_18')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_18">18 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_18') is-invalid @enderror" name="month_18" id="month_18" value="{{ $data->month_18 }}">
                                        @error('month_18')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="date_m_24">Date at 24 months</label>
                                        <input type="date" class="form-control @error('date_m_24') is-invalid @enderror" name="date_m_24" id="date_m_24" readonly>
                                        @error('date_m_24')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_24">24 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_24') is-invalid @enderror" name="month_24" id="month_24" value="{{ $data->month_24 }}">
                                        @error('month_24')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="date_m_30">Date at 30 months</label>
                                        <input type="date" class="form-control @error('date_m_30') is-invalid @enderror" name="date_m_30" id="date_m_30" readonly>
                                        @error('date_m_30')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_30">30 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_30') is-invalid @enderror" name="month_30" id="month_30" value="{{ $data->month_30 }}">
                                        @error('month_30')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="date_m_36">Date at 36 months</label>
                                        <input type="date" class="form-control @error('date_m_36') is-invalid @enderror" name="date_m_36" id="date_m_36" readonly>
                                        @error('date_m_36')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_36">36 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_36') is-invalid @enderror" name="month_36" id="month_36" value="{{ $data->month_36 }}">
                                        @error('month_36')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="date_m_42">Date at 42 months</label>
                                        <input type="date" class="form-control @error('date_m_42') is-invalid @enderror" name="date_m_42" id="date_m_42" readonly>
                                        @error('date_m_42')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_42">42 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_42') is-invalid @enderror" name="month_42" id="month_42" value="{{ $data->month_42 }}">
                                        @error('month_42')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date_m_48">Date at 48 months</label>
                                        <input type="date" class="form-control @error('date_m_48') is-invalid @enderror" name="date_m_48" id="date_m_48" readonly>
                                        @error('date_m_48')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="month_48">48 months body wt. (kg)</label>
                                        <input type="number" class="form-control @error('month_48') is-invalid @enderror" name="month_48" id="month_48" value="{{ $data->month_48 }}">
                                        @error('month_48')
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
            }
        })
    });
</script> --}}


<script>
    var date_d_0 = $("#date_d_0").val();
    var date = new Date(date_d_0);
    var date_d_15 = moment(date, "YYYY-MM-DD").add(15, 'days').format('YYYY-MM-DD');
    $('#date_d_15').val(date_d_15);
    var date_m_1 = moment(date, "YYYY-MM-DD").add(1, 'months').format('YYYY-MM-DD');
    $('#date_m_1').val(date_m_1);
    var date_m_2 = moment(date, "YYYY-MM-DD").add(2, 'months').format('YYYY-MM-DD');
    $('#date_m_2').val(date_m_2);

    var date_m_3 = moment(date, "YYYY-MM-DD").add(3, 'months').format('YYYY-MM-DD');
    $('#date_m_3').val(date_m_3);

    var date_m_6 = moment(date, "YYYY-MM-DD").add(6, 'months').format('YYYY-MM-DD');
    $('#date_m_6').val(date_m_6);

    var date_m_12 = moment(date, "YYYY-MM-DD").add(12, 'months').format('YYYY-MM-DD');
    $('#date_m_12').val(date_m_12);

    var date_m_18 = moment(date, "YYYY-MM-DD").add(18, 'months').format('YYYY-MM-DD');
    $('#date_m_18').val(date_m_18);

    var date_m_24 = moment(date, "YYYY-MM-DD").add(24, 'months').format('YYYY-MM-DD');
    $('#date_m_24').val(date_m_24);

    var date_m_30 = moment(date, "YYYY-MM-DD").add(30, 'months').format('YYYY-MM-DD');
    $('#date_m_30').val(date_m_30);

    var date_m_36 = moment(date, "YYYY-MM-DD").add(36, 'months').format('YYYY-MM-DD');
    $('#date_m_36').val(date_m_36);

    var date_m_42 = moment(date, "YYYY-MM-DD").add(42, 'months').format('YYYY-MM-DD');
    $('#date_m_42').val(date_m_42);

    var date_m_48 = moment(date, "YYYY-MM-DD").add(48, 'months').format('YYYY-MM-DD');
    $('#date_m_48').val(date_m_48);

    // $('#animal_info').on('change',function(e) {
    //     var animalInfoId = $(this).val();
    //     $.ajax({
    //         url:'{{ route("get.bodyWeight") }}',
    //         type:"get",
    //         data: {
    //             animalInfoId: animalInfoId
    //             },
    //         success:function (res) {
    //             res = $.parseJSON(res);
    //             $('#day_0').val(res.day_0);
    //             $('#date_d_0').val(res.date_d_0);
    //             $('#day_15').val(res.day_15);
    //             $('#month_1').val(res.month_1);
    //             $('#month_2').val(res.month_2);
    //             $('#month_2').val(res.month_2);
    //             $('#month_3').val(res.month_3);
    //             $('#month_4').val(res.month_4);
    //             $('#month_5').val(res.month_5);
    //             $('#month_6').val(res.month_6);
    //             $('#month_7').val(res.month_7);
    //             $('#month_8').val(res.month_8);
    //             $('#month_9').val(res.month_9);
    //             $('#month_10').val(res.month_10);
    //             $('#month_11').val(res.month_11);
    //             $('#month_12').val(res.month_12);

    //             var date = new Date(res.date_d_0);
    //             var date_d_15 = moment(date, "YYYY-MM-DD").add(15, 'days').format('YYYY-MM-DD');
    //             $('#date_d_15').val(date_d_15);
    //             var date_m_1 = moment(date, "YYYY-MM-DD").add(1, 'months').format('YYYY-MM-DD');
    //             $('#date_m_1').val(date_m_1);
    //             var date_m_2 = moment(date, "YYYY-MM-DD").add(2, 'months').format('YYYY-MM-DD');
    //             $('#date_m_2').val(date_m_2);

    //             var date_m_3 = moment(date, "YYYY-MM-DD").add(3, 'months').format('YYYY-MM-DD');
    //             $('#date_m_3').val(date_m_3);

    //             var date_m_6 = moment(date, "YYYY-MM-DD").add(6, 'months').format('YYYY-MM-DD');
    //             $('#date_m_6').val(date_m_6);

    //             var date_m_12 = moment(date, "YYYY-MM-DD").add(12, 'months').format('YYYY-MM-DD');
    //             $('#date_m_12').val(date_m_12);

    //             var date_m_18 = moment(date, "YYYY-MM-DD").add(18, 'months').format('YYYY-MM-DD');
    //             $('#date_m_18').val(date_m_18);

    //             var date_m_24 = moment(date, "YYYY-MM-DD").add(24, 'months').format('YYYY-MM-DD');
    //             $('#date_m_24').val(date_m_24);

    //             var date_m_30 = moment(date, "YYYY-MM-DD").add(30, 'months').format('YYYY-MM-DD');
    //             $('#date_m_30').val(date_m_30);

    //             var date_m_36 = moment(date, "YYYY-MM-DD").add(36, 'months').format('YYYY-MM-DD');
    //             $('#date_m_36').val(date_m_36);

    //             var date_m_42 = moment(date, "YYYY-MM-DD").add(42, 'months').format('YYYY-MM-DD');
    //             $('#date_m_42').val(date_m_42);

    //             var date_m_48 = moment(date, "YYYY-MM-DD").add(48, 'months').format('YYYY-MM-DD');
    //             $('#date_m_48').val(date_m_48);
    //         }
    //     })
    // });
</script>
@endpush
@endsection

