@extends('layouts.admin')

@section('meta_title', $controller_route_path)

@section('content')
	@include("admin.{$controller_route_path}.menu")
	@foreach ($items as $key => $row)
		<b><% $key + 1 %>)</b> <a href="/one/<% $row['id'] %>"><% $row['title'] %></a><br/>
	@endforeach
@endsection
