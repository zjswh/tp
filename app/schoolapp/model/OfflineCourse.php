<?php
namespace app\schoolapp\model;

use think\Model;
use app\schoolapp\model\OrderCourse as orderCourseModel;
use app\schoolapp\model\OfflineChildtitle as OfflineChildtitleModel;

class OfflineCourse extends Model
{   
    protected $name = 'Offlinecourse';
    

    public function getNum($id){
        return orderCourseModel::where('offlineCourseId',$id)->count();
    }
    public function getFinishNum($id){
        return OfflineChildtitleModel::where([
                    'courseId' => $id,
                    'isFinish' => 1,
                ])->count();
    }
    public function gettotal($id){
        return OfflineChildtitleModel::where('courseId',$id)->count();
    }
    public function getNameAttr($name){
        return mb_substr($name, 0, 10, 'UTF-8');
    }
}