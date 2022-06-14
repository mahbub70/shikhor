<?php

namespace App\Http\Controllers;

use App\Models\ClassVideo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class ClassVideoController extends Controller
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
        // Validation for Edit Item
        $validator = Validator::make($request->all(),[
            'title'=>'bail|nullable|max:255',
            'description'=>'bail|nullable|max:5000',
            'class_name'=>'bail|nullable|max:255',
            'type'=>'bail|required|numeric|digits_between:0,2|max:2',
            'author'=>'bail|nullable|string|max:255',
            'link'=>'bail|required_without:video_file',
            'video_file'=>'bail|required_without:link|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
            'video_thumb' => 'bail|required_with:video_file|nullable',
        ]);



        // If Single Validation Fails
        if ($validator->stopOnFirstFailure()->fails()) {
            return  back()->withErrors($validator)->withInput();
        }

        $validated = $validator->safe()->all();
        // $validated = unset($validated["video_file"]);
        $remove_video = Arr::pull($validated,'video_file');

        $validated['created_at'] = Carbon::now();

        // Insert Data Without File
        $insert_id = ClassVideo::insertGetId($validated);

        // Check If the link is not prasent
        if($validated['link'] == "") {
            // Then Receive Video
            if($request->hasFile('video_file')) {
                $video_file = $request->video_file;
                $file_ext = $video_file->getClientOriginalExtension();
                $file_name = $video_file->getClientOriginalName();
                $file_name = explode('.',$file_name);
                $file_name = strtolower(Arr::first($file_name));
                $file_name = preg_replace("/ /i", "-", $file_name);
                $create_new_file_name = $file_name . "-" . uniqid() . $insert_id . "." . $file_ext;

                // Video Thimbnail if have
                $thumb_name="";
                if($request->hasFile('video_thumb')) {
                    $thumb_image = $request->video_thumb;
                    $thumb_ext = $thumb_image->getClientOriginalExtension();

                    $thumb_name = "thumbnail_".uniqid().$insert_id.".".$thumb_ext;
                }else {
                    $thumb_name = null;
                }

                try{
                    $file_moved = File::move($video_file, public_path('themes/admin/class-videos/' . $create_new_file_name));

                    if($file_moved == true) {
                        // Update video information to database
                        $file_update = ClassVideo::find($insert_id)->update([
                            'video_file' => $create_new_file_name,
                        ]);
                        $video_uploaded = true;
                    }
                }catch(Exception $e){
                    if(File::exists(public_path('themes/admin/class-videos/' . $create_new_file_name))) {
                        File::delete(public_path('themes/admin/class-videos/' . $create_new_file_name));
                    }
                    throw ValidationException::withMessages([
                        'video_file' => "Class Video Not Uploaded Properly.",
                    ]);

                }


                if(isset($video_uploaded) && $video_uploaded == true && $thumb_name != null) {
                    try{
                        $thumb_moved = File::move($thumb_image,public_path('themes/admin/thumbnails/'.$thumb_name));
                        if($thumb_moved == true) {
                            $thumb_update = ClassVideo::find($insert_id)->update([
                                'video_thumb' => $thumb_name,
                            ]);
                        }
                    }catch(Exception $e){
                        if(File::exists(public_path('themes/admin/class-videos/' . $create_new_file_name))) {
                            File::delete(public_path('themes/admin/class-videos/' . $create_new_file_name));
                        }

                        if(File::exists(public_path('themes/admin/thumbnails/'.$thumb_name))) {
                            File::delete(public_path('themes/admin/thumbnails/'.$thumb_name));
                        }

                        $remove_from_db = ClassVideo::find($insert_id)->update([
                            'video_thumb' => null,
                            'video_file' => null,
                        ]);

                        throw ValidationException::withMessages([
                            'video_thumb' => "Video Thumbnail Not Uploaded Properly.",
                        ]);

                    }
                }

            }
        }

        return back()->with('success',"Video Added Succfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $all_videos = ClassVideo::orderBy('id','desc')->get();
        return view('pages.all-videos',[
            'all_videos'=>$all_videos,
        ]);
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
    public function destroy($id)
    {
        //
    }
}
