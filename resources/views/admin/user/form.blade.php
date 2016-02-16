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
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#general"><% trans("admin.General") %></a></li>
				</ul>

				<div class="tab-content">
				  <div id="general" class="tab-pane fade in active">
				      <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.Name") %></label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="<% trans("admin.name") %>" name="name" value='<%isset($item) ? $item->name : ""%>' maxlength="200" required />
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.email") %></label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="<% trans("admin.email") %>" name="email" value='<%isset($item) ? $item->email : ""%>' maxlength="200" disabled />
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.password") %></label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" placeholder="<% trans("admin.password") %>" name="password" maxlength="200" />
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Roles") %></label>
					    <div class="col-sm-10" ng-controller="SelectBoxController">
							<select class="form-control attach_select_2" multiple="multiple" name="roles_list[]">
							 	@foreach ($roles as $role_id => $role)
					                <option value="<% $role_id %>" <% isset($item) && in_array($role_id, $roles_ids) ? "selected" : '' %>><% $role %></option>
					            @endforeach
							</select>
					    </div>
					  </div>

					 

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

@include("admin.select_box")