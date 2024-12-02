<?php

namespace lz\admin;

use Illuminate\Support\ServiceProvider;

class LzAdminProvider extends ServiceProvider
{

    public function boot()
    {
        // 加载路由
        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
    }

    public function register()
    {

    }
}
