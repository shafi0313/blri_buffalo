@extends('admin.layout.master')
@section('title', 'Milk Composition')
@section('content')
    @php
        $p = 'animalRecord';
        $sm = 'milkComposition';
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
                        <li class="nav-item active">Milk Composition</li>
                    </ul>
                </div>
                <div class="divider1"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Milk Composition</h4>
                                    <a href="{{ route('milk-composition.create') }}"
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
                                                <th>Area</th>
                                                <th>Tag no</th>
                                                <th>Tattoo no</th>
                                                <th>Calving Date</th>
                                                <th>Milking Date</th>
                                                <th>Milk Production</th>
                                                <th>Milk Fat(%)</th>
                                                <th>Density</th>
                                                <th>Lactose</th>
                                                <th>SNF</th>
                                                <th>Protein(%)</th>
                                                <th>Water</th>
                                                <th>Salt</th>
                                                <th class="no-sort" style="text-align:center;width:80px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $x=1; @endphp
                                            @foreach ($milkCompositions as $milkComposition)
                                                <tr class="text-center">
                                                    <td>{{ $x++ }} </td>
                                                    <td>{{ $milkComposition->farm ? $milkComposition->farm->name : $milkComposition->communityCat->name }}
                                                    </td>
                                                    <td>{{ $milkComposition->animalInfo->animal_tag }} </td>
                                                    <td>{{ $milkComposition->animalInfo->tattoo_no }} </td>
                                                    <td>{{ \Carbon\Carbon::parse($milkComposition->calving_date)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($milkComposition->date)->format('d/m/Y') }}
                                                    </td>
                                                    <td>{{ $milkComposition->production }} </td>
                                                    <td>{{ $milkComposition->fat }}</td>
                                                    <td>{{ $milkComposition->density }}</td>
                                                    <td>{{ $milkComposition->lactose }}</td>
                                                    <td>{{ $milkComposition->snf }}</td>
                                                    <td>{{ $milkComposition->protein }}</td>
                                                    <td>{{ $milkComposition->water }}</td>
                                                    <td>{{ $milkComposition->salt }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a href="{{ route('milk-composition.edit', $milkComposition->id) }}"
                                                                title="Edit" class="btn btn-link btn-primary btn-lg">
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('milk-composition.destroy', $milkComposition->id) }}"
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
