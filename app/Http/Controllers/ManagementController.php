<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($encrypt_id)
    {
        $id = decrypt($encrypt_id);
        // Delete User
        $delete = User::find($id)->delete();
        if($delete != true) {
            return back()->with('error','Something Worng! Please try again.');
        }
        return back()->with('success','User Deleted Successfull!');
    }

    public function userShow()
    {
        // collect all users
        $users = User::orderBy('id','desc')->get();
        
        return view('management.users-list',[
            'users'=>$users,
        ]);
    }


    // User Status Change
    public function userStatusChange($encrypt_id)
    {
        $id = decrypt($encrypt_id);
        if(User::find($id)->status == 1) {
            $updateStatus = User::find($id)->update([
                'status'=> 0,
            ]);
        }else {
            $updateStatus = User::find($id)->update([
                'status'=> 1,
            ]);
        }

        if($updateStatus != true) {
            return back()->with('error','Something Worng! Please try again.');
        }

        return back()->with('success','Information Updated Successfully!');
    }
}
