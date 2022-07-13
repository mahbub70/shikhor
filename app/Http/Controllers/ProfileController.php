<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public $default_image_name = "default.jpg";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    // Admin Password Update
    public function passwordUpdate(Request $request)
    {
        $old_password = $request->old_password;

        // Check old Password is match or not
        if(Hash::check($old_password,auth()->user()->password)) {
            // old password matched
            $validated = $request->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Update Password
            $update = Admin::find(auth()->user()->id)->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            if($update != true) {
                return back()->with('error',"Something Worng! Please try again.");
            }

        }else {
            throw ValidationException::withMessages([
                'old_password' => "Old Password didn't match.",
            ]);
        }

        return back()->with('success',"Password Update Success!");
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validated = $request->validate([
            'name' => 'string|min:1',
            'image' => 'required|mimes:png,jpg,webp,jpeg,svg',
        ]);

        // if has image
        if($request->hasFile('image')) {
            $image = $request->image;
            $imageExt = $image->getClientOriginalExtension();
            $image_name = Str::uuid() . "_" . Auth::user()->id . "." . $imageExt;
            
            $old_image = Auth::user()->image;
            if($old_image != $this->default_image_name) {
                // Remove Old Image
                if(File::exists(public_path('themes/admin/users/'.$old_image))) {
                    File::delete(public_path('themes/admin/users/'.$old_image));
                }
            }

            // New File Move
            File::move($image,public_path('themes/admin/users/'.$image_name));
            $validated['image'] = $image_name;
        }

        // Update Information
        $update = Admin::find(Auth::user()->id)->update($validated);
        if($update != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }
        return back()->with('success',"Information Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
