@section('css')
<link href="/css/ngAutocomplete.css" rel="stylesheet" type="text/css" />
@append

@section('js')
<script src='/js/lib/ngAutocomplete.js'></script>
@append

@section('js_footer')
<script src='/js/angular/admin/input_search_controller.js'></script>
@append

@section('plain_js')
	angular_dependencies.push('jkuri.autocomplete');
@append

<div class="form-inline pull-right list_search" ng-controller="InputSearchController">
	<ng-autocomplete 
		ng-model="autocomplete"
		url="<% $action_path %>/autocomplete"
		search-property="title"
		max-results="10"
		delay="300"
		min-length="2"
		theme="blue"
		allow-only-results="false"
		placeholder="<% trans("admin.title") %>">
	</ng-autocomplete>
	<button class="btn btn-primary btn-sm" ng-click="buttonClick()"><% trans("admin.search") %></button>
</div> 