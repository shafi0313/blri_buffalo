@extends('admin.layout.master')
@section('title', 'Farm')
@section('content')
@php $p='farmSett'; $sm='comm'; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Farm</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Farm</h4>
                                <a href="{{route('community.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th style="width: 35px">SL</th>
                                            <th>Farm/Community Name</th>
                                            <th>Farm Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th class="no-sort" style="text-align:center;width:80px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($communitys as $community)
                                        <tr>
                                            <td class="text-center">{{ $x++ }} </td>
                                            <td>{{ $community->communityCat->name ?? $community->farm->name }} </td>
                                            <td>{{ $community->name }} </td>
                                            <td>{{ $community->contact_person }} </td>
                                            <td>{{ $community->phone }} </td>
                                            <td>{{ $community->address }} </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    {{-- <a href="{{ route('community.edit', $community->id) }}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a> --}}
                                                    <form action="{{ route('community.destroy', $community->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>


@push('custom_scripts') @include('admin.include.data_table')

@endpush

@endsection

