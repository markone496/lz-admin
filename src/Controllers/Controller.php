<?php

namespace lz\admin\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * 请求成功
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public function success($data = [], $msg = '操作成功', $code = 0)
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    /**
     * 请求失败
     * @param array $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public function error($msg = '请求失败', $code = 1, $data = [])
    {
        return ['code' => $code, 'msg' => $msg, 'data' => $data];
    }

    /**
     * 响应请求
     * @param $result
     * @return array
     */
    public function result($result)
    {
        if ($result) {
            return $this->success();
        }
        return $this->error();
    }
}
