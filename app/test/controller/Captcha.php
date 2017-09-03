<?php
namespace app\test\controller;
class Captcha extends \think\Controller
{

    // 验证码表单
    public function index()
    {
        return $this->fetch();
    }
   
    public function check()
    {
        if (!captcha_check(input('code'),input('id')) ){
            $this->error('验证码错误');
        } else {
            $this->success('验证码正确');
        }
    }
}