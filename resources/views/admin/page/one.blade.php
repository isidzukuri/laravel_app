@extends('layouts.app')

@section('meta_title', 'Title: The One')

@section('content')
	<h1>Im the One</h1>
	<h2>The {{ $name }} !!!</h2>
	@foreach ($user_data as $key => $value)
		<b>{{ $key }}:</b> {{ $value }}<br/>
	@endforeach
@endsection
