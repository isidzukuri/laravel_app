<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title')</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    @yield('css')
    <link href="/css/admin.css" rel="stylesheet" type="text/css" />

    <script src="/js/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="/js/angular.min.js" type="text/javascript"></script>
    <!-- <script src="/js/ui-bootstrap-tpls-1.1.2.min.js" type="text/javascript"></script> -->
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    @yield('js')   
</head>
<body ng-app="adminApp">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/admin">Home</a></li>
            <li><a href="/admin/page"><% trans("admin.page") %></a></li>
            <li><a href="/admin/post"><% trans("admin.post") %></a></li>
            <li><a href="/admin/blog_tag"><% trans("admin.blog_tag") %></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container admin_content">
<!-- 
        <div ng-controller="BasicCtrl">
        {{message}}
        </div> -->

        @if(Session::has('flash_message'))
            <div class="alert alert-<%Session::get('flash_message')['status']%> alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <%% Session::get('flash_message')['message'] %%>
            </div>
        @endif

        @yield('content')

    </div><!-- /.container -->








   <!-- dd(DB::getQueryLog())  --> 


    <script type="text/javascript">
        window.admin_data = {};
        var angular_dependencies = [];
        @yield('plain_js')
        var admin_app = angular.module('adminApp', angular_dependencies); 
    </script>
    <script src='/js/angular/admin/row_in_list_controller.js'></script>
    @yield('js_footer')
</body>
</html>
