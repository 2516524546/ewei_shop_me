<?php
namespace Admin\Controller;

use Index\Model\CrowdConditionModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\NoteCommentModel;
use Index\Model\NoteModel;
use Index\Model\NoteVIModel;
use Index\Model\TutorShipIssueModel;
use Index\Model\TutorShipNeedModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Exception;

class QuestionController extends CommonController {

    //群列表
    public function crowd_list(){

        $crowdmodel = new CrowdModel();
        $notemodel = new NoteModel();

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
        foreach ($crowdlist as $key=>$crowd){

            $notecount = $notemodel->findone('note_type = 2 and note_cid = '.$crowd['crowd_id'],'count(*) num')['num'];
            $crowdlist[$key]['notecount'] = $notecount;

        }


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
            $usermodel = new UserModel();

            $crowdmodel->startTrans();
            try {
                $crowdres = $crowdmodel->where('crowd_id = ' . $cid)->delete();
                $crowdconditionmodel->where('crowd_condition_cid = ' . $cid)->delete();
                $crowdmembermodel->where('crowd_member_cid = ' . $cid)->delete();
                $usernotelist = $notemodel->joinlist('note_cid = ' . $cid,'u_user u on u_note.note_uid = u.user_id');

                foreach ($usernotelist as $usernote){

                    $data=array();
                    $userone = $usermodel->findone('user_id = '.$usernote['user_id']);
                    $data['user_notes'] = $userone['user_notes']-1;

                    $usermodel->updataone('user_id = '.$userone['user_id'],$data);

                }

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

        $cid = '';
        $uname = '';
        $title = '';
        $type = '';
        $where = 'note_type=2';

        if (isset($_GET['cid'])) {
            $cid = $_GET['cid'];
            $where .= ' and note_cid = '.$cid;
            $_SESSION['note_note_list_cid'] = $cid;
            $_SESSION['note_note_list_where'] = $where;
            $_SESSION['note_note_list_uname'] = '';
            $_SESSION['note_note_list_title'] = '';
            $_SESSION['note_note_list_type'] = '';
        }

        if (isset($_POST['cid'])){
            $cid = $_POST['cid'];
            $where .= ' and note_cid = '.$cid;
            $_SESSION['note_note_list_cid'] = $cid;
        }
        if (isset($_POST['uname'])){
            $uname = $_POST['uname'];
            $where .= ' and user_name like "%'.$uname.'%"';
            $_SESSION['note_note_list_uname'] = $uname;
        }
        if (isset($_POST['title'])){
            $title = $_POST['title'];
            $where .= ' and note_name like "%'.$title.'%"';
            $_SESSION['note_note_list_title'] = $title;
        }
        if (isset($_POST['type'])&&$_POST['type']!=''){
            $type = $_POST['type'];
            $where .= ' and note_ishide = '.$type;
            $_SESSION['note_note_list_type'] = $type;
        }

        if (isset($_POST['button'])){
            $_SESSION['note_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['note_note_list_where'];
                $cid = $_SESSION['note_note_list_cid'];
                $uname = $_SESSION['note_note_list_uname'];
                $title = $_SESSION['note_note_list_title'];
                $type = $_SESSION['note_note_list_type'];
            }else{
                $_SESSION['note_note_list_where'] = 'note_type = 2';
                $_SESSION['note_note_list_cid'] = '';
                $_SESSION['note_note_list_uname'] = '';
                $_SESSION['note_note_list_title'] = '';
                $_SESSION['note_note_list_type'] = '';
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
            'cid' => $cid,
            'uname' => $uname,
            'title' => $title,
            'type' => $type,
            'notelist' => $notelist,
            'page' => $show,
        ));
        $this->display();

    }

    //屏蔽
    public function ajax_note_list_hide(){

        if (IS_POST) {

            $nid = $_POST['nid'];
            $type = $_POST['type'];
            $notemodel = new NoteModel();
            $noteone = $notemodel->findone('note_id = '.$nid);
            $usermodel = new UserModel();
            $userone = $usermodel->findone('user_id = '.$noteone['note_uid']);

            $notemodel->startTrans();
            try {
                $data = array(
                    'note_ishide' => $type,
                );
                $res = $notemodel->updataone('note_id = ' . $nid, $data);



                if ($res) {
                    $notemodel->commit();
                    if ($type == 0) {
                        die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_hideyes'))));
                    } else {
                        die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_closehideyes'))));
                    }

                } else {
                    $notemodel->rollback();
                    if ($type == 0) {
                        die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_hideno'))));
                    } else {
                        die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closehideno'))));
                    }

                }
            }catch (Exception $e){
                $notemodel->rollback();
                if ($type == 0) {
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_hideno'))));
                } else {
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closehideno'))));
                }
            }


        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //置顶
    public function ajax_note_list_top(){

        if (IS_POST) {

            $nid = $_POST['nid'];
            $type = $_POST['type'];
            $notemodel = new NoteModel();

            $data = array(
                'note_istop' => $type,
            );
            $res = $notemodel->updataone('note_id = '.$nid,$data);

            if ($res) {
                if ($type == 1){
                    die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_topyes'))));
                }else{
                    die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_closetopyes'))));
                }

            } else {
                if ($type == 1){
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_topno'))));
                }else{
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closetopno'))));
                }
            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //加精
    public function ajax_note_list_wally(){

        if (IS_POST) {

            $nid = $_POST['nid'];
            $type = $_POST['type'];
            $notemodel = new NoteModel();

            $data = array(
                'note_iswally' => $type,
            );
            $res = $notemodel->updataone('note_id = '.$nid,$data);

            if ($res) {
                if ($type == 1){
                    die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_wallyyes'))));
                }else{
                    die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_closewallyyes'))));
                }

            } else {
                if ($type == 1){
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_wallyno'))));
                }else{
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closewallyno'))));
                }

            }


        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //删除帖子
    public function ajax_note_list_del(){
        if (IS_POST) {

            $nid = $_POST['nid'];
            $notemodel = new NoteModel();
            $usermodel = new UserModel();
            $noteone = $notemodel->findone('note_id = '.$nid);
            $userone = $usermodel->findone('user_id = '.$noteone['note_uid']);
            $data = array(
                'user_notes' => $userone['user_notes']-1,
            );
            $notemodel->startTrans();
            try {

                $res = $notemodel->where('note_id = '.$nid)->delete();

                if ($res) {
                    $notemodel->commit();
                    die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_delyes'))));
                } else {
                    $notemodel->rollback();
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_delno'))));
                }
            }catch (Exception $e){
                $notemodel->rollback();
                die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_delno'))));
            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //帖子详情
    public function note_detail(){

        $nid = $_GET['nid'];
        $notemodel = new NoteModel();
        $commentmodel = new NoteCommentModel();
        $notevimodel = new NoteVIModel();

        $noteone = $notemodel->findone('note_id = '.$nid);
        $notevilist = $notevimodel->findlist('note_vi_nid = '.$nid,'note_vi_sort desc');

        $commentcount = $commentmodel->joinone('note_comment_nid = '.$nid,'u_user u on u_note_comment.note_comment_uid = u.user_id','','INNER','count(*) num')['num'];

        $Page = new \Think\Page($commentcount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();

        $commentlist = $commentmodel->joinonelist('note_comment_nid = '.$nid,'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_createtime desc',$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'notevilist' => $notevilist,
            'noteone' => $noteone,
            'commentlist' => $commentlist,
            'page' => $show,
        ));
        $this->display();

    }

    //评论屏蔽
    public function ajax_note_comment_hide(){

        if (IS_POST) {

            $cid = $_POST['cid'];
            $type = $_POST['type'];
            $commentmodel = new NoteCommentModel();
            $commentone = $commentmodel->findone('note_comment_id = ' . $cid);
            $notemodel = new NoteModel();
            $noteone = $notemodel->findone('note_id = '.$commentone['note_comment_nid']);


            $commentmodel->startTrans();
            try {

                $commentdata = array(
                    'note_comment_ishide' => $type,
                );
                $commentres = $commentmodel->updataone('note_comment_id = ' . $cid, $commentdata);

                if ($type == 0){
                    $notedata = array(
                        'note_comments' => $noteone['note_comments']-1,
                    );
                }else{
                    $notedata = array(
                        'note_comments' => $noteone['note_comments']+1,
                    );
                }
                $noteres = $notemodel->updataone('note_id = '.$commentone['note_comment_nid'],$notedata);


                if ($noteres&&$commentres) {
                    $commentmodel->commit();
                    if ($type == 0) {
                        die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_hideyes'))));
                    } else {
                        die(json_encode(array('str' => 1, 'msg' => L('Note_note_list_closehideyes'))));
                    }

                } else {
                    $commentmodel->rollback();
                    if ($type == 0) {
                        die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_hideno'))));
                    } else {
                        die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closehideno'))));
                    }

                }
            }catch (Exception $e){
                $commentmodel->rollback();
                if ($type == 0) {
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_hideno'))));
                } else {
                    die(json_encode(array('str' => 2, 'msg' => L('Note_note_list_closehideno'))));
                }
            }


        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

}