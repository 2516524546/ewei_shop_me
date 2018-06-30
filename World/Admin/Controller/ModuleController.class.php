<?php
namespace Admin\Controller;
use Think\Controller;
class ModuleController extends CommonController{

    public function module_list(){
        $list=M("s_module")->where("module_id !=1")->select();
        $this->assign("list",$list);
        $this->display();
    }

    public function module_edit(){
        if (IS_POST){
            $post=$_POST;
            $res=M("s_module")->where("module_id={$post['module_id']}")->save($post);
            if ($res){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            $id=I("id");
            $module=M("s_module")->where("module_id={$id}")->find();
            $this->assign("module",$module);
            $this->display();
        }
    }
    public function module_del(){
        $id=I("id");
        $res=M("s_module")->where("module_id={$id}")->setField("module_content","");
        if ($res){
            echo 1;
        }else{
            echo L('newworld_ajax_operation_fail');
        }
    }

}