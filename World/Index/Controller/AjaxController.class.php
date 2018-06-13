<?php

namespace Index\Controller;

use Index\Model\CommodityModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\DonationModel;
use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\FriendsModel;
use Index\Model\NoteCommentModel;
use Index\Model\NoteModel;
use Index\Model\NoteVIModel;
use Index\Model\OpinionModel;
use Index\Model\ProposalModel;
use Index\Model\QuestionModel;
use Index\Model\QuestionVIModel;
use Index\Model\ResourceModel;
use Index\Model\ResourceVIModel;
use Index\Model\ResumeModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
use Index\Model\UserModel;
use Index\extend;
use Index\Model\WorksModel;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Incentive;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use Think\Controller;
use Think\Db;
use Think\Exception;

class AjaxController extends CommonController
{

    //登录判断
    public function ajax_login()
    {

        if (IS_POST) {

            if (!$this->post('username')) {

                die(json_encode(array('str' => 3, 'msg' => '用户名错误')));
            } else if (!$this->post('password')) {

                die(json_encode(array('str' => 4, 'msg' => '密码错误')));
            } else {

                $usermodel = new UserModel();
                $where['user_mail'] = $this->post('username');
                $userone = $usermodel->findone($where);
                if (!$userone) {

                    die(json_encode(array('str' => 5, 'msg' => '用户不存在')));
                } else {

                    if (md5($this->post('password')) . $userone['user_password_joint'] == $userone['user_password']) {

                        session('userid', $userone['user_id']);
                        //cookie('userid',$userone['user_id'],86400);
                        die(json_encode(array('str' => 1, 'msg' => '登录成功')));
                    } else {
                        die(json_encode(array('str' => 2, 'msg' => '帐号密码不匹配')));
                    }

                }

            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }


    }

    //退出登录
    public function ajax_loginout(){

        if (!$this->userid) {

            die(json_encode(array('str' => 3, 'msg' => '用户名未登录，请刷新页面')));
        } else {

            try{
                unset($_SESSION['userid']);
                die(json_encode(array('str' => 1, 'msg' => '退出成功')));
            }catch (\ErrorException $e){
                die(json_encode(array('str' => 2, 'msg' => '退出失败，请刷新页面')));
            }
        }

    }

    //注册第一步
    public function ajax_registerfirst()
    {

        if (IS_POST) {

            if (!isset($_POST['mail'])) {

                die(json_encode(array('str' => 2, 'msg' => '不存在邮箱')));;
            } else if (!isset($_POST['passwordone'])) {

                die(json_encode(array('str' => 3, 'msg' => '不存在密码1')));
            } else if (!isset($_POST['passwordtwo'])) {

                die(json_encode(array('str' => 4, 'msg' => '不存在密码2')));
            } else if ($this->post('passwordone') != $this->post('passwordtwo')) {

                die(json_encode(array('str' => 5, 'msg' => '两个密码不相等')));
            } else if ($this->post('code') != S($this->post('mail') . '_key')) {

                die(json_encode(array('str' => 7, 'msg' => '验证码不正确')));
            } else {


                $usermodel = new UserModel();
                $where['user_mail'] = $this->post('mail');

                if ($usermodel->findone($where)) {
                    die(json_encode(array('str' => 7, 'msg' => '该帐号已注册')));
                } else {
                    session('register_mail', $this->post('mail'));
                    session('register_password', $this->post('passwordone'));
                    if (session('register_mail')&&session('register_password')){

                        die(json_encode(array('str' => 1, 'msg' => 'OK')));
                    }else{

                        die(json_encode(array('str' => 2, 'msg' => '系统错误')));
                    }

                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //注册第二步
    public function ajax_registersecond()
    {

        if (IS_POST) {

            if (!isset($_POST['name']) || $this->post('name') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入昵称')));
            } else if (!isset($_POST['sex']) || $this->post('sex') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请选择性别')));
            } else if (!isset($_POST['tag']) || $this->post('tag') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请选择标签')));
            } else {

                session('register_name', $this->post('name'));
                session('register_sex', $this->post('sex'));
                session('register_tag', $this->post('tag'));
                if (isset($_POST['birth']) && $this->post('birth') != ''){
                    session('register_birth', $this->post('birth'));
                }
                if (isset($_POST['country']) && $this->post('country') != ''){
                    session('register_country', $this->post('country'));
                }
                if (isset($_POST['city']) && $this->post('city') != ''){
                    session('register_city', $this->post('city'));
                }
                if (isset($_POST['signature']) && $this->post('signature') != ''){
                    session('register_signature', $this->post('signature'));
                }

                if (session('register_name')&&session('register_sex')&&session('register_tag')){

                    die(json_encode(array('str' => 1, 'msg' => 'OK')));
                }else{

                    die(json_encode(array('str' => 2, 'msg' => '系统错误')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //执行注册
    public function ajax_register(){

        if (IS_POST) {

            if (!session('register_mail')) {

                die(json_encode(array('str' => 3, 'msg' => '邮箱验证已过时')));
            } else if (!session('register_password')) {

                die(json_encode(array('str' => 4, 'msg' => '密码验证已过时')));
            } else if (!session('register_name')) {

                die(json_encode(array('str' => 5, 'msg' => '昵称验证已过时')));
            } else if (!session('register_sex')) {

                die(json_encode(array('str' => 6, 'msg' => '性别验证已过时')));
            } else if (!session('register_tag')) {

                die(json_encode(array('str' => 7, 'msg' => '标签验证已过时')));
            } else {

                $data = array();
                $data['user_mail'] = session('register_mail');
                $data['user_password_joint'] = uniqid();
                $data['user_password'] = md5(session('register_password')) . $data['user_password_joint'];
                $data['user_name'] = session('register_name');
                $data['user_sex'] = session('register_sex');
                $data['user_tag'] = session('register_tag');

                if (session('register_birth')){
                    $data['user_birth']= session('register_birth');
                }
                if (session('register_country')){
                    $data['user_country']= session('register_country');
                }
                if (session('register_city')){
                    $data['user_city']= session('register_city');
                }
                if (session('register_signature')){
                    $data['user_signature']= session('register_signature');
                }

                    $data['user_logintime'] = date("Y-m-d H:i:s", time());
                    $usermodel = new UserModel();
                    $userone = $usermodel->findone('user_mail = "'.$data['user_mail'].'"');

                    if ($userone){
                        die(json_encode(array('str' => 8, 'msg' => '该邮箱已有用户注册')));
                    }else{

                        $res = $usermodel->add($data);
                        if ($res) {
                            unset($_SESSION['register_mail']);
                            unset($_SESSION['register_password']);
                            unset($_SESSION['register_name']);
                            unset($_SESSION['register_sex']);
                            unset($_SESSION['register_tag']);
                            unset($_SESSION['register_birth']);
                            unset($_SESSION['register_country']);
                            unset($_SESSION['register_city']);
                            unset($_SESSION['register_signature']);

                            die(json_encode(array('str' => 1, 'msg' => '注册成功')));
                        } else {
                            die(json_encode(array('str' => 2, 'msg' => '注册失败')));
                        }
                    }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //发送邮箱验证码
    public function ajax_sendemailcode()
    {

        if (IS_POST) {

            $user = new UserModel();
            $where['user_mail'] = $this->post('mail');
            if (!isset($_POST['mail']) || !preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i", $this->post('mail'))) {
                die(json_encode(array('str' => 3, 'msg' => '请填写正确的邮箱')));
            } else {

                try {
                    $code = rand(100000, 999999);
                    $message = "【NEW-WORLD】您好!您的验证码为:" . $code;

                    $title = 'NEW-WORLD验证码';
                    vendor('Phpmailer');
                    vendor('Smtp');
                    $Email = new \Phpmailer();
                    //设置PHPMailer使用SMTP服务器发送email
                    $Email->IsSMTP();
                    //设置字符串编码
                    $Email->CharSet = 'UTF-8';
                    //添加收件人地址，可以使用多次来添加多个收件人
                    $Email->AddAddress($this->post('mail'));
                    //设置邮件正文
                    $Email->Body = $message;

                    //设置邮件头的FROM字段
                    $Email->From = C('EMAIL_USERNAME');
                    //设置发件人名称
                    $Email->FromName = C('EMAIL_FROMNAME');
                    //设置邮件标题
                    $Email->Subject = $title;
                    //设置SMTP服务器
                    $Email->Host = C('EMAIL_HOST');
                    $Email->SMTPSecure = C('EMAIL_SMTPSECURE');
                    $Email->Port = C('EMAIL_PORT');
                    //设置为验证码
                    $Email->SMTPAuth = true;
                    //设置用户名密码
                    $Email->Username = C('EMAIL_USERNAME');
                    $Email->Password = C('EMAIL_PASSWORD');
                    //发送邮件
                    //return ($Email->Send());成功返回true
                    S($this->post('mail') . '_key', $code, C('EMAIL_TIME'));
                    //var_dump(S($_POST['mail'] . '_key'));
                    $result = $Email->Send();

                    if ($result) {

                        die(json_encode(array('str' => 1, 'msg' => '验证码已发送')));
                    } else {
                        die(json_encode(array('str' => 2, 'msg' => '验证码发送失败')));
                    }
                } catch (\Exception $e) {
                    die(json_encode(array('str' => 4, 'msg' => '发送错误')));
                }

            }

        } else {
            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //忘记密码
    public function ajax_forgetpassword()
    {

        if (IS_POST) {

            if (!isset($_POST['mail'])) {

                die(json_encode(array('str' => 2, 'msg' => '不存在邮箱')));;
            } else if (!isset($_POST['passwordone'])) {

                die(json_encode(array('str' => 3, 'msg' => '不存在密码1')));
            } else if (!isset($_POST['passwordtwo'])) {

                die(json_encode(array('str' => 4, 'msg' => '不存在密码2')));
            } else if ($this->post('passwordone') != $this->post('passwordtwo')) {

                die(json_encode(array('str' => 5, 'msg' => '两个密码不相等')));
            } else if ($this->post('code') != S($this->post('mail') . '_key')) {

                die(json_encode(array('str' => 7, 'msg' => '验证码不正确')));
            } else {

                $usermodel = new UserModel();
                $where['user_mail'] = $this->post('mail');

                if (!$usermodel->findone($where)) {
                    die(json_encode(array('str' => 7, 'msg' => '用户不存在')));
                } else {

                    $data['user_password_joint'] = uniqid();
                    $data['user_password'] = md5($this->post('passwordone')) . $data['user_password_joint'];
                    $data['user_updatatime'] = date("Y-m-d H:i:s", time());
                    $res = $usermodel->updataone($where, $data);
                    if ($res) {
                        die(json_encode(array('str' => 1, 'msg' => '修改成功')));
                    } else {
                        die(json_encode(array('str' => 6, 'msg' => '修改失败')));
                    }
                }
            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //生成捐赠订单
    public function ajax_createdonation()
    {

        if (IS_POST) {

            if (!isset($_POST['money'])) {

                die(json_encode(array('str' => 2, 'msg' => '不存在金额')));;
            } else if (!isset($_POST['code'])) {

                die(json_encode(array('str' => 3, 'msg' => '不存在验证码')));
            } else if (!isset($_POST['type'])) {

                die(json_encode(array('str' => 5, 'msg' => '不存在支付方式')));
            } else if ($this->post('type') == 0) {

                die(json_encode(array('str' => 6, 'msg' => '请选择正确的支付方式')));
            } else {

                $usermodel = new UserModel();
                $where['user_id'] = $this->userid;
                $verify = new \Think\Verify();

                if (!$usermodel->findone($where)) {

                    die(json_encode(array('str' => 7, 'msg' => '用户不存在')));
                } else if (!$verify->check($this->post('code'))) {

                    die(json_encode(array('str' => 4, 'msg' => '验证码错误')));
                } else {

                    $data['donation_orderid'] = 'dd' . date("YmdHis", time()) . rand(10000, 99999);
                    $data['donation_uid'] = $this->userid;
                    $data['donation_money'] = $this->post('money') * 100;
                    $data['donation_coin'] = $this->post('money') * 10;
                    $data['donation_paytype'] = $this->post('type');
                    $data['donation_createtime'] = date("Y-m-d H:i:s", time());
                    $donationmodel = new DonationModel();
                    $res = $donationmodel->add($data);

                    if ($res) {
                        die(json_encode(array('str' => 1, 'orderid' => $res)));
                    } else {
                        die(json_encode(array('str' => 8, 'msg' => '支付失败')));
                    }
                }
            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //提交建议
    public function ajax_createproposal()
    {

        if (IS_POST) {

            if (!isset($_POST['text']) || $this->post('text') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入内容')));
            } else if (!isset($_POST['type']) || $this->post('type') == 0) {

                die(json_encode(array('str' => 4, 'msg' => '请选择类型')));
            } else {

                $usermodel = new UserModel();
                $uwhere['user_id'] = $this->userid;
                $userone = $usermodel->findone($uwhere);

                if (!$userone) {

                    die(json_encode(array('str' => 5, 'msg' => '用户不存在')));
                } else {

                    $proposalmodel = new ProposalModel();
                    $pdata['proposal_uid'] = $userone['user_id'];
                    $pdata['proposal_tid'] = $this->post('type');
                    $pdata['proposal_content'] = $this->post('text');
                    $pdata['proposal_phone'] = 123456789;
                    $pdata['proposal_time'] = date('Y-m-d H:i:s', time());
                    $pres = $proposalmodel->add($pdata);
                    if ($pres) {

                        die(json_encode(array('str' => 1, 'msg' => '提交成功')));
                    } else {

                        die(json_encode(array('str' => 2, 'msg' => '提交失败')));
                    }

                }
            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //贡献榜
    public function ajax_honorlist()
    {

        if (IS_POST) {

            if (!isset($_POST['limit1']) || $this->post('limit1') == 0) {

                die(json_encode(array('str' => 3, 'msg' => '请选择正确的页码')));
            } else if (!isset($_POST['limit2']) || $this->post('limit2') == 0) {

                die(json_encode(array('str' => 4, 'msg' => '请选择正确的页码')));
            } else if (!isset($_POST['type']) ) {

                die(json_encode(array('str' => 5, 'msg' => '请选择类型')));
            } else {

                $usermodel = new UserModel();
                $field = "user_havecoin,user_outcoin,user_outmoney,user_name,user_icon";

                $limit1 = ($this->post('limit1')-1)*$this->post('limit2');
                if ($this->post('type')==1){

                    $res = $usermodel->honorlist('','user_havecoin desc',$limit1,$this->post('limit2'),$field);
                }else if ($this->post('type')==2){

                    $res = $usermodel->honorlist('','user_outcoin desc',$limit1,$this->post('limit2'),$field);
                }else if ($this->post('type')==3){

                    $res = $usermodel->honorlist('','user_outmoney desc',$limit1,$this->post('limit2'),$field);
                    $res = $this->array_set_float2($res,'user_outmoney','/',100);
                }


                if ($res) {

                    die(json_encode(array('str' => 1, 'msg' => $res)));
                } else {

                    die(json_encode(array('str' => 2, 'msg' => '程序错误')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //捐款虚拟支付
    /*
public function ajax_donationpay()
{

    if (IS_POST) {

        if (!isset($_POST['orderid'])) {

            die(json_encode(array('str' => 2, 'msg' => '订单不存在')));
        } else {

            $usermodel = new UserModel();
            $uwhere['user_id'] = $this->userid;
            $userone = $usermodel->findone($uwhere);
            $donationmodel = new DonationModel();
            $dwhere['donation_id'] = $this->post('orderid');
            $donationone = $donationmodel->findone($dwhere);

            if (!$userone) {

                die(json_encode(array('str' => 3, 'msg' => '用户不存在')));
            } else if (!$donationone) {

                die(json_encode(array('str' => 4, 'msg' => '订单不存在')));
            } else {

                $udata['user_outmoney'] = $userone['user_outmoney'] + $donationone['donation_money'];
                $udata['user_havecoin'] = $userone['user_havecoin'] + $donationone['donation_coin'];

                $ddata['donation_ispay'] = 1;
                $ddata['donation_paytime'] = date("Y-m-d H:i:s", time());
                $usermodel->startTrans();
                try {

                    $ures = $usermodel->updataone($uwhere, $udata);
                    $dres = $donationmodel->updataone($dwhere, $ddata);

                    if ($ures && $dres) {
                        $usermodel->commit();
                        die(json_encode(array('str' => 1, 'msg' => '支付成功')));
                    } else {
                        $usermodel->rollback();
                        die(json_encode(array('str' => 5, 'msg' => '支付失败')));
                    }
                } catch (Exception $e) {
                    $usermodel->rollback();
                    die(json_encode(array('str' => 6, 'msg' => '支付错误')));
                }

            }
        }
    } else {

        die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
    }
}*/

    /*******************************************paypal-start*************************/
    //获取paypal支付URL
    public function have_paypal_url(){

        $donationmodel = new DonationModel();
        $donationone = $donationmodel->findone('donation_id = '.$this->post('orderid'));

        $pirce = $donationone['donation_money']/100;
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName('donation')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($pirce);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

// 自定义用户收货地址，避免用户在paypal上账单的收货地址和销售方收货地址有出入
// 这里定义了收货地址，用户在支付过程中就不能更改收货地址，否则，用户可以自己更改收货地址
        $address = new ShippingAddress();
        $address->setRecipientName('newworld')//名字
        ->setLine1('lyx')//什么街什么路什么小区
        ->setCity('guangzhou')//城市名
        ->setState('guangdong')//省名
        ->setPhone('13712345678')//电话
        ->setPostalCode('510000')//邮编
        ->setCountryCode('CN');//国家

        $itemList->setShippingAddress($address);

        $details = new Details();
        $details->setShipping(0)
            ->setSubtotal($pirce);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($pirce)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Thinks")
            ->setInvoiceNumber($donationone['donation_orderid']);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://web.newworld.com/index.php?m=Index&c=Ajax&a=paypalexec&success=true')
            ->setCancelUrl('http://web.newworld.com/index.php?m=Index&c=Ajax&a=paypalcancel&success=false&orderid='.$donationone['donation_orderid']);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        $payment->create($this->apiContext);
        $approvalUrl = $payment->getApprovalLink();

        die(json_encode(array('str' => 1,'msg'=>$approvalUrl)));

    }

    //支付成功回调
    public function paypalexec(){

        set_time_limit(3600);
        if (isset($_GET['success']) && $_GET['success'] == 'true') {

            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $this->apiContext);
            $transactions = $payment->getTransactions()[0];
            $orderid = $transactions->getInvoiceNumber();
            $amount = $transactions->getAmount();
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID'],$this->apiContext);

            $donationmodel = new DonationModel();
            $usermodel = new UserModel();
            $uwhere['user_id'] = $this->userid;


            $donationmodel->startTrans();

            try {
                $donationone = $donationmodel->findone("donation_orderid = '".$orderid."'");
                $userone = $usermodel->findone($uwhere);
                if (($amount->getTotal()==($donationone['donation_money']/100))){
                    $donationdata['donation_static'] = 1;
                    $donationdata['donation_ispay'] = 1;
                    $donationdata['donation_paytime'] = date('Y-m-d H:i:s');
                    $donationdata['donation_paypalid'] = $_GET['paymentId'];

                    $udata['user_outmoney'] = $userone['user_outmoney'] + $donationone['donation_money'];
                    $udata['user_havecoin'] = $userone['user_havecoin'] + $donationone['donation_coin'];
                    $ures = $usermodel->updataone($uwhere, $udata);

                    $donationres = $donationmodel->updataone("donation_orderid = '".$orderid."'",$donationdata);
                    if ($donationres&&$ures){
                        $result = $payment->execute($execution, $this->apiContext);
                        $donationmodel->commit();
                        echo '<script>window.close();</script>';
                    }else{
                        $donationmodel->rollback();
                        $donationdata['donation_static'] = 3;
                        $donationres = $donationmodel->updataone("donation_orderid = '".$orderid."'",$donationdata);
                        echo '<script>window.close();</script>';
                    }

                }else{

                    $donationdata['donation_static'] = 2;
                    $donationres = $donationmodel->updataone("donation_orderid = '".$orderid."'",$donationdata);
                    if ($donationres){
                        $donationmodel->commit();
                        echo '<script>window.close();</script>';
                    }else{
                        $donationmodel->rollback();
                        $donationdata['donation_static'] = 3;
                        $donationres = $donationmodel->updataone("donation_orderid = '".$orderid."'",$donationdata);
                        echo '<script>window.close();</script>';

                    }

                }

            } catch (Exception $ex) {
                $donationmodel->rollback();
                $donationdata['donation_static'] = 3;
                $donationres = $donationmodel->updataone("donation_orderid = '".$orderid."'",$donationdata);
                echo '<script>window.close();</script>';
            }

        } else {

            //echo "PayPal返回回调地址参数错误";
            echo '<script>window.close();</script>';
        }

    }

    //支付失败回调
    public function paypalcancel(){

        set_time_limit(3600);
        $donationmodel = new DonationModel();
        $donationdata['donation_static'] = 3;
        $donationres = $donationmodel->updataone("donation_orderid = '".$_GET['orderid']."'",$donationdata);
        echo '<script>window.close();</script>';

    }

    //订单轮询
    public function ajax_paypalstatic(){

        if (IS_POST) {

            if (!isset($_POST['orderid']) || $this->post('orderid') == 0) {

                die(json_encode(array('str' => 4,'message'=>'支付错误，请联系客服人员')));
            } else {

                $donationmodel = new DonationModel();
                $donationone = $donationmodel->findone('donation_id = '.$this->post('orderid'));
                if ($donationone){
                    if ($donationone['donation_static'] == 0){
                        die(json_encode(array('str' => $donationone['donation_static'])));
                    }else if ($donationone['donation_static'] == 1){
                        die(json_encode(array('str' => $donationone['donation_static'],'message'=>'支付成功')));
                    }else if ($donationone['donation_static'] == 2){
                        die(json_encode(array('str' => $donationone['donation_static'],'message'=>'订单金额不一致')));
                    }else if ($donationone['donation_static'] == 3){
                        die(json_encode(array('str' => $donationone['donation_static'],'message'=>'支付失败')));
                    }

                }else{

                    die(json_encode(array('str' => 4,'message'=>'支付错误，请联系客服人员')));
                }

            }
        } else {

            die(json_encode(array('str' => 4,'message'=>'支付错误，请联系客服人员')));
        }

    }

    /*******************************************paypal-end*************************/

    //捐款记录
    public function ajax_donationlist()
    {

        if (IS_POST) {

            if (!isset($_POST['limit1']) || $this->post('limit1') == 0) {

                die(json_encode(array('str' => 3, 'msg' => '请选择正确的页码')));
            } else if (!isset($_POST['limit2']) || $this->post('limit2') == 0) {

                die(json_encode(array('str' => 4, 'msg' => '请选择正确的页码')));
            } else if (!isset($_POST['type']) ) {

                die(json_encode(array('str' => 5, 'msg' => '请选择类型')));
            } else {

                $donationmodel = new DonationModel();
                $field = 'donation_money,donation_coin,donation_paytime,user_name';

                $limit1 = ($this->post('limit1')-1)*$this->post('limit2');
                if ($this->post('type')==1){

                    $res = $donationmodel->donatelist('u_user u on u_donation.donation_uid = u.user_id','donation_ispay = 1','donation_paytime desc',$limit1,$this->post('limit2'),$field);
                    $res = $this->array_set_float2($res,'donation_money','/',100);
                }else if ($this->post('type')==2){

                    $res = $donationmodel->donatelist('u_user u on u_donation.donation_uid = u.user_id','donation_ispay = 1 and donation_uid = '.$this->userid ,'donation_paytime desc',$limit1,$this->post('limit2'),$field);
                    $res = $this->array_set_float2($res,'donation_money','/',100);
                }

                if ($res) {

                    die(json_encode(array('str' => 1, 'msg' => $res)));
                } else {

                    die(json_encode(array('str' => 2, 'msg' => '你暂无记录')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //查询second字段
    public function ajax_secondmarkone()
    {

        if (IS_POST) {

            if (!isset($_POST['secondid']) || $this->post('secondid') == 0) {

                die(json_encode(array('str' => 0)));
            } else {

                $secondmodel = new SecondMarkModel();
                $thirdmodel = new ThirdMarkModel();
                $res = $secondmodel->findone('second_mark_id = '.$this->post('secondid'));

                $thirdlist = array();
                if ($res['second_mark_isextend'] == 1){
                    $thirdlist = $thirdmodel->findlist('third_mark_sid = '.$this->post('secondid'));
                }

                if ($thirdlist) {

                    die(json_encode(array('str' => 1, 'msg' => $thirdlist,'firstid'=>$res['second_mark_fid'])));
                } else {

                    die(json_encode(array('str' => 0,'firstid'=>$res['second_mark_fid'])));
                }

            }
        } else {

            die(json_encode(array('str' => 0)));
        }

    }

    //查询third字段
    public function ajax_thirdmarkone()
    {

        if (IS_POST) {

            if (!isset($_POST['thirdid']) || $this->post('thirdid') == 0) {

                die(json_encode(array('str' => 0)));
            } else {

                $thirdmodel = new ThirdMarkModel();
                $fourmodel = new FourthMarkModel();
                $res = $thirdmodel->findone('third_mark_id = '.$this->post('thirdid'));
                $fourlist = array();
                if ($res['third_mark_isextend'] == 1){
                    $fourlist = $fourmodel->findlist('fourth_mark_tid = '.$this->post('thirdid'));
                }

                if ($fourlist) {

                    die(json_encode(array('str' => 1, 'msg' => $fourlist,'secondid'=>$res['third_mark_sid'])));
                } else {

                    die(json_encode(array('str' => 0,'secondid'=>$res['third_mark_sid'])));
                }

            }
        } else {

            die(json_encode(array('str' => 0)));
        }

    }

    //图片上传
    public function ajax_uploadimg(){

        if (IS_POST) {

            $file = $_FILES['img'];

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3072000 ;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
// 上传单个文件
            $info = $upload->uploadOne($file);
            if(!$info) {// 上传错误提示错误信息
                die(json_encode(array('str' => 0)));
            }else{// 上传成功 获取上传文件信息
                die(json_encode(array('str' => 1,'msg'=>$info['savepath'].$info['savename'])));
            }

        } else {

            die(json_encode(array('str' => 0)));
        }

    }

    //文件上传
    public function ajax_uploadfile(){

        if (IS_POST) {


            $file = $_FILES['img'];

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 102400000 ;// 设置附件上传大小
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
// 上传单个文件
            $info = $upload->uploadOne($file);
            if(!$info) {// 上传错误提示错误信息
                die(json_encode(array('str' => 0)));
            }else{// 上传成功 获取上传文件信息
                die(json_encode(array('str' => 1,'msg'=>$info['savepath'].$info['savename'])));
            }

        } else {

            die(json_encode(array('str' => 0)));
        }

    }

    //创建兴趣群
    public function ajax_createinterest(){

        if (IS_POST) {

            if (!isset($_POST['crowd_icon']) || $this->post('crowd_icon') == '') {

                die(json_encode(array('str' => 3, 'msg' => '不存在图标')));
            } else if (!isset($_POST['crowd_name']) || $this->post('crowd_name') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入群名称')));
            } else if (!isset($_POST['crowd_intro']) || $this->post('crowd_intro') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请输入群简介')));
            } else {

                $fistmodel = new FirstMarkModel();
                $firstlist = $fistmodel->findlist('first_mark_mid = 2 and first_mark_type = 1','firsth_mark_sort');
                $firststr = '';
                foreach ($firstlist as $key =>$first){

                    if ($firststr==''){
                        $firststr .=$first['first_mark_id'];
                    }else{
                        $firststr .=','.$first['first_mark_id'];
                    }

                }

                $firstdata = array(
                    'crowd_mid' => 2,
                    'crowd_uid' => $this->userid,
                    'crowd_name' => $this->post('crowd_name'),
                    'crowd_icon' => $this->post('crowd_icon'),
                    'crowd_intro' => $this->post('crowd_intro'),
                    'crowd_peoplenum' => 1,
                    'crowd_firstmarks' => $firststr,
                    'crowd_secondmarks' => $this->post('second'),
                    'crowd_thirdmarks' => $this->post('third'),
                    'crowd_fourthmarks' => $this->post('four'),
                    'crowd_creattime' => date('Y-m-d H:i:s',time()),

                );

                $crowdmodel = new CrowdModel();
                $crowdmembermodel = new CrowdMemberModel();

                $crowdmodel->startTrans();
                try{
                    $crowdres = $crowdmodel->add($firstdata);
                    $memberdata = array(
                        'crowd_member_cid'=>$crowdres,
                        'crowd_member_uid'=>$this->userid,
                        'crowd_member_status'=>2,
                        'crowd_member_logintime'=>date('Y-m-d H:i:s',time()),
                    );
                    $memberres = $crowdmembermodel->add($memberdata);

                    if ($crowdres&&$memberres) {
                        $crowdmodel->commit();
                        die(json_encode(array('str' => 1, 'msg' => $crowdres)));
                    } else {
                        $crowdmodel->rollback();
                        die(json_encode(array('str' => 2, 'msg' => '创建失败')));
                    }
                }catch (Exception $e){
                    $crowdmodel->rollback();
                    die(json_encode(array('str' => 6, 'msg' => '创建失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //创建学术群
    public function ajax_createacademic(){

        if (IS_POST) {

            if (!isset($_POST['crowd_icon']) || $this->post('crowd_icon') == '') {

                die(json_encode(array('str' => 3, 'msg' => '不存在图标')));
            } else if (!isset($_POST['crowd_name']) || $this->post('crowd_name') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入群名称')));
            } else if (!isset($_POST['crowd_intro']) || $this->post('crowd_intro') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请输入群简介')));
            } else {

                $fistmodel = new FirstMarkModel();
                $firstlist = $fistmodel->findlist('first_mark_mid = 3 and first_mark_type = 1','firsth_mark_sort');
                $firststr = '';
                foreach ($firstlist as $key =>$first){

                    if ($firststr==''){
                        $firststr .=$first['first_mark_id'];
                    }else{
                        $firststr .=','.$first['first_mark_id'];
                    }

                }

                $firstdata = array(
                    'crowd_mid' => 3,
                    'crowd_uid' => $this->userid,
                    'crowd_name' => $this->post('crowd_name'),
                    'crowd_icon' => $this->post('crowd_icon'),
                    'crowd_intro' => $this->post('crowd_intro'),
                    'crowd_peoplenum' => 1,
                    'crowd_firstmarks' => $firststr,
                    'crowd_secondmarks' => $this->post('second'),
                    'crowd_thirdmarks' => $this->post('third'),
                    'crowd_fourthmarks' => $this->post('four'),
                    'crowd_creattime' => date('Y-m-d H:i:s',time()),

                );

                $crowdmodel = new CrowdModel();
                $crowdmembermodel = new CrowdMemberModel();

                $crowdmodel->startTrans();
                try{
                    $crowdres = $crowdmodel->add($firstdata);
                    $memberdata = array(
                        'crowd_member_cid'=>$crowdres,
                        'crowd_member_uid'=>$this->userid,
                        'crowd_member_status'=>2,
                        'crowd_member_logintime'=>date('Y-m-d H:i:s',time()),
                    );
                    $memberres = $crowdmembermodel->add($memberdata);

                    if ($crowdres&&$memberres) {
                        $crowdmodel->commit();
                        die(json_encode(array('str' => 1, 'msg' => $crowdres)));
                    } else {
                        $crowdmodel->rollback();
                        die(json_encode(array('str' => 2, 'msg' => '创建失败')));
                    }
                }catch (Exception $e){
                    $crowdmodel->rollback();
                    die(json_encode(array('str' => 6, 'msg' => '创建失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //创建生活群
    public function ajax_createlife(){

        if (IS_POST) {

            if (!isset($_POST['crowd_icon']) || $this->post('crowd_icon') == '') {

                die(json_encode(array('str' => 3, 'msg' => '不存在图标')));
            } else if (!isset($_POST['crowd_name']) || $this->post('crowd_name') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入群名称')));
            } else if (!isset($_POST['crowd_intro']) || $this->post('crowd_intro') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请输入群简介')));
            } else {

                $fistmodel = new FirstMarkModel();
                $firstlist = $fistmodel->findlist('first_mark_mid = 5 and first_mark_type = 1','firsth_mark_sort');
                $firststr = '';
                foreach ($firstlist as $key =>$first){

                    if ($firststr==''){
                        $firststr .=$first['first_mark_id'];
                    }else{
                        $firststr .=','.$first['first_mark_id'];
                    }

                }

                $firstdata = array(
                    'crowd_mid' => 5,
                    'crowd_uid' => $this->userid,
                    'crowd_name' => $this->post('crowd_name'),
                    'crowd_icon' => $this->post('crowd_icon'),
                    'crowd_intro' => $this->post('crowd_intro'),
                    'crowd_peoplenum' => 1,
                    'crowd_firstmarks' => $firststr,
                    'crowd_secondmarks' => $this->post('second'),
                    'crowd_thirdmarks' => $this->post('third'),
                    'crowd_fourthmarks' => $this->post('four'),
                    'crowd_creattime' => date('Y-m-d H:i:s',time()),

                );

                $crowdmodel = new CrowdModel();
                $crowdmembermodel = new CrowdMemberModel();

                $crowdmodel->startTrans();
                try{
                    $crowdres = $crowdmodel->add($firstdata);
                    $memberdata = array(
                        'crowd_member_cid'=>$crowdres,
                        'crowd_member_uid'=>$this->userid,
                        'crowd_member_status'=>2,
                        'crowd_member_logintime'=>date('Y-m-d H:i:s',time()),
                    );
                    $memberres = $crowdmembermodel->add($memberdata);

                    if ($crowdres&&$memberres) {
                        $crowdmodel->commit();
                        die(json_encode(array('str' => 1, 'msg' => $crowdres)));
                    } else {
                        $crowdmodel->rollback();
                        die(json_encode(array('str' => 2, 'msg' => '创建失败')));
                    }
                }catch (Exception $e){
                    $crowdmodel->rollback();
                    die(json_encode(array('str' => 6, 'msg' => '创建失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //获取群列表
    public function ajax_crowd_list(){

        if (IS_POST) {

            if (!isset($_POST['mid']) || $this->post('mid') == 0) {

                die(json_encode(array('str' => 3, 'msg' => 'mid不存在')));
            } else if (!isset($_POST['order']) || $this->post('order') == '') {

                die(json_encode(array('str' => 4, 'msg' => 'order不存在')));
            } else if (!isset($_POST['limit1']) || $this->post('limit1') <0) {

                die(json_encode(array('str' => 5, 'msg' => 'limit1不存在')));
            } else if (!isset($_POST['limit2']) || $this->post('limit2') <0) {

                die(json_encode(array('str' => 6, 'msg' => 'limit2不存在')));
            } else {

                $order = $this->post('order');
                $limit1 = $this->post('limit1');
                $limit2 = $this->post('limit2');
                $where = 'crowd_mid = '.$this->post('mid');

                if (isset($_POST['crowd_name'])&&$this->post('crowd_name')!=''){

                    $where.=" and crowd_name like '%".$this->post('crowd_name')."%'";
                }
                if (isset($_POST['second'])&&$this->post('second')!=''){

                    $where.=" and crowd_secondmarks like '%".$this->post('second')."%'";
                }
                if (isset($_POST['third'])&&$this->post('third')!=''){

                    $where.=" and crowd_thirdmarks like '%".$this->post('third')."%'";
                }
                if (isset($_POST['four'])&&$this->post('four')!=''){

                    $where.=" and crowd_fourthmarks like '%".$this->post('four')."%'";
                }

                $crowdmodel = new CrowdModel();

                $crowdlist = $crowdmodel->findlist($where,'u_user u on u_crowd.crowd_uid = u.user_id','INNER',$order,'u.user_name,u_crowd.*',$limit1,$limit2);
                $count = $crowdmodel->findone($where,'','INNER','count(*) num')['num'];

                if ($crowdlist) {

                    die(json_encode(array('str' => 1, 'msg' => $crowdlist,'count'=>$count)));
                } else {

                    die(json_encode(array('str' => 2,'msg' => '暂无数据','count'=>$count)));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }


    }

    //发布工作
    public function ajax_createworks(){

        if (IS_POST) {

            if (!isset($_POST['type']) || $this->post('type') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请选择工作类型')));
            } else if (!isset($_POST['position']) || $this->post('position') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请填写职位')));
            } else if (!isset($_POST['minmoney']) || $this->post('minmoney') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请填写最低薪资')));
            } else if (!isset($_POST['maxmoney']) || $this->post('maxmoney') == '') {

                die(json_encode(array('str' => 6, 'msg' => '请填写最高薪资')));
            } else if (!isset($_POST['years']) || $this->post('years') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写工作年限')));
            } else if (!isset($_POST['school']) || $this->post('school') == '') {

                die(json_encode(array('str' => 8, 'msg' => '请填写毕业院校')));
            } else if (!isset($_POST['degree']) || $this->post('degree') == '') {

                die(json_encode(array('str' => 9, 'msg' => '请填写要求学位')));
            } else if (!isset($_POST['specialty']) || $this->post('specialty') == '') {

                die(json_encode(array('str' => 10, 'msg' => '请填写要求专业')));
            } else if (!isset($_POST['company_name']) || $this->post('company_name') == '') {

                die(json_encode(array('str' => 11, 'msg' => '请填写公司名称')));
            } else if (!isset($_POST['company_nature']) || $this->post('company_nature') == '') {

                die(json_encode(array('str' => 12, 'msg' => '请填写公司性质')));
            } else if (!isset($_POST['company_type']) || $this->post('company_type') == '') {

                die(json_encode(array('str' => 13, 'msg' => '请填写公司类型')));
            } else if (!isset($_POST['company_size']) || $this->post('company_size') == '') {

                die(json_encode(array('str' => 14, 'msg' => '请填写公司规模')));
            } else if (!isset($_POST['company_mail']) || $this->post('company_mail') == '') {

                die(json_encode(array('str' => 15, 'msg' => '请填写接收简历邮箱')));
            } else if (!isset($_POST['company_content']) || $this->post('company_content') == '') {

                die(json_encode(array('str' => 16, 'msg' => '请填写公司信息')));
            } else if (!isset($_POST['isnegotiable']) || $this->post('isnegotiable') == '') {

                die(json_encode(array('str' => 17, 'msg' => '请选择是否接受面议')));
            } else {

                $data = array(
                    'works_uid' => $this->userid,
                    'works_type' => $this->post('type'),
                    'works_position' => $this->post('position'),
                    'works_minmoney' => $this->post('minmoney'),
                    'works_maxmoney' => $this->post('maxmoney'),
                    'works_years' => $this->post('years'),
                    'works_school' => $this->post('school'),
                    'works_degree' => $this->post('degree'),
                    'works_specialty' => $this->post('specialty'),
                    'works_company_name' => $this->post('company_name'),
                    'works_company_nature' => $this->post('company_nature'),
                    'works_company_type' => $this->post('company_type'),
                    'works_company_size' => $this->post('company_size'),
                    'works_company_mail' => $this->post('company_mail'),
                    'works_company_content' => $this->post('company_content'),
                    'works_isnegotiable' => $this->post('isnegotiable'),
                    'works_updatetime' => date("Y-m-d H:i:s", time()),
                    'works_createtime' => date("Y-m-d H:i:s", time()),

                );

                $worksmodel = new WorksModel();

                $res = $worksmodel->add($data);

                if ($res) {

                    die(json_encode(array('str' => 1,'msg'=>'发布成功')));
                } else {

                    die(json_encode(array('str' => 2,'msg'=>'发布失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //帐号设置
    public function ajax_acountSetting(){

        if (IS_POST) {

            if (!isset($_POST['name']) || $this->post('name') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入昵称')));
            } else if (!isset($_POST['birth']) || $this->post('birth') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入出色年月日')));
            } else if (!isset($_POST['sex']) || $this->post('sex') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请选择性别')));
            } else if (!isset($_POST['country']) || $this->post('country') == '') {

                die(json_encode(array('str' => 6, 'msg' => '请选择你所在的国家')));
            } else if (!isset($_POST['city']) || $this->post('city') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写你所在的城市')));
            } else if (!isset($_POST['signature']) || $this->post('signature') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写你的签名')));
            } else {

                $data = array(
                    'user_icon' => $this->post('icon'),
                    'user_name' => $this->post('name'),
                    'user_sex' => $this->post('sex'),
                    'user_country' => $this->post('country'),
                    'user_city' => $this->post('city'),
                    'user_birth' => $this->post('birth'),
                    'user_signature' => $this->post('signature'),

                );

                $usermodel = new UserModel();

                $res = $usermodel->updataone('user_id = '.$this->userid,$data);

                if ($res) {

                    die(json_encode(array('str' => 1,'msg'=>'修改成功')));
                } else {

                    die(json_encode(array('str' => 2,'msg'=>'修改失败，请保证您的信息有变化')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //简历设置
    public function ajax_resumedetails(){

        if (IS_POST) {

            if (!isset($_POST['name']) || $this->post('name') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入您的真实姓名')));
            } else if (!isset($_POST['position']) || $this->post('position') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入你应聘的职位')));
            } else if (!isset($_POST['tid']) || $this->post('tid') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请选择你的工作类型')));
            } else if (!isset($_POST['lowmoney']) || $this->post('lowmoney') == '') {

                die(json_encode(array('str' => 6, 'msg' => '请输入您的最低接受薪资')));
            } else if (!isset($_POST['hightmoney']) || $this->post('hightmoney') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请输入您的最高薪资')));
            } else if (!isset($_POST['workyear']) || $this->post('workyear') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请输入您的工作年限')));
            } else if (!isset($_POST['university']) || $this->post('university') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写您的毕业院校')));
            } else if (!isset($_POST['degree']) || $this->post('degree') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写您的学位')));
            } else if (!isset($_POST['specialty']) || $this->post('specialty') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请填写您的专业')));
            } else if (!isset($_POST['fileurl']) || $this->post('fileurl') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请上传您的简历')));
            } else if (!isset($_POST['isnegotiable']) || $this->post('isnegotiable') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请选择是否接受薪资面议')));
            } else {


                $resumemodel = new ResumeModel();
                $resumeone = $resumemodel->findone();

                if ($resumeone){
                    $data = array(
                        'resume_tid' => $this->post('tid'),
                        'resume_name' => $this->post('name'),
                        'resume_position' => $this->post('position'),
                        'resume_lowmoney' => $this->post('lowmoney'),
                        'resume_hightmoney' => $this->post('hightmoney'),
                        'resume_workyear' => $this->post('workyear'),
                        'resume_university' => $this->post('university'),
                        'resume_degree' => $this->post('degree'),
                        'resume_specialty' => $this->post('specialty'),
                        'resume_fileurl' => $this->post('fileurl'),
                        'resume_isnegotiable' => $this->post('isnegotiable'),
                        'resume_updatetime' => date("Y-m-d H:i:s", time()),
                        'resume_status' => 1,

                    );
                    $res = $resumemodel->updataone('resume_id = '.$resumeone['resume_id'],$data);

                    if ($res) {

                        die(json_encode(array('str' => 1,'msg'=>'修改成功')));
                    } else {

                        die(json_encode(array('str' => 2,'msg'=>'修改失败，请保证您的信息有变化')));
                    }

                }else{

                    $data = array(
                        'resume_uid' => $this->userid,
                        'resume_tid' => $this->post('tid'),
                        'resume_name' => $this->post('name'),
                        'resume_position' => $this->post('position'),
                        'resume_lowmoney' => $this->post('lowmoney'),
                        'resume_hightmoney' => $this->post('hightmoney'),
                        'resume_workyear' => $this->post('workyear'),
                        'resume_university' => $this->post('university'),
                        'resume_degree' => $this->post('degree'),
                        'resume_specialty' => $this->post('specialty'),
                        'resume_fileurl' => $this->post('fileurl'),
                        'resume_isnegotiable' => $this->post('isnegotiable'),
                        'resume_createtime' => date("Y-m-d H:i:s", time()),
                        'resume_updatetime' => date("Y-m-d H:i:s", time()),
                        'resume_status' => 1,

                    );

                    $res = $resumemodel->add($data);
                    if ($res) {

                        die(json_encode(array('str' => 1,'msg'=>'修改成功')));
                    } else {

                        die(json_encode(array('str' => 2,'msg'=>'修改失败，请保证您的信息有变化')));
                    }

                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }
    }

    //意见反馈
    public function ajax_feedback(){

        if (IS_POST) {

            if (!isset($_POST['content']) || $this->post('content') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入你要反馈的内容')));
            } else {

                $data = array(
                    'opinion_uid' => $this->userid,
                    'opinion_content' => $this->post('content'),
                    'opinion_time' => date("Y-m-d H:i:s", time()),

                );

                $opinionmodel = new OpinionModel();

                $res = $opinionmodel->add($data);

                if ($res) {

                    die(json_encode(array('str' => 1,'msg'=>'提交成功，谢谢您的建议')));
                } else {

                    die(json_encode(array('str' => 2,'msg'=>'提交失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //发布商品
    public function ajax_postProduct(){

        if (IS_POST) {

            if (!isset($_POST['name']) || $this->post('name') == '') {

                die(json_encode(array('str' => 3, 'msg' => '请输入商品名称')));
            } else if (!isset($_POST['price']) || $this->post('price') == '') {

                die(json_encode(array('str' => 4, 'msg' => '请输入商品价格')));
            } else if (!isset($_POST['uname']) || $this->post('uname') == '') {

                die(json_encode(array('str' => 5, 'msg' => '请输入联系人姓名')));
            } else if (!isset($_POST['contact']) || $this->post('contact') == '') {

                die(json_encode(array('str' => 6, 'msg' => '请输入联系方式')));
            } else if (!isset($_POST['category']) || $this->post('category') == '') {

                die(json_encode(array('str' => 7, 'msg' => '请选择商品类型')));
            } else if (!isset($_POST['content']) || $this->post('content') == '') {

                die(json_encode(array('str' => 8, 'msg' => '请输入商品介绍')));
            } else if (!isset($_POST['img']) || $this->post('img') == '') {

                die(json_encode(array('str' => 9, 'msg' => '请上传商品图片')));
            } else {

                $firstmodel = new FirstMarkModel();
                $firstlist = $firstmodel->findlist('first_mark_mid = 5 and first_mark_type = 4','firsth_mark_sort');
                $first = '';
                foreach ($firstlist as $f){
                    if ($first==''){
                        $first.=$f['first_mark_id'];
                    }else{
                        $first.=','.$f['first_mark_id'];
                    }
                }
                $data = array(
                    'commodity_uid' => $this->userid,
                    'commodity_name' => $this->post('name'),
                    'commodity_price' => $this->post('price'),
                    'commodity_uname' => $this->post('uname'),
                    'commodity_contact' => $this->post('contact'),
                    'commodity_category' => $this->post('category'),
                    'commodity_content' => $this->post('content'),
                    'commodity_img' => $this->post('img'),
                    'commodity_firstmark' => $first,
                    'commodity_secondmark' => $this->post('second'),
                    'commodity_thirdmark' => $this->post('third'),
                    'commodity_fourthmark' => $this->post('four'),
                    'commodity_createtime' => date("Y-m-d H:i:s", time()),
                    'commodity_updatetime' => date("Y-m-d H:i:s", time()),

                );


                if (!isset($_POST['explain']) || $this->post('explain') == '') {

                    $data['commodity_explain'] = $this->post('explain');
                }

                $commoditymodel = new CommodityModel();

                $res = $commoditymodel->add($data);

                if ($res) {

                    die(json_encode(array('str' => 1,'msg'=>$res)));
                } else {

                    die(json_encode(array('str' => 2,'msg'=>'发布失败')));
                }

            }
        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }


    }

    //商品列表
    public function ajax_market_list(){

        if (IS_POST) {

            $commoditymodel = new CommodityModel();

            $where = 'commodity_status = 1';
            if (isset($_POST['staticli']) && $this->post('staticli') != 0){
                $where .= ' and commodity_category = '.$this->post('staticli');
            }
            $listr = '';
            if (isset($_POST['moneyli']) && $this->post('moneyli') != 0){
                if ($listr == ''){
                    $listr .= $this->post('moneyli');
                }else{
                    $listr .= ','.$this->post('moneyli');
                }
            }
            if (isset($_POST['stateli']) && $this->post('stateli') != 0){
                if ($listr == ''){
                    $listr .= $this->post('stateli');
                }else{
                    $listr .= ','.$this->post('stateli');
                }

            }
            if (isset($_POST['cityli']) && $this->post('cityli') != 0){
                if ($listr == ''){
                    $listr .= $this->post('cityli');
                }else{
                    $listr .= ','.$this->post('cityli');
                }

            }
            if (isset($_POST['universityli']) && $this->post('universityli') != 0){
                if ($listr == ''){
                    $listr .= $this->post('universityli');
                }else{
                    $listr .= ','.$this->post('universityli');
                }

            }
            $where .= " and commodity_secondmark like '%".$listr."%'";
            if (isset($_POST['minmonry']) && $this->post('minmonry') != ''){
                $where .= ' and commodity_price > '.$this->post('minmonry');
            }

            if (isset($_POST['maxmonry']) && $this->post('maxmonry') != ''){
                $where .= ' and commodity_price < '.$this->post('maxmonry');
            }

            if (isset($_POST['name']) && $this->post('name') != ''){
                $where .= ' and commodity_name like "%'.$this->post('name').'%"';
            }

            $commoditylist = $commoditymodel->joinonelist($where,'u_user u on l_commodity.commodity_uid = u.user_id','commodity_updatetime desc',0,10);

            $crowdcount = $commoditymodel->findone($where,'count(*) num')['num'];


                if ($commoditylist) {

                    die(json_encode(array('str' => 1,'msg'=>$commoditylist,'count'=>$crowdcount)));
                } else {

                    die(json_encode(array('str' => 2,'msg'=>'暂无商品')));
                }

        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }

    }

    //群成员列表
    public function ajax_members(){

        if (IS_POST) {

            if (!isset($_POST['limit1']) || $this->post('limit1') == ''){

                die(json_encode(array('str' => 3, 'msg' => '页码错误')));
            } else if (!isset($_POST['limit2']) || $this->post('limit2') == ''){

                die(json_encode(array('str' => 4, 'msg' => '页码错误')));
            } else if (!isset($_POST['cid']) || $this->post('cid') == ''){

                die(json_encode(array('str' => 5, 'msg' => '没有该群')));
            } else {

                $limit2 = $this->post('limit2');
                $limit1 = ($this->post('limit1')-1)*$limit2;
                $crowdmembermodel = new CrowdMemberModel();
                $list = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$this->post('cid'),'u_user u on u_crowd_member.crowd_member_uid = u.user_id',$limit1,$limit2,'INNER','crowd_member_status desc,crowd_member_logintime desc','u_crowd_member.*,u.user_id,u.user_icon,u.user_name');
                $adminlist = array();
                $memberlist = array();
                $friendmodel = new FriendsModel();
                foreach ($list as $l){
                    $friendone = $friendmodel->findone('firends_uid = '.$this->userid.' and firends_aid = '.$l['user_id'].' and firends_type = 1');

                    if ($friendone){
                        $l['isfriend']=1;
                    }else{
                        $l['isfriend']=0;
                    }
                    if ($l['crowd_member_status']!=0){
                        $adminlist[]=$l;
                    }else if ($l['crowd_member_status']==0){
                        $memberlist[]=$l;
                    }
                }


                if ($list) {

                    die(json_encode(array('str' => 1, 'adminlist' => $adminlist, 'memberlist' => $memberlist)));
                } else {

                    die(json_encode(array('str' => 2, 'msg' => '暂无数据')));
                }
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => '存在非法字符')));
        }


    }

    //发布帖子
    public function ajax_createnote(){

        if (IS_POST){

            if (!isset($_POST['name']) || $this->post('name') == ''){

                die(json_encode(array('str' => 3, 'msg' => '请输入标题')));
            }else if(!isset($_POST['content']) || $this->post('content') == ''){

                die(json_encode(array('str' => 4, 'msg' => '请输入内容')));
            }else if(!isset($_POST['cid']) || $this->post('cid') == ''){

                die(json_encode(array('str' => 6, 'msg' => '没有该群')));
            }else {
                if ($_FILES) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $type = explode('/', $_FILES['img']['type'][0]);
                    if ($type[0] == 'video') {
                        $upload->maxSize = 204800000;// 设置附件上传大小
                    } else {
                        $upload->maxSize = 3072000;// 设置附件上传大小
                    }

                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'mp4', 'avi');// 设置附件上传类型
                    $upload->rootPath = './Uploads/'; // 设置附件上传根目录

                    $filelist = $upload->dealFiles($_FILES);

                    $info = $upload->upload($_FILES);

                    if (!$info || count($filelist) != count($info)) {
                        // 上传错误提示错误信息
                        die(json_encode(array('str' => 0, 'msg' => $upload->getError())));
                    } else {

                        $notemodel = new NoteModel();
                        $notevimodel = new NoteVIModel();
                        $usermodel = new UserModel();

                        $notemodel->startTrans();
                        try{
                            $notedata = array(
                                'note_cid' => $this->post('cid'),
                                'note_uid' => $this->userid,
                                'note_name' => $this->post('name'),
                                'note_content' => $this->post('content'),
                                'note_createtime' => date("Y-m-d H:i:s", time()),
                            );

                            $noteid = $notemodel->add($notedata);
                            $userone = $usermodel->findone('user_id = '.$this->userid);
                            $userdata = array(
                                'user_notes' => $userone['user_notes']+1,
                            );
                            $usermodel->updataone('user_id = '.$this->userid,$userdata);

                            if ($noteid){

                                foreach ($info as $i){
                                    $url = $i['savepath'].$i['savename'];

                                    $vidata = array(
                                        'note_vi_nid' => $noteid,
                                        'note_vi_url' =>$url,
                                    );
                                    $vitype = explode('/', $i['type']);
                                    if ($vitype[0]== 'video'){
                                        $vidata['note_vi_type']=2;
                                    }else{
                                        $vidata['note_vi_type']=1;
                                    }

                                    $notevimodel->add($vidata);

                                }

                                $notemodel->commit();
                                die(json_encode(array('str' => 1, 'id' => $noteid,'cid' => $this->post('cid'))));
                            }else{
                                $notevimodel->rollback();
                                die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                            }
                        }catch (Exception $e){
                            $notevimodel->rollback();
                            die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                        }

                    }
                }else{

                    die(json_encode(array('str' => 5,'msg'=>'请上传相应的图片或视频')));
                }
            }
        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //发布问答
    public function ajax_createqa(){


        if (IS_POST){


            if (!isset($_POST['name']) || $this->post('name') == ''){

                die(json_encode(array('str' => 3, 'msg' => '请输入标题')));
            }else if(!isset($_POST['content']) || $this->post('content') == ''){

                die(json_encode(array('str' => 4, 'msg' => '请输入内容')));
            }else if(!isset($_POST['cid']) || $this->post('cid') == ''){

                die(json_encode(array('str' => 6, 'msg' => '没有该群')));
            }else {
                if ($_FILES) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $type = explode('/', $_FILES['img']['type'][0]);
                    if ($type[0] == 'video') {
                        $upload->maxSize = 204800000;// 设置附件上传大小
                    } else {
                        $upload->maxSize = 3072000;// 设置附件上传大小
                    }

                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'mp4', 'avi');// 设置附件上传类型
                    $upload->rootPath = './Uploads/'; // 设置附件上传根目录

                    $filelist = $upload->dealFiles($_FILES);

                    $info = $upload->upload($_FILES);

                    if (!$info || count($filelist) != count($info)) {
                        // 上传错误提示错误信息
                        die(json_encode(array('str' => 0, 'msg' => $upload->getError())));
                    } else {

                        $questionmodel = new QuestionModel();
                        $questionvimodel = new QuestionVIModel();

                        $questionmodel->startTrans();
                        try{
                            $questiondata = array(
                                'question_cid' => $this->post('cid'),
                                'question_uid' => $this->userid,
                                'question_name' => $this->post('name'),
                                'question_content' => $this->post('content'),
                                'question_createtime' => date("Y-m-d H:i:s", time()),
                            );
                            if (isset($_POST['reward']) && $this->post('reward') != ''){

                                $questiondata['question_reward'] = $this->post('reward');
                            }else{

                                $questiondata['question_reward']=0;
                            }

                            $questionid = $questionmodel->add($questiondata);

                            if ($questionid){

                                foreach ($info as $i){
                                    $url = $i['savepath'].$i['savename'];

                                    $vidata = array(
                                        'question_vi_qid' => $questionid,
                                        'question_vi_url' =>$url,
                                    );
                                    $vitype = explode('/', $i['type']);
                                    if ($vitype[0]== 'video'){
                                        $vidata['question_vi_type']=2;
                                    }else{
                                        $vidata['question_vi_type']=1;
                                    }

                                    $questionvimodel->add($vidata);

                                }

                                $questionmodel->commit();
                                die(json_encode(array('str' => 1, 'id' => $questionid,'cid' => $this->post('cid'))));
                            }else{
                                $questionmodel->rollback();
                                die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                            }
                        }catch (Exception $e){
                            $questionmodel->rollback();
                            die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                        }

                    }
                }else{

                    die(json_encode(array('str' => 5,'msg'=>'请上传相应的图片或视频')));
                }
            }
        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //发布资源
    public function ajax_createresource(){


        if (IS_POST){


            if (!isset($_POST['name']) || $this->post('name') == ''){

                die(json_encode(array('str' => 3, 'msg' => '请输入标题')));
            } else if(!isset($_POST['content']) || $this->post('content') == ''){

                die(json_encode(array('str' => 4, 'msg' => '请输入内容')));
            } else if(!isset($_POST['cid']) || $this->post('cid') == ''){

                die(json_encode(array('str' => 6, 'msg' => '没有该群')));
            } else if(!isset($_POST['resourcefile']) || $this->post('resourcefile') == ''){

                die(json_encode(array('str' => 7, 'msg' => '没有资源')));
            } else {
                if ($_FILES) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $type = explode('/', $_FILES['img']['type'][0]);
                    if ($type[0] == 'video') {
                        $upload->maxSize = 204800000;// 设置附件上传大小
                    } else {
                        $upload->maxSize = 3072000;// 设置附件上传大小
                    }

                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'mp4', 'avi');// 设置附件上传类型
                    $upload->rootPath = './Uploads/'; // 设置附件上传根目录

                    $filelist = $upload->dealFiles($_FILES);

                    $info = $upload->upload($_FILES);

                    if (!$info || count($filelist) != count($info)) {
                        // 上传错误提示错误信息
                        die(json_encode(array('str' => 0, 'msg' => $upload->getError())));
                    } else {

                        $resourcemodel = new ResourceModel();
                        $resourcevimodel = new ResourceVIModel();

                        $resourcemodel->startTrans();
                        try{
                            $resourcedata = array(
                                'resource_cid' => $this->post('cid'),
                                'resource_uid' => $this->userid,
                                'resource_name' => $this->post('name'),
                                'resource_content' => $this->post('content'),
                                'resource_url' => $this->post('resourcefile'),
                                'resource_createtime' => date("Y-m-d H:i:s", time()),
                            );
                            if (isset($_POST['reward']) && $this->post('reward') != ''){

                                $resourcedata['question_reward'] = $this->post('reward');
                            }else{

                                $resourcedata['question_reward']=0;
                            }

                            $resourceid = $resourcemodel->add($resourcedata);

                            if ($resourceid){

                                foreach ($info as $i){
                                    $url = $i['savepath'].$i['savename'];

                                    $vidata = array(
                                        'question_vi_qid' => $resourceid,
                                        'question_vi_url' =>$url,
                                    );
                                    $vitype = explode('/', $i['type']);
                                    if ($vitype[0]== 'video'){
                                        $vidata['resource_vi_type']=2;
                                    }else{
                                        $vidata['resource_vi_type']=1;
                                    }

                                    $resourcevimodel->add($vidata);

                                }

                                $resourcemodel->commit();
                                die(json_encode(array('str' => 1, 'id' => $resourceid,'cid' => $this->post('cid'))));
                            }else{
                                $resourcemodel->rollback();
                                die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                            }
                        }catch (Exception $e){
                            $resourcemodel->rollback();
                            die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                        }

                    }
                }else{

                    die(json_encode(array('str' => 5,'msg'=>'请上传相应的图片或视频')));
                }
            }
        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //发布post
    public function ajax_createpost(){


        if (IS_POST){


            if (!isset($_POST['name']) || $this->post('name') == ''){

                die(json_encode(array('str' => 3, 'msg' => '请输入标题')));
            } else if(!isset($_POST['content']) || $this->post('content') == ''){

                die(json_encode(array('str' => 4, 'msg' => '请输入内容')));
            } else if(!isset($_POST['cid']) || $this->post('cid') == ''){

                die(json_encode(array('str' => 6, 'msg' => '没有该群')));
            } else {
                if ($_POST['posttype']==3){
                    if(!isset($_POST['resourcefile']) || $this->post('resourcefile') == ''){

                        die(json_encode(array('str' => 7, 'msg' => '没有资源')));
                    }
                }

                if ($_FILES) {
                    $upload = new \Think\Upload();// 实例化上传类
                    $type = explode('/', $_FILES['img']['type'][0]);
                    if ($type[0] == 'video') {
                        $upload->maxSize = 204800000;// 设置附件上传大小
                    } else {
                        $upload->maxSize = 3072000;// 设置附件上传大小
                    }

                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'mp4', 'avi');// 设置附件上传类型
                    $upload->rootPath = './Uploads/'; // 设置附件上传根目录

                    $filelist = $upload->dealFiles($_FILES);

                    $info = $upload->upload($_FILES);

                    if (!$info || count($filelist) != count($info)) {
                        // 上传错误提示错误信息
                        die(json_encode(array('str' => 0, 'msg' => $upload->getError())));
                    } else {

                        $notemodel = new NoteModel();
                        $notevimodel = new NoteVIModel();
                        $usermodel = new UserModel();

                        $notemodel->startTrans();
                        try{
                            $notedata = array(
                                'note_cid' => $this->post('cid'),
                                'note_uid' => $this->userid,
                                'note_name' => $this->post('name'),
                                'note_content' => $this->post('content'),
                                'note_type' => $this->post('posttype'),
                                'note_createtime' => date("Y-m-d H:i:s", time()),
                            );
                            if ($this->post('posttype')==2){
                                $notedata['note_reward'] = $this->post('reward');
                            }
                            if ($this->post('posttype')==3){
                                $notedata['note_reward'] = $this->post('reward');
                                $notedata['note_url'] = $this->post('resourcefile');
                            }

                            $noteid = $notemodel->add($notedata);
                            $userone = $usermodel->findone('user_id = '.$this->userid);
                            $userdata = array(
                                'user_notes' => $userone['user_notes']+1,
                            );
                            $usermodel->updataone('user_id = '.$this->userid,$userdata);

                            if ($noteid){

                                foreach ($info as $i){
                                    $url = $i['savepath'].$i['savename'];

                                    $vidata = array(
                                        'note_vi_nid' => $noteid,
                                        'note_vi_url' =>$url,
                                    );
                                    $vitype = explode('/', $i['type']);
                                    if ($vitype[0]== 'video'){
                                        $vidata['note_vi_type']=2;
                                    }else{
                                        $vidata['note_vi_type']=1;
                                    }

                                    $notevimodel->add($vidata);

                                }

                                $notemodel->commit();
                                die(json_encode(array('str' => 1, 'id' => $noteid,'cid' => $this->post('cid'))));
                            }else{
                                $notevimodel->rollback();
                                die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                            }
                        }catch (Exception $e){
                            $notevimodel->rollback();
                            die(json_encode(array('str' => 2, 'msg' => '发布失败')));
                        }

                    }
                }else{

                    die(json_encode(array('str' => 5,'msg'=>'请上传相应的图片或视频')));
                }
            }
        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //帖子懒加载
    public function ajax_havenote(){
        if (IS_POST){

            $where = 'note_cid = '.$this->post('cid').' and note_ishide = 1';
            if (isset($_POST['name'])&&$this->post('name')!=''){
                $where .= ' and note_name like "%'.$this->post('name').'%"';
            }
            $notemodel = new NoteModel();
            $limit1 = $this->post('limit1')*$this->post('limit2');
            $limit2 = $this->post('limit2');
            $notelist = $notemodel->joinonelist($where,'u_user u on u_note.note_uid = u.user_id',$this->post('order'),$limit1,$limit2);
            $notecount = $notemodel->joinone($where,'u_user u on u_note.note_uid = u.user_id',$this->post('order'),'INNER','count(*) num')['num'];
            if ($notelist){
                die(json_encode(array('str' => 1,'msg'=>$notelist,'count'=>$notecount)));
            }else{
                die(json_encode(array('str' => 2,'msg'=>$notelist,'count'=>$notecount)));
            }


        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //问答懒加载
    public function ajax_havequestion(){

        if (IS_POST){

            $where = 'question_cid = '.$this->post('cid').' and question_ishide = 1';
            if (isset($_POST['name'])&&$this->post('name')!=''){
                $where .= ' and question_name like "%'.$this->post('name').'%"';
            }

            $questionmodel = new QuestionModel();
            $limit1 = $this->post('limit1')*$this->post('limit2');
            $limit2 = $this->post('limit2');
            $questionlist = $questionmodel->joinonelist($where,'u_user u on u_question.question_uid = u.user_id',$this->post('order'),$limit1,$limit2);
            $questioncount = $questionmodel->joinone($where,'u_user u on u_question.question_uid = u.user_id',$this->post('order'),'INNER','count(*) num')['num'];
            if ($questionlist){
                die(json_encode(array('str' => 1,'msg'=>$questionlist,'count'=>$questioncount)));
            }else{
                die(json_encode(array('str' => 2,'msg'=>$questionlist,'count'=>$questioncount)));
            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //资源懒加载
    public function ajax_haveresource(){

        if (IS_POST){

            $where = 'resource_cid = '.$this->post('cid').' and resource_ishide = 1';
            if (isset($_POST['name'])&&$this->post('name')!=''){
                $where .= ' and resource_name like "%'.$this->post('name').'%"';
            }

            $resourcemodel = new ResourceModel();
            $limit1 = $this->post('limit1')*$this->post('limit2');
            $limit2 = $this->post('limit2');
            $resourcelist = $resourcemodel->joinonelist($where,'u_user u on u_resource.resource_uid = u.user_id',$this->post('order'),$limit1,$limit2);
            $resourcecount = $resourcemodel->joinone($where,'u_user u on u_resource.resource_uid = u.user_id',$this->post('order'),'INNER','count(*) num')['num'];
            if ($resourcelist){
                die(json_encode(array('str' => 1,'msg'=>$resourcelist,'count'=>$resourcecount)));
            }else{
                die(json_encode(array('str' => 2,'msg'=>$resourcelist,'count'=>$resourcecount)));
            }


        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //post懒加载
    public function ajax_havepost(){

        if (IS_POST){

            $where = 'note_cid = '.$this->post('cid').' and note_ishide = 1 and note_type = '.$this->post('type');

            if (isset($_POST['name'])&&$this->post('name')!=''){
                $where .= ' and note_name like "%'.$this->post('name').'%"';
            }

            $notemodel = new NoteModel();
            $limit1 = $this->post('limit1')*$this->post('limit2');
            $limit2 = $this->post('limit2');
            $notelist = $notemodel->joinonelist($where,'u_user u on u_note.note_uid = u.user_id',$this->post('order'),$limit1,$limit2);
            $notecount = $notemodel->joinone($where,'u_user u on u_note.note_uid = u.user_id',$this->post('order'),'INNER','count(*) num')['num'];
            if ($notelist){
                die(json_encode(array('str' => 1,'msg'=>$notelist,'count'=>$notecount)));
            }else{
                die(json_encode(array('str' => 2,'msg'=>$notelist,'count'=>$notecount)));
            }


        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //加入普通群
    public function ajax_followcrowd(){

        if (IS_POST){

            if (!$this->userid){

                die(json_encode(array('str' => 3, 'msg' => '请先登录')));
            }else if (!isset($_POST['cid'])||$this->post('cid')==''){

                die(json_encode(array('str' => 4, 'msg' => '请选择群')));
            }else {

                $crowdmembermodel = new CrowdMemberModel();
                $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$this->post('cid').' and crowd_member_uid = '.$this->userid);
                if ($memberone['crowd_member_status']==-1){

                    die(json_encode(array('str' => 5, 'msg' => '你是该群的黑名单')));
                }else if ($memberone){

                    die(json_encode(array('str' => 6, 'msg' => '你已是该群成员')));
                }else {

                    $data=array(
                        'crowd_member_cid'=>$this->post('cid'),
                        'crowd_member_uid'=>$this->userid,
                        'crowd_member_status'=>0,
                        'crowd_member_logintime'=>date("Y-m-d H:i:s", time()),
                    );

                    $res = $crowdmembermodel->add($data);

                    if ($res) {
                        die(json_encode(array('str' => 1, 'msg' => '加入成功')));
                    } else {
                        die(json_encode(array('str' => 2, 'msg' => '加入失败')));
                    }
                }
            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //发表帖子评论
    public function ajax_createNoteComment(){

        if (IS_POST){

            if (!isset($_POST['content'])||$this->post('content')==''){

                die(json_encode(array('str' => 3, 'msg' => '请填写内容')));
            }else if (!isset($_POST['nid'])||$this->post('nid')==''){

                die(json_encode(array('str' => 4, 'msg' => '没有该帖子')));
            }else {

                $data = array(
                    'note_comment_uid' => $this->userid,
                    'note_comment_nid' => $this->post('nid'),
                    'note_comment_content' => $this->post('content'),
                    'note_comment_createtime' => date("Y-m-d H:i:s", time()),
                );
                $notecommentmodel = new NoteCommentModel();
                $res = $notecommentmodel->add($data);
                if ($res){

                    die(json_encode(array('str' => 1,'msg'=>'发表成功')));
                }else{
                    die(json_encode(array('str' => 2,'msg'=>'发表失败')));
                }

            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //评论点赞
    public function ajax_noteCommentZan(){

        if (IS_POST){

            if (!isset($_POST['commemtid'])||$this->post('commemtid')==''){

                die(json_encode(array('str' => 3, 'msg' => '请填写内容')));
            }else {


                $notecommentmodel = new NoteCommentModel();
                $commentone = $notecommentmodel->findone('note_comment_id = '.$this->post('commemtid'));
                $uidlist = explode(',',$commentone['note_comment_zaner']);
                if (in_array($this->userid,$uidlist)){

                    die(json_encode(array('str' => 4,'msg'=>'你已经点赞过了')));
                }else{

                    $data['note_comment_zans'] = $commentone['note_comment_zans']+1;
                    if ($commentone['note_comment_zaner']){
                        $data['note_comment_zaner'] = $this->userid;
                    }else{
                        $data['note_comment_zaner'] = ','.$this->userid;
                    }

                    $res = $notecommentmodel->updataone('note_comment_id = '.$this->post('commemtid'),$data);

                    if ($res){
                        $commenttwo = $notecommentmodel->findone('note_comment_id = '.$this->post('commemtid'));
                        die(json_encode(array('str' => 1,'msg'=>$commenttwo['note_comment_zans'])));
                    }else{
                        die(json_encode(array('str' => 2,'msg'=>'点赞失败')));
                    }

                }
            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //评论取消点赞
    public function ajax_noteCommentUnzan(){

        if (IS_POST){

            if (!isset($_POST['commemtid'])||$this->post('commemtid')==''){

                die(json_encode(array('str' => 3, 'msg' => '请填写内容')));
            }else {


                $notecommentmodel = new NoteCommentModel();
                $commentone = $notecommentmodel->findone('note_comment_id = '.$this->post('commemtid'));
                $uidlist = explode(',',$commentone['note_comment_zaner']);
                if (!in_array($this->userid,$uidlist)){

                    die(json_encode(array('str' => 4,'msg'=>'你还未点赞')));
                }else{

                    $data['note_comment_zans'] = $commentone['note_comment_zans']-1;
                    foreach( $uidlist as $k=>$uid) {
                        if($uid == $this->userid) {
                            unset($uidlist[$k]);
                        }
                    }
                    $uidlist = array_values($uidlist);
                    $zaner = implode(',',$uidlist);
                    $data['note_comment_zaner'] = $zaner;

                    $res = $notecommentmodel->updataone('note_comment_id = '.$this->post('commemtid'),$data);

                    if ($res){
                        $commenttwo = $notecommentmodel->findone('note_comment_id = '.$this->post('commemtid'));
                        die(json_encode(array('str' => 1,'msg'=>$commenttwo['note_comment_zans'])));
                    }else{
                        die(json_encode(array('str' => 2,'msg'=>'取消点赞失败')));
                    }

                }
            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }
    }

    //评论列表
    public function ajax_commentlist(){

        if (IS_POST){

            if (!isset($_POST['nid'])||$this->post('nid')==''){

                die(json_encode(array('str' => 3, 'msg' => '没有这个内容')));
            }else {

                $notecommentmodel = new NoteCommentModel();
                $limit1 = ($this->post('limit1')-1)*$this->post('limit2');
                $commentlist = $notecommentmodel->joinonelist('note_comment_nid = '.$this->post('nid'),'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_isanswer desc,note_comment_zans desc,note_comment_createtime desc',$limit1,$this->post('limit2'));
                foreach ($commentlist as $key => $comment){
                    $uidlist = explode(',',$comment['note_comment_zaner']);
                    if (in_array($this->userid,$uidlist)){

                        $commentlist[$key]['iszan'] = 1;
                    }else{

                        $commentlist[$key]['iszan'] = 0;
                    }
                }
                die(json_encode(array('str' => 1,'msg'=>$commentlist)));

            }

        }else{
            die(json_encode(array('str' => 0,'msg'=>'存在非法字符')));
        }

    }



}