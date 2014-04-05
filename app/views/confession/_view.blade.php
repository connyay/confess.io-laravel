<section class="post">
    <header class="post-header">

        <h2 class="post-title"><a href="{{{ $confession->url() }}}">{{ $confession->link }}</a></h2>

        <p class="post-meta">
        	
            {{{ $confession->date }}} &mdash; <a href="{{{ $confession->
				url() }}}">{{$confession->comments()->count()}} {{ Str::plural('Comment', $confession->comments()->count()) }}
			</a>
			
        </p>
    </header>

    <div class="post-body">
        <p>
          {{ Str::words($confession->content()) }}
		@if(str_word_count($confession->confession) > 100)
		<p>
			<a href="{{{ $confession->url() }}}">Continue Reading &raquo;</a>
		</p>
		@endif
        </p>
    </div>


    <button data-v="1" data-id="{{ $confession->
				id }}" type="button" class="pure-button pure-button-hug">{{ $confession->hugs()->count() }} {{ Str::plural('Hug', $confession->hugs()->count()) }}
			</button>
			<button data-v="-1" data-id="{{ $confession->
				id }}" type="button" class="pure-button pure-button-shrug">{{ $confession->shrugs()->count() }} {{ Str::plural('Shrug', $confession->shrugs()->count()) }}
			</button>
</section>