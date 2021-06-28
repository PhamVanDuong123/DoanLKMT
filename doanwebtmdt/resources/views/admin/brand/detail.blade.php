@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="jumbotron">
        @if(!empty($post))
        <h1>{{$post->name}}</h1>
        {!!$post->content!!}
        @endif
    </div>
</div>
@endsection