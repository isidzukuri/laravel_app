@extends('layouts.app')

@section('meta_title', 'The One[s]s form')

@section('content')
	<form method='POST' action='{{isset($item) ? "/one/{$item->id}" : "/one"}}'>
		
		name <input type="text" name="name" value='{{isset($item) ? $item->name : ""}}' /><br/>
		awesomeness <input type="text" name="awesomeness" value='{{$item->awesomeness or ""}}' /><br/>
		power <input type="text" name="power" value='@if(isset($item)){{ $item->power }}@endif' /><br/>
		<input type="submit" value="fire!!!" />

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<input type="hidden" name="_method" value='{{isset($item) ? "PUT" : "POST"}}' />
		
	</form>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif
@endsection
