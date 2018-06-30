<?php

namespace Admin\Controller;

use Think\Controller;

class WorkController extends CommonController
{
    public function work_list()
    {
        $where = "works_isdel !=0";
        $count = M("j_works")->where($where)->count();
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
        $list = M("j_works")->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("works_id DESC")->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }

//按职位名称搜索
    public function work_list_sou()
    {
        $position = $_POST['position'];
        $where = "works_isdel !=0";
        if ($position) {
            $where.= " and works_position like '%$position%'";
            $this->assign("position", $position);
        }
        $count = M("j_works")->where($where)->count();
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
        $list = M("j_works")->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("works_id DESC")->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display("work_list");
    }
    //删除已发布的职位
    public function work_del(){
       $id=$_POST['id'];
       //软删除
       $res=M('j_works')->where("works_id={$id}")->setField("works_isdel",0);
       if ($res){
           echo 1;
       }else{
           echo L('newworld_ajax_operation_fail');
       }
    }
    //编辑发布的职位
    public function work_edit(){
        if (IS_POST){
            $this->checkData($_POST);
            $id =$_POST['works_id'];
            $res=M('j_works')->where("works_id={$id}")->save($_POST);
            if ($res){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            $id=$_GET['id'];
            $work=M('j_works')->where("works_id={$id}")->find();
            $companyType=M('j_works_company_type')->select();
            $this->assign("work",$work);
            $this->assign("companyType",$companyType);
            $this->display();
        }
    }
    //查看发布的职位详情
    public function work_detail(){
        $join="join j_works_company_type as t on j_works.works_company_type=t.works_company_type_id";
        $id=$_GET['id'];
        $work=M('j_works')->join($join)->where("works_id={$id}")->find();
        $this->assign("work",$work);
        $this->display();
    }

    private function checkData($post)
    {
        if (empty($post['works_position'])){
            echo L('Work_work_not_empty_position_name');
            exit;
        }
        if (empty($post['works_maxmoney'])){
            echo L('Work_work_not_empty_position_money');
            exit;
        }
        if (!is_numeric($post['works_maxmoney'])){
            echo L('Work_work_must_num_position_money');
            exit;
        }
        if (empty($post['works_years'])){
            echo L('Work_work_not_empty_work_year');
            exit;
        }
        if (!is_numeric($post['works_years'])){
            echo L('Work_work_must_num_work_year');
            exit;
        }
        if (empty($post['works_school'])){
            echo L('Work_work_not_empty_school');
            exit;
        }
        if (empty($post['works_degree'])){
            echo L('Work_work_not_empty_degree');
            exit;
        }
        if (empty($post['works_specialty'])){
            echo L('Work_work_not_empty_major');
            exit;
        }
        if (empty($post['works_company_name'])){
            echo L('Work_work_not_empty_company_name');
            exit;
        }
        if (empty($post['works_company_size'])){
            echo L('Work_work_not_empty_company_size');
            exit;
        }
        if (empty($post['works_company_mail'])){
            echo L('Work_work_not_empty_email');
            exit;
        }
        //检验是否符合邮箱格式
       if (!isEmail($post['works_company_mail'])){
           echo L('newworld_email_illegal');
           exit;
       }



    }
}