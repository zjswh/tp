<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    // 验证规则
    // protected $rule = [
    //     'nickname' => 'require|min:5|token',
    //     'email'    => 'require|email',
    //     'birthday' => 'dateFormat:Y-m-d',
    // ];
    //  protected $rule = [
    //     'nickname' => ['require', 'min'=>5, 'token'],
    //     'email'    => ['require', 'email'],
    //     'birthday' => ['dateFormat' => 'Y|m|d'],
    // ];
    // protected $rule = [
    //     ['nickname','require|min:5','昵称必须|昵称不能短于5个字符'],
    //     ['email', 'email', '邮箱格式错误'],
    //     ['birthday', 'dateFormat:Y-m-d', '生日格式错误'],
    // ];

    //自定义规则
    // 验证规则
    protected $rule = [
        ['nickname', 'require|min:5', '昵称必须|昵称不能短于5个字符'],
        ['email', 'checkMail:qq.com', '邮箱格式错误'],
        ['birthday', 'dateFormat:Y-m-d', '生日格式错误'],
    ];

    // 验证邮箱格式 是否符合指定的域名
    protected function checkMail($value, $rule)
    {
        $result = preg_match('/^\w+([-+.]\w+)*@' . $rule . '$/', $value);
        if (!$result) {
            return '邮箱只能是' . $rule . '域名';
        } else {
            return true;
        }
    }
}