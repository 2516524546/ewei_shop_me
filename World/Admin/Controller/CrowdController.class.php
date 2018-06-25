<?php
namespace Admin\Controller;

use Index\Model\CrowdConditionModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\NoteModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
use Index\Model\TutorShipIssueModel;
use Index\Model\TutorShipNeedModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Exception;

class CrowdController extends CommonController {


    public function crowd_list(){

        $crowdmodel = new CrowdModel();
        $where = '1=1';
        $id = '';
        $crowdname = '';
        $peoplename = '';
        $peoplephone = '';

        if (isset($_POST['id'])){
            $where .= ' and crowd_id like "%'.$_POST['id'].'%"';
            $id = $_POST['id'];
            $_SESSION['crowd_list_id'] = $_POST['id'];
        }
        if (isset($_POST['crowdname'])){
            $where .= ' and crowd_name like "%'.$_POST['crowdname'].'%"';
            $crowdname = $_POST['crowdname'];
            $_SESSION['crowd_list_crowdname'] = $_POST['crowdname'];
        }
        if (isset($_POST['peoplename'])){
            $where .= ' and user_name like "%'.$_POST['peoplename'].'%"';
            $peoplename = $_POST['peoplename'];
            $_SESSION['crowd_list_peoplename'] = $_POST['peoplename'];
        }
        if (isset($_POST['peoplephone'])){
            $where .= ' and user_mail like "%'.$_POST['peoplephone'].'%"';
            $peoplephone = $_POST['peoplephone'];
            $_SESSION['crowd_list_peoplephone'] = $_POST['peoplephone'];
        }

        if (isset($_POST['button'])){
            $_SESSION['crowd_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['crowd_list_where'];
                $id = $_SESSION['crowd_list_id'];
                $crowdname = $_SESSION['crowd_list_crowdname'];
                $peoplename = $_SESSION['crowd_list_peoplename'];
                $peoplephone = $_SESSION['crowd_list_peoplephone'];
            }
        }

        $crowdcount = $crowdmodel->findone($where,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','count(*) num')['num'];

        $Page = new \Think\Page($crowdcount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();

        $crowdlist = $crowdmodel->findlist($where,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','crowd_creattime desc','*',$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'crowdlist'=>$crowdlist,
            'page' => $show,
            'id' => $id,
            'crowdname' => $crowdname,
            'peoplename' => $peoplename,
            'peoplephone' => $peoplephone,

        ));
        $this->display();
    }

    //解散群组
    public function ajax_crowddel(){

        if (IS_POST) {

            $cid = $_POST['cid'];

            $crowdmodel = new CrowdModel();
            $crowdconditionmodel = new CrowdConditionModel();
            $crowdmembermodel = new CrowdMemberModel();
            $notemodel = new NoteModel();
            $tutorissuemodel = new TutorShipIssueModel();
            $tutorneedmodel = new TutorShipNeedModel();

            $crowdmodel->startTrans();
            try {
                $crowdres = $crowdmodel->where('crowd_id = ' . $cid)->delete();
                $crowdconditionmodel->where('crowd_condition_cid = ' . $cid)->delete();
                $crowdmembermodel->where('crowd_member_cid = ' . $cid)->delete();
                $notemodel->where('note_cid = ' . $cid)->delete();
                $tutorissuemodel->where('tutorship_issue_cid = ' . $cid)->delete();
                $tutorneedmodel->where('tutorship_need_cid = ' . $cid)->delete();


                if ($crowdres) {
                    $crowdmodel->commit();
                    die(json_encode(array('str' => 1, 'msg' => L('Crowd_crowd_list_delyes'))));
                } else {
                    $crowdmodel->rollback();
                    die(json_encode(array('str' => 2, 'msg' => L('Crowd_crowd_list_delno'))));
                }
            }catch (Exception $e){
                $crowdmodel->rollback();
                die(json_encode(array('str' => 2, 'msg' => L('Crowd_crowd_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //群修改页面
    public function crowd_detail(){

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'u_user u on u_crowd.crowd_uid = u.user_id');

        $this->assign(array(
            'crowdone'=>$crowdone,

        ));

        $this->display();
    }

    //群编辑ajax
    public function crowd_edit(){
        if (IS_POST) {

            $crowddata = array(
                'crowd_name' => $_POST['name'],
                'crowd_type' => $_POST['type'],
                'crowd_intro' => $_POST['intro'],
            );
            $userdata = array(
                'user_name' => $_POST['uname'],
                'user_mail' => $_POST['umail'],
            );

            $file1 = $_FILES['icon'];
            if($file1){
                $upload1 = new \Think\Upload();
                $upload1->maxSize = 3072000;
                $upload1->exts = array('jpg', 'gif', 'png', 'jpeg');
                $upload1->rootPath = './Uploads/';
                $info1 = $upload1->uploadOne($file1);
                if(!$info1) {
                    die(json_encode(array('str' => 0,'msg'=>$upload1->getError())));
                }else{
                    $crowddata['crowd_icon'] = $info1['savepath'].$info1['savename'];
                }
            }
            $file2 = $_FILES['uicon'];
            if($file2){
                $upload2 = new \Think\Upload();
                $upload2->maxSize = 3072000;
                $upload2->exts = array('jpg', 'gif', 'png', 'jpeg');
                $upload2->rootPath = './Uploads/';
                $info2 = $upload2->uploadOne($file1);
                if(!$info2) {
                    die(json_encode(array('str' => 0,'msg'=>$upload2->getError())));
                }else{
                    $userdata['user_icon'] = $info2['savepath'].$info2['savename'];
                }
            }

            $crowdmodel = new CrowdModel();
            $usermodel = new UserModel();
            $crowdmodel->startTrans();
            try{

                $crowdres = $crowdmodel->updataone('crowd_id = '.$_POST['cid'],$crowddata);
                $userres = $usermodel->updataone('user_id = '.$_POST['uid'],$userdata);
                $crowdmodel->commit();
                die(json_encode(array('str' => 1, 'msg' => L('Crowd_crowd_detail_yes'))));
            }catch (Exception $e){
                $crowdmodel->rollback();
                die(json_encode(array('str' => 0, 'msg' => L('Crowd_crowd_detail_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //群成员列表
    public function member_list(){

        $cid = $_GET['cid'];
        $where = 'crowd_member_cid = '.$_GET['cid'];
        $uname = '';
        $umail = '';

        if (isset($_POST['uname'])){
            $where .= ' and user_name like "%'.$_POST['uname'].'%"';
            $uname = $_POST['uname'];
            $_SESSION['member_list_uname'] = $_POST['uname'];
        }
        if (isset($_POST['umail'])){
            $where .= ' and user_mail like "%'.$_POST['umail'].'%"';
            $umail = $_POST['umail'];
            $_SESSION['member_list_umail'] = $_POST['umail'];
        }

        if (isset($_POST['button'])){
            $_SESSION['member_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['member_list_where'];
                $uname = $_SESSION['member_list_uname'];
                $umail = $_SESSION['member_list_umail'];

            }
        }

        $membermodel = new CrowdMemberModel();
        $membercount = $membermodel->findonejoin($where,'u_user u on u_crowd_member.crowd_member_uid = u.user_id','INNER','crowd_member_status desc,crowd_member_logintime desc','count(*) num')['num'];

        $Page = new \Think\Page($membercount,$this->pagenum);
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $Page->show();

        $memberlist = $membermodel->findlistlimit($where,'u_user u on u_crowd_member.crowd_member_uid = u.user_id',$Page->firstRow,$Page->listRows,'INNER','crowd_member_status desc,crowd_member_logintime desc');

        $this->assign(array(
            'page' => $show,
            'memberlist' => $memberlist,
            'uname' => $uname,
            'umail' => $umail,
            'cid' => $cid,

        ));
        $this->display();

    }

    //删除群成员
    public function ajax_memberdel(){

        if (IS_POST) {

            $mid = $_POST['mid'];

            $crowdmembermodel = new CrowdMemberModel();
            $crowdmodel = new CrowdModel();
            $memberone = $crowdmembermodel->findone('crowd_member_id = ' . $mid);
            $crowdone = $crowdmodel->findone('crowd_id = '.$memberone['crowd_member_cid'],'');
            $crowdmembermodel->startTrans();
            try {
                $data = array(
                    'crowd_peoplenum' => $crowdone['crowd_peoplenum'] - 1,
                );
                $res = $crowdmembermodel->where('crowd_member_id = ' . $mid)->delete();
                $crowdres = $crowdmodel->updataone('crowd_id = '.$memberone['crowd_member_cid'],$data);

                if ($res&&$crowdres) {
                    $crowdmembermodel->commit();
                    die(json_encode(array('str' => 1, 'msg' => L('Crowd_member_list_delyes'))));
                } else {
                    $crowdmembermodel->rollback();
                    die(json_encode(array('str' => 2, 'msg' => L('Crowd_member_list_delno'))));
                }
            }catch (Exception $e){
                $crowdmembermodel->rollback();
                die(json_encode(array('str' => 2, 'msg' => L('Crowd_member_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //查看成员
    public function member_detail(){

        $membermodel = new CrowdMemberModel();
        $memberone = $membermodel->findonejoin('crowd_member_id = '.$_GET['mid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id');

        $this->assign(array(
            'memberone' => $memberone,

        ));
        $this->display();
    }

	
}