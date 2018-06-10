<?php
namespace Index\Controller;
use Index\Model\ConcernsModel;
use Index\Model\FirendsModel;
use Index\Model\ResumeModel;
use Index\Model\UserCountryModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Upload;

class UserController extends CommonController {

    protected $_checkAction = ['FollowList','personalCenter','acountSetting','resumeDetails','myPosts','myMessage','myFollowing','addressBook'
                                    ,'myGroup','feedback','virtualCurrencyRecharge','FansList','DeliveryRecord','ResumeTemplateList'];//需要做登录验证的action

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

    public function personalCenter(){
        $id = $this->geturl('id');
        $usermodel = new UserModel();
        $userone = $usermodel->findone('user_id = '.$id);

        if ($userone['user_concerns']>10000){
            $userone['user_concerns'] = floor($userone['user_concerns']/10000).'m';
        }
        if ($userone['user_fans']>10000){
            $userone['user_fans'] = floor($userone['user_fans']/10000).'m';
        }

        $firendsmodel = new FirendsModel();
        $firendone = $firendsmodel->findone('firends_uid = '.$this->userid.' and firends_aid = '.$userone['user_id'].' and firends_type = 1');

        $concernsmodel = new ConcernsModel();
        $concernsone = $concernsmodel->findone('concerns_uid = '.$this->userid.' and concerns_cuid = '.$userone['user_id']);

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,
            'userone' => $userone,
            'firendone' => $firendone,
            'concernsone' => $concernsone
        ));
        $this->display();

    }

    public function acountSetting(){

        $countrymodel = new UserCountryModel();
        $countrylist = $countrymodel->findlist('','user_country_sort desc,user_country_name');

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,
            'countrylist' =>$countrylist,

        ));
        $this->display();
    }

    public function resumeDetails(){

        $goindex = 1;
        if (isset($_GET['gourl'])){
            $goindex = 0;
        }

        $resumemodel = new ResumeModel();
        $resumeone = $resumemodel->findone('resume_uid = '.$this->userid);


        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,
            'goindex' => $goindex,
            'resumeone' => $resumeone,
        ));
        $this->display();
    }

    public function myPosts(){
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->assign('title','My Posts');
        $css = addCss('myPosts');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function myMessage(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->assign('title','My Message');
        $css = addCss('MyMessage');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function myFollowing(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function addressBook(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function myGroup(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->assign('title','My Group');
        $css = addCss('MyGroup');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function feedback(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function virtualCurrencyRecharge(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $css = addCss('VCR');
        $this->assign('title','Virtual Currency Recharge');
        $this->assign('CSS',$css);
        $this->display();
    }

    /**
     * 我的关注列表
     * @return mixed
     */
    public function FollowList(){
        $css = addCss('FollowList');
        $this->assign('title','Follow List');
        $this->assign('CSS',$css);
        $this->display();
    }

    //帮助
    public function helpCenter(){

        $this->display();
    }

    //告诉我们 
    public function contactUs(){

        $this->display();
    }

    /**
     * 我的投递记录
     * @return mixed
     */
    public function DeliveryRecord(){
        $css = addCss('DeliveryRecord');
        $this->assign('title','Resume Details');
        $this->assign('CSS',$css);
        $this->display();
    }

    /**
     * 简历模板
     * @return mixed
     */
    public function ResumeTemplateList(){
        $css = addCss('ResumeTemplateList');
        $this->assign('title','Resume Template List');
        $this->assign('CSS',$css);
        $this->display();
    }
}