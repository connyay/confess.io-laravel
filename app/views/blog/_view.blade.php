
<h4 class="blog-post-title">
@if ($single) {{ $post->title }}
@else {{ link_to($post->url(), $post->title) }}
@endif
</h4>
<ul class="list-unstyled  tags  blog-tags">
    <li><p title="{{ $post->created_at }}">{{ $post->date() }}</p></li>
    <li><p title="{{ $post->author->username }}">{{ $post->author->username }}</p></li>
</ul>
<p>
@if ($single) {{ $post->content() }}
@else {{ Str::words($post->content()) }}
@endif
</p>
@if(!$single && str_word_count($post->content) > 100)
<div class="text-right">
<a href="{{{ $post->url() }}}" class="btn btn-sm btn--green">Read More</a>
</div>
@endif
<hr />