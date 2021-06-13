<div class="section" id="selling-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm bán chạy</h3>
    </div>
    <div class="section-detail">
        
        @if(!empty($list_pro_selling))
        <ul class="list-item">
            @foreach($list_pro_selling as $product)
            <li class="clearfix">
                <a href="{{$product->url}}" title="" class="thumb thumb-selling fl-left">
                    <img src="{{$product->thumb}}" alt="">
                </a>
                <div class="info fl-right">
                    <a href="?page=detail_product" title="" class="product-name">{{$product->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($product->price)}}đ</span>
                        <span class="old">{{number_format($product->old_price)}}đ</span>
                    </div>
                    <a href="{{$product->url_checkout}}" title="" class="buy-now">Mua ngay</a>
                </div>
            </li>
            @endforeach
        </ul>
        @endif
    </div>
</div>