<p>{{{ $confession->comments->count() }}} {{{ Str::plural('Comment', $confession->comments->count()) }}}</p>
<a id="comments"><ul class="media-list"></a>
<? $count = 0; ?>
@foreach ($confession->comments as $comment)
<li class="media">
	<hr>
	<div class="pull-left">
      <p><b>{{ ++$count }}</b><p>
    </div>
	<div class="media-body">
      <h6 class="media-heading"><em>{{ $comment->date() }}</em></h6>
      <p>{{ $comment->content() }}</p>
    </div>
</li>
@endforeach
</ul>
