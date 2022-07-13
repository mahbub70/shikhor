<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    @yield('title')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/jqvmap/jqvmap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/admin/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('themes/admin/css/app.css') }}" type="text/css"/>

    <style>
      .be-user-nav>li.dropdown>a img {
        width: 32px;
        height: 32px;
        object-fit: cover;
      }
    </style>
    @yield('css')


  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-expand fixed-top be-top-header">
        <div class="container-fluid">
          <div class="be-navbar-header"><a class="navbar-brand" href="#"></a>
          </div>
          <div class="page-title"><span>Dashboard</span></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav float-right be-user-nav">
              <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('themes/admin/users/') }}/{{ Auth::guard('admin')->user()->image }}" alt="Avatar"><span class="user-name">{{ Auth::guard('admin')->user()->name }}</span></a>
                <div class="dropdown-menu" role="menu">     
                  <div class="user-info">
                    <div class="user-name">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="user-position online">Available</div>
                  </div><a class="dropdown-item" href="{{ route('admin.profile.view') }}"><span class="icon mdi mdi-face"></span>Account</a>
                  <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <span class="icon mdi mdi-power"></span>Logout
                </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="{{ route('admin.dashboard') }}">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Menu</li>
                  <li><a href="{{ route('admin.dashboard') }}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                  </li>

                  {{-- Users --}}
                  <li class="parent"><a href="javascript:void(0)"><i class="icon mdi mdi-face"></i><span>Management</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.users-list")?'active':'') }}"><a href="{{ route('admin.users-list') }}">Users</a>
                      </li>
                    </ul>
                  </li>

                  {{-- Videos  --}}
                  <li class="parent {{ ((Route::currentRouteName() == "admin.class-video-edit-form" || Route::currentRouteName() == "admin.class-video.edit")?'active open':'') }}"><a href="#"><i class="icon mdi mdi-collection-video"></i><span>Class Videos</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.all-videos")?'active':'') }}"><a href="{{ route('admin.all-videos') }}">All Videos</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.free-videos")?'active':'') }}"><a href="{{ route('admin.free-videos') }}">Free Classes</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.live-class-videos")?'active':'') }}"><a href="{{ route('admin.live-class-videos') }}">Live Classes</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.class-video-add-form")?'active':'') }}"><a href="{{ route('admin.class-video-add-form') }}">Add Class Video</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.class-video.instruction")?'active':'') }}"><a href="{{ route('admin.class-video.instruction') }}">Instructions</a>
                      </li>
                    </ul>
                  </li>

                  {{-- Products --}}
                  <li class="parent {{ ((Route::currentRouteName()=='admin.category.add-form' || Route::currentRouteName()=='admin.category.edit-form')?'active open':'') }}"><a href="#"><i class="icon mdi mdi-dot-circle"></i><span>Products</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.product.all")?'active':'') }}"><a href="{{ route('admin.product.all') }}">All Products</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.category.all")?'active':'') }}"><a href="{{ route('admin.category.all') }}">Categories</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == 'admin.product.add-form')?'active':'') }}"><a href="{{ route('admin.product.add-form') }}">Add Product</a>
                      </li>
                    </ul>
                  </li>

                  {{-- Success People --}}
                  <li class="parent"><a href="javascript:void(0)"><i class="icon mdi mdi-face"></i><span>Success People</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.success.people.list")?'active':'') }}"><a href="{{ route('admin.success.people.list') }}">Success People List</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.success.people.add-form")?'active':'') }}"><a href="{{ route('admin.success.people.add-form') }}">Add New</a>
                      </li>
                    </ul>
                  </li>

                  {{-- MCQ --}}
                  <li class="parent"><a href="javascript:void(0)"><i class="icon mdi mdi-calendar-note"></i><span>MCQ</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.mcq.list")?'active':'') }}"><a href="{{ route('admin.mcq.list') }}">MCQ List</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.mcq.add-form")?'active':'') }}"><a href="{{ route('admin.mcq.add-form') }}">MCQ Add</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.class.add-form")?'active':'') }}"><a href="{{ route('admin.class.add-form') }}">Add Class</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.class.list")?'active':'') }}"><a href="{{ route('admin.class.list') }}">Class List</a>
                      </li>
                    </ul>
                  </li>

                  {{-- Order --}}
                  <li class="parent"><a href="javascript:void(0)"><i class="icon mdi mdi-view-dashboard"></i><span>Order</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.order.list")?'active':'') }}"><a href="{{ route('admin.order.list') }}">All Orders</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.order.complete-list")?'active':'') }}"><a href="{{ route('admin.order.complete-list') }}">Complete Orders</a>
                      </li>
                      <li class="{{ ((Route::currentRouteName() == "admin.order.create")?'active':'') }}"><a href="{{ route('admin.order.create') }}">Create Order</a>
                      </li>
                    </ul>
                  </li>

                  {{-- About US --}}
                  <li class="parent"><a href="javascript:void(0)"><i class="icon mdi mdi-chart-donut"></i><span>About US</span></a>
                    <ul class="sub-menu">
                      <li class="{{ ((Route::currentRouteName() == "admin.about.us")?'active':'') }}"><a href="{{ route('admin.about.us') }}">About US</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>


      @yield('content')

      <nav class="be-right-sidebar">
        <div class="sb-content">
          <div class="tab-navigation">
            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li class="nav-item" role="presentation"><a class="nav-link active" href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Chat</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Todo</a></li>
              <li class="nav-item" role="presentation"><a class="nav-link" href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Settings</a></li>
            </ul>
          </div>
          <div class="tab-panel">
            <div class="tab-content">
              <div class="tab-pane tab-chat active" id="tab1" role="tabpanel">
                <div class="chat-contacts">
                  <div class="chat-sections">
                    <div class="be-scroller-chat">
                      <div class="content">
                        <h2>Recent</h2>
                        <div class="contact-list contact-list-recent">
                          <div class="user"><a href="#"><img src="assets/img/avatar1.png" alt="Avatar">
                              <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar2.png" alt="Avatar">
                              <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar3.png" alt="Avatar">
                              <div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div>
                        </div>
                        <h2>Contacts</h2>
                        <div class="contact-list">
                          <div class="user"><a href="#"><img src="assets/img/avatar4.png" alt="Avatar">
                              <div class="user-data2"><span class="status"></span><span class="name">Mike Bolthort</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar5.png" alt="Avatar">
                              <div class="user-data2"><span class="status"></span><span class="name">Maggie jackson</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar6.png" alt="Avatar">
                              <div class="user-data2"><span class="status offline"></span><span class="name">Jhon Voltemar</span></div></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="bottom-input">
                    <input type="text" placeholder="Search..." name="q"><span class="mdi mdi-search"></span>
                  </div>
                </div>
                <div class="chat-window">
                  <div class="title">
                    <div class="user"><img src="assets/img/avatar2.png" alt="Avatar">
                      <h2>Maggie jackson</h2><span>Active 1h ago</span>
                    </div><span class="icon return mdi mdi-chevron-left"></span>
                  </div>
                  <div class="chat-messages">
                    <div class="be-scroller-messages">
                      <div class="content">
                        <ul>
                          <li class="friend">
                            <div class="msg">Hello</div>
                          </li>
                          <li class="self">
                            <div class="msg">Hi, how are you?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">Good, I'll need support with my pc</div>
                          </li>
                          <li class="self">
                            <div class="msg">Sure, just tell me what is going on with your computer?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">I don't know it just turns off suddenly</div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="chat-input">
                    <div class="input-wrapper"><span class="photo mdi mdi-camera"></span>
                      <input type="text" placeholder="Message..." name="q" autocomplete="off"><span class="send-msg mdi mdi-mail-send"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane tab-todo" id="tab2" role="tabpanel">
                <div class="todo-container">
                  <div class="todo-wrapper">
                    <div class="be-scroller-todo">
                      <div class="todo-content"><span class="category-title">Today</span>
                        <ul class="todo-list">
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" checked="" id="tck1">
                              <label class="custom-control-label" for="tck1">Initialize the project</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck2">
                              <label class="custom-control-label" for="tck2">Create the main structure							</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck3">
                              <label class="custom-control-label" for="tck3">Updates changes to GitHub							</label>
                            </div>
                          </li>
                        </ul><span class="category-title">Tomorrow</span>
                        <ul class="todo-list">
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck4">
                              <label class="custom-control-label" for="tck4">Initialize the project							</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck5">
                              <label class="custom-control-label" for="tck5">Create the main structure							</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck6">
                              <label class="custom-control-label" for="tck6">Updates changes to GitHub							</label>
                            </div>
                          </li>
                          <li>
                            <div class="custom-checkbox custom-control custom-control-sm"><span class="delete mdi mdi-delete"></span>
                              <input class="custom-control-input" type="checkbox" id="tck7">
                              <label class="custom-control-label" for="tck7" title="This task is too long to be displayed in a normal space!">This task is too long to be displayed in a normal space!							</label>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="bottom-input">
                    <input type="text" placeholder="Create new task..." name="q"><span class="mdi mdi-plus"></span>
                  </div>
                </div>
              </div>
              <div class="tab-pane tab-settings" id="tab3" role="tabpanel">
                <div class="settings-wrapper">
                  <div class="be-scroller-settings"><span class="category-title">General</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st1" id="st1"><span>
                            <label for="st1"></label></span>
                        </div><span class="name">Available</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st2" id="st2"><span>
                            <label for="st2"></label></span>
                        </div><span class="name">Enable notifications</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st3" id="st3"><span>
                            <label for="st3"></label></span>
                        </div><span class="name">Login with Facebook</span>
                      </li>
                    </ul><span class="category-title">Notifications</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st4" id="st4"><span>
                            <label for="st4"></label></span>
                        </div><span class="name">Email notifications</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st5" id="st5"><span>
                            <label for="st5"></label></span>
                        </div><span class="name">Project updates</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st6" id="st6"><span>
                            <label for="st6"></label></span>
                        </div><span class="name">New comments</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st7" id="st7"><span>
                            <label for="st7"></label></span>
                        </div><span class="name">Chat messages</span>
                      </li>
                    </ul><span class="category-title">Workflow</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st8" id="st8"><span>
                            <label for="st8"></label></span>
                        </div><span class="name">Deploy on commit</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <script src="{{ asset('themes/admin/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/perfect-scrollbar/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/jquery.flot.time.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/plugins/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/plugins/curvedLines.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-flot/plugins/jquery.flot.tooltip.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery.sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/countup/countUp.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jqvmap/jquery.vmap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/admin/lib/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//-initialize the javascript
      	App.init();
      	App.dashboard();
      
      });
    </script>

    @yield('js')

  </body>
</html>





{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js', 'themes/admin') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'themes/admin') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        @include('layouts.navigation')

        <main class="py-4">
            {{ $slot }}
        </main>
    </div>
</body>
</html> --}}
