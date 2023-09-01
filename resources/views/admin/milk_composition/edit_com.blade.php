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
                            <form action="{{ route('milk-composition.update', $milkComposition->id)}}" method="post">
                                @csrf
                                @isset($milkData->day_count)
                                    @php $day_count = $milkData->day_count+28; @endphp
                                @else
                                    @php $day_count = 14; @endphp
                                @endisset
                                <input type="hidden" name="day_count" value="{{ $day_count }}">
                                {{-- <input type="hidden" name="animal_info_id" value="{{  $animalInfo->id }}"> --}}

                                <div class="row">
                                    {{-- <div class="form-group col-md-3">
                                        <label for="community_cat">Farm Id <span class="t_r">*</span></label>
                                        <select name="community_cat" id="subFarm" class="form-control @error('community_cat') is-invalid @enderror">
                                            <option selected disabled value>Select</option>
                                            @foreach ($communities as $community)
                                            <option value="{{$community->id}}f">{{$community->no}}-{{$community->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('community_cat')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="name">Tag no <span class="t_r">*</span></label>
                                        <select name="animal_info_id" id="animal_info" class="form-control @error('animal_info_id') is-invalid @enderror"></select>
                                        @error('animal_info_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    {{-- @include('admin.animal_tag.female.user') --}}

                                    {{-- @if ($milkCompositions->count() < 1) --}}
                                        <div class="form-group col-md-3">
                                            <label for="calving_date">Milk Calving Date <span class="t_r">*</span></label>
                                            <input name="calving_date" type="date" class="form-control @error('calving_date') is-invalid @enderror" id="calving_date" value="{{$milkComposition->calving_date}}" required>
                                            @error('calving_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    {{-- @endif --}}

                                    {{-- @php
                                            $dateText = '';
                                            $$dateVal = '';
                                    @endphp --}}

                                    {{-- @if ($milkCompositions->count() < 1)
                                        @php
                                            $dateText = '14th Day Date';
                                            $dateVal = \Carbon\Carbon::now()->format('Y-m-d');
                                            // $dateVal = '';
                                        @endphp
                                    @else
                                        @php
                                            $dateText = $milkData->day_count + 28 .'Day Date';
                                            $dateVal =  \Carbon\Carbon::parse($milkData->date)->addDays(28)->format('Y-m-d');
                                        @endphp
                                    @endif --}}


                                    {{-- <div class="form-group col-md-3">
                                        <label for="date">{{$dateText}} <span class="t_r">*</span></label>
                                        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $dateVal }}" required>
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}

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
                                        <label for="water">waterater <span class="t_r">*</span></label>
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
                                        <label for="remark">Remark <span class="t_r">*</span></label>
                                        <input name="remark" type="text" step="any" class="form-control @error('remark') is-invalid @enderror" value="{{$milkComposition->remark}}">
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
    // $('#subFarm').on('change',function(e) {
    //         var community_id = $(this).val()
    //         $.ajax({
    //             url:'{{ route("get.animalF") }}',
    //             type:"get",
    //             data: {
    //                 community_id: community_id
    //                 },
    //             success:function (res) {
    //                 res = $.parseJSON(res);
    //                 $('#animal_info').html(res.name);
    //             }
    //         })
    //     });

        // $('#animal_info').on('change',function(e) {
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
        //             $('#animal_sl').val(res.animal_sl);
        //             $('#birth_wt').val(res.birth_wt);
        //             $('#color').val(res.color);
        //         }
        //     })
        // });
    </script>
@endpush
@endsection

