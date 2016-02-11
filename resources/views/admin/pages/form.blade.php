@extends('layouts.admin')

@section('meta_title', $controller_route_path)

@section('content')
	@include("admin.{$controller_route_path}.menu")


	<div class="panel panel-primary"> 
		<div class="panel-heading"> 
			<h3 class="panel-title">Panel title</h3> 
		</div> 
		<div class="panel-body"> 
			<form class="form-horizontal" method='POST' action='<%isset($item) ? "{$action_path}/{$item->id}" : $action_path %>'>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" placeholder="title" name="title" value='<%isset($item) ? $item->title : ""%>' />
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Text</label>
			    <div class="col-sm-10" ng-controller="TextEditorController">
			    	<div text-angular ng-model="htmlVariable" name="text"></div>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-primary">Save</button>
			    </div>
			  </div>

			  <input type="hidden" name="_token" value="<% csrf_token() %>">
			  <input type="hidden" name="_method" value='<%isset($item) ? "PUT" : "POST"%>' />
			</form>
		</div> 
	</div>
	

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><% $error %></li>
            @endforeach
        </ul>
    </div>
	@endif
@endsection


@section('js')
<script src='/js/lib/textangular/textAngular-rangy.min.js'></script>
<script src='/js/lib/textangular/textAngular-sanitize.min.js'></script>
<script src='/js/lib/textangular/textAngular.min.js'></script>
@endsection

@section('js_footer')
<script src='/js/angular/admin/text_editor_controller.js'></script>
@endsection

@section('css')
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" >
<link href="/js/lib/textangular/textAngular.css" rel="stylesheet" >
@endsection

@section('plain_js')
	window.admin_data.text_editor = "<% isset($item) ? $item->text : "" %>";
	angular_dependencies.push('textAngular');
@endsection