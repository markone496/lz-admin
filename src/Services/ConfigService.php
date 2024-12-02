<?php


namespace lz\admin\Services;


use lz\admin\Models\ConfigModel;
use lz\admin\Traits\ResTrait;

class ConfigService
{

    use ResTrait;

    /**
     * 刷新缓存
     * @param $index_key
     * @return bool
     */
    public static function refreshCache($index_key = null)
    {
        $key = CacheKeyService::SYS_CONFIG;
        $query = ConfigModel::query();
        $query->select([
            'id',
            'index_key',
            'data'
        ]);
        if ($index_key) {
            $query->where('index_key', $index_key);
            $data = $query->first()->toArray();
            RedisService::hset($key, $index_key, $data['data']);
        } else {
            $data = $query->get()->toArray();
            foreach ($data as $datum) {
                RedisService::hset($key, $datum['index_key'], $datum['data']);
            }
        }
        return true;
    }

    /**
     * 获取配置
     * @param $index_key
     * @return mixed
     */
    public static function getDataByIndexKey($index_key)
    {
        $key = CacheKeyService::SYS_CONFIG;
        $data = RedisService::hget($key, $index_key);
        if (!empty($data)) {
            return $data;
        }
        $query = ConfigModel::query();
        $query->select([
            'id',
            'index_key',
            'data'
        ]);
        $query->where('index_key', $index_key);
        $data = $query->first()->toArray();
        RedisService::hset($key, $index_key, $data['data']);
        return $data['data'];
    }
}
