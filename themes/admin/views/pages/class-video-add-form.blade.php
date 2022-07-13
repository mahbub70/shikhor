@extends('layouts.app')

@section('title')
    <title>Form - Add Class Video</title>
@endsection

@section('css')

<link rel="stylesheet" href="{{ asset('themes/admin/lib/summernote/summernote-bs4.css') }}">
    
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-border-color card-border-color-primary">
                  <div class="card-header card-header-divider">Add Class Video<span class="card-subtitle"></span></div>
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
                    <form action="{{ route('admin.class-video-add') }}" method="POST" id="video_add_form" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group pt-2">
                        <label for="inputTitle">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="inputTitle" type="text" placeholder="Enter Title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputTitle">Description</label>
                        <div class="rich_editor_desc @error('description') is-invalid @enderror">
                            {!! old('description') !!}
                        </div>
                        <input type="hidden" name="description" id="description_input">
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputClassName">Class Name</label>
                        <input class="form-control @error('class_name') is-invalid @enderror" id="inputClassName" type="text" placeholder="Enter Class Name" name="class_name" value="{{ old('class_name') }}">
                        @error('class_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputAuthorInfo">Video Type</label>
                        <select name="type" id="" class="form-control @error('type') is-invalid @enderror">
                            <option value="" selected disabled>Choose One</option>
                            <option value="0" >Free Video</option>
                            <option value="1" >Class Video</option>
                            <option value="2" >Live Video</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputAuthorInfo">Author</label>
                        <input class="form-control @error('author') is-invalid @enderror" id="inputAuthorInfo" type="text" placeholder="Enter Author Info" name="author" value="{{ old('author') }}">
                        @error('author')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputVideoLink">Video Link</label><span> (Make sure the link is embed link.)</span>
                        <input class="form-control @error('link') is-invalid @enderror" id="inputVideoLink" type="text" placeholder="Enter Video Link" name="link" value="{{ old('link') }}">
                        @error('link')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputVideoLink">Upload Video</label>
                        <input class="form-control @error('video_file') is-invalid @enderror" type="file" name="video_file">
                        @error('video_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputVideoThumb">Upload Video Thumbnails (Optional)</label>
                        <input class="form-control @error('video_thumb') is-invalid @enderror" type="file" name="video_thumb">
                        @error('video_thumb')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="video_add_form_btn">Add Video</button>
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
    <script src="{{ asset('themes/admin/lib/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('themes/admin/lib/summernote/summernote-ext-beagle.js') }}"></script>
    <script>
        App.textEditors();
        $(document).ready(function() {
            $('.rich_editor_desc').summernote(
                {
                    height: 200,
                    focus: false
                }
            );
        });
    </script>

    <script>
        // $('#video_add_form_btn').click(function(){
        //     $('#video_add_form').preventDefault;
        // });

        $('#video_add_form_btn').click(function(e){
            e.preventDefault();
            var getDescriptionData = $('.rich_editor_desc').summernote('code');
            $('#description_input').val(getDescriptionData);

            $('#video_add_form_btn').unbind();
            $('#video_add_form').submit();

        })
    </script>
@endsection