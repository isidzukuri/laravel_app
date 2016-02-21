@extends('layouts.admin')

@section('meta_title', trans("admin.{$controller_route_path}").' '.trans("admin.form"))

@section('content')
	@include("admin.{$controller_route_path}.menu")
	<div class="clearfix"></div>

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

				<div class="tab-content">
				  <div id="general" class="tab-pane fade in active">
				      <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.Uploads") %></label>
					    <div class="col-sm-10">
					      @include("admin.fileupload")
					    </div>
					  </div>

					  
				  </div>
				  
				</div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      	<a href="<% $action_path %>" class="btn btn-primary"><% trans("admin.complete") %></a>
			    </div>
			  </div>

			  <input type="hidden" name="_token" value="<% csrf_token() %>">
			  <input type="hidden" name="_method" value='<%isset($item) ? "PUT" : "POST"%>' />
			</form>
		</div> 
	</div>
@endsection

@include("admin.textangular")
@include("admin.select_box")