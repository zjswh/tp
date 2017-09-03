<?php
namespace app\schoolapp\controller;
use PHPExcel_IOFactory;
use PHPExcel;
class Test {
    public function index(){
        $letter = array('A','B','C','D','E','F','F','G');
        //表头数组
        $tableheader = array('序号','用户名','所在院校(单位)','Tel','e-mail','备注');
        $path = dirname(__FILE__); //找到当前脚本所在路径
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('demo'); //给当前活动sheet设置名称

        for($i=0;$i<sizeof($tableheader);$i++){
            $PHPSheet->setCellValue("$letter[$i]1","$tableheader[$i]");
        }
        // $PHPSheet->setCellValue('A1','姓名')->setCellValue('B1','分数');//给当前活动sheet填充数据，数据填充是按顺序一行一行填充的，假如想给A1留空，可以直接setCellValue(‘A1’,’’);
        // $PHPSheet->setCellValue('A2','张三')->setCellValue('B2','50');
        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel,'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，
        $PHPWriter->save($path.'/demo.xlsx'); //表示在$path路径下面生成demo.xlsx文件
    }
}
?>
