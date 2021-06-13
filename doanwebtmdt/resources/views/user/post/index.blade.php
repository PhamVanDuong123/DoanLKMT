@extends('layout.home')
@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            @if(!empty($list_post))
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Bài viết</h3>
                </div>
                <div class="section-detail">                    
                    <ul class="list-item">
                        @foreach($list_post as $post)
                        <li class="clearfix">
                            <a href="{{$post->url}}" title="" class="thumb fl-left">
                                <img src="{{$post->thumb}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?page=detail_blog" title="" class="title">{{$post->title}}</a>
                                <span class="create-date">{{$post->created_at}}</span>
                                <p class="desc">{{$post->short_desc}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                {!! $list_post->links() !!}
            </div>
            @else
                <h3>Không tồn tại sản phẩm nào!!!</h3>
            @endif
        </div>
        <div class="sidebar fl-left">
                @include('layout.sb-selling-pro')
                @include('layout.sb-banner')
        </div>
    </div>
</div>
@endsection