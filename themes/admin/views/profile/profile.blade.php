@extends('layouts.app')

@section('title')
    <title>Profile</title>
@endsection

@section('css')
    <style>
      .user-display-avatar img {
        object-fit: cover;
      }
    </style>
@endsection


@section('content')
<div class="be-content" style="margin-top:30px">
    <div class="main-content container-fluid">
      <div class="user-profile">
            @if (session('success'))
                <div class="alert alert-success p-3 w-50 mt-2 m-auto">
                    <strong>Success!</strong> {!! session('success') !!}
                </div>                        
            @endif
            @if (session('error'))
                <div class="alert alert-danger p-3 w-50 mt-2 m-auto">
                    <strong>Faild!</strong> {!! session('error') !!}
                </div>                        
            @endif
        <div class="row mt-2">
          <div class="col-lg-5">
            <div class="user-display" style="min-height: 100px">
              <div class="user-display-bottom">
                <div class="user-display-avatar"><img src="{{ asset('themes/admin/users') }}/{{ Auth::user()->image }}" alt="Profile Image"></div>
                <div class="user-display-info">
                  <div class="name">{{ Auth::user()->name }}</div>
                </div>
              </div>
            </div>
            <div class="user-info-list card">
              <div class="card-header card-header-divider">Change Password</div>
              <div class="card-body">
                {{-- Password Changing Form --}}
                    <form action="{{ route('admin.profile.password.update') }}" method="post">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="oldPassword">Old Password</label>
                            <input class="form-control @error('old_password') is-invalid @enderror" id="oldPassword" type="password" placeholder="Enter Old Password" name="old_password">
                            @error('old_password')
                                <div class="alert alert-danger p-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input class="form-control @error('new_password') is-invalid @enderror" id="newPassword" type="password" placeholder="Enter New Password" name="new_password">
                            @error('new_password')
                                <div class="alert alert-danger p-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword" class="form-label">Conform Password</label>
                            <input type="password" placeholder="Enter Confirm Password" name="new_password_confirmation" id="confirmPassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="widget widget-fullwidth widget-small">
              <div class="widget-head pb-6">
                <div class="title">Update Information</div>
              </div>
              <div class="widget-chart-container p-3">
                {{-- Profile Name and Image Changing Form --}}
                <form action="{{ route('admin.profile.update.information') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="profileImage">Change Profile Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    @error('image')
                      <div class="alert alert-danger p-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Change Name</label>
                    <input type="text" placeholder="Enter Name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}">
                    @error('name')
                      <div class="alert alert-danger p-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <button type="text" name="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
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