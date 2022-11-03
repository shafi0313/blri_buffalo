@extends('admin.layout.master')
@section('title', 'Sales ledger Book')
@section('content')
@php $p='sales'; $sm="salesLedger"; @endphp
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('admin.dashboard')}}" title="Dashboard"><i class="flaticon-home"></i></a></li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    {{-- <li class="nav-item"><a href="{{ route('purchaseLedgerBook.index') }}">Sales ledger Book</a></li> --}}
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item active">Select Date</li>
                </ul>
            </div>
            <div class="divider1"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Select Date</h4>
                            </div>
                        </div> --}}
                        <div class="card-body" >
                            <h1 class="text-center mr-5 mb-3">Select the date and show the report</h1>
                            <hr>
                            <form action="{{ route('communityStock.report') }}" method="get">
                                @csrf
                                {{-- <input type="hidden" name="customer_id" value="{{ $customer_id->id }}"> --}}
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-6">
                                        <label for="">Select Community <span class="t_r">*</span></label>
                                        <select name="community_cat_id" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($communityCats as $communityCat)
                                            <option value="">{{$communityCat->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                <div class="col-md-7">
                                    <div class="form-group row">
                                        <label for="form_date" class="col-sm-2 col-form-label">Form Date:</label>
                                        <div class="col-sm-4">
                                          <input type="date" name="form_date" class="form-control" id="form_date" placeholder="Email">
                                        </div>

                                        <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>
                                        <div class="col-sm-4">
                                          <input type="date" name="to_date" class="form-control" id="to_date" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center" style="margin-top: 10px">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>

@push('custom_scripts')

@endpush
@endsection

