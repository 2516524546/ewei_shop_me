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
	
}