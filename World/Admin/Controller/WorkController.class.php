<?php
namespace Admin\Controller;
use Think\Controller;
class WorkController extends CommonController {
    public function work_list(){
        $count = M("j_works")->count();
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        //$field = "u_donation.*,";
        $list = M("j_works")->limit($Page->firstRow.','.$Page->listRows)->order("works_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
}