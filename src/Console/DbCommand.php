<?php

namespace lz\admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class DbCommand extends Command
{

    protected $signature = 'lzadmin:db';
    protected $description = '执行后台系统数据导入';

    public function handle()
    {
        $path = base_path("vendor/lz/admin/admin.sql");
        if (!file_exists($path)) {
            $this->error('sql文件不存在');
            return;
        }
        $sql = file_get_contents($path);
        try {
            DB::unprepared($sql);
            $this->info('导入成功');
        } catch (\Exception $e) {
            $this->error('导入失败： ' . $e->getMessage());
        }
    }
}
