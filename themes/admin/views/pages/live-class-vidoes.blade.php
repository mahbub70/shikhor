@extends('layouts.app')

@section('title')
    <title>Live Class Videos</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"/>

    <style>
        div.dataTables_wrapper div.dataTables_length label select.form-control-sm {
            width: 60px !important;
        }
    </style>
@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
              <div class="card card-table">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <span>Live Class Videos</span>
                  <a href="{{ route('admin.class-video-add-form') }}" class="btn btn-primary">Add Video</a>
                </div>
                <div class="card-body">
                    @if ($videos->count() == 0)
                        <div class="text-dark text-center p-4 font-weight-bold">No Data Found!</div>
                    @else
                    <table class="table table-striped table-hover table-fw-widget" id="table4">
                        <thead>
                          <tr>
                            <th>SL NO</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Type</th>
                            <th>Upload Time</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $key=>$video)
                            <tr class="odd gradeX">
                                <td>{{ $key+1 }}</td>
                                <td>
                                    @if ($video->video_thumb != "")
                                        <img style="width: 50px" src="{{ asset('themes/admin/thumbnails') }}/{{ $video->video_thumb }}" alt="Thumbnails">
                                    @else
                                        <span>Empty</span>
                                    @endif
                                </td>
                                <td class="center">{{ (($video->title != "")?substr($video->title,0,20).'...':'Empty') }}</td>
                                <td class="center">{!! (($video->description != "")?substr($video->description,0,30).'...':'Empty') !!}</td>
                                <td class="center">{{ (($video->author != "")?substr($video->author,0,30).'...':'Empty') }}</td>
                                <td>{{ CustomHelper::get_class_type($video->type) }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($video->created_at)->diffForHumans() }}</td>

                                <td>{{ CustomHelper::get_status($video->status) }}</td>

                                <td class="center">
                                    <a href="{{ route('admin.class-video-edit-form',encrypt($video->id)) }}" class="btn btn-primary">Edit</a>    
                                    <a href="{{ route('admin.class-video.delete',encrypt($video->id)) }}" class="btn btn-danger videoDeleteBtn" onclick="event.preventDefault(); if(confirm('Are You Sure?') === true) {
                                        document.getElementById('class-video-del-form').submit();
                                      }
                                        ">Delete</a>    
                                </td>
                                <form id="class-video-del-form" action="{{ route('admin.class-video.delete',encrypt($video->id)) }}" method="POST" class="d-none">
                                    @csrf
                                  </form>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                    @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script src="{{ asset('themes/admin/lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

<script src="{{ asset('themes/admin/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>


{{-- Alternative Start --}}
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/jszip/jszip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/pdfmake/pdfmake.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/pdfmake/vfs_fonts.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('themes/admin/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
{{-- Alternative End --}}




<script>
    $(document).ready(function(){
        App.dataTables();
    });
</script>
@endsection