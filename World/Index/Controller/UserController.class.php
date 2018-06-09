<?php
namespace Index\Controller;
use Index\Model\ConcernsModel;
use Index\Model\FirendsModel;
use Index\Model\ResumeModel;
use Index\Model\UserCountryModel;
use Index\Model\UserModel;
use Think\Controller;
class UserController extends CommonController {

    public function personalCenter(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }
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

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

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

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

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

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function myMessage(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function myFollowing(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function addressBook(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function myGroup(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function feedback(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function virtualCurrencyRecharge(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

}