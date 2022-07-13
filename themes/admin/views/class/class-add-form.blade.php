@extends('layouts.app')

@section('title')
    <title>Form - Add Class</title>
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
                  <div class="card-header card-header-divider">Add Class<span class="card-subtitle"></span></div>
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
                    <form action="{{ route('admin.class.add') }}" method="POST" id="people_add_form" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group pt-2">
                        <label for="inputName">Class Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputName" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="description_input">Description</label>
                        <div class="rich_editor_desc @error('desc') is-invalid @enderror">
                            {!! old('desc') !!}
                        </div>
                        <input type="hidden" name="desc" id="description_input">
                        @error('desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="people_add_form_btn">Add Class</button>
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
        $('#people_add_form_btn').click(function(e){
            e.preventDefault();
            var getDescriptionData = $('.rich_editor_desc').summernote('code');
            $('#description_input').val(getDescriptionData);

            $('#people_add_form_btn').unbind();
            $('#people_add_form').submit();

        })
    </script>
@endsection