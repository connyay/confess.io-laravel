@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; Read
@stop
{{-- Content --}}
@section('content')
	<div class="col-lg-8 col-lg-offset-2 blog">
	<h6 class="blog-post-sub-title text-right">Displaying {{ $confessions->getFrom() }} - {{ $confessions->getTo() }} of {{ $confessions->getTotal() }} Confessions</h6>
	
	@foreach ($confessions as $confession)
	@include('confession._view')
	<hr>
	@endforeach
	<div class="text-center">
		{{ $confessions->links() }}
	</div>
	
</div>
@section('scripts')
{{ HTML::script('js/vote.js') }}
@stop
@stop