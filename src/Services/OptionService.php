<?php


namespace lz\admin\Services;


use lz\admin\Models\OptionModel;
use lz\admin\Traits\ResTrait;

class OptionService
{

    use ResTrait;

    /**
     * 刷新缓存
     * @param $id
     * @return bool
     */
    public static function refreshCache($id = null)
    {
        $key = CacheKeyService::SYS_OPTION;
        $query = OptionModel::query();
        $query->select([
            'id as value',
            'title',
            'option_config',
            'action'
        ]);
        if (!empty($id)) {
            $query->where('id', $id);
            $data = $query->first()->toArray();
            RedisService::hset($key, $id, $data);
        } else {
            RedisService::del($key);
            $data = $query->get()->toArray();
            foreach ($data as $datum) {
                RedisService::hset($key, $datum['value'], $datum);
            }
        }
        return true;
    }

    /**
     * 删除缓存
     * @param $id
     * @return bool
     */
    public static function deleteCache($id)
    {
        $key = CacheKeyService::SYS_OPTION;
        RedisService::hdel($key, $id);
        return true;
    }

    /**
     * 获取所有选项
     * @return array
     */
    public static function all()
    {
        $key = CacheKeyService::SYS_OPTION;
        return RedisService::hgetAll($key);
    }

    /**
     * 获取单个
     * @param $id
     * @return mixed
     */
    public static function getOptionById($id)
    {
        $key = CacheKeyService::SYS_OPTION;
        $data = RedisService::hget($key, $id);
        if (empty($data)) {
            return [];
        }
        if (!empty($action = $data['action'])) {
            return self::$action();
        }
        return array_column($data['option_config'], null, 'value');
    }

    /**
     * 系统角色选项
     * @return array
     */
    public static function optionSysRole()
    {
        return RoleService::getRoleOption();
    }
}
