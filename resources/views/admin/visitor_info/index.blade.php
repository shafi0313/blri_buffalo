@extends('admin.layout.master')
@section('title', 'Visitor Info')
@section('content')
<?php $p = 'visitor'; ?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Visitor Info</a>
                    </li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Visitor Info</h4>
                            {{-- <a class="btn btn-primary btn-round ml-auto" href="{{ route('doctor.create') }}">
                                    <i class="fa fa-plus"></i>
                                    Add New
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>IP</th>
                                            <th>Country Name</th>
                                            <th>Region Name</th>
                                            <th>City Name</th>
                                            <th>Zip Code</th>
                                            <th>Latitude</th>
                                            <th>Longtitude </th>
                                            <th>currency</th>
                                            <th style="display:none;">SL</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>SN</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($visitors as $key=>$visitor)

                                        <tr>
                                            <td>{{$key+1}} </td>
                                            <td>{{$visitor->ip}} </td>
                                            <td>
                                                <span><i class="{{strtolower($visitor->country)}} flag"></i></span>
                                                {{$visitor->country}}
                                            </td>
                                            <td>{{$visitor->state_name}} </td>
                                            <td>{{$visitor->city}} </td>
                                            <td>{{$visitor->postal_code}} </td>
                                            <td>{{$visitor->lat}} </td>
                                            <td>{{$visitor->lon}} </td>
                                            <td>{{$visitor->currency}} </td>
                                            <td style="display:none;"></td>
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
</div>

@push('custom_scripts')

<script >
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });

        $('#multi-filter-select').DataTable( {
            "lengthMenu": [[50, 100, -1], [50, 100, "All"]],
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control form-control-sm"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                            );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 5,
        });
    });
</script>
<script>
    $('.delete').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
@endpush
@endsection

