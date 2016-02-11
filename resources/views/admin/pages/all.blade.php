@extends('layouts.admin')

@section('meta_title', $controller_route_path)

@section('content')
	@include("admin.{$controller_route_path}.menu")

	<div class="panel panel-primary"> 
		<div class="panel-heading"> 
			<h3 class="panel-title"><% $controller_route_path %></h3> 
		</div> 
		<div class="container-fluid items_list" >
	 		@foreach ($items as $key => $row)
				<div ng-controller="RowInListController" class="row" ng-click="open_item()" ng-init="href='<% $action_path %>/<% $row['id'] %>'; id = <% $row['id'] %>">
				  <div class="col-xs-12 col-sm-6 col-md-8"><% $row['title'] %></div>
				  <div class="col-xs-6 col-md-4">
				  	<button  ng-click="delete_item()" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  </div>
				</div>
			@endforeach
		</div>
	</div>
	
@endsection
