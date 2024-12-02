<?php

namespace lz\admin;

use Illuminate\Support\ServiceProvider;

class LzAdminProvider extends ServiceProvider
{

    public function boot()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__ . '/config/admin.php' => config_path('admin.php'),
        ], 'config');
        // 发布资源文件
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/lz/admin/src/assets'),
        ], 'assets');
        // 加载路由
        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');

    }

    public function register()
    {

        // 绑定配置文件
        $this->mergeConfigFrom(
            __DIR__ . '/config/admin.php', 'admin'
        );

    }
}
