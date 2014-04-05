@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
@parent
&raquo; Read
@stop

{{-- Content --}}
@section('content')

<div class="posts">
    <h1 class="content-subhead">Confessions <span class="content-results">Displaying {{ $confessions->getFrom() }} - {{ $confessions->getTo() }} of {{ $confessions->getTotal() }}</span></h1>
	
		@foreach ($confessions as $confession)
		@include('confession._view')
		@endforeach
{{ $confessions->links() }}
</div>
@section('scripts')
{{ HTML::script('js/vote.js') }}
@stop
@stop