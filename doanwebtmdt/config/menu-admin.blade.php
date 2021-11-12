<?php

return [
    'dashboard' => [
        'name' => 'Dashboard',
        'module'=>'dashboard',
        'route'=>'admin.dashboard.show',
        'icon' => 'fas fa-tachometer-alt',
        'role' => 3
    ],
    'statistics' => [
        'name' => 'Thống kê chi tiết',
        'module'=>'statistics',
        'route'=>'admin.statistics.sale',
        'icon' => 'fas fa-chart-line',
        'role' => 3,
        'items' => [
            [
                'name' => 'Bán hàng',
                'route'=>'admin.statistics.sale',
                'role' => 3
            ],
            [
                'name' => 'Sản phẩm - Bài viết',
                'route'=>'admin.statistics.product_post',
                'role' => 3
            ]
        ]
    ],
    'order' => [
        'name' => 'Quản lý đơn hàng',
        'module'=>'order',
        'route'=>'admin.order.index',
        'icon' => 'fas fa-chart-line',
        'role' => 3,
        'items' => [
            [
                'name' => 'Danh sách đơn hàng',
                'route'=>'admin.order.index',
                'role' => 3
            ]
        ]
    ],    
    'promotion' => [
        'name'=>'Quản lý khuyến mãi',
        'module'=>'promotion',
        'route'=>'admin.promotion.index',
        'icon'=>'fas fa-percent',
        'role' => 3,
        'items'=>[
            [
                'name'=>'Danh sách khuyến mãi',
                'route'=>'admin.promotion.index',
                'role' => 3
            ],
            [
                'name'=>'Thêm khuyến mãi',
                'route'=>'admin.promotion.add',
                'role' => 3
            ],
            [
                'name'=>'Xét duyệt khuyến mãi',
                'route'=>'admin.promotion.approve',
                'role' => 1
            ]
        ]
    ],
    'delivery' => [
        'name' => 'Quản lý vận chuyển',
        'module'=>'delivery',
        'route'=>'admin.delivery',
        'icon' => 'fas fa-truck',
        'role' => 2,
    ],
    'user' => [
        'name' => 'Quản lý thành viên',
        'module'=>'user',
        'route'=>'admin.user.index',
        'icon' => 'fas fa-users',
        'role' => 2,
        'items' => [
            [
                'name' => 'Danh sách thành viên',
                'route'=>'admin.user.index',
                'role' => 2,
            ]
        ]
    ],  
    'product' => [
        'name'=>'Quản lý sản phẩm',
        'module'=>'product',
        'route'=>'admin.product.index',
        'icon'=>'fab fa-product-hunt',
        'role' => 2,
        'items'=>[
            [
                'name'=>'Danh sách sản phẩm',
                'route'=>'admin.product.index',
                'role' => 2,
            ],
            [
                'name'=>'Thêm sản phẩm',
                'route'=>'admin.product.add',
                'role' => 2,
            ],
            [
                'name'=>'Xét duyệt sản phẩm',
                'route'=>'admin.product.approve',
                'role' => 1,
            ]
        ]
    ],
    'product_category' => [
        'name'=>'Quản lý loại sản phẩm',
        'module'=>'product_category',
        'route'=>'admin.product_category.index',
        'icon'=>'fab fa-product-hunt',
        'role' => 2,
        'items'=>[
            [
                'name'=>'Danh sách sản phẩm',
                'route'=>'admin.product_category.index',
                'role' => 2, 
            ],
            [
                'name'=>'Thêm loại sản phẩm',
                'route'=>'admin.product_category.add',
                'role' => 2,
            ]
        ]
    ],
    'post' => [
        'name'=>'Quản lý bài viết',
        'module'=>'post',
        'route'=>'admin.post.index',
        'icon'=>'fas fa-blog',
        'role' => 2,
        'items'=>[
            [
                'name'=>'Danh sách bài viết',
                'route'=>'admin.post.index',
                'role' => 2,
            ],
            [
                'name'=>'Thêm bài viết',
                'route'=>'admin.post.add',
                'role' => 2,
            ],
            [
                'name'=>'Xét duyệt bài viết',
                'route'=>'admin.post.approve',
                'role' => 1,
            ]
        ]
    ],
    'post_category' => [
        'name'=>'Quản lý danh mục bài viết',
        'module'=>'post_category',
        'route'=>'admin.post_category.index',
        'icon'=>'fas fa-blog',
        'role' => 2,
        'items'=>[
            [
                'name'=>'Danh sách danh mục bài viết',
                'route'=>'admin.post_category.index',
                'role' => 2,
            ],
            [
                'name'=>'Thêm danh mục bài viết',
                'route'=>'admin.post_category.add',
                'role' => 2,
            ]
        ]
    ],
    'brand' => [
        'name'=>'Quản lý thương hiệu',
        'module'=>'brand',
        'route'=>'admin.brand.index',
        'icon'=>'fas fa-map icon',
        'role' => 2,
        'items'=>[
            [
                'name'=>'Danh sách thương hiệu',
                'route'=>'admin.brand.index',
                'role' => 2,
            ],
            [
                'name'=>'Thêm thương hiệu',
                'route'=>'admin.brand.add',
                'role' => 2,
            ]
        ]
    ]
];
