@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; {{ $confession->link }}
@stop
{{-- Content --}}
@section('content')
	<div class="col-lg-8 col-lg-offset-2 blog">
	@include('confession._view', array('single'=>true))
	<!-- the comment box -->
	{{ Form::open(array('url' => 'n/'.$confession->link.'/comment', 'class' => 'form-horizontal')) }}
		<div class="form-group">
			<div class="col-12">
			{{ Form::textarea('comment', Request::old('comment'), array('class' => 'form-control', 'placeholder' => 'Enter your nice comment here, please.', 'rows'=>
			'5')) }}
		</div>
	</div>
	{{ Form::submit('Submit', array('class' => 'btn btn-lg btn--green btn-block')) }}
	{{ Form::close() }}
	<p>{{{ $comments->count() }}} {{{ Str::plural('Comment', $comments->count()) }}}</p>
	
	@include('confession._comments')
	{{ $confession->twitterCard() }}
</div>
@section('scripts')
{{ HTML::script('js/vote.js') }}
@stop
@stop