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
                    <li class="nav-item active">Add Milk Composition</li>
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
                            <form action="{{ route('milk-composition.store')}}" method="post">
                                @csrf
                                @isset($milkData->day_count)
                                    @php $day_count = $milkData->day_count+28; @endphp
                                @else
                                    @php $day_count = 14; @endphp
                                @endisset
                                <input type="hidden" name="day_count" value="{{ $day_count }}">

                                <div class="row">
                                    <div class="form-check">
                                        <label>Milk Type</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="milk_type"
                                                value="ind" id="ind">
                                            <span class="form-radio-sign">Individual</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="milk_type"
                                                value="bulk" id="bulk">
                                            <span class="form-radio-sign">Bulk Milk</span>
                                        </label>
                                    </div>
                                    
                                    @include('admin.animal_tag.group.user_female')

                                    @if ($milkCompositions->count() < 1)
                                        <div class="form-group col-md-3">
                                            <label for="calving_date">Milk Calving Date <span class="t_r">*</span></label>
                                            <input name="calving_date" type="date" class="form-control @error('calving_date') is-invalid @enderror" id="calving_date" value="{{old('calving_date')}}" required>
                                            @error('calving_date')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    @if ($milkCompositions->count() < 1)
                                        @php
                                            $dateText = '14th Day Date';
                                            $dateVal = \Carbon\Carbon::now()->format('Y-m-d');
                                        @endphp
                                    @else
                                        @php
                                            $dateText = $milkData->day_count + 28 .'Day Date';
                                            $dateVal =  \Carbon\Carbon::parse($milkData->date)->addDays(28)->format('Y-m-d');
                                        @endphp
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="date">{{$dateText}} <span class="t_r">*</span></label>
                                        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $dateVal }}" required>
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="production">Milk Production (kg) <span class="t_r">*</span></label>
                                        <input name="production" type="number" step="any" class="form-control @error('production') is-invalid @enderror" value="{{old('production')}}" required>
                                        @error('production')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="fat">Milk Fat (%) <span class="t_r">*</span></label>
                                        <input name="fat" type="number" step="any" class="form-control @error('fat') is-invalid @enderror" value="{{old('fat')}}" required>
                                        @error('fat')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="density">Density <span class="t_r">*</span></label>
                                        <input name="density" type="number" step="any" class="form-control @error('density') is-invalid @enderror" value="{{old('density')}}" required>
                                        @error('density')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="lactose">Lactose <span class="t_r">*</span></label>
                                        <input name="lactose" type="number" step="any" class="form-control @error('lactose') is-invalid @enderror" value="{{old('lactose')}}" required>
                                        @error('lactose')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="snf">SNF <span class="t_r">*</span></label>
                                        <input name="snf" type="number" step="any" class="form-control @error('snf') is-invalid @enderror" value="{{old('snf')}}" required>
                                        @error('snf')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="protein">Milk Protein (%)<span class="t_r">*</span></label>
                                        <input name="protein" type="number" step="any" class="form-control @error('protein') is-invalid @enderror" value="{{old('protein')}}" required>
                                        @error('protein')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="water">waterater <span class="t_r">*</span></label>
                                        <input name="water" type="number" step="any" class="form-control @error('water') is-invalid @enderror" value="{{old('water')}}" required>
                                        @error('water')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="temperature">Temperature<span class="t_r">*</span></label>
                                        <input name="temperature" type="number" step="any" class="form-control @error('temperature') is-invalid @enderror" value="{{old('temperature')}}" required>
                                        @error('temperature')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="freezing_point">Freezing Point <span class="t_r">*</span></label>
                                        <input name="freezing_point" type="number" step="any" class="form-control @error('freezing_point') is-invalid @enderror" value="{{old('freezing_point')}}" required>
                                        @error('freezing_point')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="salt">Salt <span class="t_r">*</span></label>
                                        <input name="salt" type="number" step="any" class="form-control @error('salt') is-invalid @enderror" value="{{old('salt')}}" required>
                                        @error('salt')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="remark">Remark <span class="t_r">*</span></label>
                                        <input name="remark" type="text" step="any" class="form-control @error('remark') is-invalid @enderror" value="{{old('remark')}}">
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
        // $(document).ready(function(){
            
        //     if($(input[name='milk_type']).val() == 'ind'){
        //         $('.singleInput').empty().trigger('change')
        //     }else{
        //         $('.singleInput').empty().trigger('change')
        //     }
        // });
    </script>

@endpush
@endsection

