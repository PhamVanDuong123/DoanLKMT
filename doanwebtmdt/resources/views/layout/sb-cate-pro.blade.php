<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">@lang('lang.danhmucsanpham')</h3>
    </div>
    <div class="secion-detail">
        @if(!empty($list_cate))
        <ul class="list-item">
            @foreach($list_cate as $cate)
            <li>
                <a href="{{$cate->url_list_pro_by_cate}}" title="">{{$cate->name}}</a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>