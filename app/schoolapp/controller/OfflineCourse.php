<?php
    namespace app\schoolapp\controller;

    use think\Controller;
    use think\Request;
    use app\schoolapp\model\OfflineCourse as OfflineCourseModel;
    use app\schoolapp\model\Common as commonModel;

    class OfflineCourse extends controller{
        public function show(){
            $offline = new OfflineCourseModel();
            $offlinelist = $offline::all();
            $this->common($offlinelist,$offline);

            $this->assign('offlinelist',$offlinelist);
            $this->assign('title','线下课程');
            return $this->fetch('Index/OfflineCourse');
        }
        public function search(){
            $word = input('word');
            $offline = new OfflineCourseModel();
            $offlinelist = $offline->where('name','like','%'.$word.'%')->select();
            $this->common($offlinelist,$offline);
            $this->assign('offlinelist',$offlinelist);
            $this->assign('title','线下课程');
            return $this->fetch('Index/OfflineCourse');
        
        }
        public function common($obj,$model){
            foreach ($obj as $key => $value) {
                $value->num   = $model->getNum($value->id);
                $value->finishNum   = $model->getFinishNum($value->id);
                $value->total = $model->getTotal($value->id);
                if(null == $value->total){
                    $value->pro = 0;
                }else{
                    $value->pro = ceil($value->finishNum*100/$value->total);
                }
            }
        } 
        public function delete(){
            $offline = OfflineCourseModel::get(input('id'));
            if($offline->delete()){
               $this->redirect("offlineCourse/show");
            }else{
                return $user->getError();
            }
            
            
        }
    } 
