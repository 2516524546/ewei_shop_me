<?php
namespace Index\Controller;
use Index\Model\AdvertisingModel;
use Index\Model\CrowdConditionModel;
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
use Index\Model\UserModel;
use Index\Model\WorksCompanyTypeModel;
use Index\Model\WorksModel;
use Think\Controller;
class JobsController extends CommonController {
    public $modeleid = 4;

    protected $_checkAction = ['MyProject','releasePosition','releaseMyPosition','ReleaseProfessional','DeleteWork','DeleteItem','EditItem','PostProfessionalComment','EditWork','ProfessionalCommentZan'];//需要做登录验证的action

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
            'data1' =>$data1,
            'data2' =>$data2,
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
    工作列表
     */
    public function jobList(){
        $where = '(w.works_isdel=1 AND w.works_isclose=1)';

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

        $companytypemodel = new WorksCompanyTypeModel();
        $companytypelist = $companytypemodel->findlist('','works_company_type_sort desc');
        $this->assign('companytypelist',$companytypelist);

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
        //获取城市
        $fid = D('FirstMark')->where('firsth_mark_name="city" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $city =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('city',$city);
        }

        //获取专业
        $fid = D('FirstMark')->where('firsth_mark_name="specialty" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $specialty =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('specialty',$specialty);
        }

        //获取行业
        $fid = D('FirstMark')->where('firsth_mark_name="industry" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $industry =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('industry',$industry);
        }

        $type = I('get.type',0,'intval');

        //项目

        $where = 'i.item_isdel=1';
        if($type === 0){
            $k = I('get.k','','trim');
            if($k){
                $where .= ' AND (i.item_name LIKE "%'.$k.'%" OR i.item_name LIKE "%'.$k.'%")';
            }
            $item_city = I('get.item_city','','trim');
            if($item_city){
                $where .= ' AND i.item_city="'.$item_city.'"';
            }

            $item_specialty = I('get.item_specialty','','trim');
            if($item_specialty){
                $where .= ' AND i.item_specialty="'.$item_specialty.'"';
            }
        }
        $count      = D('Item')->alias('i')->join('u_user u ON u.user_id = i.item_uid','LEFT')->where($where)->count();
        $Page       = new \Think\Page($count,8);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $items = D('Item')->alias('i')->field('i.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = i.item_uid','LEFT')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('items',$items);
        $this->assign('page',$show);

        //专业人士
        $where = '1';

        if($type === 1){
            $professional_industry = I('get.professional_industry','','trim');
            if($professional_industry){
                $where .= ' AND p.professional_city="'.$professional_industry.'"';
            }
            $professional_city = I('get.professional_city','','trim');
            if($professional_city){
                $where .= ' AND p.professional_city="'.$professional_city.'"';
            }

            $professional_specialty = I('get.professional_specialty','','trim');
            if($professional_specialty){
                $where .= ' AND p.professional_specialty="'.$professional_specialty.'"';
            }
        }
        $count      = D('Professional')->alias('p')->join('u_user u ON u.user_id = p.professional_uid','LEFT')->where($where)->count();
        $Page       = new \Think\Page($count,8);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $professionals_show       = $Page->show();
        if($professionals_show){
            $professionals = D('Professional')->alias('p')->field('p.*,u.user_name,u.user_icon,u.user_signature,count(pc.professional_comment_id) as professional_comment')->join('u_user u ON u.user_id = p.professional_uid','LEFT')->join('j_professional_comment pc ON pc.professional_comment_pid = p.professional_id','LEFT')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        }else{
            $professionals = null;
        }

        $this->assign('professionals',$professionals);
        $this->assign('professionals_page',$professionals_show);
        $this->display();
    }

    /*
    发布项目
     */
    public function releaseProject(){
        if(IS_POST){
            $rules = array(
                array('item_city','require','Choose a city！'),
                array('item_specialty','require','Choose industry！'),
                array('item_school','require','Choose a school！'),
                array('item_name','6,80','The project name length requires 6-80 characters！',0,'length'),
                array('item_uname','require','Enter your real name！'),
                array('item_contact','require',' Enter the contact information！'),
                array('item_mail','check_email','Enter the email！',0,'callback'),
                array('item_company','require','Enter the company！'),
                array('item_type','require','Enter the project’s type！'),
                array('item_content','require','Enter the company information！'),
                array('item_budget','require','Enter the project’s budget！'),
                array('item_time','require','Enter the duration of the project！'),
                array('item_needspecialty','require','Enter the major you require！'),
            );
            $data = I('post.');
            $data['item_uid'] = $this->userid;
            $data['item_icon'] = '';
            $data['item_firstmarks'] = '';
            $data['item_secondmarks'] = '';
            $data['item_thirdmarks'] = '';
            $data['item_fourthmarks'] = '';
            $data['item_createtime'] = date('Y-m-d H:i:s',time());
            $Item = D("Item"); // 实例化User对象
            if (!$Item->validate($rules)->create()){
                die(json_encode(['status'=>0,'msg'=>$Item->getError()]));
            }else{
                // 验证通过 可以进行其他数据操作
                if($Item->add($data)){
                    die(json_encode(['status'=>1,'msg'=>'Create success!','href'=>U('Index/Jobs/projectsProfessionals')]));
                }else{
                    die(json_encode(['status'=>0,'msg'=>'Create Failed!']));
                }
                exit;
            }

        }

        //获取城市
        $fid = D('FirstMark')->where('firsth_mark_name="city" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $city =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('city',$city);
        }

        //获取专业
        $fid = D('FirstMark')->where('firsth_mark_name="specialty" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $specialty =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('specialty',$specialty);
        }

        //获取学校
        $fid = D('FirstMark')->where('firsth_mark_name="school" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $school =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('school',$school);
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
        //获取城市
        $fid = D('FirstMark')->where('firsth_mark_name="city" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $city =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('city',$city);
        }

        //获取专业
        $fid = D('FirstMark')->where('firsth_mark_name="specialty" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $specialty =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('specialty',$specialty);
        }

        $where = 'i.item_isdel=1 AND item_uid='.$this->userid;

        $k = I('get.k','','trim');
        if($k){
            $where .= ' AND (i.item_name LIKE "%'.$k.'%" OR i.item_name LIKE "%'.$k.'%")';
        }
        $item_city = I('get.item_city','','trim');
        if($item_city){
            $where .= ' AND i.item_city="'.$item_city.'"';
        }

        $item_specialty = I('get.item_specialty','','trim');
        if($item_specialty){
            $where .= ' AND i.item_specialty="'.$item_specialty.'"';
        }

        $count      = D('Item')->alias('i')->join('u_user u ON u.user_id = i.item_uid','LEFT')->where($where)->count();
        $Page       = new \Think\Page($count,8);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $items = D('Item')->alias('i')->field('i.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = i.item_uid','LEFT')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('items',$items);
        $this->assign('page',$show);

        $this->assign('title','My project');
        $css = addCss('WorkList');
        $this->assign('CSS',$css);

        $this->display();
    }

    public function ProjectDetails(){
        $item_id = I('get.item_id');
        $item = D('Item')->where('item_id='.$item_id)->find();
        if(!$item){
            $this->error('The project does not exist!');
        }
        $this->assign('item',$item);

        $this->assign('title','Project details');
        $this->display();
    }

    public function ReleaseProfessional(){

        $professional_uid = I('get.professional_uid',0,'intval');
        if(!$professional_uid || $professional_uid != $this->userid){
            $this->error('Parameter error！');
        }
        $professional = D('Professional')->where('professional_uid='.$professional_uid)->find();
        $this->assign('professional',$professional);


        if(IS_POST){
            $rules = array(
                array('professional_city','require','Choose a city！'),
                array('professional_specialty','require','Choose industry！'),
                array('professional_school','require','Choose a school！'),
                array('professional_specialty','6,80','The major name length requires 6-80 characters！',0,'length'),
                array('professional_uname','require','Enter your real name！'),
                array('professional_contact','require',' Enter the contact information！'),
                array('professional_trait','require','Enter your speciality！'),
                array('item_company','require','Enter the company！'),
                array('professional_content','require','Enter the company information！'),
            );
            $data = I('post.');
            $data['professional_uid'] = $this->userid;
            $data['professional_firstmarks'] = '';
            $data['professional_secondmarks'] = '';
            $data['professional_thirdmarks'] = '';
            $data['professional_fourthmarks'] = '';
            $data['professional_createtime'] = $data['professional_updatetime'] = date('Y-m-d H:i:s',time());
            $Professional = D("Professional"); // 实例化User对象
            if (!$Professional->validate($rules)->create()){
                die(json_encode(['status'=>0,'msg'=>$Professional->getError()]));
            }else{
                if(!$professional){
                    // 验证通过 进行文件上传
                    $upload = new \Think\Upload();
                    $upload->maxSize   =     3145728 ;
                    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
                    $upload->rootPath  =      './Uploads/';
                    $info   =   $upload->uploadOne($_FILES['professional_pic']);
                    if(!$info) {
                        die(json_encode(['status'=>0,'msg'=>$upload->getError()]));
                    }else{
                        $data['professional_pic'] = $info['savepath'].$info['savename'];
                    }

                    if($Professional->add($data)){
                        die(json_encode(['status'=>1,'msg'=>'Create success!']));
                    }else{
                        die(json_encode(['status'=>0,'msg'=>'Create Faild!']));
                    }
                }else{
                    if($Professional->where('professional_uid='.$this->userid)->save($data)){
                        die(json_encode(['status'=>1,'msg'=>'Edit success!']));
                    }else{
                        die(json_encode(['status'=>0,'msg'=>'Create Faild!']));
                    }
                }
                exit;
            }
        }
        //获取城市
        $fid = D('FirstMark')->where('firsth_mark_name="city" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $city =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('city',$city);
        }

        //获取专业
        $fid = D('FirstMark')->where('firsth_mark_name="specialty" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $specialty =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('specialty',$specialty);
        }

        //获取学校
        $fid = D('FirstMark')->where('firsth_mark_name="school" AND first_mark_mid=4 AND first_mark_type=3')->getField('first_mark_id');
        if($fid){
            $school =  D('SecondMark')->where('second_mark_fid='.$fid)->select();
            $this->assign('school',$school);
        }

        $this->assign('title','I am a professional');
        $css = addCss('JobList');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function ProfessionalDetails(){
        $professional_id = I('get.professional_id');
        $professional = D('Professional')->alias('p')->field('p.*,u.user_name,u.user_icon,u.user_signature,u.user_notes,u.user_sex,u.user_mail')->join('u_user u ON u.user_id = p.professional_uid','LEFT')->where('professional_id='.$professional_id)->find();
        if(!$professional){
            $this->error('The professional does not exist!');
        }
        $this->assign('professional',$professional);

        $count      = D('ProfessionalComment')->alias('pc')->join('u_user u on pc.professional_comment_uid = u.user_id','LEFT')->where('pc.professional_comment_pid = '.$professional_id)->count();
        $Page       = new \Think\Page($count,10);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $commentlist = D('ProfessionalComment')->alias('pc')->field('pc.*,u.user_name,u.user_icon,u.user_signature,u.user_notes,u.user_sex,u.user_mail')->join('u_user u on pc.professional_comment_uid = u.user_id','LEFT')->where('pc.professional_comment_pid = '.$professional_id)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('commentlist',$commentlist);
        $this->assign('page',$show);


        $this->assign('title','Professional Details');
        $css = addCss(['lifeProductDetails','StickSonDetails','Donation']);
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

    public function DeleteItem(){
        $item_id = I('post.item_id',0,'intval');
        if($item_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($item_id <= 0){
            $this->error('Parameter error！');
        }

        if(D('Item')->where('item_id='.$item_id . ' AND item_uid='.$this->userid)->delete()){
            die(json_encode(['status'=>1,'msg'=>'Delete success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delete failed!']));
        }
    }

    public function GetItem(){
        $item_id = I('post.item_id',0,'intval');
        if($item_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($item_id <= 0){
            $this->error('Parameter error！');
        }
        $result = D('Item')->where('item_id='.$item_id . ' AND item_uid='.$this->userid)->find();
        if($result){
            die(json_encode($result));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Query failed!']));
        }
    }

    public function EditItem(){
        $rules = array(
            array('item_city','require','Choose a city！'),
            array('item_specialty','require','Choose industry！'),
            array('item_school','require','Choose a school！'),
            array('item_name','6,80','The project name length requires 6-80 characters！',0,'length'),
            array('item_uname','require','Enter your real name！'),
            array('item_contact','require',' Enter the contact information！'),
            array('item_mail','check_email','Enter the email！',0,'callback'),
            array('item_company','require','Enter the company！'),
            array('item_type','require','Enter the project’s type！'),
            array('item_content','require','Enter the company information！'),
            array('item_budget','require','Enter the project’s budget！'),
            array('item_time','require','Enter the duration of the project！'),
            array('item_needspecialty','require','Enter the major you require！'),
        );
        $data = I('post.');
        $data['item_uid'] = $this->userid;
        $data['item_icon'] = '';
        $data['item_firstmarks'] = '';
        $data['item_secondmarks'] = '';
        $data['item_thirdmarks'] = '';
        $data['item_fourthmarks'] = '';
        $data['item_createtime'] = date('Y-m-d H:i:s',time());
        $Item = D("Item"); // 实例化User对象
        if (!$Item->validate($rules)->create()){
            exit(json_encode($Item->getError()));
        }else{
            // 验证通过 可以进行其他数据操作
            if($Item->save($data)){
                exit(json_encode(['status'=>1,'msg'=>'Edit Success!']));
            }else{
                exit(json_encode(['status'=>1,'msg'=>'Edit Faild!']));
            }
        }
    }


    public function PostProfessionalComment(){
        $professional_id = I('post.professional_id',0,'intval');
        $professional_comment_id = I('post.professional_comment_id',0,'intval');
        $comment = I('post.comment',0,'htmlspecialchars');
        if(($professional_id <= 0 || strlen($comment) < 6) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($professional_id <= 0 || strlen($comment) < 6)){
            $this->error('Parameter error！');
        }

        if($professional_comment_id){
            $professional_comment = D('ProfessionalComment')->alias('pc')->join('j_professional p ON p.professional_id = pc.professional_comment_pid')->field('pc.*,p.professional_uid')->where('professional_comment_id='.$professional_comment_id)->find();
            if(!$professional_comment){
                die(json_encode(['status'=>0,'msg'=>'The comment does not exist！']));
            }
            if($professional_comment['professional_uid'] != $this->userid){
                die(json_encode(['status'=>0,'msg'=>'Your meiy rights review！']));
            }

            //回复
            $data['professional_comment_id'] = $professional_comment_id;
            $data['professional_comment_reply'] = $comment;
            $data['professional_comment_replytime'] = date('Y-m-d H:i:s',time());

            if(D('ProfessionalComment')->save($data)){
                die(json_encode(['status'=>1,'msg'=>'Comment success!']));
            }else{
                die(json_encode(['status'=>0,'msg'=>'Comment failed!']));
            }
        }else{
            $data['professional_comment_pid'] = $professional_id;
            $data['professional_comment_uid'] = $this->userid;
            $data['professional_comment_content'] = $comment;
            $data['professional_comment_zans'] = 0;
            $data['professional_comment_createtime'] = date('Y-m-d H:i:s',time());
            $data['professional_comment_replytime'] = date('Y-m-d H:i:s',time());

            if(D('ProfessionalComment')->add($data)){
                die(json_encode(['status'=>1,'msg'=>'Comment success!']));
            }else{
                die(json_encode(['status'=>0,'msg'=>'Comment failed!']));
            }
        }
    }

    public function GetWork(){
        $works_id = I('post.works_id',0,'intval');
        if($works_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($works_id <= 0){
            $this->error('Parameter error！');
        }
        $result = D('Works')->where('works_id='.$works_id . ' AND works_uid='.$this->userid)->find();

        if($result){
            die(json_encode($result));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Query failed!']));
        }
    }

    public function EditWork(){
        $rules = array(
            array('works_type',array(1,2,3),'Choose a city！',0,'in'),
            array('works_position','require','Enter a position！'),
            array('works_minmoney','require','Enter a numerical value！'),
            array('works_maxmoney','require','Enter a numerical value！'),
            array('works_years','require','Enter the number of years of service'),
            array('works_school','require','Enter a graduate school'),
            array('works_degree','require','Enter your degree'),
            array('works_specialty','require','Enter the specialty！'),
            array('works_company_name','require','Enter a job title!’s type！'),
            array('works_company_nature','require','Choose a company nature！'),
            array('works_company_type','require','Choose a company type！'),
            array('works_company_size','require','Enter the company size！'),
            array('works_company_mail','check_email','Enter the company mailbox！',0,'callback'),
            array('works_company_content','require','Enter the company information！'),
            array('works_isnegotiable',array(0,1),'Choose Salary Negotiable！',0,'in'),
        );
        $data = I('post.');
        $data['works_uid'] = $this->userid;
        $data['works_updatetime'] = date('Y-m-d H:i:s',time());
        $Works = D("Works"); // 实例化User对象
        if (!$Works->validate($rules)->create()){
            exit(json_encode(['status'=>1,'msg'=>$Works->getError()]));
        }else{
            // 验证通过 可以进行其他数据操作
            if($Works->save($data)){
                exit(json_encode(['status'=>1,'msg'=>'Edit Success!']));
            }else{
                exit(json_encode(['status'=>1,'msg'=>'Edit Faild!']));
            }
        }
    }

    public function ProfessionalCommentZan(){
        $professional_comment_id = I('post.professional_comment_id',0,'intval');
        $zan = I('post.zan',0,'intval');
        if(($professional_comment_id <= 0 || $zan < 0) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($professional_comment_id <= 0 || $zan < 0)){
            $this->error('Parameter error！');
        }
        $Comment = D('ProfessionalComment')->where('professional_comment_id='.$professional_comment_id )->find();
        if(!$Comment){
            die(json_encode(['status'=>0,'msg'=>'The comment does not exist！']));
        }
        if($zan === 1){
            $professional_comment_zaner = empty($Comment['professional_comment_zaner']) ? [] : explode(',',$Comment['professional_comment_zaner']);
            $professional_comment_zaner[] = $this->userid;
            $professional_comment_zaner = join(',',$professional_comment_zaner);
            $professional_comment_zans = $Comment['professional_comment_zans'] + 1;
        }else{
            $professional_comment_zaner = explode(',',$Comment['professional_comment_zaner']);
            $professional_comment_zaner = array_flip($professional_comment_zaner);
            if(isset($professional_comment_zaner[$this->userid])){
                unset($professional_comment_zaner[$this->userid]);
            }
            $professional_comment_zaner = array_flip($professional_comment_zaner);
            $professional_comment_zaner = join(',',$professional_comment_zaner);
            $professional_comment_zans = $Comment['professional_comment_zans'] - 1;
        }

        if(D('ProfessionalComment')->where('professional_comment_id='.$professional_comment_id )->setField(['professional_comment_zaner'=>$professional_comment_zaner,'professional_comment_zans'=>$professional_comment_zans])){
            die(json_encode(['status'=>1,'msg'=>'Praise Success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Praise failed!']));
        }
    }
}