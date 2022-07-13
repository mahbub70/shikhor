<?php

namespace App\Http\Controllers;

use App\Models\AcademicClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mcq;
use Exception;

class McqController extends Controller
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
        $all_mcq = Mcq::orderBy('id','desc')->get();
        return view('mcq.mcq-list',[
            'all_mcq' => $all_mcq
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = AcademicClass::orderBy('id','desc')->get();
        return view('mcq.mcq-add-form',[
            'classes' => $classes,
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
        $validated = $request->validate([
            'class_id' => 'required|integer',
            'year' => 'nullable|integer',
            'question' => 'required|string|max:255',
            'option_one' => 'nullable|max:255',
            'option_two' => 'nullable|max:255',
            'option_three' => 'nullable|max:255',
            'option_four' => 'nullable|max:255',
            'currect_ans' => 'nullable|max:255',
        ]);

        $validated['added_by'] = auth()->user()->name;
        $validated['created_at'] = Carbon::now();
        $insert = Mcq::create($validated);
        if($insert != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"MCQ Added Successfully!");


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

        $data = Mcq::find($id);
        $classes = AcademicClass::orderBy('id','desc')->get();

        return view('mcq.mcq-edit-from',[
            'data' => $data,
            'classes' => $classes
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
            'class_id' => 'required|integer',
            'year' => 'nullable|integer',
            'question' => 'required|string|max:255',
            'option_one' => 'nullable|max:255',
            'option_two' => 'nullable|max:255',
            'option_three' => 'nullable|max:255',
            'option_four' => 'nullable|max:255',
            'currect_ans' => 'nullable|max:255',
        ]);

        $validated['added_by'] = auth()->user()->name;

        $update = Mcq::find($id)->update($validated);
        if($update != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"MCQ Updated Successfully!");

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

        $delete = Mcq::find($id)->delete();

        if($delete != true) {
            return back()->with('error',"Something Worng! Please try again.");
        }

        return back()->with('success',"Deleted Successfully!");
    }
}
