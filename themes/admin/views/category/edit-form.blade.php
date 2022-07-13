@extends('layouts.app')

@section('title')
    <title>Form - Edit Category</title>
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
                  <div class="card-header card-header-divider">Edit Category<span class="card-subtitle"></span></div>
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
                    <form action="{{ route('admin.category.update',encrypt($data->id)) }}" method="POST" id="category_edit_form" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group pt-2">
                        <label for="inputName">Category Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputName" type="text" placeholder="Enter Category Name" name="name" value="{{ old('name',$data->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="inputImage">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="inputImage">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="video_add_form_btn">Update</button>
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

@endsection