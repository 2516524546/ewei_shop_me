<?php
namespace Index\Controller;
use Index\Model\CrowdConditionModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\CrowdTabModel;
use Index\Model\FirstMarkModel;
use Index\Model\NoteCommentModel;
use Index\Model\NoteModel;
use Index\Model\NoteVIModel;
use Index\Model\QuestionModel;
use Index\Model\ResourceModel;
use Index\Model\SecondMarkModel;
use Index\Model\UserModel;
use Index\Model\WorksCompanyTypeModel;
use Index\Model\WorksModel;
use Think\Controller;
class JobsController extends CommonController {
    public $modeleid = 4;

    protected $_checkAction = ['MyProject','releasePosition','releaseMyPosition','ReleaseProfessional','DeleteWork'];//需要做登录验证的action

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
	工作{:L('newworld_home')}
	 */
    public function work(){

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();
        $crodmodel = new CrowdModel();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
        $data1 = array();
        foreach ($firstlist as $firthkey =>$first){

            $data1[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');
            $data1[$firthkey]['message'] = $secondlist;
        }


        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 2','firsth_mark_sort');
        $data2 = array();
        foreach ($firstlist as $firthkey =>$first){

            $data2[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');
            $data2[$firthkey]['message'] = $secondlist;
        }

        $crodlist = $crodmodel->findlist('crowd_mid = '.$this->modeleid.' and crowd_type = 1','u_user u on u_crowd.crowd_uid = u.user_id','INNER','crowd_creattime desc','u.user_name,u_crowd.*');

        $crowdcount = $crodmodel->findone('crowd_mid = '.$this->modeleid.' and crowd_type = 1','u_user u on u_crowd.crowd_uid = u.user_id','INNER','count(*) num')['num'];
        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'data1' =>$data1,
            'data2' =>$data2,
            'crodlist'=>$crodlist,
            'crowdcount' => $crowdcount,
        ));
        $this->display();
    }

    /*
    工作列表
     */
    public function jobList(){
        $where = 'w.works_isdel=1';

        $k = I('get.k','','trim');
        if($k){
            $where .= ' AND (w.works_position LIKE "%'.$k.'%" OR w.works_position LIKE "%'.$k.'%")';
        }
        $major = I('get.major','','trim');
        if($major){
            $where .= ' AND (w.works_specialty LIKE "%'.$major.'%" OR w.works_specialty LIKE "%'.$major.'%")';
        }

        $work_type = I('get.work_type','','intval');
        if($work_type){
            $where .= ' AND w.works_type='.$work_type;
        }


        $count      = D('Works')->alias('w')->join('u_user u ON u.user_id = w.works_uid','LEFT')->where($where)->count();
        $Page       = new \Think\Page($count,8);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $works = D('Works')->alias('w')->field('w.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = w.works_uid','LEFT')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('works',$works);
        $this->assign('page',$show);
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
        $count      = D('Works')->where('works_uid = '.$this->userid)->count();
        $Page       = new \Think\Page($count,10);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $worklist = D('Works')->where('works_uid = '.$this->userid)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('worklist',$worklist);
        $this->assign('page',$show);

        $this->display();
    }

    /*
    工作详情
     */
    public function jobdetails(){

        $works_id = I('get.works_id','0','intval');
        $jobDetails = D('Works')->findone('works_id='.$works_id);
        $this->assign('jobDetails',$jobDetails);

        //获取用户的简历列表
        if($this->userid){
            $myResume = D('Resume')->field('resume_id,resume_name')->where('resume_uid='.$this->userid)->select();
            $this->assign('myResume',$myResume);
        }

        //增加浏览量
        D('Works')->updataone('works_id='.$works_id,['works_views'=>$jobDetails['works_views'] + 1]);

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
        if(IS_POST){
            $rules = array(
                array('city','require','Choose a city！'),
                array('industry','require','Choose industry！'),
                array('school','require','Choose a school！'),
                array('item_name','require','Enter the project name！'),
                array('item_uname','require','Enter your real name！'),
                array('item_content','require',' Enter the project’s introduction！'),
                array('value',array(1,2,3),'值的范围不正确！',2,'in'),
                array('repassword','password','确认密码不正确',0,'confirm'),
                array('password','checkPwd','密码格式不正确',0,'function'),
            );
        }

        $this->display();
    }

    /* 
    我发布的工作
    */
    public function postDeliveryRecord(){


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

        $conditionmodel = new CrowdConditionModel();
        if ($crowdone['crowd_type']==2){
            $conditionone = $conditionmodel->findone('crowd_condition_cid = '.$crowdone['crowd_id']);
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
            'conditionone' => $conditionone,
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
    兴趣帖子详情
     */
    public function postDetails(){
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        if (!isset($_GET['cid'])||$_GET['cid']==''){
            Header("Location:".U('Index/Jobs/work'));
            exit();
        }
        if (!isset($_GET['nid'])||$_GET['nid']==''){
            Header("Location:".U('Index/Jobs/groupDetails')."&cid=".$_GET['cid']);
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();
        $notemodel = new NoteModel();
        $notevimodel = new NoteVIModel();
        $notecommentmodel = new NoteCommentModel();
        $usermodel = new UserModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        if ($crowdone['crowd_mid']!=$this->modeleid){
            if ($crowdone['crowd_mid']==1){
                Header("Location:".U('Index/Index/index'));
                exit();
            }
            if ($crowdone['crowd_mid']==2){
                Header("Location:".U('Index/Rnterst/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==3){
                Header("Location:".U('Index/Academic/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==4){
                Header("Location:".U('Index/Jobs/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==5){
                Header("Location:".U('Index/Life/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
        }

        $crowdmemberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid.' and crowd_member_status != -1');
        $noteone = $notemodel->findone('note_id = '.$_GET['nid']);
        if ($noteone['note_cid']!=$_GET['cid']){
            Header("Location:".U('Index/Jobs/groupDetails')."&cid=".$_GET['cid']);
            exit();
        }
        $vilist = $notevimodel->findlist('note_vi_nid = '.$_GET['nid'],'note_vi_sort desc');
        $commentlist = $notecommentmodel->joinonelist('note_comment_nid = '.$_GET['nid'],'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_isanswer desc,note_comment_zans desc,note_comment_createtime desc',0,10);
        foreach ($commentlist as $key => $comment){
            $uidlist = explode(',',$comment['note_comment_zaner']);
            if (in_array($this->userid,$uidlist)){

                $commentlist[$key]['iszan'] = 1;
            }else{

                $commentlist[$key]['iszan'] = 0;
            }
        }
        $commentcount = $notecommentmodel->joinone('note_comment_nid = '.$_GET['nid'],'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_zans desc,note_comment_createtime desc','INNER','count(*) num')['num'];
        $noteuser = $usermodel->findone('user_id = '.$noteone['note_uid']);

        $isjoin = 0;
        $ishave = 0;
        if ($crowdmemberone){
            $isjoin = 1;
        }
        if ($noteone['note_uid']==$this->userid){
            $ishave = 1;
        }

        $this->assign(array(
            'crowdone' => $crowdone,
            'isjoin' => $isjoin,
            'crowdmemberone' => $crowdmemberone,
            'noteone' => $noteone,
            'cid' => $_GET['cid'],
            'noteuser' => $noteuser,
            'ishave' => $ishave,
            'vilist' => $vilist,
            'commentlist' => $commentlist,
            'commentcount' => $commentcount

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

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Jobs/work'));
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
            Header("Location:".U('Index/Jobs/work'));
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
        $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);
        if (!$memberone){
            Header("Location:".U('Index/Jobs/groupDetails').'&cid = '.$_GET['cid']);
            exit();
        }

        $crowdtabmodel = new CrowdTabModel();
        $tablist = $crowdtabmodel->findlist('','crowd_tab_sort');
        $this->assign(array(
            'tablist' => $tablist,
            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
        ));

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

    public function DeleteWork(){
        $works_id = I('post.works_id',0,'intval');
        if($works_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($works_id <= 0){
            $this->error('Parameter error！');
        }


        if(D('Works')->updataone('works_id='.$works_id,['works_isdel'=>'0'])){//拒绝好友
            die(json_encode(['status'=>1,'msg'=>'Delete success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delete failed!']));
        }
    }


    public function CloseWork(){
        $works_id = I('post.works_id',0,'intval');
        if($works_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($works_id <= 0){
            $this->error('Parameter error！');
        }


        if(D('Works')->updataone('works_id='.$works_id,['works_isclose'=>'0'])){//拒绝好友
            die(json_encode(['status'=>1,'msg'=>'Close success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Close failed!']));
        }
    }
}