@extends('layouts.app')

@section('title')
  <title>Home - Dashboard</title>
@endsection

@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
          <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Today Login Users</div>
                  <div class="value">
                    <span class="indicator indicator-equal mdi mdi-chevron-right"></span>
                    <span class="number" data-toggle="counter" data-end="{{ $today_login }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Today Register Users</div>
                  <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="{{ $today_register }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Total Users</div>
                  <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up"></span><span class="number" data-toggle="counter" data-end="{{ $users }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Total Admins</div>
                  <div class="value"><span class="indicator indicator-positive mdi mdi-chevron-up""></span><span class="number" data-toggle="counter" data-end="{{ $admins }}">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Total Videos</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $videos }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Free Videos</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $free_videos }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Live Videos</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $live_videos }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Class Videos</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $class_videos }}">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Total Products</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $products }}">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Total Orders</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $orders }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Active Orders</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $active_orders }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Hold Orders</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $hold_orders }}">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="widget widget-tile">
                <div class="data-info">
                  <div class="desc">Complete Orders</div>
                  <div class="value">
                    <span class="number" data-toggle="counter" data-end="{{ $complete_orders }}">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
