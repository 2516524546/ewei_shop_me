<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
	public $pagenum=10;
	public function _initialize() {
		if(!session('?piano_user')) {
		   $this->redirect('Login/login');	
		}
	}
	
	public function exportexcel($data=array(),$title=array(),$filename='report'){
		//处理中文文件名
		ob_end_clean();
		Header('content-Type:application/vnd.ms-excel;charset=utf-8');
	
 		header("Content-Disposition:attachment;filename=export_data.xls"); 
		//处理中文文件名
		$ua = $_SERVER["HTTP_USER_AGENT"];
		
		$encoded_filename = urlencode($filename);
		$encoded_filename = str_replace("+", "%20", $encoded_filename);
		if (preg_match("/MSIE/", $ua) || preg_match("/LCTE/", $ua) || $ua == 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko') {
		   header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
		}else {
		   header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        }
		header ( "Content-type:application/vnd.ms-excel" );
		
		
		$html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <meta http-equiv='Content-type' content='text/html;charset=UTF-8' />
            <head>
          
            <title>".$filename."</title>
            <style>
            td{
                text-align:center;
                font-size:12px;
                font-family:Arial, Helvetica, sans-serif;
                border:#1C7A80 1px solid;
                color:#152122;
                width:auto;
            }
            table,tr{
                border-style:none;
            }
            .title{
                background:#7DDCF0;
                color:#FFFFFF;
                font-weight:bold;
            }
            </style>
            </head>
            <body>
            <table width='100%' border='1'>
              <tr>";
		foreach($title as $k=>$v){
			$html .= " <td class='title' style='text-align:center;'>".$v."</td>";
		}
	
		$html .= "</tr>";
	
		foreach ($data as $key => $value) {
			$html .= "<tr>";
			foreach($value as $aa){
				$html .= "<td>".$aa."</td>";
			}
	
			$html .= "</tr>";
			 
		}
		$html .= "</table></body></html>";
		echo $html;
		exit;
	}




	//转码
	public function json_encode_ex($value){
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
	/**验证url的有效性
	 * @link http://www.phpddt.com
	*/
	public function url_exists($url){
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		//不下载
		curl_setopt($ch, CURLOPT_NOBODY, 1);
		//设置超时
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		curl_exec($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if($http_code == 200) {
			return true;
		}
		return false;
	}
	/**
	 **发送短信函数
	 **$phone 为手机号码，可以一个或多个号码，多个号码以“,”号隔开 例：13800000000,13800000000
	 **$msg 为短信内容，请发正规的验证码或行业通知类的内容和带签名,测试用例请发："你好，你的验证码为：666888.【企业宝】"
	 **$sendtime 为发送时间，为空立即发送，时间格式为："2016-12-12 12:12:12"
	 **$port 为端口号，默认为空
	 **$needstatus 是否需要状态回推,值为true或false,回推地址在后台设置
	 **所有线上公开促发短信发送的接入，比如公开的验证码、注册等必须加以判断每个号码的发送限制、ip发送短信限制
	 **/
	public function sendMessage($phone,$msg,$sendtime='',$port='',$needstatus=''){
		$username = "zihao2"; //在这里配置你们的发送帐号
		$passwd = "zihao99";    //在这里配置你们的发送密码
	
		$ch = curl_init();
		$post_data = "username=".$username."&passwd=".$passwd."&phone=".$phone."&msg=".urlencode($msg)."&needstatus=true&port=".$port."&sendtime=".$sendtime;
	
		// php5.4或php6 curl版本的curl数据格式为数组   你们接入时要注意
		/*  $post_data = array(
		 "username"=>$username,
				"passwd"=>$passwd,
				"phone"=>$phone,
				"msg"=>urlencode("您好,你的验证码:".$msg."【子昊钢琴】"),
				"needstatus"=>"true",
				"port"=>'',
				"sendtime"=>''
		);   */
		// echo '<pre/>';
		//var_dump($post_data);exit;
		curl_setopt ($ch, CURLOPT_URL,"http://www.qybor.com:8500/shortMessage");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		return json_decode($file_contents);
	}
	
	public function ckeck_mobile($mobile){
		if(!preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$mobile)){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 验证18位身份证（计算方式在百度百科有）
	 * @param  string $id 身份证
	 * return boolean
	 */
	public function check_identity($id=''){
		$set = array(7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2);
		$ver = array('1','0','x','9','8','7','6','5','4','3','2');
		$arr = str_split($id);
		$sum = 0;
		for ($i = 0; $i < 17; $i++){
			if (!is_numeric($arr[$i])){
				return false;
			}
			$sum += $arr[$i] * $set[$i];
		}
		$mod = $sum % 11;
		if(strcasecmp($ver[$mod],$arr[17]) != 0){
			return false;
		}
		return true;
	}
	
	/******************消息推送**********************/
	/***@title:标题，
	 * @content:内容
	* @tag:dui对象：老板：boss; 店长：dianzhang; 员工：yuangong; 学员：student; 所有人：四个拼接，用逗号隔开
	**/
	public function xiaoxi_tuisong($title,$content,$htime,$tag,$type,$quanxian){
		header('content-type:text/html;charset=utf8');
		include('./umerapp/Admin/Common/jpush.php');
	
		$n_title   = $title;
		$n_content =  $content;
		$receiver_value = $tag;
       
		
		$appkeys = 'd0c106edc569c3fd9b170573';
		$masterSecret = '6b1da388d34a844efcaf7628';
	
		//统计消息推送最大id标记消息纪录
		$xiaoxi = M('Tuisong');
		$sendno = $xiaoxi->max('id');
		$sendno = $sendno+1;
	
		//android发消息
		$content = json_encode(array('id'=>$sendno,'title'=>$title,'htime'=>$htime,'content'=>$content,'time'=>date('Y-m-d H:i'),'type'=>$type,'quanxian'=>$quanxian),JSON_UNESCAPED_UNICODE);
		//设备
		$platform = 'android';
		$msg_content = json_encode(array('message'=>$content));
	
		$obj = new \jpush($masterSecret,$appkeys); 
		$res = $obj->send($sendno, 2, $receiver_value, 2, $msg_content, $platform);
	
		//设备：ios,发通知
		/* $platform = 'ios';
		$msg_content = json_encode(array('n_builder_id'=>$sendno, 'n_title'=>$n_title, 'n_content'=>$n_content));
		$res = $obj->send($sendno, 4, $receiver_value, 1, $msg_content, $platform); */
		//var_dump($res);exit;
		return $res;
	}
	/******************消息推送**********************/
	//上传图片
	public function upload_img($file){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
		
		$upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
		$info   =   $upload->uploadOne($file);
		
		/* //获取图片的信息
		$img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
		list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
		//像素
		if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
		} */
		
		if(!$upload->rootPath){
			mkdir($upload->rootPath,0777,true);
		}
		//var_dump($info);exit;
		if(!$info) {// 上传错误提示错误信息
			echo $upload->getError();exit;
			//$this->error($upload->getError());
		}else{// 上传成功 获取上传文件信息
			$file_name= '/Uploads/'.$info['savepath'].$info['savename'];
	        return $file_name;
	        /* for($i=0;$i<count($info);$i++){      
	        	$file[$i]='/Uploads/'.$info[$i]['savepath'].$info[$i]['savename'];   
	         }
	         return $file;exit; */
		}
	}
	
//数据无限级处理	
	public function getTree($list,$parent_id=0,$level=0) {
		static $tree = array();
		foreach($list as $row) {
			if($row['pid']==$parent_id) {
				$row['level'] = $level;
				$tree[] = $row;
				$this->getTree($list, $row['id'], $level + 1);
			}
		}
		return $tree;
	}
	
//全体发送消息
	public function send_msg($sendno,$title,$content){
		header('content-type:text/html;charset=utf8');
		require_once('./Piano/Common/Common/jpush.php');
	    
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
		 
		$obj = new \jpush($masterSecret,$appkeys);
		// dump($sendno);
		// die;
		$sendnum = $sendno;
		// dump($sendnum);
		// die;
		if($platform == 'android'){//安卓和ＩＯＳ不同，msg_content 需要做不同的处理  android手机使用型号太多，需要转码
			$content = $this->json_encode_ex(array('userid'=>$userid,'title'=>$title,'content'=>$content,'time'=>date('Y-m-d'),'type'=>2,));

			$msg_content = json_encode(array('message'=>$content));
		}else{
			$msg_content = json_encode(array('n_builder_id'=>1, 'n_title'=>$title, 'n_content'=>$content,'n_extras'=>array('type'=>2,'title'=>$title)));
		}
		// dump($msg_content);
		// die;
		$res = $obj->send($sendnum,$receiver_type = 4,$receiver_value = '', $msg_type = 1,
		                  $msg_content,$platform = 'android,ios');

		return $res;
	}
	
	public function message_tuisong($content,$shebei,$type,$userid){
		header('content-type:text/html;charset=utf8');
		require_once('./Piano/Common/Common/jpush.php');
	   
		
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
		 
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
		// dump($userid);
		// die;
		$n_content =  $content;
		$receiver_value = $shebei;
	
		if($type == 1){//android发消息
			//设备
			$platform = 'android';
			//android发消息
			$content = $this->json_encode_ex(array('userid'=>$userid,'title'=>'系统通知','content'=>$n_content,'time'=>date('Y-m-d'),'type'=>2,));
			$msg_content = json_encode(array('message'=>$content));
				
			$res = $obj->send($sendno, 3, $receiver_value, 2, $msg_content, $platform);
		}else if($type == 2){//设备：ios,发发通知
			//设备
			$platform = 'ios';
	
			$msg_content = json_encode(array('n_builder_id'=>1, 'n_title'=>'系统通知', 'n_content'=>$n_content,'n_extras'=>array('type'=>2,'title'=>'系统通知')));
			
			$res = $obj->send($sendno, 3, $receiver_value, 1, $msg_content, $platform);
			
		}
	
		return $res;
	}
	
	
	
	public function Sec2Time($time){
	    if(is_numeric($time)){
	    	$value = array("years" => 0, "days" => 0, "hours" => 0,"minutes" => 0, "seconds" => 0,);
	    	
		    if($time >= 31556926){
		      	$value["years"] = floor($time/31556926);
		      	$time = ($time%31556926);
		    }
		    if($time >= 86400){
		      	$value["days"] = floor($time/86400);
		      	$time = ($time%86400);
		    }
		    if($time >= 3600){
		      	$value["hours"] = floor($time/3600);
		      	$time = ($time%3600);
		    }
		    if($time >= 60){
		      	$value["minutes"] = floor($time/60);
		      	$time = ($time%60);
		    }
		    $value["seconds"] = floor($time);
		    //return (array) $value;
		    $t=$value["years"] ."年". $value["days"] ."天"." ". $value["hours"] ."小时". 
		       $value["minutes"] ."分".$value["seconds"]."秒";

		    if($value["years"] == 0){
		    	$t= $value["days"] ."天"." ". $value["hours"] ."小时". 
		       		$value["minutes"] ."分".$value["seconds"]."秒";
		    }
		    if($value["days"] == 0){
		    	$t= $value["hours"] ."小时".$value["minutes"] ."分".$value["seconds"]."秒";
		    }
		    if($value["hours"] == 0){
		    	$t= $value["minutes"] ."分".$value["seconds"]."秒";
		    }
		    Return $t;
	    
	    }else{
	    	return (bool) FALSE;
	    }
 	}
	
	public function ios_msg_send($content,$shebei,$userid){
		require_once './Piano/Home/Common/jpush-api-php-client-3.5.12/autoload.php';
		header('content-type:text/html;charset=utf8');

		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
		$client = new \JPush\Client($appkeys, $masterSecret);
		// $a = $client->device()->getAliasDevices($shebei);
		                        
		// if(!$a){
		// 	return false;
		// }

		// if(!$a['body']['registration_ids']){
		// 	return false;
		// }
		

		// $content = '测试内容';
		// $title = "测试标题";
		//安卓
		// $a = $client->push()
  //              ->setPlatform(array('android'))
  //              ->addAlias('861374033229342') 
  //               // ->addAllAudience() // 设置所有设备都推送
  //              ->androidNotification('人生自古多艰难321')
  //              ->send();

  //              dump($a);exit;

		//苹果
		 // $payload = $client->push()
		 //  ->setPlatform('ios')
	  //   ->addAlias($shebei)
	  //   ->setNotificationAlert($content)
	  //   ->send();
		  $response = $client->push()
		    ->setPlatform('ios')
		    ->addAlias($shebei)
		    ->iosNotification($content, [
							  'sound' => 'sound.caf',
							  'badge' => '1',
							  'extras' => [
							    'key' => 'value'
							  ]
							])
		    ->send();
        // $b =   $client->push()
        //        ->setPlatform(array('ios'))
        //        // ->setNotificationAlert('人生自古多艰难')
        //        ->addAlias($shebei)
        //        ->iosNotification($content, array(
					   //           'sound' => 'sound.caf',
					   //           'badge' => '1',
					   //           'content-available' => true,
					   //           'mutable-content' => true,
					   //           'category' => 'jiguang',
					   //           'extras' => array(
					   //              'userid' => $userid,
					   //              'jiguang'
        //                          ),
        //                         ))
        //         ->options(array(
		      //       // sendno: 表示推送序号，纯粹用来作为 API 调用标识，
		      //       // API 返回时被原样返回，以方便 API 调用方匹配请求与返回
		      //       // 这里设置为 100 仅作为示例

		      //       // 'sendno' => 100,

		      //       // time_to_live: 表示离线消息保留时长(秒)，
		      //       // 推送当前用户不在线时，为该用户保留多长时间的离线消息，以便其上线时再次推送。
		      //       // 默认 86400 （1 天），最长 10 天。设置为 0 表示不保留离线消息，只有推送当前在线的用户可以收到
		      //       // 这里设置为 1 仅作为示例

		      //       // 'time_to_live' => 1,

		      //       // apns_production: 表示APNs是否生产环境，
		      //       // True 表示推送生产环境，False 表示要推送开发环境；如果不指定则默认为推送生产环境

		      //       'apns_production' => True,

		      //       // big_push_duration: 表示定速推送时长(分钟)，又名缓慢推送，把原本尽可能快的推送速度，降低下来，
		      //       // 给定的 n 分钟内，均匀地向这次推送的目标用户推送。最大值为1400.未设置则不是定速推送
		      //       // 这里设置为 1 仅作为示例

		      //       // 'big_push_duration' => 1
        //         ))

        //        ->send();


        //         dump($b);exit;
	}

















	
	
}