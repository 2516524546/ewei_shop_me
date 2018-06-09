<?php
	$g = date('Y-m-d H:i:s',time());
	$fp = fopen('/mnt/gangqing/log1.txt','a+');
	fwrite($fp,$g."\r\n");
	fclose($fp);
 

	$dsn = "mysql:host=localhost;dbname=piano";
	$db = new PDO($dsn, 'root', 'zihao123');
	$time = strtotime(date('Y-m-d H:i:00',time()+3600));  
	//那么就需要后台每分钟自动执行一次  
	//当查到时间等于现在时间加1小时的分钟整的时候，就推送消息
	//等同于提前1小时的定时推送了1
	$now = strtotime(date('Y-m-d H:i:00',time()));
	
	$c = $db->query("select * from piano_course_list where cl_stime = '$time' and cl_status='1'")
			->fetchall();

	if($c){
		if(count($c) == count($c,1)) {
			$c = $db->query("select * from piano_course_list where cl_stime ='$time' and 
				             cl_stime>'$now' and cl_status='1'")
					->fetch();

			$name = explode(',',($c['cl_stuid'].','.$c['cl_tid']));
  			$mini = floor(($c['cl_stime']-$now)/60);
  			foreach ($name as $key => $value){
  				$d = $db->query("select * from piano_token where t_userid ='$value'")
						->fetch();

  				$shebei = $d['t_shebei'];
	  			$type = $d['t_leixin'];
	  			$userid = $value;
	  			$content = "您有一堂课就快要开始上课了，时间还剩".$mini."分钟";
	  			if($shebei && $type){
		  			call_user_func('message_tuisong',$content,$shebei,$type,$userid);
		  		}
  			}
		}else{
			foreach ($c as $k => $v){
				$name = explode(',',$v['cl_stuid'].','.$v['cl_tid']);
	  			$mini = floor(($v['cl_stime']-$now)/60);
	  			foreach ($name as $key => $value){
	  				$d = $db->query("select * from piano_token where t_userid ='$value'")
							->fetch();

	  				$shebei = $d['t_shebei'];
		  			$type = $d['t_leixin'];
		  			$userid = $value;
		  			$content = "您有一堂课就快要开始上课了，时间还剩".$mini."分钟";
		  			if($shebei && $type){
			  			call_user_func('message_tuisong',$content,$shebei,$type,$userid);
			  		}
	  			}
			}
		}
	}


	$e = $db->query("select * from piano_room where UNIX_TIMESTAMP(s_time) = '$time' and UNIX_TIMESTAMP(s_time)>'$now'")
			->fetchall();

	if($e){
		if(count($e) == count($e,1)) {
			$e = $db->query("select * from piano_room where UNIX_TIMESTAMP(s_time) ='$time' and UNIX_TIMESTAMP(s_time)>'$now'")
					->fetch();   

			$mini = floor((strtotime($e['s_time'])-$now)/60);
			$id = $e['zhubo_id'];
			$f = $db->query("select * from piano_token where t_userid ='$id'")
					->fetch();
		
			$shebei = $f['t_shebei'];
	  		$type = $f['t_leixin'];
	  		$userid = $id;
	  		$content = "您有一次预约马上就要开播了，时间还剩".$mini."分钟";
	  		if($shebei && $type){
	  			call_user_func('message_tuisong',$content,$shebei,$type,$userid);
	  		}

		}else{
			foreach ($e as $k => $v){
				$mini = floor((strtotime($v['s_time'])-$now)/60);
				$id = $v['zhubo_id'];
				$f = $db->query("select * from piano_token where t_userid ='$id'")
						->fetch();
  				$shebei = $f['t_shebei'];
		  		$type = $f['t_leixin'];
		  		$userid = $id;
		  		$content = "您有一次预约马上就要开播了，时间还剩".$mini."分钟";
		  		if($shebei && $type){
		  			call_user_func('message_tuisong',$content,$shebei,$type,$userid);
		  		}
			}
		}
	}
	$db = null;


	function message_tuisong($content,$shebei,$type,$userid){
		require_once './Piano/Home/Common/jpush-api-php-client-3.5.12/autoload.php';
		header('content-type:text/html;charset=utf8');
		$appkeys = '92f6747676ad02928b60193d';
		$masterSecret = 'fd03317972e9e36777b378b9';
		
		$client = new \JPush\Client($appkeys, $masterSecret);
		          
		$a = $client->device()->getAliasDevices($shebei);
	                   
		if(!$a){
			return false;
		}

		if(!$a['body']['registration_ids']){
			return false;
		}
	
		if($type == 1){//android发消息
			$res = $client->push()
		                  ->setPlatform(array('android'))
		                  ->addAlias($shebei) 
		                // ->addAllAudience() // 设置所有设备都推送
		                  ->androidNotification($content,array('userid'=>$userid))
		                  ->send();

		}else if($type == 2){//设备：ios,发发通知	
			$res =  $client->push()
			               ->setPlatform(array('ios'))	               
			               ->addAlias($shebei)
			               ->iosNotification($content, array(
								             'sound' => 'sound.caf',
								             'badge' => '+1',
								             'content-available' => true,
								             'mutable-content' => true,
								             'category' => 'jiguang',
								             'extras' => array('userid' => $userid)
			                                ))
			               ->options(array('apns_production' => false))
			               ->send();
			
		}
	
		return $res;
	}

 
	function json_encode_ex($value){
		if (version_compare(PHP_VERSION,'5.4.0','<')){
			$str = json_encode($value);
			$str = preg_replace_callback(
					"#\\\u([0-9a-f]{4})#i",
					function($matchs)
					{
						return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
					},
					$str
			);
			return $str;
		}else{
			return json_encode($value, JSON_UNESCAPED_UNICODE);
		}
	}
	

?>