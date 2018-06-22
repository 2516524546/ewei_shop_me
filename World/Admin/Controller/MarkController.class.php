<?php
namespace Admin\Controller;

use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
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

    //添加第二标识
    public function ajax_secondadd(){
        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];

            $secondmarkmodel = new SecondMarkModel();

            $secondone = $secondmarkmodel->findone('second_mark_fid = '.$fid);
            $isextend = 0;
            if ($secondone){
                $isextend = $secondone['second_mark_isextend'];
            }

            $data = array(
                'second_mark_fid'=>$fid,
                'second_mark_name'=>$name,
                'second_mark_isextend'=>$isextend,
                'second_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $secondmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第二标识
    public function ajax_seconddel(){
        if (IS_POST) {

            $sid = $_POST['sid'];

            $secondmarkmodel = new SecondMarkModel();

            $data = array('second_mark_id'=>$sid);
            $res = $secondmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第二标签
    public function ajax_secondedit(){

        if (IS_POST) {

            $sid = $_POST['sid'];
            $name = $_POST['name'];
            $data = array(
                'second_mark_name'=>$name,
            );
            $secondmarkmodel = new SecondMarkModel();

            $res = $secondmarkmodel->updataone('second_mark_id = '.$sid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //扩充第二标签
    public function ajax_secondextend(){

        if (IS_POST) {

            $fid = $_POST['fid'];

            $data = array(
                'second_mark_isextend'=>1,
            );
            $secondmarkmodel = new SecondMarkModel();

            $res = $secondmarkmodel->updataone('second_mark_fid = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_extendok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_extendno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //第三层标识列表
    public function third_list(){
        $sid = $_GET['sid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();
        $thirdmarkmodel = new ThirdMarkModel();

        $secondone = $secondmarkmodel->findone('second_mark_id = '.$sid);
        $firstone = $firstmarkmodel->findone('first_mark_id = '.$secondone['second_mark_fid']);
        $thirdcount = $thirdmarkmodel->findone('third_mark_sid = '.$sid,'count(*) num')['num'];

        $Page = new \Think\Page($thirdcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $thirdlist = $thirdmarkmodel->findlimit('third_mark_sid = '.$sid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondone' => $secondone,
            'thirdlist'=> $thirdlist,
            'page' => $show,

        ));
        $this->display();

    }

    //添加第三标识
    public function ajax_thirdadd(){
        if (IS_POST) {

            $sid = $_POST['sid'];
            $name = $_POST['name'];

            $thirdmarkmodel = new ThirdMarkModel();

            $thirdone = $thirdmarkmodel->findone('third_mark_sid = '.$sid);
            $isextend = 0;
            if ($thirdone){
                $isextend = $thirdone['third_mark_isextend'];
            }

            $data = array(
                'third_mark_sid'=>$sid,
                'third_mark_name'=>$name,
                'third_mark_isextend'=>$isextend,
                'third_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $thirdmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第三标识
    public function ajax_thirddel(){
        if (IS_POST) {

            $tid = $_POST['tid'];

            $thirdmarkmodel = new ThirdMarkModel();

            $data = array('third_mark_id'=>$tid);
            $res = $thirdmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第三标签
    public function ajax_thirdedit(){

        if (IS_POST) {

            $tid = $_POST['tid'];
            $name = $_POST['name'];
            $data = array(
                'third_mark_name'=>$name,
            );
            $thirdmarkmodel = new ThirdMarkModel();

            $res = $thirdmarkmodel->updataone('third_mark_id = '.$tid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //扩充第三标签
    public function ajax_thirdextend(){

        if (IS_POST) {

            $sid = $_POST['sid'];

            $data = array(
                'third_mark_isextend'=>1,
            );
            $thirdmarkmodel = new ThirdMarkModel();

            $res = $thirdmarkmodel->updataone('third_mark_sid = '.$sid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_extendok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_extendno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //第四层标识列表
    public function fourth_list(){
        $tid = $_GET['tid'];

        $firstmarkmodel = new FirstMarkModel();
        $secondmarkmodel = new SecondMarkModel();
        $thirdmarkmodel = new ThirdMarkModel();
        $fourthmarkmodel = new FourthMarkModel();

        $thirdone = $thirdmarkmodel->findone('third_mark_id = '.$tid);
        $secondone = $secondmarkmodel->findone('second_mark_id = '.$thirdone['third_mark_sid']);
        $firstone = $firstmarkmodel->findone('first_mark_id = '.$secondone['second_mark_fid']);
        $fourthcount = $fourthmarkmodel->findone('fourth_mark_tid = '.$tid,'count(*) num')['num'];

        $Page = new \Think\Page($fourthcount,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $fourthlist = $fourthmarkmodel->findlimit('fourth_mark_tid = '.$tid,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'firstone' => $firstone,
            'secondone' => $secondone,
            'thirdone' => $thirdone,
            'fourthlist'=> $fourthlist,
            'page' => $show,

        ));
        $this->display();

    }

    //添加第四标识
    public function ajax_fourthadd(){
        if (IS_POST) {

            $tid = $_POST['tid'];
            $name = $_POST['name'];

            $fourthmarkmodel = new FourthMarkModel();

            $fourthone = $fourthmarkmodel->findone('fourth_mark_tid = '.$tid);
            $isextend = 0;
            if ($fourthone){
                $isextend = $fourthone['fourth_mark_isextend'];
            }

            $data = array(
                'fourth_mark_tid'=>$tid,
                'fourth_mark_name'=>$name,
                'fourth_mark_isextend'=>$isextend,
                'fourth_mark_createtime'=>date("Y-m-d H:i:s", time()),
            );

            $res = $fourthmarkmodel->add($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_addok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_addno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //删除第四标识
    public function ajax_fourthdel(){
        if (IS_POST) {

            $fid = $_POST['fid'];

            $fourthmarkmodel = new FourthMarkModel();

            $data = array('fourth_mark_id'=>$fid);
            $res = $fourthmarkmodel->where($data)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_second_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_second_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //修改第三标签
    public function ajax_fourthedit(){

        if (IS_POST) {

            $fid = $_POST['fid'];
            $name = $_POST['name'];
            $data = array(
                'fourth_mark_name'=>$name,
            );
            $fourthmarkmodel = new FourthMarkModel();

            $res = $fourthmarkmodel->updataone('fourth_mark_id = '.$fid,$data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Mark_ajax_firstedit_ok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('Mark_ajax_firstedit_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }
	
}