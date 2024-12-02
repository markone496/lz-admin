<?php

use Illuminate\Support\Facades\Route;

use lz\admin\Controllers as C;

Route::get('/index', [C\IndexController::class, 'index']);//后台首页
