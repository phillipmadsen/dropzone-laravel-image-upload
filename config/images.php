<?php

return [
    'full_size'        => env('UPLOAD_FULL_SIZE',           public_path('uploads/products/full_size/')),
    'icon_size'        => env('UPLOAD_ICON_SIZE',           public_path('uploads/products/icon_size/')),
    'catalog_size'     => env('UPLOAD_CATALOG_SIZE',        public_path('uploads/products/catalog_size/')),
    'grid_size'        => env('UPLOAD_GRID_SIZE',           public_path('uploads/products/grid_size/')),
    'product_thumb'    => env('UPLOAD_PRODUCT_THUMB_SIZE',  public_path('uploads/products/product_thumb/')),
    'thumb_size'       => env('UPLOAD_THUMB_SIZE',          public_path('uploads/images/thumb_size')),
    'main_size'        => env('UPLOAD_MAIN_SIZE',           public_path('uploads/products/main_size')),
    'blog_header_size' => env('UPLOAD_BLOG_HEADER_SIZE',    public_path('uploads/blog/blog_header_size/')),
    'post_size'        => env('UPLOAD_POST_SIZE',           public_path('uploads/article/post_size/'))
];
