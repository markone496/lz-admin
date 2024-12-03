<?php

return [

    /*
   |--------------------------------------------------------------------------
   | 后台访问域名
   |--------------------------------------------------------------------------
   |
   | 只有该域名才能访问后台
   |
   */

    "domain" => env('ADMIN_URL', 'localhost'),

    /*
 |--------------------------------------------------------------------------
 | 首页路由
 |--------------------------------------------------------------------------
 |
 | 默认 /main
 |
 */

    "main_route" => env('MAIN_ROUTE', '/main'),

    /*
  |--------------------------------------------------------------------------
  | 文件上传配置
  |--------------------------------------------------------------------------
  |
  | 默认阿里云OSS上传
  |
  */

    'upload' => [

        'default' => env('UPLOAD_CONNECTION', 'OSS'),

        'connections' => [

            'OSS' => [
                "OSS_ACCESS_KEY_ID" => env('OSS_ACCESS_KEY_ID', ''),//AccessKey
                "OSS_ACCESS_KEY_SECRET" => env('OSS_ACCESS_KEY_SECRET', ''),//SecretKey
                "OSS_HOST" => env('OSS_HOST', ''),//上传地址
                "OSS_CDN" => env('OSS_CDN', ''),//访问地址
                "OSS_DIR" => env('OSS_DIR', ''),//文件上传目录
            ],
//
//            "QINIU" => [
//                "QINIU_ACCESS_KEY_ID" => env('QINIU_ACCESS_KEY_ID', ''),//AccessKey
//                "QINIU_ACCESS_KEY_SECRET" => env('QINIU_ACCESS_KEY_SECRET', ''),//SecretKey
//                "QINIU_HOST" => env('QINIU_HOST', ''),//上传地址
//                "QINIU_CDN" => env('QINIU_CDN', ''),//访问地址
//                "QINIU_DIR" => env('QINIU_DIR', ''),//文件上传目录
//                "QINIU_BUCKET" => env('QINIU_BUCKET', ''),//储存桶
//            ]
        ]
    ]
];
