<?php
namespace Admin\Controller;

use Index\Model\CrowdConditionModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\MessageModel;
use Index\Model\NoteModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
use Index\Model\TutorShipIssueModel;
use Index\Model\TutorShipNeedModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Exception;

class NoteController extends CommonController {

    //群列表
    public function crowd_list(){

        $crowdmodel = new CrowdModel();

        $mid = '';
        $name = '';
        $where = '1=1';
        if (isset($_GET['mid'])) {
            $mid = $_GET['mid'];
            $where .= ' and crowd_mid = '.$mid;
            $_SESSION['note_crowd_list_mid'] = $mid;
            $_SESSION['note_crowd_list_where'] = $where;
            $_SESSION['note_crowd_list_name'] = '';
        }
        if (isset($_POST['mid'])){
            $mid = $_POST['mid'];
            $where .= ' and crowd_mid = '.$mid;
            $_SESSION['note_crowd_list_mid'] = $mid;
        }
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $where .= ' and crowd_name like "%'.$name.'%"';
            $_SESSION['note_crowd_list_name'] = $name;
        }

        if (isset($_POST['button'])){
            $_SESSION['note_crowd_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['note_crowd_list_where'];
                $mid = $_SESSION['note_crowd_list_mid'];
                $name = $_SESSION['note_crowd_list_name'];
            }
        }

        $crowdcount = $crowdmodel->findone($where,'','','count(*) num')['num'];

        $Page = new \Think\Page($crowdcount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();

        $crowdlist= $crowdmodel->findlist($where,'','','crowd_posts desc,crowd_creattime desc',false,$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'mid' => $mid,
            'name' => $name,
            'crowdlist' => $crowdlist,
            'page' => $show,
        ));
        $this->display();
    }

    //删除群
    public function ajax_crowd_del(){
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

    //帖子列表
    public function note_list(){

        $cid = $_GET['cid'];
        $uname = '';
        $name = '';
        $type = 1;
        $where = '1=1';

        if (isset($_POST['uname'])){
            $uname = $_POST['uname'];
            $where .= ' and user_name = like "%'.$uname.'%"';
            $_SESSION['note_list_uname'] = $uname;
        }
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $where .= ' and note_name like "%'.$name.'%"';
            $_SESSION['note_list_name'] = $name;
        }
        if (isset($_POST['type'])){
            $type = $_POST['type'];
            $where .= ' and note_ishide = '.$type;
            $_SESSION['note_list_type'] = $type;
        }

        if (isset($_POST['button'])){
            $_SESSION['note_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['note_list_where'];
                $uname = $_SESSION['note_list_uname'];
                $name = $_SESSION['note_list_name'];
                $type = $_SESSION['note_list_type'];
            }else{
                $_SESSION['note_list_where'] = '';
                $_SESSION['note_list_uname'] = '';
                $_SESSION['note_list_name'] = '';
                $_SESSION['note_list_type'] = '';
            }
        }

        $notemodel = new NoteModel();

        $notecount = $notemodel->joinone($where,'u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        $Page = new \Think\Page($notecount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();

        $notelist= $notemodel->joinonelist($where,'u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'uname' => $uname,
            'name' => $name,
            'type' => $type,
            'notelist' => $notelist,
            'page' => $show,
        ));
        $this->display();

    }


}