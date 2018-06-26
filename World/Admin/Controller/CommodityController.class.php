<?php
namespace Admin\Controller;
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
}