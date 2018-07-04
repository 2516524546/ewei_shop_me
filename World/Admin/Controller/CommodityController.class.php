<?php
namespace Admin\Controller;
use Think\Controller;
class CommodityController extends CommonController{
    public function commodity_list(){
        $where = "commodity_status != 0";
        $join="u_user as u on u.user_id=l_commodity.commodity_uid";
        $field="l_commodity.*,u.user_icon";
        $count = M("l_commodity")->where($where)->count();
        //实例化分页类

        $Page = new \Think\Page($count,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        $list = M("l_commodity")->where($where)->join($join,'LEFT')->field($field)->
        limit($Page->firstRow.','.$Page->listRows)->
        order("commodity_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    public function commodity_list_sou(){

        $where = "commodity_status != 0";
        $status = trim($_POST['status']);
        if($status&&$status!=-1){
            $where = "commodity_status ={$status}";
            $this->assign('status',$status);
        }elseif($status&&$status==0){
            $where = "commodity_status != 0";
        }
        $contact = trim($_POST['contact']);
        if($contact){
            $where .= " and commodity_uname like '%$contact%'";
            $this->assign('contact',$contact);
        }

        $phone = trim($_POST['phone']);
        if($phone){
            $where .= " and commodity_contact like '%$phone%'";
            $this->assign('phone',$phone);
        }
        $name = trim($_POST['name']);
        if($name){
            $where .= " and commodity_name like '%$name%'";
            $this->assign('name',$name);
        }


        $stime = trim($_POST['stime']);
        if($stime){
              $where .= " and UNIX_TIMESTAMP(commodity_createtime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
              $this->assign('stime',$stime);
          }

          $etime = trim($_POST['etime']);
          if($etime){
              $where .= " and UNIX_TIMESTAMP(commodity_createtime) <= UNIX_TIMESTAMP('$etime 23:59:59')";
              $this->assign('etime',$etime);
          }

       /* $button = $_POST['button'];
        if(empty($nickname) && empty($id) && empty($email)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['user_list_sou']){
                    $where = $_SESSION['user_list_sou'];
                }
            }
        }
        $_SESSION['user_list_sou'] = $where;*/

        $count = M("l_commodity")->where($where)->count();
        // dump(M("Users")->getLastSql());exit;
        //实例化分页类

        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $list = M("l_commodity")->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("commodity_id DESC")->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display('commodity_list');
    }

    public function commodity_updateStatus(){
        $ids = explode(',',$_POST['id']);
        foreach ($ids as $key=>$v){
            $res=M('l_commodity')->where("commodity_id={$v}")->setField("commodity_status",$_POST['status']);
        }
        if($res){
            echo 1;exit;
        }else{
            echo L('newworld_ajax_operation_fail');exit;
        }
    }

    public function commodity_del(){
        $res=M('l_commodity')->where("commodity_id={$_POST['id']}")->setField("commodity_status",0);
        if($res){
            echo 1;exit;
        }else{
            echo L('newworld_ajax_operation_fail');exit;
        }
    }
    public function commodity_add(){
        if (IS_POST){
            $this->verifyData($_POST);
            $res=M('l_commodity')->add($_POST);
            if($res){
                echo 1;exit;
            }else{
                echo L('newworld_ajax_operation_fail');exit;
            }
        }else{
            $cate=M('s_second_mark')->where("second_mark_fid=8")->select();
            $this->assign('cate',$cate);
            $this->display();
        }

    }

    public function verifyData($post){

        if (empty($post['commodity_name'])){
            echo L('Commodity_commodity_name_not_empty');
            exit;
        }
        if (empty($post['commodity_img'])){
            echo L('Commodity_commodity_img_not_empty');
            exit;
        }
        if (empty($post['commodity_category'])||$post['commodity_category']==0){
            echo L('Commodity_commodity_category_not_empty');
            exit;
        }
        if (empty($post['commodity_price'])){
            echo L('Commodity_commodity_price_not_empty');
            exit;
        }
        if (empty($post['commodity_uname'])){
            echo  L('Commodity_commodity_uname_not_empty');
            exit;
        }
        if (empty($post['commodity_contact'])){
            echo  L('Commodity_commodity_contact_not_empty');
            exit;
        }

        if (empty($post['commodity_content'])){
            echo L('Commodity_commodity_content_not_empty');
            exit;
        }
        if (empty($post['commodity_createtime'])){
            echo L('Commodity_commodity_createtime_not_empty');
            exit;
        }
    }
    //商品编辑
    public function commodity_edit(){
        if (IS_POST){
            $post=$_POST;
            $this->verifyData($post);
            if (empty($post['commodity_views'])||!isset($post['commodity_views'])){
                $post['commodity_views']=0;
            }
            if (!is_numeric($post['commodity_views'])){
               echo L('newworld_input_number');
               exit;
            }
            $id=$post['commodity_id'];
            $res=M('l_commodity')->where("commodity_id={$id}")->save($post);
            if($res){
                echo 1;exit;
            }else{
                echo L('newworld_ajax_operation_fail');exit;
            }

        }else{
            $id=$_GET['id'];
            $commodity=M('l_commodity')->where("commodity_id={$id}")->find();
            $cate=M('s_second_mark')->where("second_mark_fid=8")->select();
            $this->assign('cate',$cate);
            $this->assign("commodity",$commodity);
            $this->display();
        }
    }
    public function commodity_detail(){
        $id=$_GET['id'];
        $join="s_second_mark as s on s.second_mark_id=l_commodity.commodity_category";
        $commodity=M('l_commodity')->join($join)->where("commodity_id={$id}")->find();
        $this->assign("commodity",$commodity);
        $this->display();
    }
}