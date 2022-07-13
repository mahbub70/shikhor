<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SuccessPeople;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SuccessPeopleController extends Controller
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
        $success_peoples = SuccessPeople::orderBy('id','desc')->get();
        return view('success-people.success-people-list',[
            'success_peoples' => $success_peoples,
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
        $validated = $request->validate([
            'name' => 'required|max:100',
            'batch_id' => 'nullable|max:100',
            'address' => 'nullable|max:255',
            'position' => 'nullable|max:100',
            'grade' => 'nullable|max:50',
            'message' => 'nullable|max:100',
            'desc' => 'nullable|max:5000',
            'image' => 'nullable|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ]);

        $validated['added_by'] = Auth::user()->name;
        $validated['created_at'] = Carbon::now();

        // Insert Information
        try{
            $inserted_id = SuccessPeople::insertGetId($validated);
        }catch(Exception $e) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        if($request->hasFile('image')) {
            $image = $request->image;
            $imgExt = $image->getClientOriginalExtension();
            $image_name = Str::uuid() . "-" . $inserted_id . "." . $imgExt;

            // Move Image to Folder
            File::move($image,public_path('themes/admin/success-peoples/'.$image_name));

            // Update Image Name
            $update_image = SuccessPeople::find($inserted_id)->update([
                'image' => $image_name,
            ]);

            if($update_image != true) {
                return back()->with('error',"Image Upload Faild!");
            }
        }

        return back()->with('success',"Added Successfully!");
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
        $data = SuccessPeople::find($id);
        return view('success-people.success-people-edit-form',[
            'data' => $data
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
        $validated = $request->validate([
            'name' => 'required|max:100',
            'batch_id' => 'nullable|max:100',
            'address' => 'nullable|max:255',
            'position' => 'nullable|max:100',
            'grade' => 'nullable|max:50',
            'message' => 'nullable|max:100',
            'desc' => 'nullable|max:5000',
            'image' => 'nullable|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ]);

        $validated['added_by'] = Auth::user()->name;
        $old_image = SuccessPeople::find($id)->image;

        if($request->hasFile('image')) {
            $image = $request->image;
            $imgExt = $image->getClientOriginalExtension();
            $image_name = Str::uuid() . "-" . $id . "." . $imgExt;

            // Delete Old File
            if($old_image != 'default.jpg') {
                if(File::exists(public_path('themes/admin/success-peoples/'.$old_image))) {
                    File::delete(public_path('themes/admin/success-peoples/'.$old_image));
                }
            }

            // Move Image to Folder
            File::move($image,public_path('themes/admin/success-peoples/'.$image_name));

            // Update Image Name
            $validated['image'] = $image_name;
        }

        $update = SuccessPeople::find($id)->update($validated);
        if($update != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Edit Successfully!");
        
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

        $image = SuccessPeople::find($id)->image;

        if($image != 'default.jpg') {
            // Delete Image
            if(File::exists(public_path('themes/admin/success-peoples/'.$image))) {
                File::delete(public_path('themes/admin/success-peoples/'.$image));
            }
        }

        $delete = SuccessPeople::find($id)->delete();
        if($delete != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Delete Successfull!");
    }
}
