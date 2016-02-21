@extends('layouts.admin')

@section('meta_title', trans("admin.{$controller_route_path}"))

@section('content')

	@include("admin.{$controller_route_path}.menu")
	<div class="clearfix"></div>

	<div class="panel panel-primary"> 
		<div class="panel-heading"> 
			<h3 class="panel-title"><% trans("admin.{$controller_route_path}") %></h3> 
		</div> 
		<div class="container-fluid items_list" >
	 		@foreach ($items as $key => $row)
				<div ng-controller="UploadsListController" class="row" ng-init="url='<% $row['url'] %>'; full_path = '<% $row['full_path'] %>'">
					<div class="col-md-1 col-xs-1">
						@if(in_array($row['extension'],['jpg','png','gif']))
							<img src="<% $row['url'] %>" width="24" height="24" />
						@else
							<img src="/images/file_icons/32px/<% $row['extension'] %>.png" width="24" height="24" />
						@endif
					</div>
					<div class="col-md-1 col-xs-1"><% $row['extension'] %></div>
					<div class="col-xs-12 col-sm-8 col-md-6"><% $row['name'] %></div>
					<div class="col-xs-10 col-md-4 row_action_column">
						<button type="button" class="close delete_item" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<a class="glyphicon glyphicon-link copy_link" href="<% $row['url'] %>" target="_blank"></a>
				    	<div class="clearfix"></div>
				    </div>
				</div>
			@endforeach
		</div>
	</div>
	
@endsection


@section('js_footer')
<script src='/js/angular/admin/uploads_list_controller.js'></script>
@append




