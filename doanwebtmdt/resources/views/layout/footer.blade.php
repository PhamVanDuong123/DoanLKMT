<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <img id="logo-footer" src="{{asset('user/images/Logo.png')}}" alt="">
                <p class="desc">HD Computer là một đơn vị luôn cung cấp các sản phẩm bộ phận linh kiện máy tính chính hãng với giá cả hợp lý đến tận tay khách hàng. HD Computer là một đơn vị luôn cung cấp các sản phẩm bộ phận linh kiện máy tính chính hãng với giá cả hợp lý đến tận tay khách hàng.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="{{asset('images/img-foot.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>65 Huỳnh Thúc Kháng, phường Bến Nghé, quận 1, TP Hồ Chí Minh</p>
                    </li>
                    <li>
                        <p>0987.654.321 - 0989.989.989</p>
                    </li>
                    <li>
                        <p>hdcomputer@gmail.com</p>
                    </li>
                    <li>
                        <p>www.facebook.com/hdcomputer</p>
                    </li>
                    <li>
                        <p>www.zalo.com/hdcomputer</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Thông tin chính sách</h3>
                <ul class="list-item">
                    <li>
                        <a href="#" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách thành viên</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách sửa chữa</a>
                    </li>
                    <li>
                        <a href="#" title="">Giao hàng - lắp đặt</a>
                    </li>
                    <li>
                        <a href="#" title="">Thanh toán - Trả góp</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Chăm sóc khách hàng</h3>
                <p>Tổng đài CSKH: </p>
                <h2 class="hotline">19001009</h2>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc Công ty TNHH HD Computer</p>
        </div>
    </div>
</div>
</div>
<div id="menu-respon">
    <a href="?page=home" title="" class="logo">VSHOP</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            <li>
                <a href="?page=home" title>Trang chủ</a>
            </li>
            <li>
                <a href="?page=category_product" title>Điện thoại</a>
                <ul class="sub-menu">
                    <li>
                        <a href="?page=category_product" title="">Iphone</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Samsung</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone X</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Iphone 8</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Nokia</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="?page=category_product" title>Máy tính bảng</a>
            </li>
            <li>
                <a href="?page=category_product" title>Laptop</a>
            </li>
            <li>
                <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
            </li>
            <li>
                <a href="?page=blog" title>Blog</a>
            </li>
            <li>
                <a href="#" title>Liên hệ</a>
            </li>
        </ul>
    </div>
</div>
<div id="btn-top"><img src="{{asset('frontend/images/icon-to-top.png')}}" alt="" /></div>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = number.toFixed(decimals);

        var nstr = number.toString();
        nstr += '';
        x = nstr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? dec_point + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1))
            x1 = x1.replace(rgx, '$1' + thousands_sep + '$2');

        return x1 + x2;
    }

    //ht tỉnh huyện xã sau khi đã tính phí vc(nếu có)
    load_province_dictrict_ward();
    //ht thông tin giao hàng(nếu có)
    load_infoship();

    //load huyện theo tỉnh, xã theo huyện (tính phí vc)
    $('.choose').on('change', function() {
        var _token = $('input[name="_token"]').val()
        var select_id = $(this).attr('id');
        var select_val = $(this).val();
        var result;

        if (select_id == 'province') {
            result = 'district'
        } else {
            result = 'ward'
        }

        $.ajax({
            url: "{{route('cart.load_district_ward_user')}}",
            method: "post",
            dataType: "html",
            data: {
                _token: _token,
                select_val: select_val,
                result: result
            },
            success: function(data) {
                $('#' + result).html(data);
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert('Lỗi: ' + xhr.status + ' - ' + thrownError)
            // }
        })
    })

    //tính phí vận chuyển
    $('#ward').on('change',function(){
        var _token = $('input[name="_token"]').val();
        var province_id = $('select#province').val();
        var district_id = $('select#district').val();
        var ward_id = $('select#ward').val();

        var html_province = $('select#province').html();
        var html_district = $('select#district').html();
        var html_ward = $('select#ward').html();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var note = $('#note').val();
        var address = $('#address').val();
        var payment = $('#payment').val();

        if (province_id == '') {
            alert('Tỉnh/thành phố không được để trống!')
        } else if (district_id == '') {
            alert('Quận/huyện không được để trống!')
        } else if (ward_id == '') {
            alert('Xã/phường không được để trống!')
        } else {
            $.ajax({
                url: "{{route('cart.calculator_feeship')}}",
                method: "post",
                data: {
                    _token: _token,
                    province_id: province_id,
                    district_id: district_id,
                    ward_id: ward_id,
                    html_province:html_province,
                    html_district:html_district,
                    html_ward:html_ward,
                    name:name,
                    phone:phone,
                    note:note,
                    address:address,
                    payment:payment
                },
                success: function() {
                    location.reload();             
                },
                // error: function(xhr, ajaxOptions, thrownError) {
                //     alert('Lỗi: ' + xhr.status + ' - ' + thrownError)
                // }
            })
        }
    })

    function load_province_dictrict_ward(){
        $.ajax({
            url: "{{route('cart.check_feeship')}}",
            dataType: "json",
            method: "get",
            success: function(data){
                if(data.status=='exist'){
                    $('select#province').html(data.html_province);
                    $('select#district').html(data.html_district);
                    $('select#ward').html(data.html_ward);

                    $('select#province').val(data.province_id);
                    $('select#district').val(data.district_id);
                    $('select#ward').val(data.ward_id);
                }        
            }
        })
    }

    function load_infoship(){
        $.ajax({
            url: "{{route('cart.check_infoship')}}",
            dataType: "json",
            method: "get",
            success: function(data){
                if(data.status=='exist'){
                    $('#name').val(data.name);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#note').val(data.note);
                    $('#payment').val(data.payment);
                }        
            }
        })
    }

    //them gio hang
    $('.add-cart').on('click', function() {
        var id = $(this).attr('data-id');
        var url = "http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/add/" + id;

        $.ajax({
            url: url,
            method: "get",
            dataType: "json",
            success: function(data) {
                if (data.status == 'success') {
                    //ht sweet alert
                    swal({
                            title: data.title,
                            text: data.message,
                            type: data.status,
                            showCancelButton: true,
                            cancelButtonText: "Mua tiếp",
                            confirmButtonColor: "green",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{route('cart.show')}}";
                        });

                    $('#cart-wp').empty();
                    $('#cart-wp').html(data.html_cart);
                    //console.log(data)
                } else {
                    //ht sweet alert
                    swal({
                            title: data.title,
                            text: data.message,
                            type: data.status,
                            showCancelButton: true,
                            cancelButtonText: "Thoát",
                            confirmButtonColor: "red",
                            confirmButtonText: "Đăng nhập",
                            closeOnConfirm: false
                        },
                        function() {
                            window.location.href = "{{route('account.login')}}";
                        });
                }
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert('Lỗi: ' + xhr.status + ' - ' + thrownError);
            // }
        })
    });

    //cập nhật số lượng giỏ hàng
    $('.num-order').change(function() {
        var _token = $("input[name='_token']").val();
        let qty = $(this).val();
        var id = $(this).attr('data-rowId');

        $.ajax({
            url: "{{route('cart.update')}}",
            dataType: "json",
            method: "post",
            data: {
                _token: _token,
                id: id,
                qty: qty
            },
            success: function(data) {
                //cập nhật html thanh thông báo giỏ hàng
                $('#cart-wp').empty();
                $('#cart-wp').html(data.html_cart);
                $('#cart-qty').html(data.num_cart);

                //cập nhật thành tiền
                $('td.subtotal-' + data.product_cart.rowId).html(number_format(data.product_cart.qty * data.product_cart.price, 0, ',', '.') + 'đ');

                //cập nhật tổng tiền      
                var total = 0;
                //tính tổng hóa đơn
                $.each(data.cart, function(key, value) {
                    total += value.price * value.qty;
                });

                //gán gt giỏ hàng
                $('span#total').html(number_format(total, 0, ',', '.') + 'đ')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert("Lỗi: " + xhr + " - " + thrownError);
            }
        })
    });

    //xóa sp trong giỏ hàng
    $('.del-product').on('click', function() {
        var id = $(this).attr('data-rowId');

        $.ajax({
            url: "http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/remove/" + id,
            dataType: "json",
            method: "get",
            success: function(data) {
                //cập nhật html thanh thông báo giỏ hàng
                $('#cart-wp').empty();
                $('#cart-wp').html(data.html_cart);
                //cập nhật html giỏ hàng
                // $('#info-cart-wp').empty();
                // $('#info-cart-wp').html(data.cart);
                location.reload();
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert("Lỗi: " + xhr + " - " + thrownError);
            // }
        })
    });

    //xóa toàn bộ giỏ hàng
    $('#destroy-cart').on('click', function() {
        $.ajax({
            url: "http://localhost:8080/DoanLKMT/doanwebtmdt/user/cart/destroy",
            dataType: "json",
            method: "get",
            success: function(data) {
                //cập nhật html thanh thông báo giỏ hàng
                $('#cart-wp').empty();
                $('#cart-wp').html(data.html_cart);
                //cập nhật html giỏ hàng
                $('#info-cart-wp').empty();
                $('#cart-qty').html("<p>Có <strong>0</strong> sản phẩm trong giỏ hàng</p>");
                //location.reload();

                //ht sweet alert
                swal({
                        title: "Xóa thành công",
                        text: "Tất cả sản phẩm trong giỏ hàng đã được xóa",
                        type: "success",
                        showCancelButton: true,
                        cancelButtonText: "Thoát",
                        confirmButtonColor: "green",
                        confirmButtonText: "Về trang chủ",
                        closeOnConfirm: false
                    },
                    function() {
                        window.location.href = "{{route('home')}}";
                    });
            },
            // error: function(xhr, ajaxOptions, thrownError) {
            //     alert("Lỗi: " + xhr + " - " + thrownError);
            // }
        })
    })    

    //đặt hàng
    $('#order-now').on('click', function() {
        var _token = $('input[name="_token"]').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var address = $('#address').val();
        var note = $('#note').val();
        var payment = $("select[name='payment']").val();
        var province_id = $('#province').val();
        var district_id = $('#district').val();
        var ward_id = $('#ward').val();

        if (!name) {
            alert('Bạn chưa nhập họ tên người nhận hàng')
        } else if (!phone) {
            alert('Bạn chưa nhập số điện thoại người nhận hàng')
        } else if (!province_id) {
            alert('Bạn chưa chọn tỉnh/thành phố')
        } else if (!district_id) {
            alert('Bạn chưa chọn quận/huyện')
        } else if (!ward_id) {
            alert('Bạn chưa chọn xã/phường/thị trấn')
        } else if (!address) {
            alert('Bạn chưa nhập số nhà tên đường người nhận hàng')
        } else if (!payment) {
            alert('Bạn chưa chọn phương thức thanh toán')
        } else {
            swal({
                    title: "Bạn có thực sự muốn đặt hàng?",
                    text: "Đơn hàng sẽ không được hoàn trả lại nếu như bạn đặt hàng!",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Thoát",
                    confirmButtonColor: "#ff6c00",
                    confirmButtonText: "Đặt hàng",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: "{{route('cart.pay')}}",
                        method: "post",
                        dataType: "json",
                        data: {
                            _token: _token,
                            name: name,
                            phone: phone,
                            province_id: province_id,
                            district_id: district_id,
                            ward_id: ward_id,
                            address: address,
                            note: note,
                            payment: payment
                        },
                        success: function(data) {
                            //ht sweet alert
                            swal({
                                title: data.title,
                                text: data.message,
                                type: data.status,
                                confirmButtonText: "Về lại trang chủ",
                                confirmButtonColor: "#7787b1",
                                closeOnConfirm: false
                            }, function() {
                                window.location.href = "{{route('home')}}";
                            });
                        },
                        // error: function(xhr, ajaxOptions, thrownError) {
                        //     alert('Lỗi: ' + xhr.status + ' - ' + thrownError);
                        // }
                    })
                });
        }
    })
</script>
</body>

</html>