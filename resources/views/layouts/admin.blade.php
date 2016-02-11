<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title')</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/admin.css" rel="stylesheet" type="text/css" />
    @yield('css')

    <script src="/js/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="/js/angular.min.js" type="text/javascript"></script>
    <script src="/js/ui-bootstrap-tpls-1.1.2.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    @yield('js')

    



    <script type="text/javascript" src="js/controllers/basic.js"></script>
    

    

   
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
            <li><a href="/pages">Pages</a></li>
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
            <div class="alert alert-success"><%Session::get('flash_message')%></div> 
        @endif

        @yield('content')

    </div><!-- /.container -->







    


    <script type="text/javascript">
    window.admin_data = {};
    var angular_dependencies = [];
    @yield('plain_js')
    var admin_app = angular.module('adminApp', angular_dependencies); 

    // app.controller('BasicCtrl', function($scope,$document) {
    //     $scope.message = 'die u all smart bastards and chickens';

    // });
    </script>
    @yield('js_footer')
</body>
</html>
