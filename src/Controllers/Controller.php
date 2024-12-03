<?php

namespace lz\admin\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use lz\admin\Traits\ResTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResTrait;

    /**
     * 处理试图渲染
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function view($view, $data = [])
    {
        $view = '/' . $view;
        return view($view, $data);
    }

}
