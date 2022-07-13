<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    // Decrypt Id
    public function check_encrypt_data($encrypt_data)
    {
        try{
            return decrypt($encrypt_data);
        }catch(Exception $e) {
            return back()->with('error',"Something Worng! Please try again.");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status','!=',3)->get();
        return view('order.orders-list',[
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('id','name')->orderBy('id','desc')->get();

        return view('order.order-add-from',[
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
        if($product != null) {
            if($request->customer_qty > $product->qty) {
                throw ValidationException::withMessages([
                    'customer_qty' => "Invalid Quantity! Quantity Is Not Available.",
                ]);
            }

            // Valiation
            $validatd = $request->validate([
                'product_id' => 'required|numeric',
                'customer_name' => 'required|string|max:100',
                'customer_phone' => 'required|numeric|digits_between:0,20',
                'customer_address' => 'required|string|max:255',
                'customer_qty' => 'required|numeric',
                'transection_id' => 'required|string|max:100',
                'advance' => 'required|numeric',
            ]);

            $validatd['unit_price'] = $product->price;
            $validatd['total'] = $product->price * $request->customer_qty;
            if($request->advance > $validatd['total']) {
                throw ValidationException::withMessages([
                    'advance' => "Invalid! Advance is gratter then Total Price.",
                ]);
            }else {
                $validatd['due'] = $validatd['total'] - $request->advance;
            }
            $validatd['added_by'] = auth()->user()->name;
            $validatd['created_at'] = Carbon::now();

            try{
                $inserted_id = Order::insertGetId($validatd);
            }catch(Exception $e) {
                return back()->with('error','Something Worng! Please try again.');
            }

            // Update Product Quantity
            $update_product_qty = Product::find($request->product_id)->update([
                'qty' => $product->qty - $request->customer_qty,
            ]);

            if($update_product_qty != true) {
                // Order Indert Back
                $order_delete = Order::find($inserted_id)->delete();
                return back()->with('error','Something Worng! Please try again.');
            }

            // Success
            return back()->with('success','Order Create Successfully!');
        }else {
            return back()->with('error','Product Not Found!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $data = Order::find($id);
        return view('order.order-edit-from',[
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $order_info = Order::find($id);
        $old_qty = $order_info->customer_qty;
        if($old_qty != $request->customer_qty) {
            $new_qty = $request->customer_qty - $old_qty;
        }

        $product = Product::find($request->product_id);
        if($product != null) {
            if($request->customer_qty > $product->qty) {
                throw ValidationException::withMessages([
                    'customer_qty' => "Invalid Quantity! Quantity Is Not Available.",
                ]);
            }

            // Valiation
            $validatd = $request->validate([
                'product_id' => 'required|numeric',
                'customer_name' => 'required|string|max:100',
                'customer_phone' => 'required|numeric|digits_between:0,20',
                'customer_address' => 'required|string|max:255',
                'customer_qty' => 'required|numeric',
                'transection_id' => 'required|string|max:100',
                'advance' => 'required|numeric',
            ]);

            $validatd['unit_price'] = $product->price;
            $validatd['total'] = $product->price * $request->customer_qty;
            if($request->advance > $validatd['total']) {
                throw ValidationException::withMessages([
                    'advance' => "Invalid! Advance is gratter then Total Price.",
                ]);
            }else {
                $validatd['due'] = $validatd['total'] - $request->advance;
            }
            $validatd['added_by'] = auth()->user()->name;

            try{
                $update = Order::find($id)->update($validatd);
            }catch(Exception $e) {
                return back()->with('error','Something Worng! Please try again.');
            }

            // Update Product Quantity
            $update_product_qty = Product::find($request->product_id)->update([
                'qty' => $product->qty - $new_qty,
            ]);

            if($update_product_qty != true) {
                return back()->with('error','Update Faild! Please try again.');
            }

            // Success
            return back()->with('success','Order Create Successfully!');
        }else {
            return back()->with('error','Product Not Found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $order_info = Order::find($id);
        if($order_info->status != 3) {
            $order_qty = $order_info->customer_qty;
            // update product Quantity
            $product_info = Product::find($order_info->product_id);
            $update_product_qty = Product::find($order_info->product_id)->update([
                'qty' => $product_info->qty + $order_qty 
            ]);
        }

        // Delete Order
        $delete = Order::find($id)->delete();
        if($delete != true) {
            return back()->with('error','Something Worng! Please try again.');
        }

        return back()->with('success','Order Deleted Successfully!');
    }

    // Get Product Info Ajax Request
    public function getProductInfo(Request $request)
    {
        $data = [];
        $product_id = $request->product_id;
        $product_info = Product::find($product_id);
        if($product_id != null) {
            $data['qty'] = $product_info->qty;
            $data['price'] = $product_info->price;
        }else {
            $data['error'] = "Product Not Found!";
        }

        return json_encode($data);
    }



    // Mark As Hold
    public function markAsHold($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $update = Order::find($id)->update([
            'status' => 0,
        ]);

        if($update != true) {
            return back()->with('error','Something Worng! Please try again.');
        }

        return back()->with('success','Order is nou Hold.');
    }


    // Mark As Complete
    public function markAsComplete($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $order_info = Order::find($id);

        $update = Order::find($id)->update([
            'status'=> 3,
            'advance' => $order_info->total,
            'due' => 0,
        ]);

        if($update != true) {
            return back()->with('error','Something Worng! Please try again.');
        }
        return back()->with('success','Order Complete Successfully!');
    }



    // Show Complete Orders
    public function completeOrders()
    {
        $complete_orders = Order::where('status',3)->orderBy('id','desc')->get();
        return view('order.complete-orders',[
            'complete_orders' => $complete_orders,
        ]);
    }


    // Complete Order Single View
    public function completeOrderView($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        
        $data = Order::find($id);
        return view('order.order-complete-view',[
            'data' =>$data,
        ]);
    }
}
