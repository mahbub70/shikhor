@extends('layouts.app')

@section('title')
    <title>Edit - About Us</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('themes/admin/lib/summernote/summernote-bs4.css') }}">
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>About US Edit</h3>
                    </div>
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
                        <form action="{{ route('admin.about-us.edit') }}" method="post" enctype="multipart/form-data" id="about_us_edit_from">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">About Us Title</label>
                                <input type="text" placeholder="Enter Title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('name',$data->title) }}">
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group pt-2">
                                <label for="description_input">Description</label>
                                <div class="rich_editor_desc @error('desc') is-invalid @enderror">
                                    {!! old('desc',$data->desc) !!}
                                </div>
                                <input type="hidden" name="desc" id="description_input">
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" id="about_us_edit_from_btn">Update</button>
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
        $('#about_us_edit_from_btn').click(function(e){
            e.preventDefault();
            var getDescriptionData = $('.rich_editor_desc').summernote('code');
            $('#description_input').val(getDescriptionData);

            $('#about_us_edit_from_btn').unbind();
            $('#about_us_edit_from').submit();

        })
    </script>
@endsection