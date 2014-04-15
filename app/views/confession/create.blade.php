@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; Write
@stop
{{-- Content --}}
<?
$placeHolderArr = ["What is on your mind?", "Something you want to get off your chest?",
"Something bothering you?", "Lay it on us.", "Want to talk about it?"];
$placeHolder = $placeHolderArr[array_rand($placeHolderArr)];
?>
@section('content')
  <div class="col-lg-8 col-lg-offset-2">
  <h4 class="contact--title">Rules:</h4>
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

  {{ Form::open(array('url' => 'n/new', 'class' => 'form-horizontal', 'id'=>'confessions-form')) }}
    <div class="form-group">
      <div class="col-12">
      {{ Form::textarea('confession', null, array('id'=>'confessionBox', 'class' => 'form-control', 'placeholder' => $placeHolder, 'rows'=>
      '5')) }}
    </div>
  </div>
    <div class="text-right">
    <button class="btn btn--green btn-xs" data-toggle="modal" data-target="#formatModal">Formatting</button>
  </div>
  {{ Form::honeypot('name', 'email') }}
  {{ Form::submit('Confess', array('id'=>'submitBtn', 'class' => 'btn btn-lg btn--green', 'disabled' => '')) }}
  {{ Form::close() }}
  
  
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
      <button class="btn btn-sm btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
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
{{ HTML::script('js/confess.js') }}
@stop
@stop