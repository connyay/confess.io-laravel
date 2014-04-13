@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; {{ $confession->link }} 
@stop

{{-- Content --}}
@section('content')
	<div class="col-lg-8 col-lg-offset-2 blog">
		@include('confession._view')
		
		<!-- the comment box -->

			<p>Leave a Comment:</p>
			<form class="pure-form pure-form-stacked" method="post" action="{{{ URL::to('n/'.$confession->
				link) }}}">
			<input type="hidden" name="_token" value="{{{ Session::getToken() }}}" />
			<textarea rows="5" class="pure-u-1-2" name="comment" id="comment" placeholder="Enter your nice comment here, please.">{{{ Request::old('comment') }}}</textarea>

				<button type="submit" class="pure-button pure-button-primary">Submit</button>
			</form>

		<p>{{{ $comments->count() }}} {{{ Str::plural('Comment', $comments->count()) }}}</p>

@include('confession._comments')



{{ $confession->twitterCard() }}
</div>
@section('scripts')
{{ HTML::script('js/vote.js') }}
@stop
@stop