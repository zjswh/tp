<?php
    namespace app\schoolapp\controller;
    use think\Image;
    use think\Request;
    use think\Controller;
    class Upload  extends controller{
        public function index(){
            return $this->fetch();
        }
        public function picture(Request $request){
            $file = $request->file('image');
            if(true !== $this->validate(['image' => $file], ['image' => 'require|image'])){
              $this->error('请选择图像文件'); 
            }else{
                $image = Image::open($file);
                switch ($request->param('type')) {
                    case 1: // 图片裁剪
                        $image->crop(300, 300);
                        break;
                    case 2: // 缩略图
                        $image->thumb(150, 150, Image::THUMB_CENTER);
                        break;
                    case 3: // 垂直翻转
                        $image->flip();
                        break;
                    case 4: // 水平翻转
                        $image->flip(Image::FLIP_Y);
                        break;
                    case 5: // 图片旋转
                        $image->rotate();
                        break;
                    case 6: // 图片水印
                        $image->water( VENDOR_PATH .'topthink/think-captcha/assets/bgs/1.jpg', Image::WATER_NORTHWEST, 50);
                        break;
                    case 7: // 文字水印
                        $image->text('ThinkPHP', VENDOR_PATH . 'topthink/think-captcha/assets/ttfs/1.ttf', 20, '#ffffff');
                        break;
                }
                
                $saveName = $request->time() . '.png';
                $date = date('m-d',time());
                $path = ROOT_PATH . 'public/uploads/'.$date;
                if(!is_dir($path) || !is_writable($path)){
                    mkdir($path);
                }
                $image->save($path .'/'. $saveName);
                $this->success('图片处理完毕...', './uploads/'. $date.'/'. $saveName, 1);
                }
        }
        public function demo(Request $request){
            return date('m-d',time());
        }
    }
?>
