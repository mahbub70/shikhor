@extends('layouts.app')

@section('title')
    <title>All Videos</title>
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
                <div class="card-header">Class Video List
                  <div class="tools dropdown"><span class="icon mdi mdi-download"></span><a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"><span class="icon mdi mdi-more-vert"></span></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
                      <div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    @if ($all_videos->count() == 0)
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_videos as $key=>$video)
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
                                <td class="center">{{ (($video->description != "")?substr($video->description,0,30).'...':'Empty') }}</td>
                                <td class="center">{{ (($video->author != "")?substr($video->author,0,30).'...':'Empty') }}</td>
                                <td>{{ CustomHelper::get_class_type($video->type) }}</td>
                                <td class="center">{{ \Carbon\Carbon::parse($video->created_at)->diffForHumans() }}</td>

                                <td class="center">
                                    <a href="#" class="btn btn-primary">Edit</a>    
                                    <a href="#" class="btn btn-danger">Delete</a>    
                                </td>
                              </tr>
                            @endforeach
                          {{-- <tr class="even gradeC">
                            <td>Trident</td>
                            <td>
                              Internet
                              Explorer 5.0
                            </td>
                            <td>Win 95+</td>
                            <td class="center">5</td>
                            <td class="center">C</td>
                          </tr>
                          <tr class="odd gradeA">
                            <td>Trident</td>
                            <td>
                              Internet
                              Explorer 5.5
                            </td>
                            <td>Win 95+</td>
                            <td class="center">5.5</td>
                            <td class="center">A</td>
                          </tr> --}}
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