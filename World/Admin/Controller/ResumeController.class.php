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
            //Resume_resume_username_not_empty
            echo L('Resume_resume_username_not_empty');
            exit;
        }
        if (empty($post['resume_position'])){
            //Resume_resume_position_not_empty
            echo L('Resume_resume_position_not_empty');
            exit;
        }
        if (empty($post['resume_hightmoney'])){
            //Resume_resume_money_not_empty
            echo L('Resume_resume_money_not_empty');
            exit;
        }
        if (!is_numeric($post['resume_hightmoney'])){
            //Resume_resume_money_must_num
            echo L('Resume_resume_money_must_num');
            exit;
        }

        if (empty($post['resume_workyear'])){
            //Resume_resume_workyear_not_empty
            echo L('Resume_resume_workyear_not_empty');
            exit;
        }
        if (!is_numeric($post['resume_workyear'])){
            //Resume_resume_workyear_must_num
            echo L('Resume_resume_workyear_must_num');
            exit;
        }
       if (empty($post['resume_fileurl'])){
           echo L('Resume_resume_not_empty');
           exit;
       }
        //resume_position
        //resume_hightmoney
        //resume_workyear
    }


    //简历模版列表
    public function resume_module(){

        $count = M("s_resume_module")->count();
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
        $list = M("s_resume_module")->limit($Page->firstRow.','.$Page->listRows)->order("resume_module_sort DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();

    }

    public function ajax_module_add(){

        if (!isset($_POST['name'])||$_POST['name']==''){
            die(json_encode(array('str' => 0, 'msg' => L('resume_module_add_isname'))));
        }
        $moduledata = array();
        $file = $_FILES['file'];
        if($file){
            $upload1 = new \Think\Upload();
            $upload1->maxSize = 3072000;
            $upload1->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload1->rootPath = './Uploads/';
            $info1 = $upload1->uploadOne($file);
            if(!$info1) {
                die(json_encode(array('str' => 0,'msg'=>$upload1->getError())));
            }else{
                $moduledata['resume_module_url'] = $info1['savepath'].$info1['savename'];
            }
        }
        $moduledata['resume_module_name'] = $_POST['name'];
        $moduledata['resume_module_createtime'] = date("Y-m-d H:i:s", time());
        $res = M("s_resume_module")->add($moduledata);
        if ($res){
            die(json_encode(array('str' => 1, 'msg' => L('resume_module_addok'))));
        }else{
            die(json_encode(array('str' => 0, 'msg' => L('resume_module_addno'))));
        }

    }

    public function module_edit(){

        $one = M("s_resume_module")->where('resume_module_id = '.$_GET['mid'])->find();

        $this->assign('one',$one);
        $this->display();
    }

    public function ajax_module_edit(){
        $file = $_FILES['file'];
        if ((!isset($_POST['name'])&&$file)||($_POST['name']==''&&$file)){
            die(json_encode(array('str' => 1, 'msg' => L('resume_module_editok'))));
        }
        $moduledata = array();
        $file = $_FILES['file'];
        if($file){
            $upload1 = new \Think\Upload();
            $upload1->maxSize = 3072000;
            $upload1->exts = array('jpg', 'gif', 'png', 'jpeg');
            $upload1->rootPath = './Uploads/';
            $info1 = $upload1->uploadOne($file);
            if(!$info1) {
                die(json_encode(array('str' => 0,'msg'=>$upload1->getError())));
            }else{
                $moduledata['resume_module_url'] = $info1['savepath'].$info1['savename'];
            }
        }
        $moduledata['resume_module_name'] = $_POST['name'];
        $res = M("s_resume_module")->where('resume_module_id = '.$_POST['id'])->save($moduledata);
        if ($res){
            die(json_encode(array('str' => 1, 'msg' => L('resume_module_editok'))));
        }else{
            die(json_encode(array('str' => 0, 'msg' => L('resume_module_editno'))));
        }

    }

    public function ajax_module_del(){

        $res = M("s_resume_module")->where('resume_module_id = '.$_POST['mid'])->delete();
        if ($res){
            die(json_encode(array('str' => 1, 'msg' => L('resume_module_delok'))));
        }else{
            die(json_encode(array('str' => 0, 'msg' => L('resume_module_delno'))));
        }
    }


}