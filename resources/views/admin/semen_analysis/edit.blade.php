@extends('admin.layout.master')
@section('title', 'Semen Analysis')
@section('content')
@php $p='animalRecord'; $sm="semenAnalysis"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('semen-analysis.index')}}">Semen Analysis</a></li>
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
                            <form action="{{ route('semen-analysis.update', $data->id)}}" method="post">
                                @csrf

                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @php $animalExtraInfo=0 @endphp
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.edit_admin')
                                    @else
                                    @include('admin.animal_tag.edit_user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="semen_type">Semen Type <span class="t_r">*</span></label>
                                        <select name="semen_type" id="animalInfo" class="form-control @error('semen_type') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="Fresh" {{ $data->semen_type=="Fresh"?'selected':''}}>Fresh</option>
                                            <option value="Frozen" {{ $data->semen_type=="Frozen"?'selected':''}}>Frozen</option>

                                        </select>
                                        @error('semen_type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="semen_color">Semen Color <span class="t_r">*</span></label>
                                        <select name="semen_color" id="animalInfo" class="form-control @error('semen_color') is-invalid @enderror">
                                            <option value="">Select</option>
                                            <option value="White" {{ $data->semen_color=="White"?'selected':''}}>White</option>
                                            <option value="Creamy" {{ $data->semen_color=="Creamy"?'selected':''}}>Creamy</option>
                                            <option value="Cloudy" {{ $data->semen_color=="Cloudy"?'selected':''}}>Cloudy</option>
                                        </select>
                                        @error('semen_color')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="volume">Semen Volume (ml) <span class="t_r">*</span></label>
                                        <input name="volume" type="text" step="any" class="form-control @error('volume') is-invalid @enderror" value="{{ $data->volume }}" oninput="this.value = this.value.replace(/[a-zA-z\-*/]/g,'');" required>
                                        @error('volume')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="date">Date <span class="t_r">*</span></label>
                                        <input name="date" type="date" class="form-control @error('date') is-invalid @enderror" value="{{ $data->date }}" required>
                                        @error('date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="straw_prepared">No. of Straw Prepared <span class="t_r">*</span></label>
                                        <input name="straw_prepared" type="text" class="form-control @error('straw_prepared') is-invalid @enderror on_input" value="{{ $data->straw_prepared }}" oninput="this.value = this.value.replace(/[a-zA-z\-*/]/g,'');" required>
                                        @error('straw_prepared')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="total_mortality">Total Motility % <span class="t_r">*</span></label>
                                        <input name="total_mortality" type="text" class="form-control @error('total_mortality') is-invalid @enderror on_input" value="{{ $data->total_mortality }}" required>
                                        @error('total_mortality')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="progressive_mortality">Progressive Motility % <span class="t_r">*</span></label>
                                        <input name="progressive_mortality" type="text" class="form-control @error('progressive_mortality') is-invalid @enderror on_input" value="{{$data->progressive_mortality}}" required>
                                        @error('progressive_mortality')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="sperm_concentration">Sperm concentration m/ml<span class="t_r">*</span></label>
                                        <input name="sperm_concentration" type="text" class="form-control @error('sperm_concentration') is-invalid @enderror on_input" value="{{ $data->sperm_concentration }}" required>
                                        @error('sperm_concentration')
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
                $('#color').val(res.color);
                $('#birth_wt').val(res.birth_wt);
                $('#type').val(res.type);
                $('#paity').val(res.paity);
                $('#litter_size').val(res.litter_size);
            }
        })
    });
</script>

@endpush
@endsection

