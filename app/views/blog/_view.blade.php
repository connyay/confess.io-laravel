<!-- Post Title -->
	<div class="row">
		<div class="col-md-12">
		<h5> <strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong>
		</h5>
		<!-- ./ post title -->
		<!-- Post Content -->
		<p>{{ String::tidy(Str::words($post->content)) }}</p>
		@if(str_word_count($post->content) > 100)
		<p>
		<a href="{{{ $post->url() }}}">Continue Reading &raquo;</a>
		</p>
		@endif
		<!-- ./ post content -->
		<!-- Post Footer -->
		<p></p>
		<p> <i class="icon-user"></i>
		by
		<span class="muted">{{{ $post->author->username }}}</span>
		| <i class="icon-calendar"></i>
		{{{ $post->date() }}}
		|
		<i class="icon-comment"></i>
		<a href="{{{ $post->
		url() }}}">{{$post->comments()->count()}} {{ Str::plural('Comment', $post->comments()->count()) }}
		</a>
		</p>
	</div>
</div>
<!-- ./ post footer -->
<hr />