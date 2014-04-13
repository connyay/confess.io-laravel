<h4 class="blog-post-title"><a href="{{{ $confession->url() }}}">{{ $confession->link }}</a></h4>
	<ul class="list-unstyled  tags  blog-tags">
	<li><p title="{{ $confession->created_at }}">{{ $confession->date() }}</p></li>
		<li><a href="{{{ $confession->
	url() }}}">{{$confession->comments()->count()}} {{ Str::plural('Comment', $confession->comments()->count()) }}</a></li>
</ul>
<p>
{{ Str::words($confession->content()) }}
</p>
<div class="text-right">
	<div class="btn-group btn-group-sm" data-toggle="buttons-radio">
	<button data-v="1" data-id="{{ $confession->id }}" type="button" class="btn-group btn btn-primary btn-hug"> {{ $confession->hugs()->count() }} {{ Str::plural('Hug', $confession->hugs()->count()) }}</button>
	@if(str_word_count($confession->confession) > 100)
	<a href="{{{ $confession->url() }}}" class="btn btn--green">Read More</a>
	@endif
	<button data-v="-1" data-id="789" type="button" class="btn btn-danger btn-shrug">{{ $confession->shrugs()->count() }} {{ Str::plural('Shrug', $confession->shrugs()->count()) }}</button>
</div>
</div>