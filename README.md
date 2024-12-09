介绍
------------
基于laravel框架搭建的快速开发后台。开发者只需要手动创建好表，后台的增删改查以及菜单权限都可以通过配置生成。内置各种表单组件和图表库、解决了80%的后台开发需求。

要求
------------
 - PHP >= 7.3.0
 - Laravel >= 8.5.0
 - php需要安装的扩展：curl、fileinfo、gd、mbstring、openssl、pdo_mysql、zip
 
项目实现了哪些功能
------------

- 支持创建后台管理员账号、角色；支持角色可视化权限设置
- 支持自定义菜单配置
- 支持表单配置（单行文本、多行文本、下拉框、单选、复选、日期时间、文件上传、富文本等组件）
- 支持列表页配置（内置增删改查按钮，支持自定义按钮配置；列表支持按月份分表查询）
- 支持echarts图标配置
- 支持多语言系统后台配置

技术支持
------------

- [Laravel](https://learnku.com/docs/laravel/10.x)
- [Layui](https://layui.itze.cn/)
- [Wangeditor](https://www.wangeditor.com/)
- [Echarts](https://echarts.apache.org/examples/zh/index.html)

安装
------------

- 下载包
```
composer require lz/admin
```
- 发布配置文件
```
php artisan vendor:publish --provider="lz\admin\LzAdminProvider"
```
运行命令后，您可以在 `config/admin.php` 中找到配置文件，在该文件中您可以更改开发者账号密码、上传等配置。

- 生成数据库文件
```
php artisan lzadmin:db
```
- 注册后台中间件：打开`app\Http\Kernel.php`、在`$routeMiddleware`里添加以下内容
```
'admin.login' => \lz\admin\Middleware\AdminLogin::class,
'admin.superuser' => \lz\admin\Middleware\AdminSuperUser::class,
'admin.auth' => \lz\admin\Middleware\AdminAuth::class,
'option.log' => \lz\admin\Middleware\OptionLog::class,
```

- 配置`.env`文件
```
APP_DEBUG=true
ADMIN_URL=admin.com
MODEL_DELETE=false
REDIS_CLIENT=predis
OSS_ACCESS_KEY_ID=
OSS_ACCESS_KEY_SECRET=
OSS_HOST=
OSS_CDN= 
```
访问后台路由地址`admin.com`。默认开发者账号:`admin`、密码：`admin`。开发者账号只有 `APP_DEBUG=true` 时才可登录      

演示地址
------------
暂未开放



