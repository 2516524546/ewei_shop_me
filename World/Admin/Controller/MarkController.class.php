<?php
namespace Admin\Controller;

use Index\Model\FirstMarkModel;
use Index\Model\SecondMarkModel;
use Think\Controller;
class MarkController extends CommonController {

    //第一层标签列表
    public function mark_list(){

        $mid = $_GET['mid'];
        $type = $_GET['type'];

        $firstmarkmodel = new FirstMarkModel();

        $marklist = $firstmarkmodel->findlist('first_mark_mid = '.$mid.' and first_mark_type = '.$type);

        $this->assign(array(
            'mid' => $mid,
            'type' => $type,
            'marklist' => $marklist,
        ));
		$this->display();
	}

	//第一层标识修改
    public function ajax_firstedit(){

        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];
            $data = array(
                'firsth_mark_name'=>$name,
            );
            $firstmarkmodel = new FirstMarkModel();

            $res = $firstmarkmodel->updataone('first_mark_id = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //第二层标识列表
    public function second_list(){
        $fid = $_GET['fid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();

        $firstone = $firstmarkmodel->findone('first_mark_id = '.$fid);
        $secondcount = $secondmarkmodel->findone('second_mark_fid = '.$fid,'count(*) num')['num'];

        $Page = new \Think\Page($secondcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $secondlist = $secondmarkmodel->findlimit('second_mark_fid = '.$fid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondlist'=> $secondlist,
            'page' => $show,

        ));
        $this->display();

    }

	
}