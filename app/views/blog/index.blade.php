@extends('layouts.master')
{{-- Web site Title --}}
@section('title')
@parent
&raquo; Blog
@stop
{{-- Content --}}
@section('content')
    <div class="col-lg-8 col-lg-offset-2 blog">
    <h6 class="blog-post-sub-title text-right">Displaying {{ $posts->getFrom() }} - {{ $posts->getTo() }} of {{ $posts->getTotal() }} Posts</h6>
    @foreach ($posts as $post)
    @include('blog._view', array('single'=>false))
    @endforeach
        <div class="text-center">
        {{ $posts->links() }}
    </div>
</div>
@stop
