@extends('admin.layout.master')
@section('title', 'Parasite')
@section('content')
@php $p='healthM'; $sm="parasite"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('parasite.index')}}">Parasite</a></li>
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
                            <form action="{{ route('parasite.update', $data->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="get_farm_id" value="{{ $data->farm_id }}">
                                <input type="hidden" id="get_community_cat_id" value="{{ $data->community_cat_id }}">
                                <input type="hidden" id="get_community_id" value="{{ $data->community_id }}">
                                <input type="hidden" id="animal_info_id" value="{{ $data->animal_info_id }}">
                                <input type="hidden" name="type" id="type">
                                <div class="row">
                                    @if (auth()->user()->permission == 1)
                                    @include('admin.animal_tag.edit_admin')
                                    @else
                                    @include('admin.animal_tag.edit_user')
                                    @endif

                                    <div class="form-group col-md-3">
                                        <label for="feces_collection_date">Date of Feces collection <span class="t_r">*</span></label>
                                        <input name="feces_collection_date" type="date" class="form-control @error('feces_collection_date') is-invalid @enderror" value="{{ $data->feces_collection_date}}" required>
                                        @error('feces_collection_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="fecal_egg_count">Fecal egg count (FEC) <span class="t_r">*</span></label>
                                        <input name="fecal_egg_count" type="text" class="form-control @error('fecal_egg_count') is-invalid @enderror" value="{{$data->fecal_egg_count}}" required>
                                        @error('fecal_egg_count')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="season">Season <span class="t_r">*</span></label>
                                        <input name="season" type="text" class="form-control @error('season') is-invalid @enderror" value="{{$data->season}}" required>
                                        @error('season')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="parasite_name">Parasite name <span class="t_r">*</span></label>
                                        <input name="parasite_name" type="text" class="form-control @error('parasite_name') is-invalid @enderror" value="{{$data->parasite_name}}" required>
                                        @error('parasite_name')
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




</script>
@endpush
@endsection

