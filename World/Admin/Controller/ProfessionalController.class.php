<?php
namespace Admin\Controller;
class ProfessionalController extends CommonController{
    public function professional_list(){

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
        $list = M("j_professional")->limit($Page->firstRow . ',' . $Page->listRows)->order("professional_id DESC")->select();

        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }


    //人才详情
    public function professional_detail(){
        $professional_id=I("id");
        $professional=M("j_professional")->where("professional_id={$professional_id}")->find();
        $this->assign("professional",$professional);
        $this->display();
    }

    public function professional_del(){
        $id=$_POST['id'];
        $res=M("j_professional")->where("professional_id={$id}")->delete();
        if ($res){
            echo 1;
        }else{
            echo "删除失败!";
        }
    }

    public function professional_list_sou(){

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
        $list = M("j_professional")->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("professional_id DESC")->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display("professional_list");
    }


}