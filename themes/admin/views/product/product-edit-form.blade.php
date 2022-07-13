@extends('layouts.app')

@section('title')
    <title>Form - Edit Product</title>
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
                  <div class="card-header card-header-divider">Edit Product<span class="card-subtitle"></span></div>
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
                    <form action="{{ route('admin.product.update',encrypt($data->id)) }}" method="POST" id="product_edit_form" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group pt-2">
                        <label for="inputName">Book Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="inputName" type="text" placeholder="Enter Book Name" name="name" value="{{ old('name',$data->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputWritter">Writter Name (Optional)</label>
                        <input class="form-control @error('writter') is-invalid @enderror" id="inputWritter" type="text" placeholder="Enter Writter Name" name="writter" value="{{ old('writter',$data->writter) }}">
                        @error('writter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
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
                        <label for="categoryName">Category Name</label>
                        <select name="category_id" id="categoryName" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="" selected disabled>Choose One</option>
                            @foreach ($categories as $item)
                                <option value="<?=($item->id)?>"><?=($item->name)?></option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input class="form-control @error('qty') is-invalid @enderror" id="quantity" type="number" placeholder="Enter Book Quantity" name="qty" value="{{ old('qty',$data->qty) }}">
                        @error('qty')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="Bprice">Price</label>
                        <input class="form-control @error('price') is-invalid @enderror" id="Bprice" type="number" placeholder="Enter Book Price" name="price" value="{{ old('price',$data->price) }}">
                        @error('price')
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
                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="product_edit_form_btn">Add Book</button>
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
        $('#product_edit_form_btn').click(function(e){
            e.preventDefault();
            var getDescriptionData = $('.rich_editor_desc').summernote('code');
            $('#description_input').val(getDescriptionData);

            $('#product_edit_form_btn').unbind();
            $('#product_edit_form').submit();

        })
    </script>
@endsection