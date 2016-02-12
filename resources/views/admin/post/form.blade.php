@extends('layouts.admin')

@section('meta_title', trans("admin.{$controller_route_path}").' '.trans("admin.form"))

@section('content')
	@include("admin.{$controller_route_path}.menu")

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><% $error %></li>
            @endforeach
        </ul>
    </div>
	@endif
	<div class="panel panel-primary"> 
		<div class="panel-heading"> 
			<h3 class="panel-title"><% trans("admin.{$controller_route_path}").' '.trans("admin.form") %></h3> 
		</div> 
		<div class="panel-body"> 
			<form class="form-horizontal" method='POST' action='<%isset($item) ? "{$action_path}/{$item->id}" : $action_path %>'>
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.title") %></label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" placeholder="<% trans("admin.title") %>" name="title" value='<%isset($item) ? $item->title : ""%>' maxlength="200" required />
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Description") %></label>
			    <div class="col-sm-10">
			    	<textarea class="form-control" rows="3" maxlength="500" name="description"><% isset($item) ? $item->description : "" %></textarea>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.text") %></label>
			    <div class="col-sm-10" ng-controller="TextEditorController">
			    	<div text-angular ng-model="htmlVariable" name="text"></div>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.Published") %></label>
			    <div class="col-sm-10">
			       <select class="form-control" name="published">
					  <option value='0'><% trans("admin.no") %></option>
					  <option value='1' <% isset($item) && $item->published ? "selected" : '' %>><% trans("admin.yes") %></option>
				   </select>

			    </div>
			  </div>

			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<button type="submit" class="btn btn-primary"><% trans("admin.save") %></button>
			    </div>
			  </div>

			  <input type="hidden" name="_token" value="<% csrf_token() %>">
			  <input type="hidden" name="_method" value='<%isset($item) ? "PUT" : "POST"%>' />
			</form>
		</div> 
	</div>
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
	window.admin_data.text_editor = <%% isset($item) ? json_encode($item->text) : "''" %%>;
	angular_dependencies.push('textAngular');
@endsection