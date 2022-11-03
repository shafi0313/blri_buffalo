@extends('admin.layout.master')
@section('title', 'Animal Category')
@section('content')
@php $p='farmSett'; $sm='animalCat'; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home"><a href="{{ route('admin.dashboard')}}"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="{{ route('animal-cat.index')}}">Animal Category</a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Add Animal Category</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Animal Category</h4>
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
                            <form action="{{ route('animal-cat.store')}}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="form-check col-md-3">
										<label>Animal Type <span class="t_r">*</span></label><br>
										<label class="form-radio-label mr-5">
											<input class="form-radio-input " type="radio" name="type" value="1" required>
											<span class="form-radio-sign">Goat</span>
										</label>
										<label class="form-radio-label ml-3" >
											<input class="form-radio-input " type="radio" name="type" value="2" required>
											<span class="form-radio-sign">Sheep</span>
										</label>
									</div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Animal Category Name <span class="t_r">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>
                                        @error('name')
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




                    <div class="card">
                        {{-- Page Content Start --}}
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Add Animal Name</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <form action="{{ route('animalCat.SubCatStore')}}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="form-check col-md-3">
										<label>Animal Type <span class="t_r">*</span></label><br>
										<label class="form-radio-label mr-5 type">
											<input class="form-radio-input" type="radio" name="type" value="1" required>
											<span class="form-radio-sign">Goat</span>
										</label>
										<label class="form-radio-label ml-3 type">
											<input class="form-radio-input " type="radio" name="type" value="2" required>
											<span class="form-radio-sign">Sheep</span>
										</label>
									</div>

                                    <div class="form-group col-md-4">
                                        <label for="name">Animal Category <span class="t_r">*</span></label>
                                        <select name="parent_id" id="cat" class="form-control"></select>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-5">
                                        <label for="name">Animal Name <span class="t_r">*</span></label>
                                        <input name="name" type="text" class="form-control">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div align="center" class="mr-auto card-action">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                </div>
                            </form> --}}
                        </div>
                    {{-- Page Content End --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>

   <!--Add Cat Modal -->
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="add-categoryLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
       <form action="{{route('inv_category.store')}}" method="POST" autocomplete="off">
           @csrf
           <input type="hidden" name="client_id" value="{{$client->id}}">
           <input type="hidden" name="profession_id" value="{{$profession->id}}">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="add-categoryLabel">Add New Category</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div class="form-group">
                   <label for="name">Category Name <strong style="color:red;">*</strong></label>
                   <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required>
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
@endpush
@endsection

