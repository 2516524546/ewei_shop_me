<?php
namespace Admin\Controller;
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
            echo "删除失败";
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
            $modules=M("s_module")->select();
            $this->assign('modules',$modules);
            $this->assign("type",I('type'));
            $this->display();
        }
    }
    //提交数据验证
    public function verifyData($post){
        if (empty($post['advertising_crowdid'])&&$post['advertising_for']==2){
            echo "群id不能为空";
            exit;
        }
        if (empty($post['advertising_title'])){
            echo "新闻标题不能空";
            exit;
        }
        if (empty($post['advertising_img'])){
            echo "图片不能空";
            exit;
        }
        if (empty($post['advertising_mid'])||$post['advertising_mid']==0){
            echo "请选择所属分类";
            exit;
        }

        if (empty($post['advertising_url'])){
            echo "链接不能为空";
            exit;
        }
        if (empty($post['advertising_starttime'])){
            echo "创建时间不能为空";
            exit;
        }
        if (empty($post['advertising_finishtime'])){
            echo "结束时间不能为空";
            exit;
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
                echo "修改失败";
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
            echo "群id不能为空";
            exit;
        }
        if (empty($post['advertising_title'])){
            echo "新闻标题不能空";
            exit;
        }
        if (empty($post['advertising_img'])){
            echo "图片不能空";
            exit;
        }

        if (empty($post['advertising_url'])){
            echo "链接不能为空";
            exit;
        }

    }
}