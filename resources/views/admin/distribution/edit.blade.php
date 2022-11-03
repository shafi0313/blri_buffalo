@extends('admin.layout.master')
@section('title', 'Distribution')
@section('content')
@php $p='animalRecord'; $sm="distribution"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('distribution.index')}}">Distribution</a></li>
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
                            <form action="{{ route('distribution.update', $data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="dis_type">Distribution Type <span class="t_r">*</span></label>
                                        <select name="dis_type" class="form-control @error('dis_type') is-invalid @enderror" id="dis_type">
                                            <option>Select</option>
                                            <option value="Semen" {{$data->dis_type=="Semen"?'selected':''}}>Semen</option>
                                            <option value="Buffalo Bull" {{$data->dis_type=="Buffalo Bull"?'selected':''}}>Buffalo Bull</option>
                                        </select>
                                        @error('dis_type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dis_to">Distribution To <span class="t_r">*</span></label>
                                        <select name="dis_to" class="form-control @error('dis_to') is-invalid @enderror">
                                            <option>Select</option>
                                            <option value="Govt Organization" {{$data->dis_to=="Govt Organization"?'selected':''}}>Govt Organization</option>
                                            <option value="Non Govt Organization" {{$data->dis_to=="Non Govt Organization"?'selected':''}}>Non Govt Organization</option>
                                        </select>
                                        @error('dis_to')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="org_name">Organization name  <span class="t_r">*</span></label>
                                        <input name="org_name" type="text" class="form-control @error('org_name') is-invalid @enderror" value="{{$data->org_name}}" required>
                                        @error('org_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="dis_date">Date <span class="t_r">*</span></label>
                                        <input name="dis_date" type="date" class="form-control @error('dis_date') is-invalid @enderror" value="{{$data->dis_date}}" required>
                                        @error('dis_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3" style="display:none" id="straw_div">
                                        <label for="straw">No of straw <span class="t_r">*</span></label>
                                        <input name="straw" type="text" class="form-control @error('straw') is-invalid @enderror" value="{{$data->straw}}" id="straw" >
                                        @error('straw')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @php $animalExtraInfo=0 @endphp
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.edit_admin')
                                    @else
                                    @include('admin.animal_tag.edit_user')
                                    @endif
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
    // $("#dis_type").on('change', function() {
        var disType = $("#dis_type").val();
        if(disType=='Semen'){
            $("#straw_div").show();
            $("#straw_div").attr('required', true);
        }else{
            $("#straw_div").hide();
            $("#straw_div").attr('required', false);
        }
    // });
</script>

@endpush
@endsection

