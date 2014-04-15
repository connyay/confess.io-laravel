<h4 class="blog-post-title">
@if($single)
{{ $confession->hash }}
@else
{{ link_to($confession->url(), $confession->hash) }}
@endif
</h4>
	<ul class="list-unstyled  tags  blog-tags">
	<li><p title="{{ $confession->created_at }}">{{ $confession->date() }}</p></li>
		<li><a href="{{ $confession->
	url() }}#comments">{{$confession->comments->count()}} {{ Str::plural('Comment', $confession->comments->count()) }}</a></li>
</ul>
<p>
@if($single)
{{ $confession->content() }}
@else
{{ Str::words($confession->content()) }}
@endif
</p>
	<div class="text-right">
		<div class="btn-group btn-group-sm" data-toggle="buttons-radio">
		<button data-v="1" data-hash="{{ $confession->hash }}" type="button" class="btn-group btn btn-primary btn-hug"> {{ $confession->hugs->count() }} {{ Str::plural('Hug', $confession->hugs->count()) }}</button>
		@if(!$single && str_word_count($confession->confession) > 100)
		<a href="{{{ $confession->url() }}}" class="btn btn--green" onclick="location.href=this.href;">Read More</a>
		@endif
		<button data-v="-1" data-hash="{{ $confession->hash }}" type="button" class="btn btn-danger btn-shrug">{{ $confession->shrugs->count() }} {{ Str::plural('Shrug', $confession->shrugs->count()) }}</button>
	</div>
</div>
<hr>