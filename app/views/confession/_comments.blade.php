<ol class="rectangle-list">
@foreach ($comments as $comment)
<li class="pure-u-1-2">
	<div>
		<p>{{ $comment->content() }}</p>
		<h5><small><em>{{{ $comment->date() }}}</em></small></h5>
	</div>
</li>
@endforeach
</ol>
