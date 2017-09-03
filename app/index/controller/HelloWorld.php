<?php
namespace app\index\controller;

class HelloWorld 
{
    public function index($name = 'World')
    {
        return 'Hello,' . $name . '！';
    }
}
