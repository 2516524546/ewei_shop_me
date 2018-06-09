<?php

	// 微信回调

	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];

	libxml_disable_entity_loader(true);
	$params = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	// dump($params);exit;
	// 回调后执行后续工作
	
	// 封装 json 放入文件
	$list = json_encode($params,JSON_UNESCAPED_UNICODE);

	
	function logResult($word='') {
		$fp = fopen("/mnt/gangqing/log.txt","a+");
		flock($fp, LOCK_EX) ;
		fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$word."\n");
		flock($fp, LOCK_UN);
		fclose($fp);
	}
	
	logResult($list);

	if($params['return_code'] == 'SUCCESS'){

		$out_trade_no = (string)$params['out_trade_no'];
		
		$dsn = "mysql:host=localhost;dbname=piano";
		$db = new PDO($dsn, 'root', 'zihao123');

		$db->exec("update piano_xnb_record set xf_status=2 where xf_num='{$out_trade_no}'");
		//更新充值记录为成功
		
		$rs = $db->query("select * from piano_xnb_record where xf_num='{$out_trade_no}'limit 1")->fetch();
		$chongzhimoney = $rs['xf_point'];
		//查充值了多少点数
		
		$money = $db->query("select * from piano_users where id='{$rs['xf_userid']}' limit 1")->fetch();
		$usermoney = $money['money'];
		//查本身多少点数

		$up = bcadd($chongzhimoney,$usermoney,1);
		$db->exec("update piano_users set money={$up} where id='{$rs['xf_userid']}'");
		//更新点数
		$db = null;

	}



	

	echo "
	        <xml>
	         <return_code><![CDATA[SUCCESS]]></return_code>
	         <return_msg><![CDATA[OK]]></return_msg>
	        </xml>
	    ";





?>