@extends('layouts.master')

@section('container')
	<h1> My Awesome URL Shortener </h1>
	{{ Form::open() }}
		<!-- {{ Form::label('url', "Your long url") }} -->
		{{ Form::text('url') }}
		<!-- {{ Form::submit('shorten') }} -->
	{{ Form::close() }}

	{{ $errors->first('url', '<p class=error>:message</p>') }}
@stop