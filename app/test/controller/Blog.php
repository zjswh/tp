<?php

namespace app\test\controller;

use think\Controller;
use think\Route; 

class Blog extends Controller
{
    public function demo($id = ''){
        return 'demo';
    }
}
