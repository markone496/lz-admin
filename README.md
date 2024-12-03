## 介绍
基于laravel框架搭建的快速开发后台。开发者只需要手动创建好表，后台的增删改查以及菜单权限都可以通过配置生成。内置各种表单组件和图表库、解决了80%的后台开发需求。

## 项目实现了哪些功能

- 支持创建后台管理员账号、角色；支持角色可视化权限设置
- 支持自定义菜单配置
- 支持表单配置（单行文本、多行文本、下拉框、单选、复选、日期时间、文件上传、富文本等组件）
- 支持列表页配置（内置增删改查按钮，支持自定义按钮配置；列表支持按月份分表查询）
- 支持多语言系统

## 技术支持

- [Laravel](https://learnku.com/docs/laravel/10.x)
- [Layui](https://layui.itze.cn/)
- [Wangeditor](https://www.wangeditor.com/)

## 安装教程

- 下载包：composer require lz/admin
- 发布配置文件：php artisan vendor:publish --provider="lz\admin\LzAdminProvider"
- 生成数据库文件：php artisan lzadmin:db

## 备注

- php需要安装的扩展：curl、fileinfo、gd、mbstring、openssl、pdo_mysql、zip
- 发布完配置文件后，会在config目录中生成admin.php文件，项目的所有配置均在这个配置文件里


## 演示地址

- 暂未开放



