@extends('layouts.app')

@section('title')
    <title>Form - Create Order</title>
@endsection

@section('css')

@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-border-color card-border-color-primary">
                  <div class="card-header card-header-divider">Create Order<span class="card-subtitle"></span></div>
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
                    <form action="{{ route('admin.order.add') }}" method="POST" id="people_add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="class">Select Product</label>
                            <select name="product_id" id="product" class="form-control @error('product_id') is-invalid @enderror">
                                <option value="" selected disabled>Choose One</option>
                                @foreach ($products as $key=>$item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                      <div class="form-group pt-2">
                        <label for="availableQty">Available Qty</label>
                        <input class="form-control" id="availableQty" type="text" value="{{ old('available_qty') }}" readonly name="available_qty" >
                      </div>
                      <div class="form-group pt-2">
                        <label for="unitPrice">Unit Price</label>
                        <input class="form-control" id="unitPrice" type="text" value="{{ old('unit_price') }}" readonly name="unit_price">
                      </div>

                      <div class="customer-info">
                        <h3>Customer Information</h3>
                      </div>

                      <div class="form-group pt-2">
                        <label for="customerName">Customer Name</label>
                        <input class="form-control @error('customer_name') is-invalid @enderror" id="customerName" type="text" placeholder="Enter Customer Name" name="customer_name" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerPhone">Customer Phone Number</label>
                        <input class="form-control @error('customer_phone') is-invalid @enderror" id="customerPhone" type="text" placeholder="Enter Phone" name="customer_phone" value="{{ old('customer_phone') }}">
                        @error('customer_phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerAddress">Customer Address</label>
                        <input class="form-control @error('customer_address') is-invalid @enderror" id="customerAddress" type="text" placeholder="Enter Address" name="customer_address" value="{{ old('customer_address') }}">
                        @error('customer_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerQty">Quantity</label>
                        <input class="form-control @error('customer_qty') is-invalid @enderror" id="customerQty" type="number" placeholder="Enter Quantity" name="customer_qty" value="{{ old('customer_qty') }}">
                        @error('customer_qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="transID">Trans. ID</label>
                        <input class="form-control @error('transection_id') is-invalid @enderror" id="transID" type="text" placeholder="Enter Transection ID" name="transection_id" value="{{ old('transection_id') }}">
                        @error('transection_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerTotal">Total Price</label>
                        <input class="form-control @error('total') is-invalid @enderror" id="customerTotal" type="text" placeholder="Enter Advance Price" name="total" value="{{ old('total') }}" readonly>
                        @error('total')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerAdvance">Advance Money</label>
                        <input class="form-control @error('advance') is-invalid @enderror" id="customerAdvance" type="number" placeholder="Enter Advance Price" name="advance" value="{{ old('advance') }}">
                        @error('advance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="customerDue">Total Due</label>
                        <input class="form-control @error('customer_due') is-invalid @enderror" id="customerDue" type="text" placeholder="Customer Due" name="customer_due" value="{{ old('customer_due') }}" readonly>
                        @error('customer_due')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="people_add_form_btn">Create Order</button>
                          </p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#product').change(function(){
      var product_id = $(this).val();
      if(product_id != "") {
        // Ajax Request
        $.post('/admin/order/get-product-info',{product_id:product_id},function(data,status){
          if(status == 'success') {
            var product_info = JSON.parse(data);
            $('#availableQty').val(product_info['qty']);
            $('#unitPrice').val(product_info['price']);
          }
        });
      }
    }); 
    
    // Customer Quantity
    $('#customerQty').keyup(function(){
      var available_qty = $('#availableQty').val();
      if(parseFloat($(this).val()) > parseFloat(available_qty)) {
        alert('Quantity is not Available.');
        $(this).val('');
      }else {
        // Calculating Total Price
        var total_price = $(this).val() * available_qty;
        $('#customerTotal').val(total_price);
      }

    });

    // Customer Due Calculate
    $('#customerAdvance').keyup(function(){
      if(parseFloat($(this).val()) > parseFloat($('#customerTotal').val())) {
          alert('Advance is gratter then Total Price.');
          $(this).val("");
          $('#customerDue').val("");
          return false;
      }
      if($('#customerTotal').val() != ""){
        var customerTotal = $('#customerTotal').val();
        var customerDue = customerTotal - $(this).val();
        $('#customerDue').val(customerDue);
      }else {
        alert('Total Price is 0');
      }
    });
  </script>  
@endsection