<?php

return [
    'dashboard' => [
        'name' => 'Dashboard',
        'module'=>'dashboard',
        'route'=>'admin.dashboard.show',
        'icon' => 'fas fa-tachometer-alt'
    ],
    'statistics' => [
        'name' => 'Thống kê chi tiết',
        'module'=>'statistics',
        'route'=>'admin.statistics.sale',
        'icon' => 'fas fa-chart-line',
        'items' => [
            [
                'name' => 'Bán hàng',
                'route'=>'admin.statistics.sale'
            ],
            [
                'name' => 'Sản phẩm - Bài viết',
                'route'=>'admin.statistics.product_post'
            ]
        ]
    ],
    'order' => [
        'name' => 'Quản lý đơn hàng',
        'module'=>'order',
        'route'=>'admin.order.index',
        'icon' => 'fas fa-chart-line',
        'items' => [
            [
                'name' => 'Danh sách đơn hàng',
                'route'=>'admin.order.index'
            ]
        ]
    ],
    'delivery' => [
        'name' => 'Quản lý vận chuyển',
        'module'=>'delivery',
        'route'=>'admin.delivery',
        'icon' => 'fas fa-truck',
    ],
    'promotion' => [
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
    ],
    'user' => [
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
    'product' => [
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
            ]
        ]
    ],
    'product_category' => [
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
                'name'=>'Thêm loại sản phẩm',
                'route'=>'admin.product_category.add'
            ]
        ]
    ],
    'post' => [
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
    'post_category' => [
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
    'brand' => [
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
    ]
];
