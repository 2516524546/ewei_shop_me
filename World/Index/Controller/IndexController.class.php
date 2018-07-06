<?php
namespace Index\Controller;
use Index\Model\AdvertisingModel;
use Index\Model\DonationModel;
use Index\Model\NewsModel;
use Index\Model\ProposalTypeModel;
use Index\Model\UserModel;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Think\Controller;
class IndexController extends CommonController {
    public $modeleid = 1;
	/*
	{:L('newworld_home')}
	 */
    public function index(){

        $usermodel = new UserModel();
        $donationmodel = new DonationModel();
        $proposaltypemodel = new ProposalTypeModel();
        $field = "user_havecoin,user_outcoin,user_outmoney,user_name,user_icon";

        $wealth = $usermodel->honorlist('','user_havecoin desc',0,5,$field);

        $donate = $usermodel->honorlist('','user_outcoin desc',0,5,$field);
        $expenditure = $usermodel->honorlist('','user_outmoney desc',0,5,$field);
        $expenditure = $this->array_set_float2($expenditure,'user_outmoney','/',100);
        $donationlist = $donationmodel->donatelist('u_user u on u_donation.donation_uid = u.user_id','donation_ispay = 1','donation_paytime desc',0,7,'donation_money,donation_coin,donation_paytime,user_name');
        $donationlist = $this->array_set_dateYMD($donationlist,'donation_paytime');
        $donationlist = $this->array_set_float2($donationlist,'donation_money','/',100);
        $proposaltypelist = $proposaltypemodel->findsome('');

        $now = date("Y-m-d H:i:s", time());
        $newsmodel = new NewsModel();
        $newslist = $newsmodel->findlist('news_static = 1 and news_for = 1 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'"','news_sort desc');

        $advertisingmodel = new AdvertisingModel();
        $advertisinglist = $advertisingmodel->findlist('advertising_for = 1 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'"');

        $honorone  = $advertisingmodel->findone('advertising_id = 1000000001');
        $adviceone  = $advertisingmodel->findone('advertising_id = 1000000002');

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

        $this->assign(array(
            'newslist' => $newslist,
            'advertisinglist' => $advertisinglist,
            'honorone' => $honorone,
            'adviceone' => $adviceone,
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'wealth' => $wealth,
            'donate' => $donate,
            'expenditure' => $expenditure,
            'donatelist' => $donationlist,
            'proposaltypelist' => $proposaltypelist,

        ));
        $this->display();
    }


    /*
    贡献榜
     */
    public function honoraryEdition(){

        $usermodel = new UserModel();
        $field = "user_havecoin,user_outcoin,user_outmoney,user_name,user_icon";
        $wealth = $usermodel->honorlist('','user_havecoin desc',0,10,$field);
        $usercount = $usermodel->findone('','count(*) num')['num'];
        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'wealth' => $wealth,
            'usercount' => $usercount,

        ));

    	$this->display();
    }

    /*
    捐款记录
     */
    public function listOfDonations(){
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }
        $donationmodel = new DonationModel();

        $donationsum = $donationmodel->donateone('u_user u on u_donation.donation_uid = u.user_id','donation_ispay = 1','donation_paytime desc',0,10,'count(*) num')['num'];
        $donationme = $donationmodel->donateone('u_user u on u_donation.donation_uid = u.user_id','donation_ispay = 1 and donation_uid = '.$this->userid ,'donation_paytime desc',0,10,'count(*) num')['num'];

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
            'donationsum' => $donationsum,
            'donationme' => $donationme,

        ));

    	$this->display();
    }

    /*
    发起捐款
     */
    public function donation(){
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
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


}