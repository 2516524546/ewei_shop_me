<?php

header('content-type:text/html;charset=utf8');
 include "./TopSdk.php";
    date_default_timezone_set('Asia/Shanghai');
    $content = '666666';
	$mobile = '13570582175';
    $c = new TopClient;
    $c->appkey = "23433374";
    $c->secretKey = "212123df96d7ab3965b1d14a03fc5470";
    $c->format = "json";
    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $req->setSmsType("normal");
    $req->setSmsFreeSignName("注册验证");
    $req->setSmsParam('{"code":"'. $content .'","product":"'. '注册验证' .'"}');
    $req->setRecNum($mobile);
    $req->setSmsTemplateCode("SMS_12982913");
    $resp = $c->execute($req);
 
    var_dump($resp);exit;
    if($resp->result->success)
    {
        return true;
    }
    else
    {
        return false;
    }