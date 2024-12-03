<?php

namespace lz\admin\Console;

use Illuminate\Console\Command;


class DbCommand extends Command
{

    protected $signature = 'lzadmin:db';
    protected $description = '执行后台系统数据导入';

    public function handle()
    {
        // 在这里实现命令的逻辑
        $this->info('导入成功');
    }
}
