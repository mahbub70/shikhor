@extends('layouts.app')

@section('title')
    <title>All Orders</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"/>

    <style>
        div.dataTables_wrapper div.dataTables_length label select.form-control-sm {
            width: 60px !important;
        }
    </style>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Orders</span>
                    <a href="{{ route('admin.order.create') }}" class="btn btn-primary">Create Order</a>
                  
                </div>
                @if (session('success'))
                    <div class="alert alert-success p-3 w-50 m-auto mt-2">
                        <strong>Success!</strong> {!! session('success') !!}
                    </div>                        
                @endif
                @if (session('error'))
                    <div class="alert alert-danger p-3 w-50 m-auto mt-2">
                        <strong>Faild!</strong> {!! session('error') !!}
                    </div>                        
                @endif
                <div class="card-body">
                    @if ($orders->count() == 0)
                        <div class="text-dark text-center p-4 font-weight-bold">No Data Found!</div>
                    @else
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                          <tr>
                            <th>SL NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Order Qty</th>
                            <th>Total Amount</th>
                            <th>Due Amount</th>
                            <th>Created At</th>
                            <th>Last Update</th>
                            <th>Order Status</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key=>$item)
                            <tr class="odd gradeX">
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($item->product->image != "")
                                        <img style="width: 50px;height:50px;border-radius:50%;object-fit:cover" src="{{ asset('themes/admin/product') }}/{{ $item->product->image }}" alt="Product Image">
                                    @else
                                        <span>Empty</span>
                                    @endif
                                </td>
                                <td class="center">{{ ((strlen($item->product->name) > 15)?substr($item->product->name,0,15).'...':$item->product->name) }}</td>

                                <td class="center">{{ ((strlen($item->customer_name) > 15)?substr($item->customer_name,0,15).'...':$item->customer_name) }}</td>

                                <td class="center">{{ ((strlen($item->customer_address) > 15)?substr($item->customer_address,0,15).'...':$item->customer_address) }}</td>
                                <td>{{ $item->customer_qty }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->due }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td class="center">{{ ($item->updated_at != null)?\Carbon\Carbon::parse($item->updated_at)->diffForHumans():'-' }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @elseif ($item->status == 0)
                                        <span class="badge badge-warning">Hold</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->delivery_status == 0) 
                                        <span class="badge badge-info">Running</span>
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin.order.edit-form',encrypt($item->id)) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('admin.order.hold',encrypt($item->id)) }}" class="btn btn-warning">Mark As Hold</a>
                                    <a href="{{ route('admin.order.complete',encrypt($item->id)) }}" class="btn btn-success">Mark As Complete</a>
                                    <a href="javacript:void(0)" class="btn btn-danger productDeleteBtn" onclick="event.preventDefault(); if(confirm('Are You Sure?') === true) {
                                      document.getElementById('order-delete-form<?=($key)?>').submit();
                                    }
                                      ">Delete</a>    
                                </td>
                                <form id="order-delete-form<?=($key)?>" action="{{ route('admin.order.delete',encrypt($item->id)) }}" method="POST" class="d-none">
                                  @csrf
                                </form>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{ asset('themes/admin/lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

<script src="{{ asset('themes/admin/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>


{{-- Alternative Start --}}
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/jszip/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/pdfmake/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/pdfmake/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
{{-- Alternative End --}}

<script>
    $(document).ready(function(){
        App.dataTables();
    });
</script>
@endsection