<?php
    return [
        // 定义test模块的自动生成
        'test' => [
            '__dir__'    => ['controller', 'model', 'view'],
            'controller' => ['Chat', 'UserType'],
            'model'      => ['Chat', 'UserType'],
            'view'       => ['index/index', 'index/test'],
        ],
    ];
?>
