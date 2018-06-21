<?php
namespace Admin\Controller;
class ProposalController extends CommonController {
    public function proposal_list(){
        $join="s_proposal_type as t on t.proposal_type_id=proposal_tid";
        $count = M("s_proposal")->count();
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
        $list = M("s_proposal")->join($join)->limit($Page->firstRow.','.$Page->listRows)->order("proposal_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("proposal_list");
    }


    public function proposal_list_sou(){
        $where="proposal_time>'0'";
        $phone=trim($_POST['phone']);
        if ($phone){
            $where .=" and proposal_phone like '%$phone%'";
            $this->assign("phone",$phone);
        }
        $join="s_proposal_type as t on t.proposal_type_id=proposal_tid";
        $count = M("s_proposal")->where($where)->count();
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
        $list = M("s_proposal")->where($where)->join($join)->limit($Page->firstRow.','.$Page->listRows)->order("proposal_id DESC")->select();
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display("proposal_list");
    }

    public function proposal_del(){
        $id=$_POST['id'];
        $res=M("s_proposal")->where("proposal_id={$id}")->delete();
        if ($res){
            echo 1;
        }else{
            echo "删除失败!";
        }
    }
}