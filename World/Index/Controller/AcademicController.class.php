<?php
namespace Index\Controller;
use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
use Index\Model\SecondMarkModel;
use Think\Controller;
class AcademicController extends CommonController {
    public $modeleid = 3;

	/*
	学术首页
	 */
    public function academic(){

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
    创建学术群
     */
    public function createAcademic(){

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
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'data' => $data,

        ));
    	$this->display();
    }

    /*
    学术群详情
     */
    public function academicGroups(){

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
    学术帖子详情（文字图片）
     */
    public function stickSonDetails(){

    	$this->display();
    }

    /*
    学术帖子详情（文字视频）
     */
    public function postVideoDetails(){

    	$this->display();
    }
    
    /*
    学术问答详情
     */
    public function questionAnswerDetails(){

    	$this->display();
    }

    /*
    学术资源详情
     */
    public function resourceDetails(){

    	$this->display();
    }

    /*
    发布
     */
    public function groupDetailsRelease(){


    	$this->display();
    }

    /*
    更多成员
     */
    public function moreMembers(){

    	$this->display();
    }


}