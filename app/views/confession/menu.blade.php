	<div class="col-md-3 pull-right side-nav">
		<ul class="nav nav-list nav-list-vivid">
			<li class="nav-header">Menu</li>
@if(!Request::is('n/new'))
			<li><a href="{{{ URL::to('n/new') }}}">Confess something</a></li>
@endif
@if(!Request::is('ns'))
			<li><a href="{{{ URL::to('ns') }}}">List Confessions</a></li>
@endif
		</ul>
	</div>