$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    //xử lý xem trước ảnh khi upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-image").change(function() {
        readURL(this);
    });

    //xử lý hiển thị tìm kiếm đơn hàng
    $("#search-option").change(function() {
        option = $(this).val();
        $("input#key").attr('type', 'text');
        $("input#key").attr('placeholder', 'Nhập mã đơn hàng');
        if (option == 'name') {
            $("input#key").attr('placeholder', 'Nhập tên khách hàng');
        }
        if (option == 'date') {
            $("input#key").attr('type', 'date');
            $("input#key").attr('placeholder', 'Nhập ngày đặt hàng');
        }
    });

    //xử lý hiển thị tìm kiếm bài viết
    $("#search_option_post").change(function() {
        option = $(this).val();
        $("input#key").attr('placeholder', 'Nhập tiêu đề bài viết');
        if (option == 'category') {
            $("input#key").attr('placeholder', 'Nhập tên danh mục');
        }
        if (option == 'actor') {
            $("input#key").attr('placeholder', 'Nhập tên tác giả');
        }
    });
});