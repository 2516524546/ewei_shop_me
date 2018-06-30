<?php
namespace Admin\Controller;
use Think\Controller;
//简历控制器
class ResumeController extends CommonController {

    public function resume_list(){
        //$join="u_user as u on u.user_id=donation_uid";
        $count = M("u_resume")->count();
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
        $list = M("u_resume")->limit($Page->firstRow.','.$Page->listRows)->order("resume_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    public function resume_list_sou(){
        $username=$_POST['username'];
        $where="";
        
        if ($username){
            $where = "resume_name like '%$username%'";
            $this->assign('username',$username);
        }
        $count = M("u_resume")->where($where)->count();
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
        $list = M("u_resume")->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("resume_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("resume_list");
    }

    public function resume_del(){
        $id=$_POST['id'];
        $resume=M('u_resume')->where("resume_id={$id}")->find();
        $fileurl='./Uploads/'.$resume['resume_fileurl'];
        $res=M('u_resume')->where("resume_id={$id}")->delete();
        if ($res){
            unlink($fileurl);
            echo 1;
        }else{
            echo L('newworld_ajax_operation_fail');
        }

    }
    public function resume_edit(){
        if (IS_POST){
           $this->checkData($_POST);
            $id =$_POST['resume_id'];
            $res=M('u_resume')->where("resume_id={$id}")->save($_POST);
            if ($res){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            $id=$_GET['id'];
            $resume=M('u_resume')->where("resume_id={$id}")->find();
            $this->assign("resume",$resume);
            $this->display();
        }
    }

    public function resume_detail(){
        $id=$_GET['id'];
        $resume=M('u_resume')->where("resume_id={$id}")->find();
        $this->assign("resume",$resume);
        $this->display();

    }

    private function checkData($post)
    {
        if (empty($post['resume_name'])){
            echo '姓名不能为空';
            exit;
        }
        if (empty($post['resume_position'])){
            echo '职位不能为空';
            exit;
        }
        if (empty($post['resume_hightmoney'])){
            echo '薪资不能为空';
            exit;
        }
        if (!is_numeric($post['resume_hightmoney'])){
            echo '薪资为数字';
            exit;
        }

        if (empty($post['resume_workyear'])){
            echo '工作年限不能为空';
            exit;
        }
        if (!is_numeric($post['resume_workyear'])){
            echo '工作年限为数字';
            exit;
        }

        //resume_position
        //resume_hightmoney
        //resume_workyear


    }


}