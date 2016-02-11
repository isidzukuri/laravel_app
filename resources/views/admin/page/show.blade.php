@extends('layouts.app')

@section('meta_title', "{$item['name']} - The One!")

@section('content')
	<h1>Im the One</h1>
	<h2>The {{ $item['name'] }} !!!</h2>
	@foreach ($item as $key => $value)
		<b>{{ $key }}:</b> {{ $value }}<br/>
	@endforeach
@endsection
