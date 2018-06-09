<?php

// 微信回调

	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	libxml_disable_entity_loader(true);
	$params = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	// 回调后执行后续工作
	
	// 封装 json 放入文件
	$list = json_encode($params,JSON_UNESCAPED_UNICODE);
	logResult($list);

	if($params['return_code'] == 'SUCCESS'){

		$out_trade_no = (string)$params['out_trade_no'];
		$dsn = "mysql:host=localhost;dbname=dfz";
		$db = new PDO($dsn, 'root', 'root');
		$db->exec("update dfz_order set order_status=1 where order_number='{$out_trade_no}'");
	}
	echo "
	        <xml>
	         <return_code><![CDATA[SUCCESS]]></return_code>
	         <return_msg><![CDATA[OK]]></return_msg>
	        </xml>
	    ";