<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	public $pagenum=10;
	/*public function _initialize() {
		$_SESSION['user']['wxid'] = C('WXID');
		 if(!session('?yh_user')) {
		   $this->redirect('Login/login');	
		} 
	}*/
	//计算经纬度
	
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * @desc 根据两点间的经纬度计算距离
	* @param float $lat 纬度值
	* @param float $lng 经度值
	*/
	public function getDistance($lat1, $lng1, $lat2, $lng2)
	{
		$earthRadius = 6367.000; //approximate radius of earth in meters

		$lat1 = ($lat1 * pi() ) / 180;
		$lng1 = ($lng1 * pi() ) / 180;
	
		$lat2 = ($lat2 * pi() ) / 180;
		$lng2 = ($lng2 * pi() ) / 180;
	

		$calcLongitude = $lng2 - $lng1;
		$calcLatitude = $lat2 - $lat1;
		$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
		$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
		$calculatedDistance = $earthRadius * $stepTwo;
	
		return round($calculatedDistance,1);
	}
	
	//数组排序
	public function array_sort($arr,$keys,$type='asc'){
		$keysvalue= $new_array= array();
		foreach($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type== 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
		}
		return $new_array;
	}
	//生成支付订单号
	public function order_sn($str){
	
		$str = $str.date('YmdHis');
		$ZM='0987654321';
		//随机生成6个数字
		for($i=0;$i<6;$i++){
			$a.=$ZM[mt_rand(0,strlen($ZM)-1)];
		}
		return $str.$a;
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
	
	 
//数据无限级处理	
	public function getTree($list,$parent_id=0,$level=0) {
		static $tree = array();
		foreach($list as $row) {
			if($row['p_huifu']==$parent_id) {
				$row['level'] = $level;
				$tree[] = $row;
				$this->getTree($list, $row['id'], $level + 1);
			}
		}
		return $tree;
	}
	
	
//多图片上传
	public function upload($file){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     3145728 ;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
		$upload->rootPath  =     './Public/Uploads/'; // 设置附件上传根目录
		$info   =   $upload->upload($file);
	
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
			return $info;		
		}
	}
	
	
	
	
	
	
	
	
	
	
	
}