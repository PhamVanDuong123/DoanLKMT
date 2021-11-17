</div>
</div>


</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('admin/js/app.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{url('/public/admin/js/simple.money.format.js')}}"></script>

<script>
    $(function() {
        load_feeship();

        function load_feeship(){
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{route('admin.delivery.load_feeship')}}",
                method: "post",
                dataType: "html",
                data: {
                    _token: _token,
                },
                success: function(data) {
                    $('#list_feeship').html(data);
                },
                // error: function(xhr, ajaxOptions, thrownError) {
                //     alert('Lỗi: ' + xhr.status + ' - ' + thrownError)
                // }
            })
        }

        //load huyện theo tỉnh, xã theo huyện (vận chuyển)
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
                url: "{{route('admin.delivery.load_district_ward')}}",
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

        //kích hoạt phần nhập giá trị hóa đơn tối thiểu
        load_min_total_order();

        function load_min_total_order(){
            var condition = $('#condition').val();
            if(condition==1){
                $('#min_total_order').val('');
                $('#min_total_order').attr('disabled','disabled');
            }else if(condition==2){
                $('#min_total_order').removeAttr('disabled');
                //$('#number').addClass('money');
                //$('#min_total_order').addClass('money');
            }
        }

        //ràng buộc giá trị khuyến mãi promotion/edit 
        $('#condition').on('change',function(){
            var condition = $(this).val()
            var value = $('#number').val()
            var min_total_order = $('#min_total_order').val();
            
            if(condition==2){
                $('#min_total_order').removeAttr('disabled');
                //$('#number').addClass('money');
            }else if(condition==1){
                $('#min_total_order').val('');
                $('#min_total_order').attr('disabled','disabled');

                if (value > 100) {
                    //trở lại giảm theo tiền
                    alert('Giá trị giảm không được lớn hơn 100%');
                    $(this).val(2);
                    $('#min_total_order').removeAttr('disabled');
                    $('#min_total_order').val(min_total_order);
                }
            }
        })
              
        $('#number').on('change', function() {
            var condition = $('#condition').val();
            var value = $(this).val();
            if (condition == 1 && value > 100) {
                alert('Giá trị giảm không được lớn hơn 100%');
                $(this).val('');
            }
        })

        //cập nhật phí vận chuyển
        $(document).on('blur','td.edit_feeship',function(){
            var _token = $('input[name="_token"]').val();
            var id=$(this).data('id');
            var fee=$(this).text();
            
            $.ajax({
                    url: "{{route('admin.delivery.edit_feeship')}}",
                    method: "post",
                    dataType: "html",
                    data: {
                        _token: _token,
                        id: id,
                        fee: fee
                    },
                    success: function(data) {
                        alert('Cập nhật phí vận chuyển thành công');
                    },
                    // error: function(xhr, ajaxOptions,thrownError){
                    //     alert('Lỗi: '+xhr.status+' - '+thrownError)
                    // }
                })
        })

        //thêm phí vận chuyển
        $('#add-feeship').on('click', function() {
            var _token = $('input[name="_token"]').val();
            var province_id = $('select#province').val();
            var district_id = $('select#district').val();
            var ward_id = $('select#ward').val();
            var fee = $('input#fee').val();
            
            if (province_id == '') {
                alert('Tỉnh/thành phố không được để trống!')
            } else if (district_id == '') {
                alert('Quận/huyện không được để trống!')
            } else if (ward_id == '') {
                alert('Xã/phường không được để trống!')
            } else if (fee == '') {
                alert('Phí vận chuyển không được để trống!')
            } else {
                $.ajax({
                    url: "{{route('admin.delivery.add_feeship')}}",
                    method: "post",
                    dataType: "json",
                    data: {
                        _token: _token,
                        province_id: province_id,
                        district_id: district_id,
                        ward_id: ward_id,
                        fee: fee,
                    },
                    success: function(data) {
                        if(data.status=='success'){
                            alert(data.message);
                            load_feeship();
                        }else{
                            alert(data.message);
                        }                        
                        //console.log(data)
                    },
                    // error: function(xhr, ajaxOptions,thrownError){
                    //     alert('Lỗi: '+xhr.status+' - '+thrownError)
                    // }
                })
            }
        })

        $('.money').simpleMoneyFormat();

        chart30day();

        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });

        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });

        //Hiển thị biểu đồ doanh thu
        var chart = new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'chart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.

            //Options
            parseTime: false,
            lineColors: ['#fa41a4', '#419efa', '#e09916', '#16c423'],
            pointFillColors: ['#c60404'],
            pointStrokeColors: ['#88836E'],
            fillOpacity: 0.2,
            hideHover: 'auto',

            // The name of the data record attribute that contains x-values.
            xkey: 'period',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['sales', 'profit', 'quantity', 'order'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Doanh thu', 'Lợi nhuận', 'Tổng sản phẩm', 'Tổng đơn hàng']
        });

        //Thống kê tự động 30 ngày 
        function chart30day() {
            var _token = $("input[name='_token']").val()
            $.ajax({
                url: "{{url('/admin/statistical_30day')}}",
                method: "post",
                dataType: "json",
                data: {
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                    console.log(data)
                },
                // error: function(xhr, ajaxOptions, thrownError) {
                //     alert('Lỗi: '+xhr.status+' - '+thrownError);
                // }
            })
        }


        //Lọc thống kê theo lựa chọn
        $("#statistical_fillter").change(function() {
            $('#datepicker').val('');
            $('#datepicker2').val('');
            
            var _token = $("input[name='_token']").val()
            var select = $(this).val();

            $.ajax({
                url: "{{url('/admin/fillter_by_select')}}",
                method: "post",
                dataType: "json",
                data: {
                    select: select,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                    //console.log(data)
                },
                // error: function(xhr, ajaxOptions, thrownError) {
                //     alert('Lỗi: '+xhr.status+' - '+thrownError);
                // }
            })
        })

        //Lọc thống kê theo ngày
        $("#btn-dashboard-fillter").click(function() {
            var _token = $("input[name='_token']").val()
            var from_date = $("#datepicker").val();
            var to_date = $("#datepicker2").val();

            $.ajax({
                url: "{{url('/admin/fillter_by_date')}}",
                method: "post",
                dataType: "json",
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    _token: _token
                },
                success: function(data) {
                    chart.setData(data);
                    //console.log(data)
                },
                // error: function(xhr, ajaxOptions, thrownError) {
                //     alert('Lỗi: '+xhr.status+' - '+thrownError);
                // }
            })
        })
    });
</script>
<!-- Khai báo trình soạn thảo bài viết  -->
<script>
    var editor_config = {
        //đường dẫn đến file xử lý
        path_absolute: "{{url('')}}",
        selector: 'textarea.form-editor',
        relative_urls: false,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        file_picker_callback: function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);
</script>
</body>

</html>