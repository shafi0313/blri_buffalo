@extends('admin.layout.master')
@section('title', 'Animal Category')
@section('content')
@php $p='farmSett'; $sm='animalCat'; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                    <a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Animal Breed</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Animal Category</h4>
                                <a href="" class="btn btn-primary btn-round ml-auto text-light" data-toggle="modal" data-target="#addCat"><i class="fa fa-plus"></i> Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-bordered table-hover" >
                                    <thead class="bg-secondary thw">
                                        <tr>
                                            <th style="width: 35px">SL</th>
                                            {{-- <th width="200px">Animal Type</th> --}}
                                            <th>Name</th>
                                            <th class="no-sort" style="text-align:center;width:200px" >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $x=1; @endphp
                                        @foreach ($animalCats as $animalCat)
                                        <tr class="bg-light">
                                            <td class="text-center">{{ $x++ }} </td>
                                            {{-- <td>{{ ($animalCat->type==1)?'Swamp':'River' }} </td> --}}
                                            <td>{{ $animalCat->name }} </td>
                                            {{-- <th></th> --}}

                                            {{-- <td align="center">
                                                <i class="btn btn-sm btn-success fa fa-plus addSub" data-toggle="modal" data-target="#add-sub" data-id="{{$animalCat->id}}"></i>
                                                <i class="btn btn-sm btn-info fa fa-edit edit" data-toggle="modal" data-target="#edit" data-url="{{route('animal-cat.update', $animalCat->id)}}" data-name="{{$animalCat->name}}"></i>
                                                <a href="" onclick="return confirm('are you sure?')" class="btn btn-danger fa fa-trash-alt"></a>
                                            </td> --}}

                                            <td>
                                                <div class="form-button-action">

                                                    <span class="btn btn-link btn-success btn-lg addSub" data-toggle="modal" data-target="#add-sub" data-id="{{$animalCat->id}}" data-type="{{$animalCat->type}}"> <i class="fas fa-plus"></i></span>
                                                    <a href="{{ route('animal-cat.edit', $animalCat->id) }}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    {{-- <span class="btn btn-link btn-primary btn-lg edit" data-toggle="modal" data-target="#edit" data-url="{{route('animal-cat.update', $animalCat->id)}}" data-name="{{$animalCat->name}}" data-type="{{$animalCat->type}}"><i class="fa fa-edit"></i></span> --}}
                                                    <form action="{{ route('animal-cat.destroy', $animalCat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @if ($animalCat->subcat->count() > 0)
                                        @foreach ($animalCat->subCat as $animalSubCat)
                                        <tr>
                                            <td class="text-center">{{ $x++ }} </td>
                                            {{-- <td>{{ ($animalCat->type==1)?'Swamp':'River' }} </td> --}}
                                            <td ><span style="margin-right: 45px"></span><i class="fas fa-hand-point-right"></i> {{$animalSubCat->name}}</td>
                                            {{-- <td align="center">
                                                <i class="btn btn-sm btn-info fa fa-edit edit" data-toggle="modal" data-target="#edit" data-url="" data-name="{{$animalSubCat->name}}" data-name="{{$animalSubCat->name}}"></i>
                                                <a href="" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger fa fa-trash-alt"></a>
                                            </td> --}}
                                            <td>
                                                <div class="form-button-action">
                                                    {{-- <span class="btn btn-link btn-primary btn-lg  editSub" data-toggle="modal" data-target="#editSub" data-url="" data-name="{{$animalSubCat->name}}" data-name="{{$animalSubCat->name}}"><i class="fa fa-edit"></i></span> --}}
                                                    <a href="{{ route('animalCat.subEdit', $animalSubCat->id) }}" title="Edit" class="btn btn-link btn-primary btn-lg">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('animal-cat.destroy', $animalSubCat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Delete" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            {{-- <td></td> --}}
                                            {{-- <td></td> --}}
                                        </tr>
                                        @endforeach
                                        @endif
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
<div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="addCatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatLabel">Add License Farm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('animal-cat.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="form-check col-md-4">
                            <label>Animal Type <span class="t_r">*</span></label><br>
                            <label class="form-radio-label mr-5">
                                <input class="form-radio-input " type="radio" name="type" value="1" required>
                                <span class="form-radio-sign">Swamp</span>
                            </label>
                            <label class="form-radio-label ml-3" >
                                <input class="form-radio-input " type="radio" name="type" value="2" required>
                                <span class="form-radio-sign">River</span>
                            </label>
                        </div> --}}

                        <div class="form-group col-md-8">
                            <label for="name">Animal Category Name <span class="t_r">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>
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
        <form action="{{ route('animalCat.SubCatStore')}}" method="post">
            @csrf
            <input type="hidden" id="main_cat_id" name="parent_id">
            <input type="hidden" id="main_cat_type" name="parent_type">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-subLabel" style="color:red;">Add New Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Animal Name <span class="t_r">*</span></label>
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

<!--Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" autocomplete="off" id="editForm">
            @csrf @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel" style="color:red;">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categoryName" name="parent_id">
                    <div class="form-check col-md-4">
                        <label>Animal Type <span class="t_r">*</span></label><br>
                        <label class="form-radio-label mr-5">
                            <input class="form-radio-input " type="radio" name="type" value="1" required>
                            <span class="form-radio-sign">Swamp</span>
                        </label>
                        <label class="form-radio-label ml-3" >
                            <input class="form-radio-input " type="radio" name="type" value="2" required>
                            <span class="form-radio-sign">River</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="edit-name">Name <strong style="color:red;">*</strong></label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editSub" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" autocomplete="off" id="editSubForm">
            @csrf @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel" style="color:red;">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categoryName" name="parent_id">
                    <div class="form-check col-md-12">
                        <label>Animal Type <span class="t_r">*</span></label><br>
                        <label class="form-radio-label mr-5 type">
                            <input class="form-radio-input" type="radio" name="type"   value="1" required>
                            <span class="form-radio-sign">Swamp</span>
                        </label>
                        <label class="form-radio-label ml-3 type">
                            <input class="form-radio-input " type="radio" name="type" value="2" required>
                            <span class="form-radio-sign">River</span>
                        </label>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Animal Category <span class="t_r">*</span></label>
                        <select name="parent_id" id="cat" class="form-control"></select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">Animal Name <span class="t_r">*</span></label>
                        <input name="name" type="text" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                    <div class="form-group">
                        <label for="edit-name">Name <strong style="color:red;">*</strong></label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('custom_scripts')
<script>
    $(document).ready(function () {
        $('#DataTable').DataTable();
    });
    $(".addSub").on('click', function(){
        $('#main_cat_id').val($(this).data('id'));
        $('#main_cat_type').val($(this).data('type'));
    });
    $(".edit").on('click', function(){
        $('#editForm').attr('action',$(this).data('url'));
        $('#edit-name').val($(this).data('name'));
        $('#edit-type').val($(this).data('type'));
    });
    $(".editSub").on('click', function(){
        $('#editSubForm').attr('action',$(this).data('url'));
        $('#edit-name').val($(this).data('name'));
    });
    </script>
    <script>
        $('.type').on('change',function(e) {
                var type = $('input:radio[name="type"]:checked').val();
                $.ajax({
                    url:'{{ route("getAnimalCat") }}',
                    type:"get",
                    data: {
                        type: type
                        },
                    success:function (res) {
                        res = $.parseJSON(res);
                        $('#cat').html(res.cat);
                    }
                })
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

        // $('#addRowButton').click(function() {
        //     $('#add-row').dataTable().fnAddData([
        //         $("#addName").val(),
        //         $("#addPosition").val(),
        //         $("#addOffice").val(),
        //         action
        //         ]);
        //     $('#addRowModal').modal('hide');

        // });
    });
</script>

@endpush

@endsection

