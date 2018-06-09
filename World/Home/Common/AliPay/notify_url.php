<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */
// header('Access-Control-Allow-Origin:*');      //跨域要加上这个头

	$fp = fopen('/mnt/gangqing/log.txt','a+');
	fwrite($fp,json_encode($_POST)."\r\n");
	fclose($fp);

	//商户订单号
	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号
	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];


	if($trade_status == 'TRADE_SUCCESS'){   
		//判断该笔订单是否在商户网站中已经做过处理
		//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
		//如果有做过处理，不执行商户的业务程序
		$dsn = "mysql:host=localhost;dbname=piano";
		$db = new PDO($dsn, 'root', 'zihao123');

		$a = $db->query("select * from piano_xnb_record where xf_num='{$out_trade_no}'limit 1")->fetch();	
		//一个是支付   一个是充值
		if($a){
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
			
		}

		$b = $db->query("select * from piano_goods_order where go_num='{$out_trade_no}'limit 1")->fetch();
		if($b){
			$db->exec("update piano_goods_order set go_status=2 where go_num='{$out_trade_no}'");
			//更新支付记录为成功
		}
		
		$db = null;
    }
		

	echo "SUCCESS";

	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


  

?>