<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function check_encrypt_data($encrypt_data) {
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
        $products = Product::orderBy('id','desc')->get();
        return view('product.all-products',[
            'products'=>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'writter'=>'nullable|string|max:255',
            'desc'=>'nullable|string|max:5000',
            'qty'=>'nullable|numeric',
            'price'=>'nullable|numeric',
            'category_id'=>'required',
            'image' => 'mimes:png,jpg,svg,webp|max:2048',
        ]);

        // If Single Validation Fails
        if ($validator->stopOnFirstFailure()->fails()) {
            return  back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        $remove_image = Arr::pull($validated,'image');
        $validated['created_at'] = Carbon::now();

        // Insert info without Image
        try{
            $inserted_id = Product::insertGetId($validated);
        }catch(Exception $e){
            return back()->with('error',"Something Worng! Please try again.");
        }

        // if has image
        if($request->hasFile('image')) {
            $image = $request->image;
            $image_ext = $image->getClientOriginalExtension();
            $image_name = "product_".uniqid().$inserted_id.".".$image_ext;

            try{
                $update_image = Product::find($inserted_id)->update([
                    'image'=>$image_name,
                ]);
                // move file to directory
                if($update_image === true) {
                    File::move($image,public_path('themes/admin/product/'.$image_name));
                }
            }catch(Exception $e) {
                $update_image = Product::find($inserted_id)->update([
                    'image'=>null,
                ]);
                return back()->with('error',"Image Upload Faild. Please try again.");
            }
        }

        return back()->with('success','Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $categories = Category::where('status',1)->orderBy('id','desc')->select('name','id')->get();
        return view('product.product-add-form',[
            'categories'=>$categories,
        ]);
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
        $product_info = Product::find($id);
        $categories = Category::orderBy('id','desc')->get();
        if($product_info === null) {
            return back()->with('error',"No Data Found!");
        }
        return view('product.product-edit-form',[
            'data'=>$product_info,
            'categories'=>$categories,
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|string|max:255',
            'writter'=>'nullable|string|max:255',
            'desc'=>'nullable|string|max:5000',
            'qty'=>'nullable|numeric',
            'price'=>'nullable|numeric',
            'category_id'=>'required',
            'image' => 'mimes:png,jpg,svg,webp|max:2048',
        ]);

        // If Single Validation Fails
        if ($validator->stopOnFirstFailure()->fails()) {
            return  back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        $remove_image = Arr::pull($validated,'image');

        $product_info = Product::find($id);
        if($product_info === null) {
            return back()->with('error','No Data Found!');
        }
        $old_image = $product_info->image;

        // if has image
        if($request->hasFile('image')) {
            $image = $request->image;
            $image_ext = $image->getClientOriginalExtension();
            $image_name = "product_".uniqid().$id.".".$image_ext;

            try{
                if($old_image != "" ||$old_image != null) {
                    // Remove old image
                    if(File::exists(public_path('themes/admin/product/'.$old_image))) {
                        File::delete(public_path('themes/admin/product/'.$old_image));
                    }
                }
                // move file to directory
                File::move($image,public_path('themes/admin/product/'.$image_name));
                $validated['image']= $image_name;
            }catch(Exception $e) {
                return back()->with('error',"Image Upload Faild. Please try again.");
            }
        }

        // update to database
        try{
            $update = Product::find($id)->update($validated);
        }catch(Exception $e){
            return back()->with('error','Something Worng! Please try again.');
        }

        return back()->with('success',"Product Information Updated Successfully!");

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

        // Delete Order if available
        $orders_delete = Order::where('product_id',$id)->delete();
        if($orders_delete != true) {
            return back()->with('error','Something Worng! Please try again.');
        }

        // Product Information
        $product_info = Product::find($id);
        if($product_info === null) {
            return back()->with('error','No Data Found!');
        }
        $old_image = $product_info->image;
        if($old_image != "") {
            if(File::exists(public_path('themes/admin/product/'.$old_image))){
                File::delete(public_path('themes/admin/product/'.$old_image));
            }
        }

        $delete = Product::find($id)->delete();
        if($delete != true) {
            return back()->with('error','Something Worng! Please try again.');
        }

        return back()->with('success','Product Deleted Successfully!');
    }



    public function shawCategories()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('category.all-category',[
            'categories' => $categories,
        ]);
    }


    public function categoryStore(Request $request)
    {
        // Validation START
        $validator = Validator::make($request->all(),[
            'name'=>'nullable|string|max:255',
            'image' => 'mimes:png,jpg,svg,webp|max:2048',
        ]);

        // If Single Validation Fails
        if ($validator->stopOnFirstFailure()->fails()) {
            return  back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        $remove_image = Arr::pull($validated,'image');
        $validated['created_at'] = Carbon::now();

        // Insert to Database 
        try{
            $insert = Category::insertGetId($validated);
        }catch(Exception $e) {
            return back()->with('error','Something Worng! Please try again.');
        }

        if($request->hasFile('image')) {
            $image = $request->image;
            $image_ext = $image->getClientOriginalExtension();
            $image_name = "category_".uniqid().$insert.".".$image_ext;

            try{
                $update_image = Category::find($insert)->update([
                    'image'=>$image_name,
                ]);
                // move file to directory
                if($update_image === true) {
                    File::move($image,public_path('themes/admin/category/'.$image_name));
                }
            }catch(Exception $e) {
                $update_image = Category::find($insert)->update([
                    'image'=>null,
                ]);
                return back()->with('error',"Image Upload Faild. Please try again.");
            }
        }

        return back()->with('success',"Category Added Successfully!");
    }


    public function categoryEditFormShow($encrypt_id) 
    {
        $id = $this->check_encrypt_data($encrypt_id);

        // Find Database
        $category_info = Category::find($id);
        if($category_info == null) {
            return back()->with('error',"No Category Found!");
        }

        return view('category.edit-form',[
            'data'=>$category_info
        ]);
    }

    public function categoryUpdate(Request $request, $encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);

        $validator = Validator::make($request->all(),[
            'name'=>'nullable|string|max:255',
            'image' => 'mimes:png,jpg,svg,webp|max:2048',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return  back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        $remove_image = Arr::pull($validated,'image');

        $old_image = Category::find($id)->image;

        // if has file
        if($request->hasFile('image')) {
            $image = $request->image;
            $image_ext = $image->getClientOriginalExtension();
            $image_name = "category_".uniqid().$id.".".$image_ext;

            try{
                if($old_image != "" ||$old_image != null) {
                    // Remove old image
                    if(File::exists(public_path('themes/admin/category/'.$old_image))) {
                        File::delete(public_path('themes/admin/category/'.$old_image));
                    }
                }
                // move file to directory
                File::move($image,public_path('themes/admin/category/'.$image_name));
                $validated['image'] = $image_name;
            }catch(Exception $e) {
                return back()->with('error',"Image Upload Faild. Please try again.");
            }
        }

        // update to database 
        try{
            $update_info = Category::find($id)->update($validated);
        }catch(Exception $e) {
            return back()->with('error',"Updated Faild! Please try again.");
        }

        return back()->with('success',"Category Updatd Successfully!");
    }

    public function categoryDelete($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        
        $category_info = Category::find($id);
        if($category_info === null) {
            return back()->with('error',"No Data Found!");
        }
        $old_image = $category_info->image;

        if($old_image != "" || $old_image != null) {
            try{
                if(File::exists(public_path('themes/admin/category/'.$old_image))) {
                    File::delete(public_path('themes/admin/category/'.$old_image));
                }
            }catch(Exception $e) {
                return back()->with('error',"Image Delete Faild! Please try again.");
            }
        }

        // Delete Information from database
        $delete = $category_info->delete();
        if($delete != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Category Deleted Successfully!");
    }


}
