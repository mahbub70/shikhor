@extends('layouts.app')

@section('title')
    <title>All Products</title>
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
                    <span>Products</span>
                    <a href="{{ route('admin.product.add-form') }}" class="btn btn-primary">Add Product</a>
                  
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
                    @if ($products->count() == 0)
                        <div class="text-dark text-center p-4 font-weight-bold">No Data Found!</div>
                    @else
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                          <tr>
                            <th>SL NO</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Writter</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Qty</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$item)
                            <tr class="odd gradeX">
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($item->image != "")
                                        <img style="width: 50px;height:50px;border-radius:50%;object-fit:cover" src="{{ asset('themes/admin/product') }}/{{ $item->image }}" alt="Product Image">
                                    @else
                                        <span>Empty</span>
                                    @endif
                                </td>
                                <td class="center">{{ (($item->name != "")?substr($item->name,0,20).'...':'Empty') }}</td>
                                <td class="center">{{ (($item->writter != "")?substr($item->writter,0,20).'...':'Empty') }}</td>
                                <td class="center">{!! (($item->desc != "")?substr($item->desc,0,25).'...':'Empty') !!}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>
                                <td class="center">
                                    <a href="{{ route('admin.product.edit-form',encrypt($item->id)) }}" class="btn btn-primary">Edit</a>    
                                    <a href="javacript:void(0)" class="btn btn-danger productDeleteBtn" onclick="event.preventDefault(); if(confirm('Are You Sure?') === true) {
                                      document.getElementById('product-delete-form<?=($key)?>').submit();
                                    }
                                      ">Delete</a>    
                                </td>
                                <form id="product-delete-form<?=($key)?>" action="{{ route('admin.product.delete',encrypt($item->id)) }}" method="POST" class="d-none">
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