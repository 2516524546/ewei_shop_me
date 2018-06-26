<?php
namespace Admin\Controller;
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
            $res=M("s_news")->add($_POST);
            if ($res){
                echo 1;
            }else{
                echo "添加失败";
            }
        }else{
            $modules=M("s_module")->select();
            $this->assign('modules',$modules);
            $this->assign("type",I('type'));
        }
        $this->display();
    }

    public function new_del(){
        $id=$_POST['id'];
        //更新状态,改为已发布
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

}