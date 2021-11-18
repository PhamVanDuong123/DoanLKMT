<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>ISMART STORE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('user/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/css/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('user/reset.css')}}" rel="stylesheet')}}" type="text/css" />
    <link href="{{asset('user/main.css')}}" rel="stylesheet')}}" type="text/css" />
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
    <script src="{{asset('user/js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('/user/js/sweetalert.min.js')}}"></script>
    <div class="zalo-chat-widget" data-oaid="2945463678774668991" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <link rel="canonical" href="http://localhost:8081/DoanLKMT/doanwebtmdt/" />
    <meta property="og:site_name" content="http://localhost:8081/DoanLKMT/doanwebtmdt/" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
    <script type="text/javascript">
        $(document).ready(function() {

            $('#sort_by').on('change', function() {

                var url = $(this).val();

                if (url) {
                    window.location = url;
                }
                return false;
            });

        });
    </script>
    <!-- tìm kiếm ajax -->
    <script type="text/javascript">
        $('#s').keyup(function() {
            var query = $(this).val();
            alert(query);

            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/autocomplete-ajax')}}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });

            } else {

                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#s').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">@lang('lang.hinhthucthanhtoan')</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{route('home')}}" class="active" title="">@lang('lang.trangchu')</a>
                                </li>
                                <li>
                                    <a href="{{route('product.index')}}" title="">@lang('lang.sanpham')</a>
                                </li>
                                <li>
                                    <a href="{{route('post.index')}}" title="">@lang('lang.baiviet')</a>
                                </li>
                                <li>
                                    <a href="{{route('page.detail','gioi-thieu')}}" title="">@lang('lang.gioithieu')</a>
                                </li>
                                <li>
                                    <a href="{{route('page.detail','lien-he')}}" title="">@lang('lang.lienhe')</a>
                                </li>
                                @if(Auth::check())
                                <li>
                                    <a href="{{route('history.index')}}">@lang('lang.lichsumuahang')</a>
                                </li>
                                <li>
                                    <a href="{{route('account.detail')}}" title="">{{Auth::user()->fullname}}
                                        <!-- <span class="glyphicon glyphicon-user"><span> -->
                                        <img src="@php echo empty(Auth::user()->avatar) ? 'http://localhost:8080/DoanLKMT/doanwebtmdt/public/uploads/no-avatar.png' : url('public/'.Auth::user()->avatar) @endphp" alt="" class="avatar">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('account.logout')}}">@lang('lang.dangxuat')
                                        <span class="fa fa-sign-in"></span>
                                    </a>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('account.login')}}">@lang('lang.dangnhap') <span class="glyphicon glyphicon-user"></span></a>
                                </li>
                                <li>
                                    <a href="{{route('account.signup')}}">@lang('lang.dangky')
                                        <span class="fa fa-user-plus"></span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
      <!-- tìm kiếm ajax -->
                        <a href="{{route('home')}}" title="" id="logo" class="fl-left"><img src="{{asset('user/images/logo.png')}}" /></a>
    
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="{{URL::to('/search')}}" autocomplete="off">
                                {{csrf_field()}}

                                <input type="text" style="with: 100%" name="keyword_submit" id="s" placeholder="@lang('lang.tukhoa')" />
                                <button name="search_item" type="submit" id="sm-s">@lang('lang.timkiem')</button>
                                <div id="search_ajax"></div>

                        </div>
                        </form>

                    </div>
                    <div class="btn-group language" style="margin-top: 20px;">
                        <button type="button" class="btn btn-danger">@lang('lang.ngonngu')</button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                         <li><a class="dropdown-item" href="{{url('lang/vi')}}">Vietnamese</a></li> 
                         <li><a class="dropdown-item" href="{{url('lang/en')}}">English</a></li> 
                         <li> <a class="dropdown-item" href="{{url('lang/cn')}}">Chinese</a></li> 


                        </div>
                    </div>


                    <!--  <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">9</span>
                            </a> -->

                    <div id="cart-wp" class="fl-right">
                        <div id="btn-cart">
                            <a class="text-white" href="{{route('cart.show')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
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
                                @if(Cart::count()>0)
                                <a href="{{route('cart.checkout')}}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                @endif
                            </dic>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- script ajax autocomplete -->
    <script type="text/javascript">
        $('#s').keyup(function() {
            var query = $(this).val();

            if (query != '') {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/autocomplete-ajax')}}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(data);
                    }
                });

            } else {

                $('#search_ajax').fadeOut();
            }
        });

        $(document).on('click', '.li_search_ajax', function() {
            $('#s').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>