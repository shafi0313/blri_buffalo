@extends('admin.layout.master')
@section('title', 'Disease and Health Record')
@section('content')
@php $p='animalForm'; $sm="DHRec"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Disease and Health Record</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Disease and Health Record</h4>
                                <a href="{{route('disease-and-health.create')}}" class="btn btn-primary btn-round ml-auto text-light"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr class="text-center">
                                            <th style="width: 35px">SL</th>
                                            <th>Amimal Tag</th>
                                            <th>Breed</th>
                                            <th>Sex</th>
                                            <th>Name of Disease</th>
                                            <th>Clinical Sign</th>
                                            <th>Season of Disease</th>
                                            <th>Date of Deworming</th>
                                            <th>Date of Dipping</th>
                                            <th>Date of PPR Vaccination</th>
                                            <th>Date of FMD Vaccination</th>
                                            <th>Date of Goat Pox Vaccination</th>
                                            <th>Date of Contagious Ecthyma Vaccination</th>
                                            <th>Recovered/Dead</th>
                                            <th class="no-sort" style="text-align:center;width:80px">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($diseaseHealths as $diseaseHealth)
                                        <tr class="text-center">
                                            <td>{{ $x++ }} </td>
                                            <td>{{ $diseaseHealth->animalInfo->animal_tag }} </td>
                                            <td>{{ $diseaseHealth->animalInfo->sex }} </td>
                                            <td>{{ $diseaseHealth->animalInfo->birth_wt }} </td>
                                            <td>{{ $diseaseHealth->disease_name }} </td>
                                            <td>{{ $diseaseHealth->clinical_sign }} </td>
                                            <td>{{ $diseaseHealth->disease_season }} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->deworming_date)->format('d/m/Y')}} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->dipping_date)->format('d/m/Y')}} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->ppr_vac_date)->format('d/m/Y')}} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->fmd_vac_date)->format('d/m/Y')}} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->pox_vacn_date)->format('d/m/Y')}} </td>
                                            <td>{{ \Carbon\Carbon::parse($diseaseHealth->contagious_vac_date)->format('d/m/Y')}} </td>
                                            <td>{{ $diseaseHealth->report }}</td>
                                            {{-- <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('production.createId', $productionRecord->id) }}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit">Input</i>
                                                    </a>
                                                    <form action="{{ route('farm.destroy', $productionRecord->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td> --}}
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
        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
    });
</script>
@endpush

@endsection

