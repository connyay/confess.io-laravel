@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; About
@stop
{{-- Content --}}
@section('content')
<?php $name = 'Confess.io'; ?>
    <div class="col-lg-8 col-lg-offset-2 blog">
    <h4>What is {{ $name }}?</h4>
    <p>{{ $name }} is a place where you can post and read 100% anonymous online confessions. No ads, easy to use, and mobile friendly.</p>
    <hr>
    <h4>What does {{ $name }} know about me?</h4>
    <p><b>If you post / read confessions:</b> absolutely nothing. We don't attach cookies, log your ip address, etc. Truly is 100% anonymous.</p>
    <p><b>If you hug / shrug confessions:</b> your ip address. We had to log IP addresses for voting to make sure people aren't voting many times on the same post.</p>
    <hr>
    <h4>Who made {{ $name }}?</h4>
    <p><a href="http://twitter.com/_connyay" target="_blank">@_connyay</a></p>
    <hr>
    <h4>I would love to see the source for {{ $name }}</h4>
    <p>It is your lucky day, fellow nerd! The full source is available <a href="https://github.com/connyay/confess.io" target="_blank">on github!</a>
    <hr>
    <h4>I have an idea / suggestion / problem with {{ $name }}</h4>
    <p>I would love to hear it! I am always available <a href="http://twitter.com/_connyay" target="_blank">@_connyay</a> or <a href="https://github.com/connyay/confess.io/issues" target="_blank">github issue page</a>.</p>
    <hr>
    <h4>I'm sick of reading this page!</h4>
    Woah, sorry! <b>{{ link_to('/ns', 'View the confessions')}}</b>
</div>
@stop
