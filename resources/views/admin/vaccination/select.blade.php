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
                    <li class="nav-item active">Select Date</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Select Date </h4>
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
                            <div class="row justify-content-center">
                                <div class="form-check">
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
                            </div>
                            <div class="row justify-content-center ind" style="display: none">
                                <div class="form-group col-md-5">
                                    <label for="name">Tag no <span class="t_r">*</span></label>
                                    <select name="animal_info_id" id="animalInfo" class="form-control @error('animal_info_id') is-invalid @enderror" onchange="location = this.value">
                                        <option value="">Select</option>
                                        @foreach ($animalInfos as $animalInfo)
                                        <option value="{{route('milkComposition.create', $animalInfo->id)}}" >{{$animalInfo->animal_tag}}</option>
                                        @endforeach
                                    </select>
                                    @error('animal_info_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center bulk" style="display: none">
                                <div class="form-group col-md-5">
                                    <label for="name">Farm Id <span class="t_r">*</span></label>
                                    <select name="farm_id" id="farm_id" class="form-control @error('farm_id') is-invalid @enderror" onchange="location = this.value">
                                        <option value="">Select</option>
                                        @foreach ($farms as $farm)
                                        <option value="{{route('milkComposition.create', $farm->id)}}" >{{$farm->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('farm_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                $('#milkCount').val(res.milkCount);

                // if(res.calving_date == NULL){
                //     alert('Calving date')
                //     $('#calving_date').attr('readonly',true);
                // }
            }
        })
    });

    $("#ind").on("click", function(){
        $(".ind").show();
        $(".bulk").hide();
    })
    $("#bulk").on("click", function(){
        $(".ind").hide();
        $(".bulk").show();
    })
</script>
@endpush
@endsection

