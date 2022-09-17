<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ModernTechTrgAdmin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <link href="{{ asset('assets/css/demo/style.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('assets/images/slidebar/sidebar-bg.jpg') }}" rel="stylesheet" type="text/css" />
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('assets/adminpanel1/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/adminpanel1/') }}/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- datatable libraries: -->
  <link rel="stylesheet" href="{{ asset('assets/adminpanel1/') }}/bower_components/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/') }}/bootstrap-tagsinput.css">
  <!-- <link rel="stylesheet" href="{{ asset('assets/adminpanel1/') }}/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
  <!-- <script src="{{ asset('assets/adminpanel1/') }}/bower_components/jquery/dist/jquery.min.js"></script> -->
  <!-- <script src="{{ asset('assets/adminpanel1/') }}/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
  
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
    .mdc-card.info-card .card-inner{
      margin: 0px;
    }

    .dataTables_paginate{
    float: right;
  }

  .dataTables_paginate .pagination .paginate_button{
    background: lightgrey;
    padding:10px;
    margin:5px;
    border-radius: 3px;
  }

  .dataTables_paginate .pagination .paginate_button a{
    color: black;
  }

  .table>:not(caption)>*>*{
    border: none;
  }
  </style>
</head>

<body>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-drawer mdc-drawer--dismissible mdc-drawer--open">
      <div class="mdc-drawer__header">
        <a href="{{route('dashboard')}}" class="brand-logo">
       Modern
        </a>
      </div>
      <div class="mdc-drawer__content">
        
        <div class="mdc-list-group">
          <nav class="mdc-list mdc-drawer-menu">
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-drawer-link" href="{{route('dashboard')}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
                Dashboard
              </a>
            </div>
            @php
              $i=1;
            @endphp
            @foreach($sidemenu as $sm)
            @if(count($sm->options) == 1)
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="{{route($sm->options[0]->redirect_link)}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
              {{ $sm->options[0]->option_name }}
              </a>
            </div>
            @elseif(count($sm->options) > 1)
            <div class="mdc-list-item mdc-drawer-item">
              <a class="mdc-expansion-panel-link" href="#" data-toggle="expansionPanel" data-target="ui-sub-menu{{$i}}">
                <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true"></i>
              {{ $sm->module_name }}
                <i class="mdc-drawer-arrow material-icons">chevron_right</i>
              </a>
              <div class="mdc-expansion-panel" id="ui-sub-menu{{$i}}">
                <nav class="mdc-list mdc-drawer-submenu">
                  @foreach($sm->options as $o)
                  <div class="mdc-list-item mdc-drawer-item">
                    <a class="mdc-drawer-link" href="{{route($o->redirect_link)}}">
                     {{ $o->option_name }}
                    </a>
                  </div>
                  @endforeach
                </nav>
              </div>
            </div>   
            @endif
            @php
            $i++;
            @endphp
          @endforeach

          </nav>
        </div>
      
    
      </div>
    </aside>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <header class="mdc-top-app-bar">
        <div class="mdc-top-app-bar__row">
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          
            <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button sidebar-toggler">menu</button>
            <a href="{{route('dashboard')}}">
            <span class="mdc-top-app-bar__title">Modern Technology</span>
</a>
          </div>
          <div class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end mdc-top-app-bar__section-right">
            <div class="menu-button-container menu-profile d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <span class="d-flex align-items-center">
                  <span class="figure">
                    <img src="https://media.istockphoto.com/vectors/user-member-vector-icon-for-ui-user-interface-or-profile-face-avatar-vector-id1130884625?k=20&m=1130884625&s=612x612&w=0&h=OITK5Otm_lRj7Cx8mBhm7NtLTEHvp6v3XnZFLZmuB9o=" alt="user" class="user">
                  </span>
                  <span class="user-name">{{ Auth::user()->name }}</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-account-edit-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Edit profile</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-settings-outline text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <a href="{{ route('logout') }}"  
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" 
                      class="item-subject font-weight-normal">Logout</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="divider d-none d-md-block"></div>
           
           
            <div class="menu-button-container">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-bell"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <h6 class="title"> <i class="mdi mdi-bell-outline mr-2 tx-16"></i> Notifications</h6>
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon">
                      <i class="mdi mdi-email-outline"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Modern Techn1</h6>
                      <small class="text-muted"> 6 min ago </small>
                    </div>
                  </li>
            
                 
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon">
                      <i class="mdi mdi-update"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">You have a new update</h6>
                      <small class="text-muted"> 3 days ago </small>
                    </div>
                  </li> 
                </ul>
              </div>
            </div>
            <div class="menu-button-container">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-email"></i>
                <span class="count-indicator">
                  <span class="count">3</span>
                </span>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <h6 class="title"><i class="mdi mdi-email-outline mr-2 tx-16"></i> Messages</h6>
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail">
                      <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG.png" alt="user">
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">User1 Information</h6>
                      <small class="text-muted"> 1 Minutes ago </small>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail">
                      <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG.png" alt="user">
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">User2 Information</h6>
                      <small class="text-muted"> 15 Minutes ago </small>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail">
                      <img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG.png" alt="user">
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">User3 Information</h6>
                      <small class="text-muted"> 18 Minutes ago </small>
                    </div>
                  </li>                
                </ul>
              </div>
            </div>
            <div class="menu-button-container d-none d-md-block">
              <button class="mdc-button mdc-menu-button">
                <i class="mdi mdi-arrow-down-bold-box"></i>
              </button>
              <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-lock-outline text-primary"></i>
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Lock screen</h6>
                    </div>
                  </li>
                  <li class="mdc-list-item" role="menuitem">
                    <div class="item-thumbnail item-thumbnail-icon-only">
                      <i class="mdi mdi-logout-variant text-primary"></i>                      
                    </div>
                    <div class="item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="item-subject font-weight-normal">Logout</h6>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </header>
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

         @if ($error_ = Session::get('error_'))
        <div class="container">
            <div class="alert alert-danger">
                <p>{{ $error_ }}</p>
            </div>
        </div>
        @endif
      @yield('content')

      <div class="modal" tabindex="-1" id="myModal">
        <!-- <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div> -->

      </div>
      <!-- <div class="modal fade" id="myModal" role="dialog"> -->
      </div>
      <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <!-- endinject -->
      <!-- Plugin js for this page-->
      <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
      <!-- <script src="../assets/vendors/chartjs/Chart.min.js"></script> -->
      <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
      <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
      <!-- End plugin js for this page-->
      <!-- inject:js -->
      <script src="{{ asset('assets/js/material.js') }}"></script>
      <script src="{{ asset('assets/js/misc.js') }}"></script>

      <script src="{{ asset('assets/js/dashboard.js') }}"></script>
      
      <script src="{{ asset('assets/adminpanel1/') }}/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="{{ asset('assets/adminpanel1/') }}/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="{{ asset('assets/adminpanel1/ckeditor') }}/ckeditor.js"></script>
      <script src="{{ asset('assets/js') }}/bootstrap-tagsinput.js"></script>
      
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script type="text/javascript">
        // $(document).ready(function(){
        //   console.log('asdasd');
        //   $(document).on('click', '.load_m', function(e){
        //     e.preventDefault();
        //     var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
        //       keyboard: false
        //     });

        //     // var url = $(this).attr("href");
        //     // $('#myModal').load(url);
        //     // $.ajax({
        //     //   url: $(this).attr("href"),
        //     //   type: 'GET',
        //     //   data: {},
        //     //   success: function(data) {
        //     //     $('#myModal').html(data);
        //     //   }
        //     // });
        //     myModal.show();
        //     // $('#myModal').modal('show').find('.modal-body').load($(this).data("remote"));
        //       // $($(this).data("target")+' .modal-body').load($(this).data("remote"));
        //   });
        // });

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'))
        var options = {
            html: true,
        }
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
          return new bootstrap.Popover(popoverTriggerEl,options)
        });


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


         CKEDITOR.replace( 'editor1', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    }); 
    CKEDITOR.replace( 'editor2', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    }); 
    CKEDITOR.replace( 'editor3', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    }); 
    CKEDITOR.replace( 'editor4', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    }); 
    CKEDITOR.replace( 'Responsibilities', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    }); 
    CKEDITOR.replace( 'summery', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    });
    CKEDITOR.replace( 'description', { 
    enterMode: CKEDITOR.ENTER_BR, 
    on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    });
    // CKEDITOR.replace( 'profile', { 
    // enterMode: CKEDITOR.ENTER_BR, 
    // on: {'instanceReady': function (evt) { evt.editor.execCommand('');}},
    // });
      </script>
  @yield('footer')
</body>
</html>
