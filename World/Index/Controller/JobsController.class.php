<?php
namespace Index\Controller;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
use Index\Model\NoteModel;
use Index\Model\QuestionModel;
use Index\Model\ResourceModel;
use Index\Model\SecondMarkModel;
use Index\Model\WorksCompanyTypeModel;
use Index\Model\WorksModel;
use Think\Controller;
class JobsController extends CommonController {
    public $modeleid = 4;

    protected $_checkAction = ['MyProject','releasePosition','releaseMyPosition','ReleaseProfessional'];//需要做登录验证的action

    public function _initialize()
    {
        parent::_initialize();
        if(in_array(ACTION_NAME,$this->_checkAction)){
            if (!$this->userid){
                session('returnurl', __SELF__);
                $this->redirect(U('Index/Login/login'));
            }
        }
    }

	/*
	工作首页
	 */
    public function work(){

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
            'data' =>$data,
            'crodlist'=>$crodlist,
            'crowdcount' => $crowdcount,
        ));
        $this->display();
    }

    /*
    工作列表
     */
    public function jobList(){

    	$this->display();
    }

    /*
    发布工作
     */
    public function releasePosition(){
        $companytypemodel = new WorksCompanyTypeModel();
        $companytypelist = $companytypemodel->findlist('','works_company_type_sort desc');

        $this->assign(array(
            'companytypelist' => $companytypelist,

        ));
    	$this->display();
    }

    /*
    我发布的工作
     */
    public function releaseMyPosition(){

        $workmodel = new WorksModel();
        $worklist = $workmodel->limitlist('works_uid = '.$this->userid.' and works_isdel = 1',0,10);

        $listnum = $workmodel->findone('works_uid = '.$this->userid.' and works_isdel = 1','count(*) num')['num'];


        $this->assign(array(
            'worklist' => $worklist,
            'listnum' => $listnum,

        ));
        $this->display();
    }

    /*
    工作详情
     */
    public function jobdetails(){

    	$this->display();
    }

    /*
    项目列表
     */
    public function projectsProfessionals(){

        $this->display();
    }

    /*
    发布项目
     */
    public function releaseProject(){


        $this->display();
    }

    /*
    创建工作群
     */
    public function createWork(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }
        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();

        $data1 = array();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
        foreach ($firstlist as $firthkey =>$first){

            $data1[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');

            $data1[$firthkey]['message'] = $secondlist;

        }

        $data2 = array();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 2','firsth_mark_sort');
        foreach ($firstlist as $firthkey =>$first){

            $data2[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');

            $data2[$firthkey]['message'] = $secondlist;

        }
        $firstone = $firstmodel->findone('first_mark_mid = '.$this->modeleid.' and first_mark_type = 0');
        $data3 = array();
        $data3 = $firstone;
        $data3['message'] = $secondmodel->findlist('second_mark_fid = '.$firstone['first_mark_id'],'second_mark_sort');


        $this->assign(array(
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,

        ));
        $this->display();
    }


    /*
    工作群详情
     */
    public function groupDetails(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'u_user u on u_crowd.crowd_uid = u.user_id','INNER','u_crowd.*,u.user_name');
        if (!$crowdone){
            Header("Location:".U('Index/Rnterst/interest'));
            exit();
        }

        if ($crowdone['crowd_mid']!=$this->modeleid){
            if ($crowdone['crowd_mid']==1){
                Header("Location:".U('Index/Index/index'));
                exit();
            }
            if ($crowdone['crowd_mid']==2){
                Header("Location:".U('Index/Rnterst/interest'));
                exit();
            }
            if ($crowdone['crowd_mid']==3){
                Header("Location:".U('Index/Academic/academic'));
                exit();
            }
            if ($crowdone['crowd_mid']==4){
                Header("Location:".U('Index/Jobs/work'));
                exit();
            }
            if ($crowdone['crowd_mid']==5){
                Header("Location:".U('Index/Life/life'));
                exit();
            }
        }

        $crowdmembermodel = new CrowdMemberModel();
        $join_in = 0;
        if ($this->userid){

            $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);

            if ($memberone){
                $join_in = 1;
            }
        }
        $adminlist = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'].' and crowd_member_status !=0','u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,4,'INNER','crowd_member_status desc','u_crowd_member.*,u.user_icon');
        $memberlist = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'].' and crowd_member_status =0','u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,8,'INNER','crowd_member_status desc,crowd_member_logintime desc','u_crowd_member.*,u.user_icon');

        $notemodel = new NoteModel();
        $questionmodel = new QuestionModel();
        $resourcemodel = new ResourceModel();

        $notelist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 1','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $notecount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 1','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        $questionlist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $questioncount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        $resourcelist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $resourcecount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'crowone' => $crowdone,
            'join_in' => $join_in,
            'adminlist' => $adminlist,
            'memberlist' => $memberlist,
            'cid' => $_GET['cid'],
            'notelist' => $notelist,
            'notecount' => $notecount,
            'questionlist' => $questionlist,
            'questioncount' => $questioncount,
            'resourcelist' => $resourcelist,
            'resourcecount' => $resourcecount,

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
    工作帖子详情(文字图片)
     */
    public function stickSonDetails(){

    	$this->display();
    }

    /*
    工作帖子详情(文字视频)
     */
    public function postVideoDetails(){

    	$this->display();
    }

    /*
    工作问答详情
     */
    public function questionAnswerDetails(){

    	$this->display();
    }

    /*
    工作资源详情
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

    public function MyProject(){
        $this->assign('title','My project');
        $css = addCss('WorkList');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function ProjectDetails(){
        $this->assign('title','Project details');
        $this->display();
    }

    public function ReleaseProfessional(){
        $this->assign('title','I am a professional');
        $css = addCss('JobList');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function ProfessionalDetails(){
        $this->assign('title','Professional Details');
        $css = addCss(['lifeProductDetails','StickSonDetails']);
        $this->assign('CSS',$css);
        $this->display();
    }
}