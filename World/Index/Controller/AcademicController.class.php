<?php
namespace Index\Controller;
use Index\Model\AdvertisingModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\CrowdTabModel;
use Index\Model\FirstMarkModel;
use Index\Model\ModuleModel;
use Index\Model\NewsModel;
use Index\Model\NoteCommentModel;
use Index\Model\NoteModel;
use Index\Model\NoteVIModel;
use Index\Model\QuestionModel;
use Index\Model\ResourceModel;
use Index\Model\SecondMarkModel;
use Index\Model\TutorShipIssueCommentModel;
use Index\Model\TutorShipIssueModel;
use Index\Model\TutorShipNeedCommentModel;
use Index\Model\TutorShipNeedModel;
use Index\Model\UserModel;
use Think\Controller;
class AcademicController extends CommonController {
    public $modeleid = 3;

	/*
	学术{:L('newworld_home')}
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

        $modulemodel = new ModuleModel();
        $moduleone = $modulemodel->findone('module_id = '.$this->modeleid);

        $now = date("Y-m-d H:i:s", time());
        $newsmodel = new NewsModel();
        $newslist = $newsmodel->findlist('news_static = 1 and news_for = 1 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'"','news_sort desc');

        $advertisingmodel = new AdvertisingModel();
        $advertisinglist = $advertisingmodel->findlist('advertising_for = 1 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'"');

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'newslist' => $newslist,
            'moduleone' => $moduleone,
            'advertisinglist' => $advertisinglist,
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'data' =>$data,
            'crodlist'=>$crodlist,
            'crowdcount' => $crowdcount,
        ));
        $this->display();
    }

    //新闻详情
    public function newsDetails(){

        $newsmodel = new NewsModel();
        $newsone = $newsmodel->findone('news_id = '.$_GET['nid']);

        $this->assign(array(
            'newsone' => $newsone,

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

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Academic/academic'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'u_user u on u_crowd.crowd_uid = u.user_id','INNER','u_crowd.*,u.user_name');
        if (!$crowdone){
            Header("Location:".U('Index/Academic/academic'));
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

        /*$questionlist = $questionmodel->joinonelist('question_cid = '.$_GET['cid'].' and question_ishide = 1','u_user u on u_question.question_uid = u.user_id','question_istop desc,question_iswally desc,question_createtime desc',0,20);

        $questioncount = $questionmodel->joinone('question_cid = '.$_GET['cid'].' and question_ishide = 1','u_user u on u_question.question_uid = u.user_id','question_istop desc,question_iswally desc,question_createtime desc','INNER','count(*) num')['num'];*/
        $questionlist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $questioncount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        /*$resourcelist = $resourcemodel->joinonelist('resource_cid = '.$_GET['cid'].' and resource_ishide = 1','u_user u on u_resource.resource_uid = u.user_id','resource_istop desc,resource_iswally desc,resource_createtime desc',0,20);

        $resourcecount = $resourcemodel->joinone('resource_cid = '.$_GET['cid'].' and resource_ishide = 1','u_user u on u_resource.resource_uid = u.user_id','resource_istop desc,resource_iswally desc,resource_createtime desc','INNER','count(*) num')['num'];*/
        $resourcelist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $resourcecount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        $tutorissuemodel = new TutorShipIssueModel();
        $issuelist = $tutorissuemodel->joinonelist('tutorship_issue_cid = '.$_GET['cid'].' and tutorship_issue_ishide = 1','u_user u on u_tutorship_issue.tutorship_issue_uid = u.user_id','tutorship_issue_istop desc,tutorship_issue_iswally desc,tutorship_issue_createtime desc',0,20);

        $issuecount = $tutorissuemodel->joinone('tutorship_issue_cid = '.$_GET['cid'].' and tutorship_issue_ishide = 1','u_user u on u_tutorship_issue.tutorship_issue_uid = u.user_id','tutorship_issue_istop desc,tutorship_issue_iswally desc,tutorship_issue_createtime desc','INNER','count(*) num')['num'];

        $tutorneedmodel = new TutorShipNeedModel();
        $needlist = $tutorneedmodel->joinonelist('tutorship_need_cid = '.$_GET['cid'].' and tutorship_need_ishide = 1','u_user u on u_tutorship_need.tutorship_need_uid = u.user_id','tutorship_need_istop desc,tutorship_need_iswally desc,tutorship_need_createtime desc',0,20);

        $needcount = $tutorneedmodel->joinone('tutorship_need_cid = '.$_GET['cid'].' and tutorship_need_ishide = 1','u_user u on u_tutorship_need.tutorship_need_uid = u.user_id','tutorship_need_istop desc,tutorship_need_iswally desc,tutorship_need_createtime desc','INNER','count(*) num')['num'];

        $now = date("Y-m-d H:i:s", time());

        $newsmodel = new NewsModel();
        $newslist = $newsmodel->findlist('news_static = 1 and news_for = 2 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'" and news_crowdid = '.$_GET['cid'],'news_sort desc');
        if (!$newslist){
            $newslist = $newsmodel->findlist('news_static = 1 and news_for = 2 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'" and news_crowdid = 0','news_sort desc');
        }

        $advertisingmodel = new AdvertisingModel();
        $advertisinglist = $advertisingmodel->findlist('advertising_for = 2 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'" and advertising_crowdid = '.$_GET['cid']);
        if (!$advertisinglist){
            $advertisinglist = $advertisingmodel->findlist('advertising_for = 2 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'" and advertising_crowdid = 0');
        }

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'newslist' => $newslist,
            'advertisinglist' => $advertisinglist,
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
            'issuelist' => $issuelist,
            'issuecount' => $issuecount,
            'needlist' => $needlist,
            'needcount' => $needcount,

        ));

    	$this->display();
    }


    //新闻详情
    public function crowdnews(){

        $newsmodel = new NewsModel();
        $newsone = $newsmodel->findone('news_id = '.$_GET['nid']);

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $this->assign(array(
            'newsone' => $newsone,
            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
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
    发布帖子
     */
    public function groupDetailsRelease(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academicGroups').'&cid = '.$_GET['cid']);
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
     帖子详情
     */
    public function postDetails(){
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        if (!isset($_GET['cid'])||$_GET['cid']==''){
            Header("Location:".U('Index/Academic/academic'));
            exit();
        }
        if (!isset($_GET['nid'])||$_GET['nid']==''){
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
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
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
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

        $isdown = 0;
        $downloadlist = explode(',',$noteone['note_downloadmember']);
        if (in_array($this->userid, $downloadlist)){
            $isdown=1;
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
            'isdown' => $isdown,
            'commentlist' => $commentlist,
            'commentcount' => $commentcount

        ));


        $this->display();
    }

    /*
     发布提供辅导
     */
    public function releasedCounseling(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academicGroups').'&cid = '.$_GET['cid']);
            exit();
        }

        $this->assign(array(

            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
        ));

        $this->display();
    }

    /*
     发布寻求辅导
     */
    public function postDemand(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academic'));
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
            Header("Location:".U('Index/Academic/academicGroups').'&cid = '.$_GET['cid']);
            exit();
        }

        $this->assign(array(

            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
        ));

        $this->display();
    }


    /*
    提供辅导详情
     */
    public function provideCounsellingDetails(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        if (!isset($_GET['cid'])||$_GET['cid']==''){
            Header("Location:".U('Index/Academic/academic'));
            exit();
        }
        if (!isset($_GET['tid'])||$_GET['tid']==''){
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();
        $tutorissuemodel = new TutorShipIssueModel();
        $issuecommentmodel = new TutorShipIssueCommentModel();
        $usermodel = new UserModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $crowdmemberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid.' and crowd_member_status != -1');
        $issueone = $tutorissuemodel->findone('tutorship_issue_id = '.$_GET['tid']);
        if ($issueone['tutorship_issue_cid']!=$_GET['cid']){
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
            exit();
        }

        $commentlist = $issuecommentmodel->joinonelist('tutorship_issue_comment_tid = '.$_GET['tid'],'u_user u on u_tutorship_issue_comment.tutorship_issue_comment_uid = u.user_id','tutorship_issue_comment_zans desc,tutorship_issue_comment_createtime desc',0,10);
        foreach ($commentlist as $key => $comment){
            $uidlist = explode(',',$comment['tutorship_issue_comment_zaner']);
            if (in_array($this->userid,$uidlist)){

                $commentlist[$key]['iszan'] = 1;
            }else{

                $commentlist[$key]['iszan'] = 0;
            }
        }
        $commentcount = $issuecommentmodel->joinone('tutorship_issue_comment_tid = '.$_GET['tid'],'u_user u on u_tutorship_issue_comment.tutorship_issue_comment_uid = u.user_id','tutorship_issue_comment_zans desc,tutorship_issue_comment_createtime desc','INNER','count(*) num')['num'];
        $issueuser = $usermodel->findone('user_id = '.$issueone['tutorship_issue_uid']);

        $isjoin = 0;
        $ishave = 0;
        if ($crowdmemberone){
            $isjoin = 1;
        }
        if ($issueone['tutorship_issue_uid']==$this->userid){
            $ishave = 1;
        }

        $this->assign(array(
            'crowdone' => $crowdone,
            'isjoin' => $isjoin,
            'crowdmemberone' => $crowdmemberone,
            'issueone' => $issueone,
            'cid' => $_GET['cid'],
            'issueuser' => $issueuser,
            'ishave' => $ishave,
            'commentlist' => $commentlist,
            'commentcount' => $commentcount

        ));

        $this->display();

    }

    /*
    寻求辅导详情
     */
    public function counselingDetails(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        if (!isset($_GET['cid'])||$_GET['cid']==''){
            Header("Location:".U('Index/Academic/academic'));
            exit();
        }
        if (!isset($_GET['tid'])||$_GET['tid']==''){
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();
        $tutorneedmodel = new TutorShipNeedModel();
        $needcommentmodel = new TutorshipNeedCommentModel();
        $usermodel = new UserModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $crowdmemberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid.' and crowd_member_status != -1');
        $needone = $tutorneedmodel->findone('tutorship_need_id = '.$_GET['tid']);
        if ($needone['tutorship_need_cid']!=$_GET['cid']){
            Header("Location:".U('Index/Academic/academicGroups')."&cid=".$_GET['cid']);
            exit();
        }

        $commentlist = $needcommentmodel->joinonelist('tutorship_need_comment_tid = '.$_GET['tid'],'u_user u on u_tutorship_need_comment.tutorship_need_comment_uid = u.user_id','tutorship_need_comment_zans desc,tutorship_need_comment_createtime desc',0,10);
        foreach ($commentlist as $key => $comment){
            $uidlist = explode(',',$comment['tutorship_need_comment_zaner']);
            if (in_array($this->userid,$uidlist)){

                $commentlist[$key]['iszan'] = 1;
            }else{

                $commentlist[$key]['iszan'] = 0;
            }
        }
        $commentcount = $needcommentmodel->joinone('tutorship_need_comment_tid = '.$_GET['tid'],'u_user u on u_tutorship_need_comment.tutorship_need_comment_uid = u.user_id','tutorship_need_comment_zans desc,tutorship_need_comment_createtime desc','INNER','count(*) num')['num'];
        $needuser = $usermodel->findone('user_id = '.$needone['tutorship_need_uid']);

        $isjoin = 0;
        $ishave = 0;
        if ($crowdmemberone){
            $isjoin = 1;
        }
        if ($needone['tutorship_need_uid']==$this->userid){
            $ishave = 1;
        }

        $this->assign(array(
            'crowdone' => $crowdone,
            'isjoin' => $isjoin,
            'crowdmemberone' => $crowdmemberone,
            'needone' => $needone,
            'cid' => $_GET['cid'],
            'needuser' => $needuser,
            'ishave' => $ishave,
            'commentlist' => $commentlist,
            'commentcount' => $commentcount

        ));

        $this->display();

    }

    /*
    更多成员
     */
    public function moreMembers(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Academic/academic'));
            exit();
        }
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $list = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,10,'INNER','crowd_member_status desc,crowd_member_logintime desc','u_crowd_member.*,u.user_icon,u.user_name');
        $listcount =$crowdmembermodel->findonejoin('crowd_member_cid = '.$_GET['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id','INNER','crowd_member_status desc,crowd_member_logintime desc','count(*) num')['num'];

        $adminlist = array();
        $memberlist = array();
        foreach ($list as $l){
            if ($l['crowd_member_status']!=0){
                $adminlist[]=$l;
            }else if ($l['crowd_member_status']==0){
                $memberlist[]=$l;
            }
        }

        $this->assign(array(
            'crowdone'=>$crowdone,
            'cid' => $_GET['cid'],
            'adminlist' => $adminlist,
            'memberlist' => $memberlist,
            'listcount' => $listcount,

        ));

        $this->display();
    }


}