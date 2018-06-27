<?php
namespace Admin\Controller;
use Think\Verify;

class NewController extends CommonController{
    public function new_list(){
        $type=I("type");
        if (empty($type)){
            $type=1;
        }
        $flag=I("flag");
        if (empty($flag)){
            $flag=1;
        }
        $where="news_mid={$type} and news_for={$flag}";
        $count = M("s_news")->where($where)->count();
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
         $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
         $list = M("s_news")->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("news_id DESC")->select();
         $modules=M("s_module")->select();
         $this->assign('modules',$modules);
         $this->assign('type',$type);
        $this->assign('flag',$flag);
         $this->assign("list",$list);
         $this->assign('page',$show);
         $this->display();
    }




    public function new_add(){

        if (IS_POST){
             $this->verifyData($_POST);
             $post=$_POST;
            if (empty($post['news_crowdid'])&&$post['news_for']==2){
                unset($post["news_crowdid"]);
            }
            $post['news_static']=0;
            $res=M("s_news")->add($post);
            if ($res){
                echo 1;
            }else{
                echo $res;
            }
        }else{
            if (I('type')==1){
                $where="module_id !=5";
            }elseif(I('type')==2){
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

        if (empty($post['news_title'])){
            echo "新闻标题不能空";
            exit;
        }
        if (empty($post['news_img'])){
            echo "图片不能空";
            exit;
        }
        if (empty($post['news_mid'])||$post['news_mid']==0){
            echo "请选择所属分类";
            exit;
        }

        if ($post['news_type']==0&&empty($post['news_url'])){
            echo "新闻链接不能为空";
            exit;
        }
        if ($post['news_type']==1&&empty($post['news_content'])){
            echo "新闻编辑内容不能为空";
            exit;
        }
        if (empty($post['news_sort'])){
            echo "轮播顺序不能为空或者不能为0";
            exit;
        }
        if (empty($post['news_createtime'])){
            echo "创建时间不能为空";
            exit;
        }
        if (empty($post['news_endtime'])){
            echo "结束时间不能为空";
            exit;
        }

    }

    public function new_del(){
        $id=$_POST['id'];
        $res=M('s_news')->where("news_id={$id}")->delete();
        if ($res){
            echo 1;
        }else{
            echo "删除失败";
        }
    }

    public function status_update(){
        $id=$_POST['id'];
        $status=$_POST['status'];
        if ($status==0){
            //更新状态,改为已发布
            $res=M('s_news')->where("news_id={$id}")->setField("news_static",1);
            if ($res){
                echo 1;
            }else{
                echo "更新失败";
            }
        }

    }

    public function new_edit(){
        if (IS_POST){
            //修改数据
            $this->verifyData2($_POST);
            $news_id=$_POST['news_id'];
            $res=M("s_news")->where("news_id={$news_id}")->save($_POST);
            if ($res){
                echo 1;
            }else{
                echo "修改失败";
            }
        }else{
            //查询数据
            $id=$_GET['id'];
            $new=M("s_news")->where("news_id={$id}")->find();
            $this->assign("new",$new);
            $this->display();
        }
    }
    //提交数据验证
    public function verifyData2($post){
       /* if (empty($post['news_crowdid'])&&$post['news_for']==2){
            echo "群id不能为空";
            exit;
        }*/
        if (empty($post['news_title'])){
            echo "新闻标题不能空";
            exit;
        }
        if (empty($post['news_img'])){
            echo "图片不能空";
            exit;
        }


        if ($post['news_type']==0&&empty($post['news_url'])){
            echo "新闻链接不能为空";
            exit;
        }
        if ($post['news_type']==1&&empty($post['news_content'])){
            echo "新闻编辑内容不能为空";
            exit;
        }
        if (empty($post['news_sort'])){
            echo "轮播顺序不能为空或者不能为0";
            exit;
        }
        if (empty($post['news_createtime'])){
            echo "创建时间不能为空";
            exit;
        }
        if (empty($post['news_endtime'])){
            echo "结束时间不能为空";
            exit;
        }

    }

}