@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; {{ $post->title }}
@stop
{{-- Content --}}
@section('content')
    <div class="col-lg-8 col-lg-offset-2 blog">
     @include('blog._view', array('single'=>true))
</div>
@stop