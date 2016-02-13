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
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#general"><% trans("admin.General") %></a></li>
				  <!-- <li><a data-toggle="tab" href="#meta_data"><% trans("admin.Meta_data") %></a></li> -->
				</ul>

				<div class="tab-content">
				  <div id="general" class="tab-pane fade in active">
				      <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.title") %></label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="<% trans("admin.title") %>" name="title" value='<%isset($item) ? $item->title : ""%>' maxlength="200" required />
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.Published") %></label>
					    <div class="col-sm-10">
					       <select class="form-control" name="published">
							  <option value='1'><% trans("admin.yes") %></option>
							  <option value='0' <% isset($item) && !$item->published ? "selected" : '' %>><% trans("admin.no") %></option>
						   </select>

					    </div>
					  </div>
				  </div>
				  <div id="meta_data" class="tab-pane fade">
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

