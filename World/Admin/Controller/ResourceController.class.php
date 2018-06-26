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

class MessageController extends CommonController {

    //信息列表
    public function message_list(){

        $messagemodel = new MessageModel();
        $messagecount = $messagemodel->joinfind('1=1','u_user u on u_message.message_uid = u.user_id','message_sendtime desc,message_delivertime desc,message_id desc','INNER','count(*) num')['num'];

        $Page = new \Think\Page($messagecount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();
        $messagelist = $messagemodel->joinlist('1=1','u_user u on u_message.message_uid = u.user_id','message_sendtime desc,message_delivertime desc,message_id desc',$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'messagelist' => $messagelist,
            'page' => $show,
        ));
        $this->display();
    }

    //发布群信息
    public function message_ajax_set(){

        if (IS_POST) {

            $messagemodel = new MessageModel();

            if ($_POST['type']==1){

                $uids = $_POST['uid'];
                $uidlist = explode(',',$uids);
                $messagemodel->startTrans();
                try {

                    foreach ($uidlist as $uid) {

                        $messagedata = array();
                        $messagedata['message_title'] = $_POST['title'];
                        $messagedata['message_content'] = $_POST['content'];
                        $messagedata['message_sendtime'] = date("Y-m-d H:i:s", time());
                        $messagedata['message_delivertime'] = date("Y-m-d H:i:s", time());
                        $messagedata['message_uid'] = $uid;
                        $messagedata['message_cid'] = $_POST['cid'];
                        $messagedata['message_type'] = 2;
                        $messagemodel->add($messagedata);
                    }
                    $messagemodel->commit();
                    die(json_encode(array('str' => 1,'msg'=>L('Crowd_message_set_yes'))));
                }catch (Exception $e){
                    $messagemodel->rollback();
                    die(json_encode(array('str' => 0,'msg'=>L('Crowd_message_set_no'))));
                }
            }else{
                $membermodel = new CrowdMemberModel();
                $memberlist = $membermodel->findlist('crowd_member_cid = '.$_POST['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id','INNER','crowd_member_status desc,crowd_member_logintime desc');
                $messagemodel->startTrans();
                try {

                    foreach ($memberlist as $member) {
                        $messagedata = array();
                        $messagedata['message_title'] = $_POST['title'];
                        $messagedata['message_content'] = $_POST['content'];
                        $messagedata['message_sendtime'] = date("Y-m-d H:i:s", time());
                        $messagedata['message_delivertime'] = date("Y-m-d H:i:s", time());
                        $messagedata['message_uid'] = $member['crowd_member_uid'];
                        $messagedata['message_cid'] = $_POST['cid'];
                        $messagedata['message_type'] = 2;
                        $messagemodel->add($messagedata);

                    }
                    $messagemodel->commit();
                    die(json_encode(array('str' => 1,'msg'=>L('Crowd_message_set_yes'))));
                }catch (Exception $e){
                    $messagemodel->rollback();
                    die(json_encode(array('str' => 0,'msg'=>L('Crowd_message_set_no'))));
                }
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //信息删除
    public function ajax_messagedel(){
        if (IS_POST) {

            $mid = $_POST['mid'];

            $messagemodel = new MessageModel();

            $res = $messagemodel->where('message_id = ' . $mid)->delete();
            if ($res) {

                die(json_encode(array('str' => 1, 'msg' => L('Message_message_list_delyes'))));
            } else {

                die(json_encode(array('str' => 2, 'msg' => L('Message_message_list_delno'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

    //群发
    public function set_list(){

        $this->display();
    }

    //群发ajax
    public function message_ajax_setlist(){

        if (IS_POST) {

            $usermodel = new UserModel();
            $messagemodel = new MessageModel();
            $userlist = $usermodel->findlist('1=1','user_id');

            $messagemodel->startTrans();
            try {

                foreach ($userlist as $user) {

                    $messagedata = array();
                    $messagedata['message_title'] = $_POST['title'];
                    $messagedata['message_content'] = $_POST['content'];
                    $messagedata['message_sendtime'] = date("Y-m-d H:i:s", time());
                    $messagedata['message_delivertime'] = date("Y-m-d H:i:s", time());
                    $messagedata['message_uid'] = $user['user_id'];

                    $messagedata['message_type'] = 0;
                    $messagemodel->add($messagedata);
                }
                $messagemodel->commit();
                die(json_encode(array('str' => 1,'msg'=>L('Message_set_list_yes'))));
            }catch (Exception $e){
                $messagemodel->rollback();
                die(json_encode(array('str' => 0,'msg'=>L('Message_set_list_no'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }

    //私发
    public function set_one(){

        $this->display();
    }

    //私发ajax
    public function message_ajax_setone(){

        if (IS_POST) {

            $messagemodel = new MessageModel();

            $messagedata = array();
            $messagedata['message_title'] = $_POST['title'];
            $messagedata['message_content'] = $_POST['content'];
            $messagedata['message_sendtime'] = date("Y-m-d H:i:s", time());
            $messagedata['message_delivertime'] = date("Y-m-d H:i:s", time());
            $messagedata['message_uid'] = $_POST['uid'];
            $messagedata['message_type'] = 0;
            $res = $messagemodel->add($messagedata);
            if ($res){
                die(json_encode(array('str' => 1,'msg'=>L('Message_set_list_yes'))));
            }else{
                die(json_encode(array('str' => 0,'msg'=>L('Message_set_list_no'))));
            }



        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }

    }


}