<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('user/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/reset.css')}}" rel="stylesheet')}}" type="text/css" />
    <link href="{{asset('user/css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="{{asset('user/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{asset('user/js/main.js')}}" type="text/javascript"></script>
    <div class="zalo-chat-widget" data-oaid="3917867475933370364" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>

    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{route('home')}}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{route('product.index')}}" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{route('post.index')}}" title="">Bài viết</a>
                                </li>
                                <li>
                                    <a href="{{route('page.detail','gioi-thieu')}}" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="{{route('page.detail','lien-he')}}" title="">Liên hệ</a>
                                </li>
                               
                                 @if(Auth::check())
                                 <li>
                               
                                <a href="{{route('account.detail')}}" title="" >{{Auth::user()->fullname}}
                                     <span class="glyphicon glyphicon-user"><span>
                               </a>         
                                </li> 
                                <li>
                               
                            
                               </li> 
                                 <li>
                                 <a href="{{route('account.logout')}}">Đăng xuất
                                     <span class="fa fa-sign-in"></span>
                                    </a>
                                </li> 
                              
                                @else
                                <li>
                                 <a href="{{route('account.login')}}"><span class ="glyphicon glyphicon-user"></span>Đăng nhập </a>
                               
                                </li>
                               
                                <li>
                                <li>
                                    <a href="{{route('account.signup')}}">Đăng Ký
                                     <span class="fa fa-user-plus"></span>
                                    </a>
                                 </li>
                                 </li>
                                @endif
                             
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{route('home')}}" title="" id="logo" class="fl-left"><img src="{{asset('user/images/logo.png')}}" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="post" action="{{URL::to('/search')}}">
                            {{ csrf_field() }}
                                      <input type="text" name="keyword_submit" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button name="search_item" type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>                        
                        <div id="action-wp" class="fl-right">
                            <!-- <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">9</span>
                            </a> -->
                            
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">{{Cart::count()}}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                                    @if(Cart::count()>0)
                                    <ul class="list-cart">
                                        @foreach(Cart::content() as $product)
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="{{$product->options->thumb}}" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">{{$product->name}}</a>
                                                <p class="price">{{number_format($product->price,0,',','.')}}đ</p>
                                                <p class="qty">Số lượng: <span>{{$product->qty}}</span></p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right"><?php echo Cart::total(); ?>đ</p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="{{route('cart.show')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="?page=checkout" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </dic>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>