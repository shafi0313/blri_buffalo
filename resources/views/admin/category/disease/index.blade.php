@extends('admin.layout.master')
@section('title', 'Clinical Sign Category')
@section('content')
@php $p = 'farmSett'; $sm='diseaseClinicalSign'; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Disease & Clinical Sign Category</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Disease & Clinical Sign</h4>
                                <button type="button" class="btn btn-primary btn-round ml-auto text-light" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th style="width: 35px">SL</th>
                                            <th>Name</th>
                                            <th style="display: none"></th>
                                            <th class="no-sort" style="text-align:center;width:150px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($diseases as $disease)
                                        <tr>
                                            <td class="text-center bg-primary text-light">{{ $x++ }} </td>

                                            <td class="bg-primary text-light">{{ $disease->name }} </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <span class="btn btn-link btn-success btn-lg addSub" data-toggle="modal" data-target="#add-sub" data-id="{{$disease->id}}" data-name="{{$disease->name}}"><i class="fas fa-plus"></i></span>
                                                   <span class="btn btn-link btn-primary edit" data-toggle="modal" data-target="#editModal" data-url="{{route('disease.update', $disease->id)}}" data-id="{{$disease->id}}" data-name="{{$disease->name}}"><i class="fa fa-edit"></i></span>
                                                    <form action="{{ route('disease.destroy', $disease->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            @if ($disease->clinicalSigns->count() > 0)
                                                @foreach ($disease->clinicalSigns as $clinicalSign)
                                                <tr>
                                                    <td></td>
                                                    <td><i class="fa-regular fa-hand-point-right"></i>&nbsp;&nbsp; {{ $clinicalSign->name }}</td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <span class="btn btn-link btn-success btn-lg addSubEdit" data-toggle="modal" data-url="{{route('admin.clinicalSign.subCatUpdate', $clinicalSign->id)}}" data-target="#add-sub-edit" data-id="{{$clinicalSign->id}}" data-name="{{$clinicalSign->name}}"><i class="fas fa-edit"></i></span>
                                                           <a href="{{ route('admin.clinicalSign.destroyClinicalSign', $clinicalSign->id)}}"title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
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


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Disease</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('disease.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name <span class="t_r">*</span></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="editModal">Edit Disease</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form method="post" id="editForm">
                <div class="modal-body">
                    @csrf @method('put')
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  id="edit-name" required>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
      </div>
  </div>

  <!-- Add Sub Cat Modal -->
<div class="modal fade" id="add-sub" tabindex="-1" role="dialog" aria-labelledby="add-subLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('admin.clinicalSign.subCatStore')}}" method="post">
            @csrf
            <input type="hidden" id="addId" name="disease_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-subLabel" style="color:red;">Add New Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Main Category Name</label>
                            <input type="text" id="addName" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Sub Category Name <span class="t_r">*</span></label>
                            <input name="name" type="text" class="form-control">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Sub Cat edit Modal -->
<div class="modal fade" id="add-sub-edit" tabindex="-1" role="dialog" aria-labelledby="add-sub-editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" id="subEditForm">
            @csrf
            {{-- @method('put') --}}
            <input type="hidden" id="subEditId" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-sub-editLabel" style="color:red;">Sub Category Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Sub Category Name <span class="t_r">*</span></label>
                            {{-- <input name="name" type="text" class="form-control" id="subEditParentName"> --}}
                            <select name="parent_id" id="" class="form-control">
                                <option value="df"></option>
                                @foreach ($diseases as $disease)
                                <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Sub Category Name <span class="t_r">*</span></label>
                            <input name="name" type="text" class="form-control" id="subEditName">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('custom_scripts')
<script>
    $(".edit").on('click', function(){
        $('#editForm').attr('action',$(this).data('url'));
        $('#edit-name').val($(this).data('name'));
    });

    $(".addSub").on('click', function(){
        $('#addId').val($(this).data('id'));
        $('#addName').val($(this).data('name'));
    });

    $(".addSubEdit").on('click', function(){
        $('#subEditForm').attr('action',$(this).data('url'));
        $('#subEditId').val($(this).data('id'));
        $('#subEditName').val($(this).data('name'));
        $('#subEditParentName').text($(this).data('parent_name'));
    });
</script>
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

