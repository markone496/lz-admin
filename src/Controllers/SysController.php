<?php

namespace lz\admin\Controllers;


use lz\admin\Services\CacheKeyService;
use lz\admin\Services\RedisService;
use lz\admin\Services\ConfigService;
use lz\admin\Services\FunctionService;
use lz\admin\Services\MenuService;
use lz\admin\Services\ModelService;
use lz\admin\Services\OptionService;
use lz\admin\Services\RoleService;
use lz\admin\Services\UserService;
use Illuminate\Support\Facades\DB;

class SysController extends Controller
{

    public function refreshCache()
    {
        ConfigService::refreshCache();
        MenuService::refreshCache();
        FunctionService::refreshCache();
        RoleService::refreshCache();
        UserService::refreshCache();
        ModelService::refreshCache();
        OptionService::refreshCache();
        OptionService::refreshCache();
        self::tableRefreshCache();
        return '更新成功';
    }

    /**
     * 表缓存和表字段缓存
     */
    public static function tableRefreshCache()
    {
        $tables = DB::select('SELECT table_name, table_comment
                      FROM information_schema.tables
                      WHERE table_schema = ?', [config('database.connections.mysql.database')]);
        $tablesArray = [];
        foreach ($tables as $table){
            $tablesArray[] = [
                'table_name' => $table->TABLE_NAME,
                'table_comment' => $table->TABLE_COMMENT
            ];
        }
        //存入缓存
        $key = CacheKeyService::SYS_TABLE;
        RedisService::set($key, $tablesArray);
        $key = CacheKeyService::SYS_TABLE_FIELD;
        RedisService::del($key);
        foreach ($tablesArray as $item) {
            $tableName = $item['table_name'];
            $columns = DB::select("SELECT column_name, column_comment
                       FROM information_schema.columns
                       WHERE table_name = ?
                       AND table_schema = ?", [$tableName, config('database.connections.mysql.database')]);
            $columnsArray = json_decode(json_encode($columns), true);
            RedisService::hset($key, $tableName, $columnsArray);
        }
    }

    /**
     * 加载图标选择页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function iconView()
    {
        return $this->view('lzadmin/sys/icon');
    }

    /**
     * 阿里云OSS配置
     * @return array
     */
    public function getOssConfig()
    {
        $ali_config = config('aliyun');
        $ali_config = $ali_config['oss'];
        $key = CacheKeyService::SYS_UPLOAD_SIGN;
        $sign = RedisService::get($key);
        $dir = $ali_config['dir'] . '/';
        if (empty($sign)) {
            $accessKeyId = $ali_config['accessKeyId'];
            $accessKeySecret = $ali_config['accessKeySecret'];
            //todo 设置过期时间
            $now = time();
            $expire = 3000;
            $end = $now + $expire;
            $expiration = $this->get_iso8601($end);
            //TODO 设置文件大小
            $condition = [
                0 => 'content-length-range',
                1 => 0,
                2 => 1048576000
            ];
            $conditions[] = $condition;
            $start = ['starts-with', '$key', $dir];
            $conditions[] = $start;
            $arr = [
                'expiration' => $expiration,
                'conditions' => $conditions
            ];
            $policy = json_encode($arr);
            $base64_policy = base64_encode($policy);
            $signature = base64_encode(hash_hmac('sha1', $base64_policy, $accessKeySecret, true));
            $sign = [
                'host' => $ali_config['host'],
                'cdn_host' => $ali_config['cdn_host'],
                'accessKeyId' => $accessKeyId,
                'policy' => $base64_policy,
                'signature' => $signature,
            ];
            RedisService::set($key, $sign, $expire - 20);
        }
        //组装文件名
        $sign['filename'] = $dir . date('Ymd') . '/' . md5(rand(0, 1000) . time());
        return $this->success($sign);
    }

    private function get_iso8601($time)
    {
        $dtStr = date('c', $time);
        $myDate = new \DateTime($dtStr);
        $expiration = $myDate->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration . 'Z';
    }


}
