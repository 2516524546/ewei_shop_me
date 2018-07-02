<?php
namespace Admin\Controller;
use Think\Controller;
//广告控制器
class AdvertisingController extends CommonController
{
    public function advertising_list()
    {
        $type = I("type");
        if (empty($type)) {
            $type = 1;
        }
        $flag = I("flag");
        if (empty($flag)) {
            $flag = 1;
        }
        $where = "advertising_mid={$type} and advertising_for={$flag}";
        $count = M("s_advertising")->where($where)->count();
        //实例化分页类
        $Page = new \Think\Page($count, $this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        $list = M("s_advertising")->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->order("advertising_id DESC")->select();
        $modules = M("s_module")->select();
        $this->assign('modules', $modules);
        $this->assign('type', $type);
        $this->assign('flag', $flag);
        $this->assign("list", $list);
        $this->assign('page', $show);
        $this->display();
    }

    public function advertising_del()
    {
        $id=$_POST['id'];
        $res=M('s_advertising')->where("advertising_id={$id}")->delete();
        if ($res){
            echo 1;
        }else{
            echo L('newworld_ajax_operation_fail');
        }
    }

    public function advertising_add(){
        if (IS_POST){
            $this->verifyData($_POST);
            $res=M("s_advertising")->add($_POST);
            if ($res){
                echo 1;
            }else{
                echo $res;
            }
        }else{
            if(I('type')==2){
                $where="module_id !=1";
            }
            $modules=M("s_module")->where($where)->select();
            $this->assign('modules',$modules);
            $this->assign("type",I('type'));
            $this->display();
        }
    }
    //提交数据验证
    public function verifyData($post){
        if (empty($post['advertising_crowdid'])&&$post['advertising_for']==2){
            //Advertising_advertising_group_id_not_empty
            echo L('Advertising_advertising_group_id_not_empty');
            exit;
        }
        if (empty($post['advertising_title'])){
            //Advertising_advertising_title_not_empty
            echo L('Advertising_advertising_title_not_empty');
            exit;
        }
        if (empty($post['advertising_img'])){
            //Advertising_advertising_picture_not_empty
            echo L('Advertising_advertising_picture_not_empty');
            exit;
        }
        if (empty($post['advertising_mid'])||$post['advertising_mid']==0){
            //Advertising_advertising_select_category
            echo L('Advertising_advertising_select_category');
            exit;
        }

        if (empty($post['advertising_url'])){
            //Advertising_advertising_link_not_empty
            echo L('Advertising_advertising_link_not_empty');
            exit;
        }
        if (empty($post['advertising_starttime'])){
            //Advertising_advertising_createtime_not_empty
            echo L('Advertising_advertising_createtime_not_empty');
            exit;
        }
        if (empty($post['advertising_finishtime'])){
            //Advertising_advertising_endtime_not_empty
            echo L('Advertising_advertising_endtime_not_empty');
            exit;
        }
        //模块广告
        if ($post['advertising_for']==1){
            //判断记录数是否大于等于2
            $now = date("Y-m-d H:i:s", time());
            $count=M("s_advertising")->where("advertising_for = 1 and advertising_mid=".$post['advertising_mid']." and advertising_finishtime > '".$now."'")->count();
            if ($count>=2){
                //Advertising_module_number_max_two
                echo L('Advertising_module_number_max_two');
                exit;
            }
        }elseif ($post['advertising_for']==2){ //群广告
            //advertising_crowdid
            $now = date("Y-m-d H:i:s", time());
            $count=M("s_advertising")->where("advertising_for = 2 and advertising_crowdid=".$post['advertising_crowdid']." and advertising_finishtime > '".$now."'")->count();
            if ($count>=1){
                //Advertising_group_number_max_one
                echo L('Advertising_group_number_max_one');
                exit;
            }
        }

    }

    public function advertising_edit(){
        if (IS_POST){
            //修改数据
            $this->verifyData2($_POST);
            $advertising_id=$_POST['advertising_id'];
            $res=M("s_advertising")->where("advertising_id={$advertising_id}")->save($_POST);
            if ($res){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            //查询数据
            $id=$_GET['id'];
            $advertising=M("s_advertising")->where("advertising_id={$id}")->find();
            $this->assign("advertising",$advertising);
            $this->display();
        }
    }
    public function verifyData2($post){
        if (empty($post['advertising_crowdid'])&&$post['advertising_for']==2){
            //Advertising_advertising_group_id_not_empty
            echo L('Advertising_advertising_group_id_not_empty');
            exit;
        }
        if (empty($post['advertising_title'])){
            //Advertising_advertising_title_not_empty
            echo L('Advertising_advertising_title_not_empty');
            exit;
        }
        if (empty($post['advertising_img'])){
            //Advertising_advertising_picture_not_empty
            echo L('Advertising_advertising_picture_not_empty');
            exit;
        }

        if (empty($post['advertising_url'])){
            //Advertising_advertising_link_not_empty
            echo L('Advertising_advertising_link_not_empty');
            exit;
        }

    }
}