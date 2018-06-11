<?php
namespace Index\Controller;
use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
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
    工作群详情
     */
    public function groupDetails(){


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