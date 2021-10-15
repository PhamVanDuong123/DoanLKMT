$(document).ready(function() {

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

});