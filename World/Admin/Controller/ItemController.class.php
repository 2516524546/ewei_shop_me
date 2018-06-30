<?php
namespace Admin\Controller;
class ItemController extends CommonController
{
    public function item_list()
    {

        $count = M("j_item")->where("item_isdel=1")->count();
        //实例化分页类
        $Page = new \Think\Page($count, $this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        //$field = "u_donation.*,";
        $list = M("j_item")->where("item_isdel=1")->limit($Page->firstRow . ',' . $Page->listRows)->order("item_id DESC")->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->assign('status', -1);
        $this->display("item_list");
    }

    public function item_qiehuan()
    {
        if ($_GET['type'] == 1) {
            $count = M("j_item")->where("item_isdel=1")->count();
            //实例化分页类
            $Page = new \Think\Page($count, $this->pagenum);
            //  $Page = new \Think\Page($count,20);
            //设置上一页与下一页
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            //显示分页信息
            $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
            //$field = "u_donation.*,";
            $list = M("j_item")->where("item_isdel=1")->limit($Page->firstRow . ',' . $Page->listRows)->order("item_id DESC")->select();
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->assign('status', -1);
            $this->assign('type', 1);
        } elseif ($_GET['type'] == 2) {
            $join="j_professional_vi as v on v.professional_vi_pid=professional_id";
            $count = M("j_professional")->count();
            //实例化分页类
            $Page = new \Think\Page($count, $this->pagenum);
            //  $Page = new \Think\Page($count,20);
            //设置上一页与下一页
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            //显示分页信息
            $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
            //$field = "u_donation.*,";
            $list = M("j_professional")->join($join)->limit($Page->firstRow . ',' . $Page->listRows)->order("professional_id DESC")->select();
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->assign('type', 2);
        }
        $this->display("item_list");
    }

    public function item_list_sou()
    {
        $post = $_POST;
        if ($post['type'] == 1) {
            $where = "item_isdel=1";
            $name = trim($_POST['name']);
            if ($name) {
                $where .= " and item_name like '%$name%'";
                $this->assign('name', $name);
            }
            $status = trim($_POST['status']);
            if ($status > -1) {
                $where .= " and item_status = {$status}";
                $this->assign('status', $status);
            } else {
                $this->assign('status', -1);
            }
            /* var_dump($where);
             exit;*/
            $count = M("j_item")->where($where)->count();
            //实例化分页类
            $Page = new \Think\Page($count, $this->pagenum);
            //  $Page = new \Think\Page($count,20);
            //设置上一页与下一页
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            //显示分页信息
            $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
            //$field = "u_donation.*,";
            $list = M("j_item")->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("item_id DESC")->select();
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->assign('type', 1);
        } elseif ($post['type'] == 2) {
            $join="j_professional_vi as v on v.professional_vi_pid=professional_id";
            $where = "professional_createtime>'0'";
            $username = trim($_POST['username']);
            if ($username) {
                $where .= " and professional_uname like '%$username%'";
                $this->assign('username', $username);
            }
            $phone = trim($_POST['phone']);
            if ($phone) {
                $where .= " and professional_contact like '%$phone%'";
                $this->assign('phone', $phone);
            }
            $count = M("j_professional")->where($where)->count();
            //实例化分页类
            $Page = new \Think\Page($count, $this->pagenum);
            //  $Page = new \Think\Page($count,20);
            //设置上一页与下一页
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            //显示分页信息
            $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
            //$field = "u_donation.*,";
            $list = M("j_professional")->join($join)->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("professional_id DESC")->select();
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->assign('type', 2);
        }
        $this->display("item_list");
    }
//项目状态更新
    public function item_update()
    {    $status=I("status");
          $id=I("id");
         if ($status==1){
             $res=M("j_item")->where("item_id={$id}")->setField("item_status",0);
             if ($res){
                 echo 1;
             }else{
                 echo L('newworld_ajax_operation_fail');
             }
         }elseif ($status==0){
             $res=M("j_item")->where("item_id={$id}")->setField("item_status",1);
             if ($res){
                 echo 1;
             }else{
                 echo L('newworld_ajax_operation_fail');
             }
         }
    }

    //项目详情
    public function item_detail(){
        $id=I("id");
        $item=M("j_item")->where("item_id={$id}")->find();
        $this->assign("item",$item);
        $this->display();
    }
    //项目编辑
    public function item_edit(){
        if (IS_POST){
            //修改表记录
            $post=$_POST;
            $res=M("j_item")->where("item_id={$post['item_id']}")->save($post);
            if ($res){
               echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            ////获取某一条记录
            $id=I("id");
            $item=M("j_item")->where("item_id={$id}")->find();
            $this->assign("item",$item);
            $this->display();
        }
    }
//删除某一条项目记录
    public function item_del(){
        if (IS_POST){
            $id=I("id");
            $res=M("j_item")->where("item_id={$id}")->setField("item_isdel",0);
            if ($res){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }
    }

    //人才详情
    public function professional_detail(){
         $join="j_professional_vi as v on v.professional_vi_pid=professional_id";
         $professional_id=I("id");
         $professional=M("j_professional")->join($join)->where("professional_id={$professional_id}")->find();
        $this->assign("professional",$professional);
        $this->display();
    }

    public function professional_del(){
        $id=$_POST['id'];
        $res=M("j_professional")->where("professional_id={$id}")->delete();
        if ($res){
            echo 1;
        }else{
            echo L('newworld_ajax_operation_fail');
        }
    }

}