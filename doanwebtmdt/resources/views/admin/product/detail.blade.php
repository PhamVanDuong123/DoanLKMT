@extends('layoutadmin.master')

@section('content')
<div id="content" class="container-fluid">
    <div class="jumbotron">
        @if(!empty($brand))
        <h1>{{$brand->name}}</h1>
        {!!$brand->content!!}
        @endif
    </div>
</div>
@endsection