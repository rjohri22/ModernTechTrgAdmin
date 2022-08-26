<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ModernTechTrgAdmin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- datatable libraries: -->
  
  <link rel="stylesheet" href="{{ url('assets/adminpanel1/') }}/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <style type="text/css">
    #overlay {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 100; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }

    #overlay h3{
      position: absolute;
      color: white;
      top: 50%;
      /* z-index: 9999999999999; */
      left: 50%;
    }
  </style>
</head>
@php
  use App\Models\User;
  $user_id = Auth::user()->id;
  $login_details = User::join('bends','bends.id','=','users.bend_id')->where('users.id',$user_id)->select(['users.id as user_id','bends.*'])->first();
@endphp
<body class="hold-transition skin-blue sidebar-mini">
  <div id="overlay">
    <h3>Loading Please Wait ...</h3>
    <i class="fa fa-refresh fa-spin"></i>
  </div>
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TRG Admin</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>TRG Admin</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ url('assets/adminpanel1/') }}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs"> {{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ url('assets/adminpanel1/') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  <p>
                   {{ Auth::user()->name }}
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{route('admin.view_profile')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  
                  <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ url('assets/adminpanel1/') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p> {{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <!-- <li class="header">MAIN NAVIGATION</li> -->
          <li>
            <a href="{{route('dashboard')}}">
              <i class="fa fa-th"></i> <span>Dashbaord</span>
            </a>
          </li>
          @foreach($sidemenu as $sm)
            @if(count($sm->options) == 1)
              <li>
                <a href="{{route($sm->options[0]->redirect_link)}}">
                  <i class="fa fa-th"></i> <span>{{ $sm->options[0]->option_name }}</span>
                </a>
              </li>
            @elseif(count($sm->options) > 1)
              <li class="treeview" style="height: auto;">
                <a href="#">
                  <i class="fa fa-share"></i> <span>{{ $sm->module_name }}</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu" style="display: none;">
                  @foreach($sm->options as $o)
                    <li>
                      <a href="{{route($o->redirect_link)}}">
                        <i class="fa fa-circle-o"></i> <span>{{ $o->option_name }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>     
            @endif
          @endforeach


<!--



          <li class="treeview" style="height: auto;">
            <a href="#">
              <i class="fa fa-share"></i> <span>Recruitment</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="{{route('admin.oppertunities')}}">
                  <i class="fa fa-circle-o"></i> <span>Job Description</span>
                </a>
              </li>

              <li>
                <a href="{{route('admin.jobs')}}">
                  <i class="fa fa-circle-o"></i> <span>Jobs</span>
                </a>
              </li>

              <li>
                <a href="{{route('admin.groups')}}">
                  <i class="fa fa-circle-o"></i> <span>Approved Jobs</span>
                </a>
              </li>
            </ul>
          </li> 

          <li class="treeview" style="height: auto;">
            <a href="#">
              <i class="fa fa-share"></i> <span>Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="{{route('admin.groups')}}">
                  <i class="fa fa-circle-o"></i> <span>Groups</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.oppertunities')}}">
                  <i class="fa fa-circle-o"></i> <span>Departments</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.designations','all')}}">
                  <i class="fa fa-circle-o"></i> <span>Designations</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.states','all')}}">
                  <i class="fa fa-circle-o"></i> <span>States</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.cities','all')}}">
                  <i class="fa fa-circle-o"></i> <span>Cities</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.busniess','all')}}">
                  <i class="fa fa-circle-o"></i> <span>Business</span>
                </a>
              </li>
            </ul>
          </li>          
          <li class="treeview" style="height: auto;">
            <a href="#">
              <i class="fa fa-share"></i> <span>Setting</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li>
                <a href="{{route('admin.setting.emailsmtp')}}">
                  <i class="fa fa-circle-o"></i> <span>Email SMTP Setting</span>
                </a>
              </li>
            </ul>
          </li>     
          <li>
                <a href="{{route('admin.bends')}}">
                  <i class="fa fa-circle-o"></i> <span>Bands</span>
                </a>
              </li>     
              <li>
                <a href="{{route('admin.job_seeker')}}">
                  <i class="fa fa-circle-o"></i> <span>Employees</span>
                </a>
              </li>
              <li>
                <a href="{{route('admin.business_locations')}}">
                  <i class="fa fa-circle-o"></i> <span>Business Location</span>
                </a>
              </li>
  -->

          </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
      </section>
      <!-- Main content -->
      <section class="content">
        @if ($errors->any())
        <div class="container">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="container">
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        </div>
        @endif
        @yield('content')
        <div class="modal fade" id="myModal" role="dialog">
        </div>
      </section>
      <!-- /.content -->
    </div>
  <!-- jQuery 3 -->
  
  <!-- jQuery UI 1.11.4 -->
  
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button);

  $(document).ready(function(){
    console.log('asdasd');
    $(document).on('click', '[data-toggle="modal"]', function(){
      $.ajax({
        url: $(this).attr("href"),
        type: 'GET',
        data: {},
        success: function(data) {
          $('#myModal').html(data);
        }
      });
      $('#myModal').modal('show');
      // $('#myModal').modal('show').find('.modal-body').load($(this).data("remote"));
        // $($(this).data("target")+' .modal-body').load($(this).data("remote"));
    });
  });
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/raphael/raphael.min.js"></script>
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/morris.js/morris.min.js"></script>
  <!-- Sparkline -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="{{ url('assets/adminpanel1/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="{{ url('assets/adminpanel1/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/moment/min/moment.min.js"></script>
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ url('assets/adminpanel1/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="{{ url('assets/adminpanel1/') }}/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ url('assets/adminpanel1/') }}/dist/js/adminlte.min.js"></script>
  <!-- scripts for datatables -->

  <script src="{{ url('assets/adminpanel1/') }}/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('assets/adminpanel1/') }}/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(function () {
   
    $('.datatable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
  </script>
  @yield('footer')
</body>
</html>
