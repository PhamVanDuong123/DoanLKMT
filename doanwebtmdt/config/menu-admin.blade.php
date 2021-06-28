<?php

return [
    [
        'name' => 'Dashboard',
        'module'=>'dashboard',
        'route'=>'admin.dashboard.show',
        'icon' => 'fas fa-tachometer-alt'
    ],
    [
        'name' => 'Quản lý thành viên',
        'module'=>'user',
        'route'=>'admin.user.index',
        'icon' => 'fas fa-users',
        'items' => [
            [
                'name' => 'Danh sách thành viên',
                'route'=>'admin.user.index'
            ]
        ]
    ],
    [
        'name' => 'Quản lý bán hàng',
        'module'=>'order',
        'route'=>'admin.user.index',
        'icon' => 'fas fa-chart-line',
        'items' => [
            [
                'name' => 'Danh sách đơn hàng',
                'route'=>'admin.user.index'
            ]
        ]
    ],
    [
        'name'=>'Quản lý sản phẩm',
        'module'=>'product',
        'route'=>'admin.product.index',
        'icon'=>'fab fa-product-hunt',
        'items'=>[
            [
                'name'=>'Danh sách sản phẩm',
                'route'=>'admin.product.index' 
            ],
            [
                'name'=>'Thêm sản phẩm',
                'route'=>'admin.product.add' 
            ],
          /*   [
                'name'=>'Cập nhật sản phẩm',
                'route'=>'admin.product.edit' 
            ] */
        ]
    ],
    [
        'name'=>'Quản lý loại sản phẩm',
        'module'=>'product_category',
        'route'=>'admin.product_category.index',
        'icon'=>'fab fa-product-hunt',
        'items'=>[
            [
                'name'=>'Danh sách sản phẩm',
                'route'=>'admin.product_category.index' 
            ],
            [
                'name'=>'Thêm sản phẩm',
                'route'=>'admin.product_category.add'
            ],
            /* [
                'name'=>'Cập nhật sản phẩm',
                'route'=>'admin.product_category.edit'
            ] */
        ]
    ],
    [
        'name'=>'Quản lý bài viết',
        'module'=>'post',
        'route'=>'admin.post.index',
        'icon'=>'fas fa-blog',
        'items'=>[
            [
                'name'=>'Danh sách bài viết',
                'route'=>'admin.post.index'
            ],
            [
                'name'=>'Thêm bài viết',
                'route'=>'admin.post.add'
            ]
        ]
    ],
    [
        'name'=>'Quản lý danh mục bài viết',
        'module'=>'post_category',
        'route'=>'admin.post_category.index',
        'icon'=>'fas fa-blog',
        'items'=>[
            [
                'name'=>'Danh sách danh mục bài viết',
                'route'=>'admin.post_category.index'
            ],
            [
                'name'=>'Thêm danh mục bài viết',
                'route'=>'admin.post_category.add'
            ]
        ]
    ],
    [
        'name'=>'Quản lý thương hiệu',
        'module'=>'brand',
        'route'=>'admin.brand.index',
        'icon'=>'fas fa-map icon',
        'items'=>[
            [
                'name'=>'Danh sách thương hiệu',
                'route'=>'admin.brand.index'
            ],
            [
                'name'=>'Thêm thương hiệu',
                'route'=>'admin.brand.add'
            ]
        ]
    ],
    [
        'name'=>'Quản lý khuyến mãi',
        'module'=>'promotion',
        'route'=>'admin.promotion.index',
        'icon'=>'fas fa-percent',
        'items'=>[
            [
                'name'=>'Danh sách khuyến mãi',
                'route'=>'admin.promotion.index'
            ],
            [
                'name'=>'Thêm khuyến mãi',
                'route'=>'admin.promotion.add'
            ]
        ]
    ]
];
