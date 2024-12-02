<?php

use Illuminate\Support\Facades\Route;

use lz\admin\Controllers as C;

//获取后台配置
$config = config('admin');

//定义路由
Route::domain($config['domain'])->group(function () {

    //请求日志中间件
    Route::middleware(['web', 'option.log'])->group(function () {

        /**** 登录 ****/
        Route::get('/login', [C\IndexController::class, 'loginView'])->name('login');//登陆页
        Route::post('/login', [C\IndexController::class, 'checkLogin']);//检查登录
        Route::get('/loginOut', [C\IndexController::class, 'loginOut'])->name('loginOut');//退出登录

        Route::middleware(['admin.login'])->group(function () {

            Route::get('/', [C\IndexController::class, 'indexView']);//框架页
            Route::get('/passwordView', [C\IndexController::class, 'passwordView']);//修改密码页
            Route::post('/password', [C\IndexController::class, 'updatePassword']);//修改密码
            Route::get('/main', [C\IndexController::class, 'mainView']);//主页
//
//            /**** 公共 ****/
//            Route::get('/sys/icon', [Sys\SysController::class, 'iconView']);//图标选择页
//            Route::post('/sys/upload/config', [Sys\SysController::class, 'getOssConfig']);//获取上传token
//            /**** 刷新缓存 ****/
//            Route::get('/sys/refreshCache', [Sys\SysController::class, 'refreshCache']);//刷新缓存
//
//            Route::prefix('sys')->middleware(['admin.superuser'])->group(function () {
//                /**** 菜单 ****/
//                Route::get('/menu', [Sys\SysMenuController::class, 'indexView']);//菜单管理页
//                Route::post('/menu/getList', [Sys\SysMenuController::class, 'getList']);//获取树形菜单
//                Route::get('/menu/addView', [Sys\SysMenuController::class, 'addView']);//菜单编辑页面
//                Route::post('/menu/create', [Sys\SysMenuController::class, 'create']);//新增菜单
//                Route::post('/menu/update', [Sys\SysMenuController::class, 'update']);//修改菜单
//                Route::post('/menu/delete', [Sys\SysMenuController::class, 'delete']);//删除菜单
//                /**** 权限 ****/
//                Route::post('/function/getList', [Sys\SysFunctionController::class, 'getList']);//菜单权限
//                Route::get('/function/edit', [Sys\SysFunctionController::class, 'editView']);//权限编辑页面
//                Route::post('/function/create', [Sys\SysFunctionController::class, 'create']);//新增权限
//                Route::post('/function/update', [Sys\SysFunctionController::class, 'update']);//修改权限
//                Route::post('/function/delete', [Sys\SysFunctionController::class, 'delete']);//新增权限
//                /**** 模型 ****/
//                Route::get('/model', [Sys\SysModelController::class, 'indexView']);//模型页
//                Route::post('/model/list', [Sys\SysModelController::class, 'getList']);//数据
//                Route::post('/model/create', [Sys\SysModelController::class, 'create']);//新增
//                Route::post('/model/update', [Sys\SysModelController::class, 'update']);//修改
//                Route::post('/model/delete', [Sys\SysModelController::class, 'delete']);//demo删除
//                Route::get('/model/config', [Sys\SysModelController::class, 'config']);//获取配置
//                Route::post('/model/updateConfig', [Sys\SysModelController::class, 'updateConfig']);//修改配置
//                /**** 选项 ****/
//                Route::get('/option', [Sys\SysOptionController::class, 'indexView']);//模型页
//                Route::post('/option/list', [Sys\SysOptionController::class, 'getList']);//数据
//                Route::post('/option/create', [Sys\SysOptionController::class, 'create']);//新增
//                Route::post('/option/update', [Sys\SysOptionController::class, 'update']);//修改
//                Route::post('/option/delete', [Sys\SysOptionController::class, 'delete']);//demo删除
//                Route::get('/option/config', [Sys\SysOptionController::class, 'config']);//获取配置
//                Route::post('/option/updateConfig', [Sys\SysOptionController::class, 'updateConfig']);//修改配置
//
//                /**** 请求日志 ****/
//                Route::get('/log', [Sys\SysLogController::class, 'indexView']);//模型页
//                Route::post('/log/list', [Sys\SysLogController::class, 'getList']);//数据
//                /**** 数据库 ****/
//                Route::get('/table', [Sys\SysTableController::class, 'indexView']);//所有表
//                Route::get('/table/info', [Sys\SysTableController::class, 'infoView']);//表字段
//
//            });
//
//            Route::prefix('sys')->middleware(['admin.auth'])->group(function () {
//                /**** 主页 ****/
//                Route::get('/main', [C\IndexController::class, 'mainView']);
//                /**** 管理员 ****/
//                Route::get('/user', [Sys\SysUserController::class, 'indexView']);//管理员页面
//                Route::post('/user/list', [Sys\SysUserController::class, 'getList']);//获取管理员列表数据
//                Route::get('/user/edit', [Sys\SysUserController::class, 'editView']);//管理员编辑页面
//                Route::post('/user/create', [Sys\SysUserController::class, 'create']);//新增管理员
//                Route::post('/user/update', [Sys\SysUserController::class, 'update']);//编辑管理员
//                Route::post('/user/delete', [Sys\SysUserController::class, 'delete']);//删除管理员
//                Route::post('/user/password', [Sys\SysUserController::class, 'password']);//重置密码
//                /**** 角色 ****/
//                Route::get('/role', [Sys\SysRoleController::class, 'indexView']);//角色页面
//                Route::post('/role/list', [Sys\SysRoleController::class, 'getList']);//获取角色列表数据
//                Route::get('/role/edit', [Sys\SysRoleController::class, 'editView']);//角色编辑页面
//                Route::post('/role/create', [Sys\SysRoleController::class, 'create']);//新增角色
//                Route::post('/role/update', [Sys\SysRoleController::class, 'update']);//编辑角色
//                Route::post('/role/delete', [Sys\SysRoleController::class, 'delete']);//删除角色
//                Route::post('/role/copy', [Sys\SysRoleController::class, 'copy']);//复制角色
//                /**** 配置 ****/
//                Route::get('/config/{index_key}', [Sys\SysConfigController::class, 'indexView']);//配置页
//                Route::post('/config/update/{index_key}', [Sys\SysConfigController::class, 'save']);//保存配置
//            });
//
//            Route::middleware(['admin.auth'])->group(function () {
//                /**** 模型 ****/
//                Route::get('/model/{id}', [Sys\ModelController::class, 'indexView'])->where('id', '[0-9]+');
//                Route::post('/model/{id}/list', [Sys\ModelController::class, 'getList'])->where('id', '[0-9]+');
//                Route::get('/model/{id}/info', [Sys\ModelController::class, 'infoView']);
//                Route::get('/model/{id}/edit', [Sys\ModelController::class, 'editView']);
//                Route::post('/model/{id}/create', [Sys\ModelController::class, 'create']);
//                Route::post('/model/{id}/update', [Sys\ModelController::class, 'update']);
//                Route::post('/model/{id}/delete', [Sys\ModelController::class, 'delete']);
//
//                /**** 分表 ****/
//                Route::get('/subTable/{id}', [Sys\SubTableController::class, 'indexView'])->where('id', '[0-9]+');
//                Route::post('/subTable/{id}/list', [Sys\SubTableController::class, 'getList'])->where('id', '[0-9]+');
//            });

        });

    });

});

