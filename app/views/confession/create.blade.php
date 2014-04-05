@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; Write
@stop

{{-- Content --}}
@section('content')
<div class="posts">
    <h1 class="content-subhead">Write</h1>
<div>
    <h4>Rules:</h4>
    <ul>
      <li>
        If you are thinking about suicide please
        <a href="http://www.metanoia.org/suicide/" target="_blank">read this.</a>
      </li>
      <li>Don't use any full names.</li>
      <li>
        Links, email addresses, and phone numbers will cause post to hit spam filter.
      </li>
      <li>
        Please be patient while waiting for your post to show (posts are moderated to prevent spam).
      </li>
    </ul>

<article contenteditable class="editable">
</article>

          <form class="pure-form pure-form-stacked" id="confessions-form" action="{{{ URL::to('n/new') }}}" method="post">
            <input type="hidden" name="_token" value="{{{ Session::getToken() }}}" />
            <textarea autofocus class="editable" tabindex="1" rows="6" id="confessionBox" placeholder="{{$placeHolder}}" name="confession">{{{ Request::old('confession') }}}</textarea>
   
            <p><a href="#formatModal" data-toggle="modal">Formatting Tips</a></p>
            <div class="form-group">
              <input class="pure-button pure-button-primary" tabindex="2" id="submitBtn" disabled type="submit" value="Confess"></div>

          </form>

   
   
  </div>
</div>
<!-- Modals -->

<div id="formatModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Formatting</h4>
      </div>
      <div class="modal-body">
        <p>
          **Hello world** will come out like <strong>Hello world</strong>
        </p>
        <p>
          *Hello world* will come out like <em>Hello world</em>
        </p>
        <p>&gt;Hello world will come out like</p>
        <blockquote>Hello world</blockquote>
        <p></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
    <!-- /.modal-content --> </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div id="createModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Last Step</h4>
      </div>
      <div class="modal-body">
        <p>Once the confession is submitted there is no going back...</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" id="confirm" aria-hidden="true">Confirm</button>
      </div>
    </div>
    <!-- /.modal-content --> </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@section('scripts')
<script src="{{{ asset('assets/js/confess.js') }}}"></script>
<script src="{{{ asset('assets/js/editor.js') }}}"></script>
<script>var editor = new MediumEditor('.editable', {
  placeholder: "{{$placeHolder}}",
  excludedActions: ['a', 'h3', 'h4']
});</script>
@stop
@stop