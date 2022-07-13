<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\AcademicClass;
use App\Models\Admin;
use App\Models\ClassVideo;
use App\Models\Mcq;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
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


    //Show Dashboard Page
    public function show() {

        $today_login_users = User::where('last_login','>',Carbon::today())->get()->count();
        $total_users = User::all()->count();
        $today_register_users = User::where('created_at','>',Carbon::today())->get()->count();
        $total_admin = Admin::all()->count();

        // Video
        $all_videos = ClassVideo::all()->count();
        $free_videos = ClassVideo::where('type',0)->get()->count();
        $live_videos = ClassVideo::where('type',2)->get()->count();
        $class_videos = ClassVideo::where('type',1)->get()->count();

        // products
        $all_products = Product::all()->count();


        // Orders 
        $all_orders = Order::all()->count();
        $active_orders = Order::where('status',1)->get()->count();
        $hold_orders = Order::where('status',0)->get()->count();
        $complete_orders = Order::where('status',3)->get()->count();


        return view('home',[
            'today_login' => $today_login_users,
            'today_register' => $today_register_users,
            'users' => $total_users,
            'admins' => $total_admin,
            'videos' => $all_videos,
            'free_videos' => $free_videos,
            'live_videos' => $live_videos,
            'class_videos' => $class_videos,
            'products' => $all_products,
            'orders' => $all_orders,
            'active_orders' => $active_orders,
            'hold_orders' => $hold_orders,
            'complete_orders' => $complete_orders,
        ]);
    }

    // Show About Us Page
    public function aboutUsIndex()
    {
        $data = AboutUs::first();
        return view('about-us.about-us',[
            'data' => $data,
        ]);
    }

    // Show About US Edit Form
    public function aboutUsEdit()
    {
        $data = AboutUs::first();
        return view('about-us.about-us-edit-from',[
            'data' => $data,
        ]);
    }


    // Update About Us
    public function aboutUsUpdate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|max:255',
            'desc' => 'nullable|max:5000',
            'image' => 'nullable|mimes:png,jpg,jpeg,svg,webp'
        ]);

        $old_image = AboutUs::first()->image;
        $validated['added_by'] = auth()->user()->name;

        if($request->hasFile('image')) {
            $image = $request->image;
            $imageExt = $image->getClientOriginalExtension();
            $image_name = Str::uuid() . "." . $imageExt;

            if($old_image != null) {
                if(File::exists(public_path('themes/admin/about-us/'.$old_image))) {
                    File::delete(public_path('themes/admin/about-us/'.$old_image));
                }
            }
            // Move New Image
            File::move($image,public_path('themes/admin/about-us/'.$image_name));
            $validated['image'] = $image_name;

        }

        // Udpate Information
        $update = AboutUs::first()->update($validated);
        if($update != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Edited Successfully!");

    }


    // Class Store
    public function classAdd(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:5000',
        ]);

        $validated['added_by'] = Auth::user()->name;
        $validated['created_at'] = Carbon::now();

        $insert = AcademicClass::create($validated);

        if($insert != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }
        return back()->with('success',"Class Added Successfully!");
    }

    // Class List Show
    public function classList()
    {
        $all_class = AcademicClass::orderBy('id','desc')->get();

        return view('class.class-list',[
            'all_class' => $all_class
        ]);
    }


    // Class Edit From Show
    public function classEdit($encrypt_id) 
    {
        $id = $this->check_encrypt_data($encrypt_id);

        $data = AcademicClass::find($id);

        return view('class.class-edit-from',[
            'data'=>$data,
        ]);
    }


    // Class Update
    public function classUpdate(Request $request, $encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:5000',
        ]);
        $validated['added_by'] = Auth::user()->name;

        $update = AcademicClass::find($id)->update($validated);
        
        if($update != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Class Edited Successfully!");
    }

    // Class Delete
    public function classDestroy($encrypt_id)
    {
        $id = $this->check_encrypt_data($encrypt_id);

        $deleteMcq = Mcq::where('class_id',$id)->delete();
        if($deleteMcq != true) {
            return back()->with('error',"Something Worng! MCQ not deleted agains this class");
        }

        $delete = AcademicClass::find($id)->delete();

        if($delete != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Class Delete Successfull!");
    }
}
