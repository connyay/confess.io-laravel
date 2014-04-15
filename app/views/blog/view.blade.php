@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
&raquo; {{{ String::title($post->title) }}}
@stop

{{-- Content --}}
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="breadcrumb-text">
			<p>
				<a href="{{{ URL::to('blog') }}}">Blog</a>
				{{ $post->title }}
			</p>
		</div>
		<h5>{{ $post->title }}</h5>
		<p>
			Posted by {{{ $post->author->username }}} on {{{ $post->date() }}}
		</p>
		<hr>
		<p>{{ $post->content() }}</p>
		<hr>

		<!-- the comment box -->
		<div class="well">
			<p>Leave a Comment:</p>

			<form method="post" action="{{{ URL::to('blog/'.$post->
				slug) }}}">
				<input type="hidden" name="_token" value="{{{ Session::getToken() }}}" />

				<div class="form-group">
					<textarea class="form-control" rows="4" name="comment" id="comment">{{{ Request::old('comment') }}}</textarea>
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>

			</form>

		</div>
	</div>
</div>
@stop