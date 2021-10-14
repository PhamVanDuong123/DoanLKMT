<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php require 'inc/sidebar.php'; ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form  method="POST" action="">
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" id="title">
                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" id="url-static">
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Trang</label>
                            <select name="page_slug">
                                <option value="0">-- Chọn --</option>
                                <option value="lien-he">Liên hệ</option>
                            </select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục sản phẩm</label>
                            <select name="product_id">
                                <option value="0">-- Chọn --</option>
                                <option value="1">Liên hệ</option>
                                <option value="2">Hướng dẫn giao hàng</option>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục bài viết</label>
                            <select name="post_id">
                                <option value="0">-- Chọn --</option>
                                <option value="1">Liên hệ</option>
                                <option value="2">Hướng dẫn giao hàng</option>
                            </select>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Danh mục cha</label>
                            <select name="parent_id">
                                <option value="0">-- Chọn --</option>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order">
                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Lưu danh mục</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <select name="post_status">
                            <option value="-1">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="1"></td>
                                    <td><span class="tbody-text">1</span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Trang chủ</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=menu&controller=index&action=edit&id=1" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=menu&controller=index&action=delete&id=1" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td style="text-align: center;"><span class="tbody-text">https://www.facebook.com</span></td>
                                    <td style="text-align: center;"><span class="tbody-text">1</span></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="2"></td>
                                    <td><span class="tbody-text">1</span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Liên hệ</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=menu&controller=index&action=edit&id=2" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=menu&controller=index&action=delete&id=2" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td style="text-align: center;"><span class="tbody-text">lien-he</span></td>
                                    <td style="text-align: center;"><span class="tbody-text">2</span></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
