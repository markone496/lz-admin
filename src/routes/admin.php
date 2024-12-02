<?php

use Illuminate\Support\Facades\Route;

use lz\admin\Controllers as C;

//获取后台配置
$config = config('admin');

//定义路由
Route::domain($config['domain'])->group(function () {

    Route::get('/index', [C\IndexController::class, 'index']);//后台首页

});

