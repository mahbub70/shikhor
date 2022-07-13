@extends('layouts.app')

@section('title')
    <title>Order Information</title>
@endsection

@section('css')
    
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <span>Complete Order Information</span>
                    </div>
                    <div class="card-body">
                        <div class="product-info">
                            <div class="title">Product Info.</div>
                            <div class="product-img mt-2">
                                @if ($data->product->image != "" || $data->product->image != null)
                                    <img class="w-100" src="{{ asset('themes/admin/product') }}/{{ $data->product->image }}" alt="Product">
                                @else
                                 <div>Image Not Found!</div>
                                @endif
                            </div>
                            <h2 class="my-3">{{ $data->product->name }}</h2>
                        </div>
                        <div class="order-info mt-3">
                            <div class="title">
                                Order Info.
                            </div>

                            <div class=""><strong>Customer Name: </strong>{{ $data->customer_name }}</div>
                            <div class=""><strong>Customer Address: </strong>{{ $data->customer_address }}</div>
                            <div class=""><strong>Customer Phone: </strong>{{ $data->customer_phone }}</div>
                            <div class=""><strong>Order Quantity: </strong>{{ $data->customer_qty }}</div>
                            <div class=""><strong>Unit Price: </strong>{{ $data->unit_price }}</div>
                            <div class=""><strong>Total Price: </strong>{{ $data->total }}</div>
                            <div class=""><strong>Due Amount: </strong>{{ $data->due }}</div>
                            <div class=""><strong>Order Create Time: </strong>{{ $data->created_at }}</div>
                            <div class=""><strong>Order Complete Time: </strong>{{ $data->updated_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    
@endsection