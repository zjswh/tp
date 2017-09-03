<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// use think\Route;
// Route::resource('blogs','index/blog');
// Route::rule('captcha/[:id]','test/captcha/captcha');

return [
    '__pattern__' => [
        'name'  => '\w+',
        'id'    => '\d+',
        'year'  => '\d{4}',
        'month' => '\d{2}',
    ],
    // '[hello]'     => [
    //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
    //     ':name' => ['index/hello', ['method' => 'post']],
        
    // ],
    'hello/:name' =>['Responses/hello',[],['name'=>'\w+']],
    // 'hello/[:name]' => 'index/hello',
     // 定义闭包
    // 'hello/[:name]' => function ($name) { 
    //     return 'Hello,' . $name . '!';
    // },
    // 'hello/[:name]' => ['index/hello', ['method' => 'get', 'ext' => 'html']],
    // 'blog/:id'            => 'blog/get',
    // 'blog/:name'          => 'blog/read',
    // 'blog-<year>-<month>' => 'blog/archive',
    // ':version/user/:id'   =>'api/:version.User/read', 
];
