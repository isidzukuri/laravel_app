@extends('layouts.app')

@section('meta_title', 'All One[s]')

@section('content')
	@foreach ($items as $key => $row)
		<b>{{ $key + 1 }})</b> <a href="/one/{{ $row['id'] }}">{{ $row['name'] }}</a><br/>
	@endforeach
	<a href="/one/create">[new one]</a><br/>
@endsection
