@extends('layouts.app')

@section('title')
    <title>Class Video Instructions</title>
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
                        <h3>Instructions</h3>
                        <a href="{{ route('admin.instruction.edit-form') }}" class="btn btn-info">Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="title">
                            <h4>{{ $data->title }}</h4>
                        </div>
                        <div class="desc">
                            <p>{!! $data->desc !!}</p>
                        </div>
                        <div class="button_text">
                            <button class="btn btn-danger">{{ $data->button_text }}</button>
                        </div>
                        <div class="button_text mt-2">
                            <strong>Button URL:</strong> <span class="">{{ $data->button_link }}</span>
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