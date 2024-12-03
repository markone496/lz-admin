<?php

namespace lz\admin\Controllers;


use lz\admin\Models\ConfigModel;
use lz\admin\Services\ConfigService;
use lz\admin\Services\ModelService;
use Illuminate\Http\Request;

class SysConfigController extends Controller
{

    /**
     * 配置
     * @param $index_key
     * @return mixed
     */
    private static function config($index_key)
    {
        $data = [
            'APP_VERSION' => ['model_id' => 1, 'auth' => isAuth(13)],
            'APP_CONFIG' => ['model_id' => 2, 'auth' => isAuth(15)],
            'AP' => ['model_id' => 13, 'auth' => isAuth(41)],
            'IM' => ['model_id' => 33, 'auth' => isAuth(70)],
            'WEB3_SET' => ['model_id' => 19, 'auth' => isAuth(91)],
        ];
        return $data[$index_key];
    }

    /**
     * 配置页
     * @param $index_key
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function indexView($index_key)
    {
        $model = ConfigModel::query()->where('index_key', $index_key)->first()->toArray();
        $config = self::config($index_key);
        $form = ModelService::getModelForm($config['model_id'], $model['data']);
        return $this->view('lzadmin/config/index', compact('form', 'config', 'model'));
    }

    /**
     * 保存配置
     * @param $index_key
     * @param Request $request
     * @return array
     */
    public function save($index_key, Request $request)
    {
        $data = [];
        $config = self::config($index_key);
        $model = ModelService::getModelById($config['model_id']);
        foreach ($model['form_config'] as $item) {
            $field = $item['field'];
            $value = $request->input($field, '');
            if (!empty($item['required'])) {
                if (!isset($value)) {
                    return $this->error('【' . $item['title'] . '】参数必填');
                }
            }
            $data[$field] = $value;
        }
        $result = ConfigModel::query()->where('index_key', $index_key)->update(['data' => $data]);
        if (!$result) {
            return $this->error();
        }
        $this->updateCallback($index_key, $data);
        ConfigService::refreshCache($index_key);
        return $this->result($result);
    }

    /**
     * 保存成功回调
     * @param $index_key
     * @param $data
     */
    private function updateCallback($index_key, $data)
    {

    }
}
