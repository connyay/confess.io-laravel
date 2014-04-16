@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; 404
@stop
{{-- Content --}}
@section('content')
	<div class="col-lg-8 col-lg-offset-2 blog">
		<div class="text-center">
		<h1>404</h1>
		<p>Something bad happened. We couldn't find that.<p>
	</div>
</div>
@stop