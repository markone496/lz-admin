<?php

namespace lz\admin\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use lz\admin\Traits\ResTrait;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResTrait;
}
