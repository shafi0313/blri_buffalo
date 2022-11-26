@extends('admin.layout.master')
@section('title', 'Vaccination')
@section('content')
    @php
        $p = 'healthM';
        $sm = 'vaccination';
    @endphp
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a>
                        </li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item active">Vaccination</li>
                    </ul>
                </div>
                <div class="divider1"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Vaccination</h4>
                                    <a href="{{ route('vaccination.create') }}"
                                        class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add
                                        New</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="multi-filter-select" class="display table table-striped table-hover">
                                        <thead class="bg-secondary thw">
                                            <tr class="text-center">
                                                <th style="width: 35px">SL</th>
                                                <th>Tag No</th>
                                                <th>Sex</th>
                                                <th>Name of Vaccine</th>
                                                <th>Date of Vaccination</th>
                                                <th>Dose</th>
                                                <th class="no-sort" style="text-align:center;width:80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $x=1; @endphp
                                            @foreach ($vaccinations as $vaccination)
                                                <tr class="text-center">
                                                    <td>{{ $x++ }} </td>
                                                    <td>{{ $vaccination->animalInfo->animal_tag }} </td>
                                                    <td>{{ $vaccination->animalInfo->sex }} </td>
                                                    <td>{{ $vaccination->vaccine_name }} </td>
                                                    <td>{{ $vaccination->vaccine_date }} </td>
                                                    <td>{{ $vaccination->dose }} </td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('vaccination.edit', $vaccination->id) }}"
                                                                title="Edit" class="btn btn-link btn-primary btn-lg">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('vaccination.destroy', $vaccination->id) }}"
                                                                method="POST">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" title="Delete"
                                                                    class="btn btn-link btn-danger"
                                                                    onclick="return confirm('Are you sure?')">
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

    @push('custom_scripts')
        @include('admin.include.data_table')
    @endpush

@endsection
