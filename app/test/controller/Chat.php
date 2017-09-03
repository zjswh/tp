<?php
namespace app\test\controller;

use think\Controller;
use app\test\model\Chat as ChatModel;

class Chat extends Controller
{
    public function client(){
        return view();
    }

    public function server(){
        return view();
    }

    public function toClient(){
        $chat['toone'] = 'user';
        $chat['fromone']    = 'admin';
        $chat['content'] = $_POST['text'];
        if ($result = ChatModel::create($chat)) {
            return json($result);
        } else {
            return '发送出错';
        }
    }

    public function toServer(){
        $chat['toone'] = 'admin';
        $chat['fromone']    = 'user';
        $chat['content'] = $_POST['text'];
        if ($result = ChatModel::create($chat)) {
            return json($result);
        } else {
            return '发送出错';
        }
    }

    public function fromClient(){

        ob_start();
        echo str_repeat('', 4096);
        ob_end_flush();
        ob_flush();
        while(true){
            $_chat = ChatModel::get(['toone'=>'admin','isNew'=>1]);
            if($_chat){
                $newchat = ChatModel::get($_chat->id);
                $newchat->isNew = 0;
                $newchat->save();
                echo '<script>parent.showMsg("'.$newchat->content.'")</script>';
                ob_flush();
                flush();
                sleep(1);
                
                
            }
            
        }
    }
    public function fromServer(){

        ob_start();
        echo str_repeat('', 4096);
        ob_end_flush();
        ob_flush();
        while(true){
            $_chat = ChatModel::get(['toone'=>'user','isNew'=>1]);
            if($_chat){
                $newchat = ChatModel::get($_chat->id);
                $newchat->isNew = 0;
                $newchat->save();
                echo '<script>parent.showMsg("'.$newchat->content.'")</script>';
                ob_flush();
                flush();
                sleep(1);
                
                
            }
            
        }
    }

}