@extends('layouts.app')

@section('title')
    <title>About US</title>
@endsection

@section('css')

@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-md-flex justify-content-between align-items-center">
                        <h3>About US</h3>
                        <a href="{{ route('admin.about-us.edit-form') }}" class="btn btn-info">Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="title">
                            <h4>{{ $data->title }}</h4>
                        </div>
                        <div class="desc">
                            <p>{!! $data->desc !!}</p>
                        </div>

                        <div class="images">
                            @if ($data->image != null)
                                <img style="max-width:300px" src="{{ asset('themes/admin/about-us') }}/{{ $data->image }}" alt="Image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection