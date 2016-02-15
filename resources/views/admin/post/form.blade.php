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
				  <li><a data-toggle="tab" href="#meta_data"><% trans("admin.Meta_data") %></a></li>
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
					    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Tags") %></label>
					    <div class="col-sm-10" ng-controller="SelectBoxController">
							<select class="form-control attach_select_2" multiple="multiple" name="tags_list[]">
							 	@foreach ($tags as $tag_id => $tag)
					                <option value="<% $tag_id %>" <% isset($item) && in_array($tag_id, $tags_ids) ? "selected" : '' %>><% $tag %></option>
					            @endforeach
							</select>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Picture") %></label>
					    <div class="col-sm-10">
							@include("admin.crop")
					    </div>
					  </div>

				  </div>
				  <div id="meta_data" class="tab-pane fade">
				      
				      <div class="form-group">
					    <label for="inputEmail3" class="col-sm-2 control-label"><% trans("admin.Meta_title") %></label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" placeholder="<% trans("admin.Meta_title") %>" name="meta_title" value='<%isset($item) ? $item->meta_tag->meta_title : ""%>' maxlength="200" />
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Meta_description") %></label>
					    <div class="col-sm-10">
					    	<textarea class="form-control" rows="3" maxlength="200" name="meta_description"><% isset($item) ? $item->meta_tag->meta_description : "" %></textarea>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-2 control-label"><% trans("admin.Meta_keywords") %></label>
					    <div class="col-sm-10">
					    	<textarea class="form-control" rows="2" maxlength="200" name="meta_keywords"><% isset($item) ? $item->meta_tag->meta_keywords : "" %></textarea>
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

@include("admin.textangular")
@include("admin.select_box")