<?php
namespace Index\Controller;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\CrowdTabModel;
use Index\Model\FirstMarkModel;
use Index\Model\SecondMarkModel;
use Think\Controller;
class RnterstController extends CommonController {
    public $modeleid = 2;

	/*
	兴趣首页
	 */
    public function interest(){

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();
        $crodmodel = new CrowdModel();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
        $data = array();
        foreach ($firstlist as $firthkey =>$first){

            $data[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');
            $data[$firthkey]['message'] = $secondlist;
        }

        $crodlist = $crodmodel->findlist('crowd_mid = '.$this->modeleid,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','crowd_creattime desc','u.user_name,u_crowd.*');

        $crowdcount = $crodmodel->findone('crowd_mid = '.$this->modeleid,'','','count(*) num')['num'];
        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'data' =>$data,
            'crodlist'=>$crodlist,
            'crowdcount' => $crowdcount,
        ));
        $this->display();
    }

    /*
    创建兴趣群
     */
    public function createInterest(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $data = array();

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
        foreach ($firstlist as $firthkey =>$first){

            $data[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');

            $data[$firthkey]['message'] = $secondlist;

        }

        $this->assign(array(
            'data' => $data,

        ));
        $this->display();
    }

    /*
    兴趣群详情
     */
    public function groupDetails(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'u_user u on u_crowd.crowd_uid = u.user_id','INNER','u_crowd.*,u.user_name');
        if (!$crowone){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }

        $crowdmembermodel = new CrowdMemberModel();
        $join_in = 0;
        if ($this->userid){

            $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);

            if ($memberone){
                $join_in = 1;
            }
        }
        $memberlist = $crowdmembermodel->findlist('crowd_member_cid = '.$_GET['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id','INNER','crowd_member_status desc','u_crowd_member.*,u.user_icon');
        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'crowone' => $crowone,
            'join_in' => $join_in,
            'memberlist' => $memberlist,

        ));

        $this->display();
    }

    /*
    分享
     */
    public function postSharing(){
        
        $this->display();
    }

    /*
    视频分享
     */
    public function videoFen(){

        $this->display();
    }

    /*
    兴趣帖子详情(文字图片)
     */
    public function stickSonDetails(){
        
        $this->display();
    }


    /*
    兴趣帖子详情(文字视频)
     */
    public function postVideoDetails(){

        $this->display();
    }

    /*
    兴趣问答详情
     */
    public function questionAnswerDetails(){

        $this->display();
    }

    /*
    兴趣资源详情
     */
    public function resourceDetails(){

        $this->display();
    }

    /*
    发布
     */
    public function groupDetailsRelease(){


        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'');

        if (!$crowdone){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }

        $crowdmembermodel = new CrowdMemberModel();
        $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);
        if (!$memberone){
            Header("Location:".U('Index/Rnterst/groupDetails').'&cid = '.$_GET['cid']);
            exit();
        }

        $crowdtabmodel = new CrowdTabModel();
        $tablist = $crowdtabmodel->findlist('','crowd_tab_sort');
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'tablist' => $tablist,

        ));

        $this->display();
    }

    /*
    更多成员
     */
    public function moreMembers(){

        $this->display();
    }

    public function test(){

        var_dump($_POST);

    }

}