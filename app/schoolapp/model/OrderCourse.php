<?php
namespace app\schoolapp\model;

use think\Model;

class OrderCourse extends Model
{   
    protected $name = 'Ordercourse';
    
    // public function 
    public function OfflineCourse(){
        return $this->belongsTo('Offlinecourse');
    }
}