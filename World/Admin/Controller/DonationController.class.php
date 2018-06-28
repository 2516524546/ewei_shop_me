<?php
namespace Admin\Controller;
use Think\Controller;
class DonationController extends CommonController {

    public function donation_list(){
        $join="u_user as u on u.user_id=donation_uid";
        $count = M("u_donation")->where("donation_static=1")->count();
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
        $list = M("u_donation")->join($join)->where("donation_static=1")->limit($Page->firstRow.','.$Page->listRows)->order("donation_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("donation_list");
    }

    public function donation_list_sou(){
        $join="u_user as u on u.user_id=donation_uid";
        $where="donation_static=1";
        $nickname = trim($_POST['nickname']);
        if($nickname){
            $where .= " and u.user_name like '%$nickname%'";
            $this->assign('nickname',$nickname);
        }
        $email= trim($_POST['email']);
        if($email){
            $where .= " and u.user_mail like '%$email%'";
            $this->assign('email',$email);
        }
        $stime = trim($_POST['stime']);
	   if($stime){
     		$where .= " and UNIX_TIMESTAMP(donation_paytime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
     		$this->assign('stime',$stime);
     	}

     	$etime = trim($_POST['etime']);
     	if($etime){
     		$where .= " and UNIX_TIMESTAMP(donation_paytime) <= UNIX_TIMESTAMP('$etime 23:59:59')";
     		$this->assign('etime',$etime);
     	}
        $count = M("u_donation")->join($join)->where($where)->count();
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
        $list = M("u_donation")->join($join)->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("donation_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("donation_list");
    }


    //查看详情
    public function donation_detail(){
        $id=$_GET["id"];
        $join="u_user as u on u.user_id=donation_uid";
        $donation=M("u_donation")->join($join)->where("donation_id={$id}")->find();
        $this->assign("donation",$donation);
        $this->display("donation_detail");
    }

    //导出文件123
    public function donation_daochu(){
        $join="u_user as u on u.user_id=donation_uid";
        $donation=M("u_donation")->join($join)->where("donation_static=1")->order("donation_id DESC")->select();
        foreach($donation as $k=>$v){
            $data[$k] = array('donation_id'=>$v['donation_id'],
                'user_name'=>$v['user_name'],
                'donation_money'=>$v['donation_money'],
                'user_mail'=>$v['user_mail'],
                'donation_coin'=>$v['donation_coin'],
                'donation_paytime'=>$v['donation_paytime']);
        }

        $this->exportexcel($data,array(L('Donation_donation_list_serial_number'),
            L('Donation_donation_list_donor'),L('Donation_donation_list_donation_amount'),
            L('Crowd_member_list_mail'),L('Donation_donation_list_virtual_currency'),
            L('Donation_donation_list_donation_date')),L('Donation_donation_list_record'));

    }



}