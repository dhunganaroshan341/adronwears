<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    */

    'default' => env('FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    */

    'disks' => [

        /*
        |--------------------------------------------------------------------------
        | Private Local Storage
        |--------------------------------------------------------------------------
        */
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'throw' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Public Uploads
        |--------------------------------------------------------------------------
        | Files will be stored in:
        | public/uploads/
        |
        | Example:
        | products/image.jpg
        |
        | Physical path:
        | public/uploads/products/image.jpg
        |
        | URL:
        | https://example.com/uploads/products/image.jpg
        |--------------------------------------------------------------------------
        */
        'public' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'url' => env('APP_URL') . '/uploads',
            'visibility' => 'public',
            'throw' => false,
        ],

        /*
        |--------------------------------------------------------------------------
        | Amazon S3
        |--------------------------------------------------------------------------
        */
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Required only if you use storage/app/public.
    | Since we're storing directly in public/uploads,
    | this isn't used, but it's fine to leave it.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
