@extends('layout.home')
@section('content')
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        @if(!empty($page))  
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{route('page.detail',$page->code)}}" title="">{{$page->name}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">            
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$page->name}}</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">{{$page->created_at}}</span>
                    <div class="detail">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>            
        </div>
        @endif
        <div class="sidebar fl-left">
            @include('layout.sb-selling-pro')
            @include('layout.sb-banner')
        </div>
    </div>
</div>
@endsection