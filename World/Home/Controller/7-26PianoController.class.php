<?php
namespace Home\Controller;
use Think\Controller;
class PianoController extends CommonController {
	
	//广告图接口
	public function banner(){
		// $reIP=$_SERVER["REMOTE_ADDR"]; 
		// echo $reIP;exit;
	
		$list = M("Banner")->field('b_url as url,b_link as link')->where("b_set='1'")->select();
		if($list){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $list;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'亲，暂时没有数据噢');
		}
	}
	
	//我的练琴日志
	public function my_practice_log(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$field = "piano_practice_log.*,";
		$field .= "piano_songs_list.list_url,piano_songs_list.list_url_music,piano_songs_list.list_name as lname,";
		$field .= "piano_songs.songs_name as sname,piano_songs_list.lid";
		
		$join1 = "piano_songs_list on piano_songs_list.lid = piano_practice_log.log_lid";
		$join2 = "piano_songs on piano_songs_list.list_sid = piano_songs.sid";
		$where = "piano_practice_log.log_userid='{$userid}'";
			
		$log = M("Practice_log")->field($field)
							->join($join1)
							->join($join2)
							->where($where)
							->group('piano_songs_list.lid')
							->order("piano_practice_log.log_id DESC")
							->limit($offset,$number)
							->select();
			
		foreach($log as $k=>$val){
			$data = array(
					'log_id' => $val['log_id'],
					'long_time' => $val['log_long'],
					'point' => $val['log_point'],
					'time' => $val['log_time'],
					'lid' => $val['log_lid'],
					'name' => $val['sname'].'('.$val['lname'].')',
					'url' => $val['list_url'],
					'url_music' => $val['list_url_music']
			);
				
			$log_data[$k] = $data;
		}
		if($log_data){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $log_data;
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'亲，暂时没有数据噢');
		}
	}

	//我的练琴日志
	public function my_practice_log1(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('获取失败',1,'尚未登录');
		// }
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$field = "piano_practice_log.*,";
		$field .= "piano_songs_list.list_url,piano_songs_list.list_url_music,piano_songs_list.list_name as lname,";
		$field .= "piano_songs.songs_name as sname,piano_songs_list.lid";
		
		$join1 = "piano_songs_list on piano_songs_list.lid = piano_practice_log.log_lid";
		$join2 = "piano_songs on piano_songs_list.list_sid = piano_songs.sid";
		$where = "piano_practice_log.log_userid='{$userid}'";
			
		$log = M("Practice_log")->field($field)
							->join($join1)
							->join($join2)
							->where($where)
							->group('piano_songs_list.lid')
							->order("piano_practice_log.log_id DESC")
							->limit(30)
							->select();
			
		foreach($log as $k=>$val){
			$data = array(
					'log_id' => $val['log_id'],
					'long_time' => $val['log_long'],
					'point' => $val['log_point'],
					'time' => $val['log_time'],
					'lid' => $val['log_lid'],
					'name' => $val['sname'].'('.$val['lname'].')',
					'url' => $val['list_url'],
					'url_music' => $val['list_url_music']
			);
				
			$log_data[$k] = $data;
		}
		if($log_data){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $log_data;
			$rest['count'] = count($log_data);
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'亲，暂时没有数据噢');
		}
	}

	//我的曲谱浏览历史
	public function my_songs_history(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('获取失败',1,'尚未登录');
		// }
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$field = "his_id,sid,songs_name as name,songs_img as img,his_time";
		$join = "piano_songs on piano_songs.sid = piano_songs_history.his_sid";
		// $join1 = 'piano_songs on piano_songs.sid = piano_songs_list.list_sid'; 
		$where = "his_userid='{$userid}'";
		
		$history = M("Songs_history")->field($field)
		              ->join($join)
		              // ->join($join1)
		              ->where($where)
		              ->order("piano_songs_history.his_time DESC")
		              ->limit($offset,$number)->select();

		if($history){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $history;
			 
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'亲，暂时没有数据噢');
		}
	}

	public function my_songs_history1(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('获取失败',1,'尚未登录');
		// }
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$field = "his_id,lid,list_name as name,list_url as url,
		          list_url_music as url_music,songs_img as img,his_time";
		$join = "piano_songs_list on piano_songs_list.lid = piano_songs_history.his_lid";
		$join1 = 'piano_songs on piano_songs.sid = piano_songs_list.list_sid'; 
		$where = "his_userid='{$userid}'";
		
		$history = M("Songs_history")->field($field)
						             ->join($join)
						             ->join($join1)
						             ->where($where)
						             ->order("piano_songs_history.his_time DESC")
						             ->limit(30)
						             ->select();

		if($history){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $history;
			 
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'亲，暂时没有数据噢');
		}
	}

	//删除我的录音视频
	public function video_del(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$vid = (int)$_REQUEST['vid'];	//1视频，2录音
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		if($vid){
		    $find_file = M("Video")->where("vid='{$vid}' and v_userid='{$userid}'")->find();
			$del = M("Video")->where("vid='{$vid}' and v_userid='{$userid}'")->limit(1)->delete();
		    if($del){
		    	@unlink($find_file['v_fileurl']);
		    	
		    	$rest['status'] = true;
		    	$rest['msg'] = '操作成功';
		    	
		    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		    }else{
		    	$this->error2('操作失败',1,'sql错误');
		    }
		}else{
			$this->error1();
		}
	}
	//我的录音视频
	public function my_video(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$type = (int)$_REQUEST['type'];	//1视频，2录音	
	
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		if($type == '1' || $type == '2'){
			$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
			$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
			$offset = $number*($page-1);//->limit($offset,$number)
			
			$field = "piano_video.vid,piano_video.v_type,piano_video.v_fileurl,piano_songs_list.list_name as lname,piano_songs.songs_name as sname";
			$join1 = "piano_songs_list on piano_songs_list.lid = piano_video.v_lid";
			$join2 = "piano_songs on piano_songs_list.list_sid = piano_songs.sid";
			$where = "piano_video.v_userid='{$userid}' and piano_video.v_type='{$type}'";
			
			$video = M("Video")->field($field)
								->join($join1)
								->join($join2)
								->where($where)
								->limit($offset,$number)
								->order("piano_video.v_time DESC")->select();
			
			foreach($video as $k=>$val){
				$data = array(
						'vid' => $val['vid'],
						'type' => $val['v_type'],
						'name' => $val['lname'],
						'fileurl' => $val['v_fileurl'],
						'sname' => $val['sname']
				);
					
				$vdata[$k] = $data;
			}
			if($vdata){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $vdata;
			
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error2('获取失败',1,'参数非法');
		}
		
	}
	//我的曲谱
	public function my_songs_collection(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$field = "piano_songs.sid,piano_songs.songs_name as name,piano_songs.songs_img as img";
		$join = "piano_songs on piano_songs.sid = piano_songs_collection.sid";
		$where = "piano_songs_collection.sc_status='1' and piano_songs_collection.sc_userid='{$userid}'";
		
		$list = M("Songs_collection")->field($field)->join($join)->where($where)->limit($offset,$number)->select();
		
		if($list){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $list;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			
		}else{
			$this->error2('获取失败',2,'您还没有相关的曲谱');
		}
	}
	//课堂中心--学生身份
	//提交作业
	public function homework_up(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('提交失败',1,'尚未登录');
		// }
		
		$hid = (int)$_REQUEST['hid'];
		$point = (float)$_REQUEST['point'];

		$long = I('long');
		
		$speed = (float)$_REQUEST['speed'];
	
		// if($_POST){
		$data = array(
				        'hid' => $hid,
						'w_userid' => $userid,
						'w_point' => $point,
						'w_long' => $long,
					    'w_speed' =>$speed
		           	);

		$add = M("Homework_stu")->add($data);

		$a = M('Homework')->where("hid = '$hid'")->find();
		$count = M("Homework_stu")->where("hid='{$hid}' and w_userid='{$userid}'")->count();
		
		if($count < $a['count']){
			
			$num = $a['count']-$count;
			$rest['status'] = false;
			$rest['msg'] = '作业还差'.$num.'次';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}elseif($count == $a['count']){
			
             //给布置作业的老师添加消息提示
			$kid = M("Homework")->where("hid='{$hid}'")->getField('kid');
			$tid = M("Course_list")->where("id='{$kid}'")->getField('cl_tid');
			
			$teacher = M("Teacher")->where("t_userid='{$tid}'")->find();
			//提交作业的学生
			$user_stu = M("Users")->where("id='{$userid}'")->find();
			$content = $teacher['t_truename']."老师,您的学生：".$user_stu['nickname'].' 提交了作业，请批改';
		
			$data = array(
							'x_userid' => $tid,
							'x_content' => $content,
							'x_tuisong' => $userid,
							'x_type' => 3,
							'x_time' => date('Y-m-d H:i:s',time()),
							'x_kid'=> $add
					);
					// var_dump($data);exit;
				M("User_xiaoxi")->add($data);

			//给登陆老师添加消息记录
			//@parm:接收用户id、消息内容、推送人、消息类型：3作业
			// $this->xiaoxi_add($tid,$content,$userid,3);
			//给登陆老师推送消息
			$stu_loing = M("Token")->where("t_userid='{$tid}'")->find();
			if($stu_loing){
				if($stu_loing['t_leixin'] == 2){
					$this->ios_msg_send($content,$stu_loing['t_shebei']);
				}else{
					//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id、@消息标题、@消息类型：1登陆，2关注、3添加课程、4添加作业、5提交作业、6批改作业
					$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$tid,'批改作业提醒',5);
				}
			}

			$rest['status'] = true;
			$rest['msg'] = '作业提交完成';
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			
		}else{
			
			$rest['status'] = false;
			$rest['msg'] = '作业已完成,无需再再提交';
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}
	
		
		
	}
	//获取课程评分
	public function get_course_score(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$kid = (int)$_REQUEST['kid'];
		
		$star = M("Course_star")->field('star_num')->where("star_userid='{$userid}' and star_kid='{$kid}'")->find()['star_num'];
	    
		if($star){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['star'] = $star;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'尚未未评分');
		}
	}
	//课程评分
	public function course_score(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('评分失败',1,'尚未登录');
		}
		
		$kid = (int)$_REQUEST['kid'];
		$tid = (int)$_REQUEST['tid'];
		$star = (float)$_REQUEST['star'];
		
		$list = M("Course_list")->where("id='{$kid}' and cl_tid='{$tid}'")->find();
		
		if($list && $star){
			$data = array(
				        'star_userid' => $userid,
						'star_kid' => $kid,
						'star_tid' => $tid,
						'star_num' => $star,
			        );
			
			$score = M("Course_star")->where("star_userid='{$userid}' and star_kid='{$kid}'")->find();
			
			if($score){
				$this->error2('操作失败',1,'当前课程已经评过分了');
			}
			
			$add = M("Course_star")->add($data);
			if($add){
				$rest['status'] = true;
				$rest['msg'] = '评分成功';
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('评分失败',1,'sql错误');
			}
		}else{
			$this->error2('评分失败',1,'参数非法');
		}
	}
   //课程详情
   public function course_xiang(){
	   	$userid = (int)$_REQUEST['userid'];
	   	$token = trim($_REQUEST['token']);
	   	$kid = (int)$_REQUEST['kid'];
	   	
	   	// if(!$this->check_token($userid, $token)){
	   	// 	$this->error2('获取失败',1,'尚未登录');
	   	// }
	   	
	   	if($kid){
	   		$where = "piano_course_list.id = '{$kid}'";
	   		 
	   		$field = "piano_users.username,piano_users.nickname,piano_course.course_address,piano_course.course_number,piano_course_list.*";
	   		$join1 = "piano_users on piano_users.id = piano_course_list.cl_tid";
	   		$join2 = "piano_course on piano_course.course_id = piano_course_list.cid";
	   		$course = M("Course_list")->field($field)
								   		->join($join1)
								   		->join($join2)
								   		->where($where)->find();
	   		
	   		$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
	   		
	   		
	   		$data = array(
	   				'kid' => $kid,
	   				'status' => $course['cl_status'],
	   				'tid' => $course['cl_tid'],
	   				'mobile' => $course['username'],
	   				'name' => $course['nickname'],
	   				'address' => $course['course_address'],
	   				'stime' => date('H:i',$course['cl_stime']),
	   				'etime' => date('H:i',$course['cl_etime']),
	   				'date' => date('Y年m月d日',$course['cl_stime']),
	   				'week' =>$weekday[date('w', $course['cl_stime'])],
	   				'num' => $course['cl_num'],
	   				'total' => $course['course_number']
	   		);
	   		
	   		if($course['cl_status'] == 2){
	   			//作业曲目
	   			$homework = M('Homework')->where("kid='{$kid}'")->find();
	   			$work_name = M('Songs_list')->where("lid='{$homework['lid']}'")->find();
	   			
	   			$work = array(
	   					  'hid' => $homework['hid'],
	   					  'lid' => $homework['lid'],
	   					  'name' =>$work_name['list_name'],
	   					  'url' => $work_name['list_url'],
	   					  'url_music' => $work_name['list_url_music'],
	   					  'jieduan' =>$homework['jieduan'],
	   					  'type' =>$homework['type'],
	   					  'speed' =>$homework['speed'],
	   					  'count' =>$homework['count'],
	   					  'point' =>$homework['point']
	   			        );
	   			if(!$homework){
	   				$work = "";
	   			}

	   		}else{
	   			$work = "";
	   		}
	   		if($course){
	   			$rest['status'] = true;
	   			$rest['msg'] = '获取成功';
	   			$rest['data'] = $data;
	   			$rest['homework'] = $work;
	   			
	   			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	   		}else{
	   			$this->error2('获取失败',1,'课程id不存在');
	   		}
	   	}else{
	   		$this->error1();
	   	}
	   
   }

//课程留言    
   public function liuyan(){
   		$data['cr_userid'] = I('id');
   		$data['cr_courseid'] = I('courseid');
   		$data['cr_text'] = I('text');
   		$data['cr_time'] = date('Y-m-d H:i:s',time());
   		if(!empty($data['cr_text'])){
   			$a = M('Course_reply')->add($data);
   			if($a){
   				$rest['status'] = true;
	   			$rest['msg'] = '留言成功';
	   			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
   			}else{
   				$this->error2('留言失败',2,'SQL错误');
   			}
   		}else{
   			$this->error2('留言失败',2,'没有内容');
   		}

   }

   //学生课表搜
   public function course_student_sou(){
	   	$userid = (int)$_REQUEST['userid'];
	   	$token = trim($_REQUEST['token']);
	   	$yuefen = (int)$_REQUEST['yuefen'];//月份
	   	if(!$this->check_token($userid, $token)){
	   		$this->error2('获取失败',1,'尚未登录');
	   	}
	   	
	   	if($userid){
	   		$user = M("Users")->field('id')->where("role=1 and id='{$userid}'")->find();
			
	   		if($user){
	   			$time_arr = $this->mFristAndLast('',$yuefen);
				$where = "piano_course_list.cl_stime>='{$time_arr['firstday']}' and piano_course_list.cl_stime<= '{$time_arr['lastday']}'";				
				
	   			$where .= " and piano_course_list.cl_stuid like '%{$userid}%'";
	   	
	   			$field = "piano_users.nickname,piano_course.course_address,piano_course_list.*";
	   			$join1 = "piano_users on piano_users.id = piano_course_list.cl_tid";
	   			$join2 = "piano_course on piano_course.course_id = piano_course_list.cid";
	   			$course = M("Course_list")->field($field)
								   			->join($join1)
								   			->join($join2)
								   			->where($where)->select();
	   	        $data = array();
	   			foreach($course as $k=>$val){
	   				$data[$k] = array(
	   						'kid' => $val['id'],
	   						'time' => date('H:i',$val['cl_stime']),
	   						'stime' => $val['cl_stime'],
	   						'etime' => $val['cl_etime'],
	   						'name' => $val['nickname']."/钢琴",
	   						'num' => $val['cl_re_num'],
	   						'status' => $val['cl_status'],
	   						'address' => $val['course_address'],
						    'type' =>1,
						    'kind'=>$val['cl_kind']
	   				);
	   					
	   			}
	   			
	   			//获取备忘录事件
	   			$where = "memo_stime>='{$time_arr['firstday']}' and memo_etime<= '{$time_arr['lastday']}'";
	   			$where .= " and memo_userid='{$userid}'";
	   			$memo_data = M("Memo")->field("memo_title as title,memo_content as content,memo_stime as stime,memo_etime as etime")
	   			                      ->where($where)->select();
	   			
	   			if(empty($memo_data)){
	   				$memo_data = array();
	   			}else{
	   				foreach($memo_data as $m=>$n){
	   					$memo_data[$m]['type'] = '2';
	   				}
	   			}
	   			
	   			$new_data = $this->arr_caozuo($data,$memo_data,'stime');
	   	
	   			if($new_data){
	   				$rest['status'] = true;
	   				$rest['msg'] = '获取成功';
	   				$rest['data'] = $new_data;
	   	
	   				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	   			}else{
	   				$this->error2('获取失败',2,'亲，暂时没有数据噢');
	   			}
	   		}else{
	   			$this->error2('获取失败',1,'非法操作');
	   		}
	   	}else{
	   		$this->error1();
	   	}
   }
   //获取用户备忘录
   public function get_memo_list(){
	   	$userid = (int)$_REQUEST['userid'];
	   	$token = trim($_REQUEST['token']);
	   	$type = (int)$_REQUEST['type'];
	   	if(!$this->check_token($userid, $token)){
	   		$this->error2('获取失败',1,'尚未登录');
	   	}
	   	//获取备忘录事件
	   	$where = $this->get_memo_time_where($type);
	   	$where .= " and memo_userid='{$userid}'";
	   	$memo_data = M("Memo")->field("memo_title as title,memo_content as content,memo_stime as stime,memo_etime as etime")
	   	                      ->where($where)
	   	                      ->select();
	   	
	   	if($memo_data){
	   		$rest['status'] = true;
	   		$rest['msg'] = '获取成功';
	   		$rest['data'] = $memo_data;
	   		 
	   		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	   	}else{
	   		$this->error2('获取失败',2,'亲，暂时没有数据噢');
	   	}
   }
   //添加备忘录
   public function memo_add(){
   	   $userid = (int)$_REQUEST['userid'];
       $token = trim($_REQUEST['token']);
       if(!$this->check_token($userid, $token)){
       	  $this->error2('获取失败',1,'尚未登录');
       }
   	
   	   $title = trim($_REQUEST["title"]);
   	   $content = trim($_REQUEST['content']);
   	   $stime  = (int)$_REQUEST['stime'];
   	   $etime  = (int)$_REQUEST['etime'];
   	 
   	   if($title && $content && $stime && $etime){
   	   	   $data = array(
		   	   	   	    'memo_userid' => $userid,
		   	   	   		'memo_title' => $title,
		   	   	   		'memo_content' => $content,
		   	   	   		'memo_stime' =>$stime,
		   	   	   		'memo_etime' => $etime
		   	   	   	
   	   	           );
   	   	    $add = M("Memo")->add($data);

			
   	   	    // $this->course_add_tuisong();
            if($add){
	   				$rest['status'] = true;
	   				$rest['msg'] = '添加成功';
	   				
	   	
	   				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	   		}else{
	   				$this->error2('添加失败',1,'sql错误');
	   		}
   	   }else{
   	   	   $this->error1();
   	   }  
   }
   
   
   //合并数组排序:参数：数组一，数组二，排序字段
   public function arr_caozuo($data1,$data2,$field){
   	  
   	  $new_data = array_merge($data1,$data2);
   	  
   	  $sort = array(
   	  		'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
   	  		'field'     => $field,       //排序字段
   	  );
   	  $arrSort = array();
   	  foreach($new_data AS $uniqid => $row){
   	  	foreach($row AS $key=>$value){
   	  		$arrSort[$key][$uniqid] = $value;
   	  	}
   	  }
   	  if($sort['direction']){
   	  	array_multisort($arrSort[$sort['field']], constant($sort['direction']), $new_data);
   	  }
   	  
   	  return $new_data;
   	 
   }
	//课表、日程记录
	public function course_student(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$type = (int)$_REQUEST['type'];
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		if($userid && $type){
			$user = M("Users")->field('id')->where("id='{$userid}'")->find();
			
			if($user){
				$where = $this->get_time_where($type);
				$where .= " and piano_course_list.cl_stuid like '%{$userid}%'";
				
				$field = "piano_users.nickname,piano_course.course_address,piano_course_list.*";
				$join1 = "piano_users on piano_users.id = piano_course_list.cl_tid";
				$join2 = "piano_course on piano_course.course_id = piano_course_list.cid";
				$course = M("Course_list")->field($field)
				                          ->join($join1)
				                          ->join($join2)
				                          ->where($where)->select();

				$data = array();
				foreach($course as $k=>$val){
					$data[$k] = array(
						        'kid' => $val['id'],						    
								'time' => date('H:i',$val['cl_stime']),
							    'stime' => $val['cl_stime'],
							    'etime' => $val['cl_etime'],
							    'name' => $val['nickname']."/钢琴",
								'num' => $val['cl_re_num'],
							    'status' => $val['cl_status'],
								'address' => $val['course_address'],
							    'type' =>'1',
							    'kind'=>$val['cl_kind']
					        );
					
				}
				
				//获取备忘录事件
				$where = $this->get_memo_time_where($type);
				$where .= " and memo_userid='{$userid}'";
				$memo_data = M("Memo")->field("memo_title as title,memo_content as content,
					                           memo_stime as stime,memo_etime as etime")
				                      ->where($where)->select();
				
				if(empty($memo_data)){
					$memo_data = array();
				}else{
					foreach($memo_data as $m=>$n){
						$memo_data[$m]['type'] = '2';
					}
				}
				
				$new_data = $this->arr_caozuo($data,$memo_data,'stime');
				
				if($new_data){
					$rest['status'] = true;
					$rest['msg'] = '获取成功';
					$rest['data'] = $new_data;
						
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('获取失败',2,'亲，暂时没有数据噢');
				}
			}else{
				$this->error2('获取失败',1,'非法操作');
			}	
		}else{
			$this->error1();
		}			
	}

	public function show_homework(){
		$id = I('userid');
		$page = I('page')?I('page'):1;
		$time = date('Y-m-d',time());

		$last_week = date('Y-m-d',time()-7*86400);
		$today = strtotime($last_week);

		$a = M('Homework')->where("stu_id like '%$id%' and UNIX_TIMESTAMP(etime) >= '$today'")
		                  ->select();
		//是所有未完成的，还是最近的最完成的？
		
		foreach ($a as $k => $v){
			$stu = explode(',',$v['stu_id']);
			
			foreach ($stu as $key => $value) {
				
				if($value == $id){
					$is_set = 1;
				}//等同于stu_id 字符串里包含有我的ID ,防止有像‘我’的ID混入
			}
			
			if($is_set == 1){
				$ids .= $v['hid'].',';
			}	

		}//通过循环，取得属于我的所有作业id集
	
		$ids = explode(',',trim($ids,',')); 
		
		foreach ($ids as $k => $v){
			$b = M('Homework')->where("hid = '$v'")->find();
			$days = $this->days($b['stime'],$b['etime']);
			$count = $days*$b['count'];
			
			$count1 = M('Homework_stu')->where("hid = '$v' and w_userid = '$id'")->count();
			
			if($count1 >= $count){
				unset($ids[$k]);
			}
			
			$count2 =  M('Homework_stu')->where("hid = '$v' and w_userid = '$id' and w_time = '$time'")
			                            ->count();
			if($count2 >= $b['count']){
				unset($ids[$k]);
			}

		
		} //筛选掉已完成的作业ID   包括今天做完了的
	

		$ids = implode(',',$ids);
	
		if(!$ids){
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}

		$c = M('Homework')->where("hid in ($ids)")
		                  ->join('piano_songs_list on piano_songs_list.lid = piano_homework.lid')
		                  ->field('hid,piano_homework.lid,list_name,list_url,list_url_music,speed,
		                  	       h_status as status,sid,point,count')
		                  ->limit(($page-1)*10,10)
		                  ->order('hid DESC')
		                  ->select();
	               
		foreach ($c as $k => $v){

			$c[$k]['nickname'] = M('Users')->where("id = '$id'")->getField('nickname');
			$c[$k]['img'] = M('Songs')->where("sid = '$v[sid]'")->getField('songs_img');
		}
			// dump($c);exit; 
		if($c){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $c;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

//查看我的作业
	public function show_my_homework(){
		$page = I('page')?I('page'):1;
		$id = I('userid');
		$type = I('type');
		$wid = I('id');
		$stu_id = I('stu_id');

		$user = M('Users')->where("id = '$id'")->getField('role');
		// echo $user;exit;
		if($user == 1){
			if(empty($wid) && empty($stu_id)){

				$a = M('Homework_stu')->where("w_userid = '$id' and w_status = '$type'")
				                      ->group('piano_homework_stu.hid')
				                      ->join('piano_homework on piano_homework.hid = 
				                      	      piano_homework_stu.hid')
				                      ->order('wid DESC')
				                      ->limit(($page-1)*10,10)
				                      ->select();
				
				foreach ($a as $k => $v) {
					$b[$k]['id'] = $v['hid'];
					$b[$k]['lid'] = $v['lid'];
					$b[$k]['stu_id'] = $v['w_userid'];
					$b[$k]['headerimg'] = M('Users')->where("id = '$v[w_userid]'")
					                                ->getField('headerimg');

					$b[$k]['img'] = M('Songs')->where("sid = '$v[sid]'")->getField('songs_img');
					$b[$k]['name'] = M('Songs_list')->where("lid = '$v[lid]'")->getField('list_name');
					$b[$k]['long_time'] = $v['w_long']?$v['w_long']:'';
					$b[$k]['nickname'] = M('Users')->where("id = '$v[w_userid]'")->getField('nickname');
					$b[$k]['status'] = $v['h_status'];
				}
			}

			if($wid && $stu_id){
				$a = M('Homework_stu')->where("w_userid = '$stu_id' and hid = '$wid'")
				                      ->select();
				// dump($a);
				foreach ($a as $k => $v) {
					$hid .= $v['wid'].',';
					$point .= $v['w_point'].',';
					$url .= $v['w_url'].','; 
				}

				$hid = $a[0]['hid'];
				$b['hw_id'] = trim($hid,',');
				$b['point'] = trim($point,',');
				$b['url'] = trim($url,',');
				$lid = M('Homework')->where("hid = '$hid'")->getField('lid');
				$b['name'] = M('Songs_list')->where("lid = '$lid'")->getField('list_name');
				$b['status'] = $a[0]['w_status'];  
				$b['speed'] = $a[0]['w_speed'];
				$b['count'] = M('Homework')->where("hid = '$hid'")->getField('count');
				$b['s_time'] = M('Homework')->where("hid = '$hid'")->getField('stime');
				$b['e_time'] = M('Homework')->where("hid = '$hid'")->getField('etime');
				$b['pinlun'] = M('Homework_stu')->where("hid = '$hid'")->getField('w_content');
				$b['yin'] = M('Homework_stu')->where("hid = '$hid'")->getField('w_yin');
				$b['flower'] = M('Homework_stu')->where("hid = '$hid'")->getField('w_flower');
				$tid = M('Homework')->where("hid = '$hid'")->getField('t_id');
				$b['teacher'] = M('Teacher')->where("t_userid = '$tid'")->getField('t_truename');
				$b['nickname'] = M('Users')->where("id = '$stu_id'")->getField('nickname');
			}
			// dump($b);exit;
		}elseif($user == 2){
			if(empty($wid) && empty($stu_id)){
	

				$a = M('Homework')->where("t_id = '$id' and w_status = '$type'")
			                  ->join('piano_homework_stu on piano_homework_stu.hid = piano_homework.hid')
			                  ->limit(($page-1)*10,10)
			                  ->group('piano_homework.hid')
			                  ->order('piano_homework.hid DESC')
			                  ->select();
				// dump($a);exit;
				foreach ($a as $k => $v) {

					$b[$k]['id'] = $v['hid'];
					$b[$k]['lid'] = $v['lid'];
					$b[$k]['stu_id'] = $v['w_userid'];
					$b[$k]['headerimg'] = M('Users')->where("id = '$v[w_userid]'")
					                                ->getField('headerimg');

					$b[$k]['img'] = M('Songs')->where("sid = '$v[sid]'")->getField('songs_img');
					$b[$k]['name'] = M('Songs_list')->where("lid = '$v[lid]'")->getField('list_name');
					$b[$k]['long_time'] = $v['w_long']?$v['w_long']:'';
					$b[$k]['nickname'] = M('Users')->where("id = '$v[w_userid]'")->getField('nickname');
					$b[$k]['status'] = $v['h_status'];


				}
			}

			if($wid && $stu_id){
				$a = M('Homework_stu')->where("w_userid = '$stu_id' and hid = '$wid'")
				                      ->select();
				
				foreach ($a as $k => $v) {
					$hid .= $v['wid'].',';
					$point .= $v['w_point'].',';
					$url .= $v['w_url'].','; 
				}
				$b['hw_id'] = trim($hid,',');
				$b['point'] = trim($point,',');
				$b['url'] = trim($url,',');
				$lid = M('Homework')->where("hid = '$wid'")->getField('lid');
				$b['name'] = M('Songs_list')->where("lid = '$lid'")->getField('list_name');
				$b['status'] = $a[0]['w_status'];  
				$b['speed'] = $a[0]['w_speed'];
				$b['count'] = M('Homework')->where("hid = '$wid'")->getField('count');
				$b['s_time'] = M('Homework')->where("hid = '$wid'")->getField('stime');
				$b['e_time'] = M('Homework')->where("hid = '$wid'")->getField('etime');
				$b['pinlun'] = M('Homework_stu')->where("hid = '$wid'")->getField('w_content');
				$b['yin'] = M('Homework_stu')->where("hid = '$wid'")->getField('w_yin');
				$b['flower'] = M('Homework_stu')->where("hid = '$wid'")->getField('w_flower');
				$tid = M('Homework')->where("hid = '$wid'")->getField('t_id');
				$b['teacher'] = M('Teacher')->where("t_userid = '$tid'")->getField('t_truename');
				$b['nickname'] = M('Users')->where("id = '$stu_id'")->getField('nickname');
			}
		}

		if($b){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $b;
						
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('查找失败',2,'亲，暂时没有数据噢');
		}	
	}
	//课堂中心--教师身份
    //点评作业
    public function dianpin_homework(){

    	$xid = I('xid');
    	if($xid){
    		$a = M('User_xiaoxi')->where("xid = '$xid'")->getField('x_info');
    		$a = json_decode($a,true);

    		$a['type'] = 2;  
    		//前端要根据这个的值来判断老师有没有点评过这个作业，所以点评的时候，这个状态要改成已点评
    		$b = json_encode($a);
    		M('User_xiaoxi')->where("xid = '$xid'")->setField('x_info',$b);
    	}



    	$userid = (int)$_REQUEST['userid'];
    	
    	$wid = I('wid');
    	$wid = explode(',',$wid);
    
    	
    	$star = (int)$_REQUEST['star'];
    	$flower = (int)$_REQUEST['flower'];
    	$content = $_REQUEST['content'];
    	$yin = $_REQUEST['yin'];
    	
    	if($wid){
    		$data = array(
    			        'w_star' =>$star?$star:0,
	    				'w_flower' => $flower?$flower:0,
	    				'w_content' => $content,
	    				'w_yin' =>$yin,
    				    'w_status' =>2
    		        );
    		
    		foreach ($wid as $k => $v){
    			//既要评分，又不能影响之前的评分  或者改版，重建数据库，让作业与提交一对一
    			
    			$a = M("Homework_stu")->where("wid='{$v}'")->getField('w_status');
    			if($a != 2){
    				$set[$k] = M("Homework_stu")->where("wid='{$v}'")->save($data);
    			}
    		
    			$stuid = M("Homework_stu")->where("wid='{$v}'")->getField('w_userid');
    			$hid = M("Homework_stu")->where("wid='{$v}'")->getField('hid');
    		}
    		
    		
    		if($set){
                //给被点评的学生发消息和推送
    			$teacher = M("Teacher")->where("t_userid='{$userid}'")->find();
    			//提交作业的学生
    		    
    			$user_stu = M("Users")->where("id='{$stuid}'")->find();
    			$content = '亲~，'.$teacher['t_truename']."老师给你的作业评分了,去看看老师对你的评价吧~";
    			
    			//给做作业的学生添加消息记录
    			//@parm:接收用户id、消息内容、推送人、消息类型：1添加好友、2其他
    			
    			
    			$s_nickname = M('Users')->where("id = '$userid'")->getField('nickname');
    			$c = M('Homework')->where("hid = '$hid'")->find();

    			$songs_name = M('Songs_list')->where("lid = '$c[lid]'")->getField('list_name');	
    			$info = json_encode(array('id'=>$hid,'type'=>2,'stu_id'=>$stuid,'nickname'=>$s_nickname,
    				                      't_name'=>$teacher['t_truename'],'name'=>$songs_name));

    			

    			$list = array('x_tuisong'=>$userid,'x_userid'=>$stuid,'x_content'=>$content,
    						'x_type' =>3,'x_status'=>1,'x_kid'=>$hid,'x_info'=>$info,
    						'x_time'=>date('Y-m-d H:i:s',time()));

    			M('User_xiaoxi')->add($list);
    			//给登陆学生推送消息
    			$stu_loing = M("Token")->where("t_userid='{$stuid}'")->find();
    			if($stu_loing){
    				if($stu_loing['t_leixin'] == 2){
    					$this->ios_msg_send($content,$stu_loing['t_shebei']);
    				}else{
	    				//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id、@消息标题、@消息类型：1登陆，2关注、3添加课程、4添加作业、5提交作业、6批改作业
	    				$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$stuid ,'作业评分提醒',6);
	    			}
    			}

    			$rest['status'] = true;
    			$rest['msg'] = '评分成功';
    			
    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
    		}else{
    			$this->error2('点评作业失败',2,'');
    		}
    		
    	}else{
    		$this->error1();
    	}
    }



	//课程点评录音
	public function dianping_video(){
		$file = $_FILES['file'];
		
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*20 ;// 设置附件上传大小
			$upload->exts      =     array('mp3','aac','amr','wav');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(100,999);
			$upload->rootPath  =     './Public/Uploads/video/'; // 设置附件上传根目录
			$upload->replace = false;
			$name = $upload->rootPath.$upload->rootPath;

			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				
				$rest['status'] = true;
				$rest['msg'] = '上传成功';
				$rest['filename'] = $file_name;
				echo $this->json_encode_ex($rest);exit;
				
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
		
		}
	}
	//课程作业--学生提交的作业
	public function homework_stu(){
		
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$kid = (int)$_REQUEST['kid'];
		
		$homework = M("Homework")->where("kid='{$kid}'")->find();
		if($homework){	
			
			$songs_name = M("Songs_list")->field('list_name')->where("lid='{$homework['lid']}'")->find()['list_name'];		
			$type = $homework['type'];
			//上课学生都要做作业
			$stus = M("Course_list")->field('cl_stuid')->where("id='{$kid}'")->find();
		
			$ids = explode(',',$stus['cl_stuid']);
			foreach($ids as $k=>$v){
				$user = M("Users")->field('nickname,headerimg')->where("id='{$v}'")->find();
				
			    //查看该学生是否提交作业
			    $stu_work = M("Homework_stu")->where("hid='{$homework['hid']}' and w_userid='{$v}'")->find();
			    
			    $arr = array();
			    if($stu_work){
			    	$arr = array(
			    			    'wid'  => $stu_work['wid'],
				    			'long_time' => $stu_work['w_long'],
				    			'point' => $stu_work['w_point'],
				    			'status' => $stu_work['w_status'],
				    			'star' => $stu_work['w_star'],
				    			'flower' => $stu_work['w_flower'],
				    			'content' => $stu_work['w_content'],
				    			'yin' => $stu_work['w_yin'],
				    			'speed'=>$stu_work['w_speed']
			    	      );  	
			    }	
		
			    $data[$k] = array(
			    	            'img' => $user['headerimg'],
					    		'nickname' => $user['nickname'],
					    		'songs_name' => $songs_name,
					    		'type' => $type,
			    		        'work' =>$arr

			                );
			}
			if($data){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $data;
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',1,'没有选择上课的学生？？');
			}
		}else{
			$this->error2('获取失败',2,'该课程老师还没有添加作业');
		}
	}
	//课程记录
	public function course_history(){
	    $userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('获取失败',1,'尚未登录');
		// }
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$list = M("Course_list")->where("(cl_tid='{$userid}' or cl_stuid like '%{$userid}%') and cl_status='2'")->order('cl_etime DESC')->limit($offset,$number)->select();
		
		foreach($list as $k=>$val){
			//课程视频
			$file = M("Course_file")->field('file_url')->where("kid='{$val['id']}'")->find()['file_url'];
			
			//课程作业
			$field = "piano_songs.songs_img,piano_songs.songs_name,piano_songs_list.list_name,piano_homework.*";
			$join1 = "piano_songs on piano_songs.sid = piano_homework.sid";
			$join2 = "piano_songs_list on piano_songs_list.lid = piano_homework.lid";
			$homework = M("Homework")->field($field)
			                         ->join($join1)
			                         ->join($join2)
			                         ->where("piano_homework.kid='{$val['id']}'")
			                         ->find();
			if($homework['point'] <= 60){
				$homework['point'] ='一般';
			}elseif($homework['point'] <= 80 and $homework['point'] > 60){
				$homework['point'] ='良好';
			}else{
				$homework['point'] ='优秀';
			}
			$hdata = array(
				        'img' => $homework['songs_img'],
					    'name' => $homework['songs_name'].'('.$homework['list_name'].')',
					    'yaoqiu' =>$homework['jieduan'].'-'.$homework['type'].'-速度:'.$homework['speed'].'-次数:'.$homework['count'].'-分数:'.$homework['point'],
			         );
			
			
			//上课学生或老师
			$a = M('Users')->where("id = '$userid'")->find();
			if($a['role'] == 1){
				$student = M('Users')->where("id = '$val[cl_tid]'")->field('id,nickname,headerimg')->select();
			}else{
				$stuid = explode(',',$val['cl_stuid']);
				foreach($stuid as $key=>$v){
				$student[$key] = M("Users")->field('id,nickname,headerimg')->where("id='{$v}'")->find();
				}
			}		

			
			$res[$k] = array(
					       'kid' => $val['id'],
					       'time' => date("m/d",$val['cl_stime']),
				           'file_url' => $file,
					       'homework' => $hdata,
					       'students' => $student,
			            );
			

		}
		
		if($res){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $res;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'亲，暂时没有数据噢');
		}
	}
	//获取教材曲目
	public function homework_list(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$sid = (int)$_REQUEST['sid'];
		if($sid){
			$list = M("Songs_list")->field('lid,list_name as name')->where("list_status='1' and list_sid='{$sid}'")->select();
			if($list){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $list;
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'该教材暂无曲目，请修改~');
			}
		}else{
			$this->error1();
		}
		
	}
	//获取教材作业
	public function homework_songs(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}
		
		$songs = M("Songs")->field("sid,songs_name as name")->where("songs_status='1'")->select();
		
		$rest['status'] = true;
		$rest['msg'] = '获取成功';
		$rest['data'] = $songs;
		
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	//添加作业
	public function homework_add(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}
		
		$sid = (int)$_REQUEST['sid'];
		$lid = (int)$_REQUEST['lid'];
		$jieduan = trim($_REQUEST['jieduan']);
		$type = trim($_REQUEST['type']);
		$speed = (float)$_REQUEST['speed'];
		$count = (int)$_REQUEST['count'];
		$point = (int)$_REQUEST['point'];
		$kid = (int)$_REQUEST['kid'];
		
		$time = time();
	
		if($sid && $lid && $jieduan && $type && $speed && $count && $kid){
			
			$list = M('Course_list')->where("id='{$kid}' and cl_status=1 and cl_stime<'{$time}'")->find();
			if($list){
				
				$homework = M('Homework')->field('hid')->where("kid='{$kid}'")->find();
				
				if($homework){
					$this->error2('添加失败',2,'该课程已经添加过作业了~');
				}else{
					$data = array(
							'kid' => $kid,
							'sid' => $sid,
							'lid' => $lid,
							'jieduan' => $jieduan,
							'type' => $type,
							'speed' => $speed,
							'count' => $count,
							'point' => $point
					);
					if(!$point){
						$data['point'] = 0;
					}
						
					$add = M('Homework')->add($data);
					if($add){

						//给做作业的学生添加消息提示
						$stuid = $list['cl_stuid'];
						$stu_arr = explode(',',$stuid);

						$teacher = M("Teacher")->where("t_userid='{$list['cl_tid']}'")->find();
						$content = '亲~'.$teacher['t_truename']."老师给你布置了一个作业,请留意,记得完成哦~";

						$join1 = 'piano_songs_list on piano_songs_list.lid = piano_homework.lid';
					
						$info = M('Homework')->where("hid = '$add'")
											 ->join($join1)
											 ->field('hid,piano_songs_list.lid,list_name as name,
											 	      list_url as url,list_url_music as url_music,
											 	      jieduan,type,speed,count,point')
						                     ->find();
						if(!$info){
							$info = array();
						}
						// $info['lid'] = M('Homework')->where("hid = '$add'")->getField('lid');
	    				$info = json_encode($info);
	    			
						foreach($stu_arr as $v){
							//给选定的学生添加消息记录
							//@parm:接收用户id、消息内容、推送人、消息类型：3作业
							
							$data = array(
										'x_userid' => $v,
										'x_content' => $content,
										'x_tuisong' => $userid,
										'x_type' => 5,
										'x_time' => date('Y-m-d H:i:s',time()),
										'x_info'=> $info,
										'x_kid'=> $add
								);
								// var_dump($data);exit;
							M("User_xiaoxi")->add($data);
							// $this->xiaoxi_add($v,$content,$list['cl_tid'],3);
							//给登陆学生推送消息
							$stu_loing = M("Token")->where("t_userid='{$v}'")->find();
							if($stu_loing){
								//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id、@消息标题、@消息类型：1登陆，2关注、3添加课程、4添加作业、5提交作业、6批改作业
								$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$v,'作业提醒',3);
							}
						}

						// M('Course_list')->where("id = '$kid'")->setField('cl_status',2);
						// //作业布置
						$rest['status'] = true;
						$rest['msg'] = '添加成功';
					
						echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
					}else{
						$this->error2('添加失败',1,'sql错误');
					}
				}
			}else{
				$this->error2('添加失败',2,'课程id非法');
			}	
		}else{
			$this->error1();
		}
	}


	
	//获取课程的作业
	public function get_course_homework(){
		$userid = (int)$_REQUEST['userid'];
		$kid = (int)$_REQUEST['kid'];
		//课程作业
		$field = "piano_songs.songs_img,piano_songs.songs_name,piano_songs_list.list_name,piano_homework.*";
		$join1 = "piano_songs on piano_songs.sid = piano_homework.sid";
		$join2 = "piano_songs_list on piano_songs_list.lid = piano_homework.lid";
		$homework = M("Homework")->field($field)
									->join($join1)
									->join($join2)
									->where("piano_homework.kid='{$kid}'")
									->find();
		if($homework){
			if($homework['point'] <= 60){
				$homework['point'] ='一般';
			}elseif($homework['point'] <= 80 and $homework['point'] > 60){
				$homework['point'] ='良好';
			}else{
				$homework['point'] ='优秀';
			}
			$hdata = array(
					'img' => $homework['songs_img'],
					'name' => $homework['songs_name'].'('.$homework['list_name'].')',
					'yaoqiu' =>$homework['jieduan'].'-'.$homework['type'].'-速度:'.$homework['speed'].'-次数:'.$homework['count'].'-分数:'.$homework['point'],
			);
		
			
			$rest['status'] = true;
			$rest['msg'] = '添加成功';
			$rest['data'] = $hdata;
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'当前课程还没有添加作业');
		}	
		
		
		
	}
	//上传上课视频
     public function upload_course_file(){
     	$userid = (int)$_REQUEST['userid'];
     	$token = trim($_REQUEST['token']);
     	if(!$this->check_token($userid, $token)){
     		$this->error2('添加失败',1,'尚未登录');
     	}
		$file = $_FILES['file'];
		$kid = (int)$_REQUEST['kid'];
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*10 ;// 设置附件上传大小
			$upload->exts      =     array('mp4','mov','3gp');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/courseFile/'; // 设置附件上传根目录
		
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				
				$data = array(
					      'kid'=>$kid,
						  'file_url' =>$file_name
				       );
				
				$list = M('Course_file')->where("kid='{$kid}'")->find();
				if($list){
					//修改
				    $set = M('Course_file')->where("kid='{$kid}'")->setField('file_url',$file_name);
				    @unlink($list['file_url']);
				}else{
					$add = M('Course_file')->add($data);
				}
				
				if($set || $add){
					$rest['status'] = true;
					$rest['msg'] = '上传成功';
					$rest['filename'] = $file_name;
					echo $this->json_encode_ex($rest);exit;
				}else{
					$this->error2('上传失败',1,'sql错误');
				}	
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
		
		}
	} 
	
	//获取上课视频
	public function get_course_file(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}
		
		$kid = (int)$_REQUEST['kid'];
		
		$file = M('Course_file')->where("kid='{$kid}'")->find()['file_url'];
		
		if($file){
			
		    $rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $file;
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'当前课程还没有上课视频');
		}	
		
	}
	//下课
	public function course_over(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$kid = (int)$_REQUEST['kid'];
		
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}


		$set = M('Course_list')->where("id='{$kid}'")->setField('cl_status',2);
		if($set){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('操作失败',1,'sql错误');
		}
		
		// if($kid){
			


		// 	//检验是否添加上课作业
		// 	$homework = M('Homework')->field('hid')->where("kid='{$kid}'")->find();
		// 	if($homework){
				
		// 	}else{
		// 		$this->error2('操作失败',2,'请先添加课堂作业');
		// 	}
			
		// }else{
		// 	$this->error1();
		// }			
	}
	//删除课程
	public function course_del(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$kid = (int)$_REQUEST['kid'];
		
		if($kid){
			$del= M("Course_list")->where("id='{$kid}' and cl_tid='{$userid}'")->limit(1)->delete();
			if($del){
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('操作失败',1,'sql错误');
			}
		}else{
			$this->error();
		}
		
	}
	//课程停一次
	public function course_stop(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$kid = (int)$_REQUEST['kid'];
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		
		$course = M("Course_list")->field('cid,cl_num')->where("id='{$kid}'")->find();
		$type = M("Course")->field('course_type')->where("course_id='{$course['cid']}'")->find()['course_type'];
		//课程类型
		if($type==1){
			$this->error2('操作失败',2,'该课程为临时类课程，不允许该操作');
		}else if($type==2){//每周
			$time = 3600*24*7;
		}else if($type==3){//两周
			$time = 3600*24*7*2;
		}
		
		 M("Course_list")->where("cid='{$course['cid']}' and cl_num >= '{$course['cl_num']}'")->setInc('cl_stime',$time);
		 M("Course_list")->where("cid='{$course['cid']}' and cl_num >= '{$course['cl_num']}'")->setInc('cl_etime',$time);
		
		 $rest['status'] = true;
		 $rest['msg'] = '操作成功';	
		 echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		
	}
	//课程换时间
	public function course_edit_time(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$kid = (int)$_REQUEST['kid'];
		$time = (int)$_REQUEST['time'];
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		
		$tt = time()+3600*24;
		
		$course = M("Course_list")->where("id='{$kid}' and cl_stime >= '{$tt}'")->find();
		if($course){
			$cid = $course['cid'];
			$num = $course['cl_num']+1;//下一课次
			$long = $course['cl_etime'] - $course['cl_stime'];
			
			$list = M("Course_list")->where("cid='{$cid}' and cl_num='{$num}'")->find();
			if($list){
				//跟换的时间需在下一次上课前
				if(($time+$long) < $list['cl_stime']){
					$set = M("Course_list")->where("id='{$kid}'")->save(array(
																		'cl_stime'=>$time,
																		'cl_etime' => $time+$long
																));
				}else{
					$this->error2('操作失败',2,'您换的时间离下一次课时的开课时间太近了');
				}
			}else{
				$set = M("Course_list")->where("id='{$kid}'")->save(array(
																		'cl_stime'=>$time,
																		'cl_etime' => $time+$long
																));		
			}
			if($set){
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('操作失败',1,'sql错误');
			}
		}else{
			$this->error2('操作失败',1,'课程换时间至少要在开课前一天');
		}
		
	}
	//课程详情--开课之前
	public function course_teacher_before(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$kid = (int)$_REQUEST['kid'];
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
			
		$field = "piano_course_list.cl_status,piano_course_list.cl_etime,piano_course_list.cl_stime,piano_course.course_address,piano_course.course_stuid";
		$join = "piano_course on piano_course.course_id = piano_course_list.cid";
		$where = "piano_course_list.id='{$kid}'";
		
		$course = M("Course_list")->field($field)->join($join)->where($where)->find();
		
		$stuid = explode(',',$course['course_stuid']);
		$name = '';
			
		foreach($stuid as $k=>$v){
			$user = M("Users")->field("id,nickname,username")->where("id='{$v}'")->find();
			$name .= $user['nickname']."/";
			
			$stu[$k] = $user;
		}
		$name .= "钢琴";
		
		$weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
		
	
		$data = array(
			        'kid' => $kid,
					'status' => $course['cl_status'],
					'address' => $course['course_address'],
					'stime' => date('H:i',$course['cl_stime']),
					'etime' => date('H:i',$course['cl_etime']),
				    'date' => date('Y年m月d日',$course['cl_stime']),
				    'week' =>$weekday[date('w', $course['cl_stime'])]
		        );
		
		if($data){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
			$rest['mobile'] = $stu;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'非法操作');
		}
	}
	public function course_teacher_sou(){
	    $userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$yuefen = (int)$_REQUEST['yuefen'];//月份
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		if($userid){
			$user = M("Users")->field('id')->where("role=2 and id='{$userid}'")->find();
			if($user){
				$time_arr = $this->mFristAndLast('',$yuefen);
				$where = "piano_course_list.cl_stime>='{$time_arr['firstday']}' and piano_course_list.cl_stime<= '{$time_arr['lastday']}'";				
				$where .= " and piano_course.course_tid='{$userid}'";
				
				$field = "piano_course_list.*,piano_course.course_address,piano_course.course_tid";
				$join = "piano_course on piano_course.course_id = piano_course_list.cid";
				
				$course = M("Course_list")->field($field)->join($join)->where($where)->select();
				
				$time = time();
				$courses = array();
				foreach($course as $k=>$val){
					$stuid = explode(',',$val['cl_stuid']);
					$name = '';
					
					foreach($stuid as $v){
						$nickname = M("Users")->field("nickname")->where("id='{$v}'")->find()['nickname']; 
					    $name .= $nickname."/";
					}
					$name .= "钢琴";
				
					if($val['cl_status'] == 1){
						if($time > $val['cl_stime'] && $val['cl_etime'] < $time){
							$val['cl_status']  = 3;
						}
					}
										
					$data = array(
						        'kid' => $val['id'],						    
								'time' => date('H:i',$val['cl_stime']),
							    'stime' => $val['cl_stime'],
							    'etime' => $val['cl_etime'],
							    'name' => $name,
								'num' => $val['cl_re_num'],
							    'status' => $val['cl_status'],
								'address' => $val['course_address'],
						        'type' =>1,
						        'kind'=>$val['cl_kind']
					        );
					
					$courses[$k] = $data;
				}
				
				//获取备忘录事件
				$where = "memo_stime>='{$time_arr['firstday']}' and memo_etime<= '{$time_arr['lastday']}'";
				$where .= " and memo_userid='{$userid}'";
				$memo_data = M("Memo")->field("memo_title as title,memo_content as content,memo_stime as stime,
											memo_etime as etime")
				                      ->where($where)->select();
				 
				if(empty($memo_data)){
					$memo_data = array();
				}else{
					foreach($memo_data as $m=>$n){
						$memo_data[$m]['type'] = '2';
					}
				}
				 
				$new_data = $this->arr_caozuo($courses,$memo_data,'stime');
				
				if($new_data){
					$rest['status'] = true;
					$rest['msg'] = '获取成功';
					$rest['data'] = $new_data;
					 
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('获取失败',2,'暂时没有课程~');
				}
			}else{
				$this->error2('获取失败',1,'非法操作');
			}	
		}else{
			$this->error1();
		}
	}
	//获取指定月份的起始时间戳
	function mFristAndLast($y = "", $m = ""){
		if($y == ""){
			$y = date("Y");
		} 
		if($m == ""){
			$m = date("m");
		} 
		$m = sprintf("%02d", intval($m));
		$y = str_pad(intval($y), 4, "0", STR_PAD_RIGHT);
	
		if($m>12 || $m<1){
			$m=1;
		}
		
		$firstday = strtotime($y . $m . "01000000");
		$firstdaystr = date("Y-m-01", $firstday);
		$lastday = strtotime(date('Y-m-d 23:59:59', strtotime("$firstdaystr +1 month -1 day")));
	
		return array(
				"firstday" => $firstday,
				"lastday" => $lastday
		);
	}
	//课程
	public function course_teacher(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$type = (int)$_REQUEST['type'];
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		if($userid && $type){
			$user = M("Users")->field('id')->where("role=2 and id='{$userid}'")->find();
			if($user){
				
				$where = $this->get_time_where($type);				
				$where .= " and piano_course.course_tid='{$userid}'";
				
				$field = "piano_course_list.*,piano_course.course_address,piano_course.course_tid";
				$join = "piano_course on piano_course.course_id = piano_course_list.cid";
				
				$course = M("Course_list")->field($field)->join($join)->where($where)->select();
				
				$time = time();
				
				$courses = array();
				
				foreach($course as $k=>$val){
					$stuid = explode(',',$val['cl_stuid']);
					$name = '';
					
					foreach($stuid as $v){
						$nickname = M("Users")->field("nickname")->where("id='{$v}'")->find()['nickname']; 
					    $name .= $nickname."/";
					}
					$name .= "钢琴";
				
					if($val['cl_status'] == 1){
						if($time > $val['cl_stime'] && $val['cl_etime'] < $time){
							$val['cl_status']  = 3;
						}
					}
										
					$data = array(
						        'kid' => $val['id'],						    
								'time' => date('H:i',$val['cl_stime']),
							    'stime' => $val['cl_stime'],
							    'etime' => $val['cl_etime'],
							    'name' => $name,
								'num' => $val['cl_re_num'],
							    'status' => $val['cl_status'],
								'address' => $val['course_address'],
							    'type' => 1,
							    'kind'=>$val['cl_kind']
					        );
					
					$courses[$k] = $data;
				}
				
				//获取备忘录事件
				$where = $this->get_memo_time_where($type);
				$where .= " and memo_userid='{$userid}'";
				$memo_data = M("Memo")->field("memo_title as title,memo_content as content,memo_stime as stime,memo_etime as etime")
				                      ->where($where)->select();
				
				if(empty($memo_data)){
					$memo_data = array();
				}else{
					foreach($memo_data as $m=>$n){
						$memo_data[$m]['type'] = '2';
					}
				}
				
				$new_data = $this->arr_caozuo($courses,$memo_data,'stime');
				
				if($new_data){

					$rest['status'] = true;
					$rest['msg'] = '获取成功';
					$rest['data'] = $new_data;
					 
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('获取失败',2,'暂时没有课程~');
				}
			}else{
				$this->error2('获取失败',1,'非法操作');
			}	
		}else{
			$this->error1();
		}
		
		
	}
	//备忘时间条件
	private function get_memo_time_where($type){
		if($type == 1){//当天
			$begin = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$end = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}else if($type == 2){//本周
			$begin=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
			$end=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
		}else if($type == 3){//本月
			$begin=mktime(0,0,0,date('m'),1,date('Y'));
			$end=mktime(23,59,59,date('m'),date('t'),date('Y'));
		}
		$where = "memo_stime>='{$begin}' and memo_etime<= '{$end}'";
		
		return $where;
	}
	//获取时间戳
	private function get_time_where($type){
		if($type == 1){//当天
			$begin = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$end = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		}else if($type == 2){//本周
			$begin=mktime(0,0,0,date('m'),date('d')-date('w')+1,date('Y'));
			$end=mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));
		}else if($type == 3){//本月
			$begin=mktime(0,0,0,date('m'),1,date('Y'));	
			$end=mktime(23,59,59,date('m'),date('t'),date('Y'));
		}
		$where = "piano_course_list.cl_stime>='{$begin}' and piano_course_list.cl_stime<= '{$end}'";
		
		return $where;
	}
	//获取学生列表
	public function get_students(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}
		$user = M("Users")->field('id')->where("role=2 and id='{$userid}'")->find();
		if($user){
		   
			$field = "piano_users.id,piano_users.nickname,piano_users.headerimg";
			$join = "piano_users on piano_users.id=piano_teacher_student.sid";
			$where = "piano_teacher_student.tid='{$userid}'";
			
	    	$students = M("Teacher_student")->field($field)
	    	                                ->join($join)
				    	                    ->where($where)
				    	                    ->select(); 
	    	
		    if($students){
		    	$rest['status'] = true;
		    	$rest['msg'] = '获取成功';
		    	$rest['data'] = $students;
		    	 
		    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		    }else{
		    	$this->error2('获取失败',2,'您还没有添加学生~');
		    }
		}else{
			$this->error2('获取失败',1,'非法操作');
		}
	}
	//推送消息
	//参数,@内容、                    $content
	//@设备号、                       $shebei
	//@类型：1安卓，2苹果、           $type
	//@用户id、                       $userid
	//@消息标题、                     $title
	//@消息类型：1登陆，2关注、3添加课程、4添加作业、5提交作业、6批改作业
	private function course_add_tuisong($content,$shebei,$type,$userid,$title,$leixin){
	
		header('content-type:text/html;charset=utf8');
		include_once('./Piano/Common/Common/jpush.php');
	
		$n_content =  $content;
		$receiver_value = $shebei;
	
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
			
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
		if($type == 1){//android发消息
			//设备
			$platform = 'android';
			//android发消息
			$content = $this->json_encode_ex(array('userid'=>$userid,'title'=>$title,
												   'content'=>$n_content,'time'=>date('Y-m-d'),
												   'type'=>$leixin));
			$msg_content = json_encode(array('message'=>$content));
	
	
			$res = $obj->send($sendno, 3, $receiver_value, 2, $msg_content, $platform);
		}else if($type == 2){//设备：ios,发发通知
			//设备
			$platform = 'ios';
	
			$msg_content = json_encode(array('n_builder_id'=>1, 'n_title'=>$title, 'n_content'=>$n_content,
											 'n_extras'=>array('type'=>$leixin,'title'=>$title)));
				
			$res = $obj->send($sendno, 3, $receiver_value, 1, $msg_content, $platform);
				
		}
	
		return $res;
	}
	//添加消息
	//@parm:接收用户id、消息内容、推送人、消息类型：1添加好友、2其他
	private function xiaoxi_add($jie_id,$content,$userid,$leixin){
		//1.添加消息记录
		$data = array(
				'x_userid' => $jie_id,
				'x_content' => $content,
				'x_tuisong' => $userid,
				'x_type' => $leixin,
				'x_time' => date('Y-m-d H:i:s',time())
		);
		// var_dump($data);exit;
		$add = M("User_xiaoxi")->add($data);
	}
	//添加课程
	public function course_add(){
		// echo time();exit;
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		$address =  trim($_REQUEST['address']);
		$time =  (int)$_REQUEST['time'];
		$long =  (int)$_REQUEST['long'];
		$type =  (int)$_REQUEST['type'];
		$number =  (int)$_REQUEST['number'];
		$stuid =  trim($_REQUEST['stuid']);
		$kind = trim($_REQUEST['kind']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('添加失败',1,'尚未登录');
		}
	
		$user = M("Users")->field('id')->where("role=2 and id='{$userid}'")->find();
	    if($user){
	    	if($address && $time && $long && $type && $number && $stuid){
	    		
	    		if($type == 1){//临时类一课
	    			$number = 1;
	    		}
	    		
	    		$etime = $time + $long * 60;
	    		$data = array(
	    			        'course_tid' => $userid,
		    				'course_address' => $address,
		    				'course_time' => $time,
		    				'course_long' => $long,
	    				    'course_etime' => $etime,
		    				'course_type' => $type,
		    				'course_number' => $number,
		    				'course_stuid' => $stuid,
	    				    'course_addtime' =>date('Y-m-d H:i:s',time()),
	    				    'course_kind'=>$kind
	    		        );
	    		
	    		
	    		//老师同时间段不能添加课程
	    		$teac = M("Course_list")->where("cl_tid='{$userid}' and ((cl_stime<='{$time}' and cl_etime>='{$time}') or (cl_stime<='{$etime}' and cl_etime>='{$etime}'))")->find();
	    		if($teac){
	    			$this->error2('添加失败',2,'您在当前时间段已经有课了,请更换时间~');
	    		}
	    		//学生相同时段不能添加课程
	    		$stu_arr = explode(',',$stuid);
	    		foreach($stu_arr as $val){
	    			$where = "cl_stuid like ('%{$val}%') and ((cl_stime<='{$time}' and cl_etime>='{$time}') or (cl_stime<='{$etime}' and cl_etime>='{$etime}'))";
	    			$stu = M("course_list")->field('id')->where($where)->find();
	    			
	    			if($stu){
	    				$nickname = M("Users")->field('nickname')->where("id='{$val}'")->find()['nickname'];
	    			    
	    				$this->error2('添加失败',2,$nickname.'同学在当前时间段已经有课了,请更换时间~');
	    			}
	    		}
	    	
	    		$add = M("Course")->add($data);
	    		if($type == 1){
	    			$for = 0;
	    		}else if($type == 2){
	    			$for = 3600*24*7;
	    		}else if($type == 3){
	    			$for = 3600*24*14;
	    		}
	    		if($add){
	    			for($i=1;$i<=$number;$i++){
	    				$arr = array(
	    						'cid' => $add,
	    						'cl_stime' => $time + $for*($i-1),
	    						'cl_etime' => $time + $long * 60 + $for*($i-1),
	    						'cl_num' => $i,
	    						'cl_re_num' => $number-$i,
	    						'cl_stuid' => $stuid,
	    						'cl_tid' =>$userid,	
	    						'cl_kind'=>$kind,    						
	    				);
	    				
	    				M("course_list")->add($arr);
	    			}

                    $stu_arr = explode(',',$stuid);
	    			$teacher = M("Teacher")->where("t_userid='{$userid}'")->find();
	    			$content = '亲~'.$teacher['t_truename']."老师给你添加了一个课程,请留意,记得准时去上~";

	    			$t = M('Course_list')->where("cid = '$add'")->getField('id');
	    			$info = M('Course')->where("course_id = '$add'")
	    							   ->field('course_id as kid,course_time as stime,
	    							   	        course_etime as etime,course_number as num,
	    							   	        course_is_wan as status,course_kind as kind,
	    							   	        course_address as address')
	    			                   ->find();

	    			$info['kid'] = $t;
	    			$info1 = json_encode($info);
	    			// dump($info);exit;
	    			foreach($stu_arr as $v){
	    				//给选定的学生添加消息记录
	    				//@parm:接收用户id、消息内容、推送人、消息类型：2课程
	    				$data = array(
										'x_userid' => $v,
										'x_content' => $content,
										'x_tuisong' => $userid,
										'x_type' => 2,
										'x_time' => date('Y-m-d H:i:s',time()),
										'x_kid' =>$t,
										'x_info'=>$info1
								);
								// var_dump($data);exit;
						$add = M("User_xiaoxi")->add($data);
	    				
	    				//给登陆学生推送消息
	    				$stu_loing = M("Token")->where("t_userid='{$v}'")->find();
	    				if($stu_loing){
	    					if($stu_loing['t_leixin'] == 2){
	    						$this->ios_msg_send($content,$stu_loing['t_shebei']);
	    					}else{
	    					//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id、@消息标题、@消息类型：1登陆，2关注、3添加课程、4添加作业、5提交作业、6批改作业
	    					$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$v,'上课提醒',3);	 
	    					}   					 
	    				}			
	    			}

	    			
	    			$rest['status'] = true;
	    			$rest['msg'] = '添加成功';
	    			
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    		}else{
	    			$this->error2('添加失败',1,'sql错误');
	    		}	
	    	}else{
	    		$this->error1();
	    	}
	    }else{
	    	$this->error2('添加失败',1,'非法操作');
	    }
	}
	//匹配手机通讯录返回注册过的用户
	public function friends_tongxun(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$mobiles = trim($_REQUEST['mobiles']);//多个号码用逗号隔开
	
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		if($mobiles){
			$users = M("Users")->field("id as userid,username as mobile,nickname,headerimg")
			->where("username in ($mobiles)")->select();

			$data = array();
			foreach($users as $k=>$v){
				$is_friend = M("User_friends")->where("((userid='{$userid}' and friend_id='{$v['userid']}') 
					or (userid='{$v['userid']}' and friend_id='{$userid}')) and u_status='1'")->find();
				
			    if(empty($is_friend)){
			    	$data[] = $v;
			    }
			}
			if($data){
				$rest['status'] = true;
				$rest['msg'] = '添加成功';
				$rest['data'] = $data;
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error1();
		}
	}
	//朋友列表
	public function friends_book(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('获取失败',1,'尚未登录');
		// }
		
		$list = M("User_friends")->where("(userid='{$userid}' or friend_id='{$userid}') and u_status='1'")->select();
	    if($list){
	    	
	    	foreach($list as $k=>$val){
	    		
	    		if($userid == $val['userid']){
	    			$friend_id = $val['friend_id'];
	    		}else{
	    			$friend_id = $val['userid'];
	    		}
	    		
	    		$user = M("Users")->field('nickname,headerimg')->where("id='{$friend_id}'")->find();
	    		
	    		$data['uid'] = $val['uid'];
	    		$data['fid'] = $friend_id;
	    		$data['name'] = $user['nickname'];
	    		$data['headerimg'] = $user['headerimg'];
	    		
	    		$res[$k] = $data;
	    	}
	    	
	    	$rest['status'] = true;
	    	$rest['msg'] = '获取成功';
	    	$rest['data'] = $res;
	    		
	    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    }else{
	    	$this->error2('获取失败',2,'您还没有添加好友');
	    }
	}

	//通讯录搜索添加
	public function friends_sou(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$mobile = trim($_REQUEST['mobile']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		if($mobile){
			$user = M("Users")->where("username='{$mobile}'")->find();
			if($user){
				
				$status = M("User_friends")->where("(userid='{$userid}' and friend_id='{$user['id']}') or (userid='{$user['id']}' and friend_id='{$userid}')")->getField('u_status');
			
				if($status){
					$is_friend = $status;
				}else{
					$is_friend = 2;
				}
				
				$data = array(
					'friend_id' => $user['id'],
					'headerimg' => $user['headerimg'],
					'nickname' => $user['nickname'],
					'mobile' => $user['username'],
					'status' => $is_friend,
				);
				
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $data;
				 
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				 
			}else{
				$this->error2('获取失败',2,'该用户不存在');
			}
		}else{
			$this->error1();
		}
	}
	//点击添加，推送消息，记录消息
	public function friends_add(){
		
		$userid = (int)$_REQUEST['userid'];		
		$token = trim($_REQUEST['token']);
		$friend_id = (int)$_REQUEST['friend_id'];
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
        if($userid != $friend_id){
        	$user = M("Users")->where("id='{$userid}'")->find();
        	$friend = M("Users")->where("id='{$friend_id}'")->find();
        	
        	if($user && $friend){
        		if($user['role'] == $friend['role']){
        			$guanxi = '朋友';
        		}else if($friend['role'] == '2'){
        			$guanxi = '学生';
        		}else if($user['role'] == '2'){
        			$guanxi = '老师';
        		}else{
        			$guanxi = '朋友';
        		}
        		
        		//1.添加消息记录 
        		$data = array(
        				'x_userid' => $friend_id,
        				'x_content' => $user['nickname'].' 请求成为您的'.$guanxi,
        				'x_tuisong' => $userid,
        				'x_time' => date('Y-m-d H:i:s',time()),
        				'x_status' => 1,
        				
        		);
        		 
        		$add = M("User_xiaoxi")->add($data);
        		 
        		if($add){
        			//2，根据朋友id查询朋友的登陆设备号进行推送
        		    $login = M("Token")->where("t_userid='{$friend_id}'")->find();//判断朋友是否登录
        			if($login){
        				//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id	
        				$content = $data['x_content'];

        				if($login['t_leixin'] == 2){//IOS 消息V3
        					$this->ios_msg_send($content,$login['t_shebei']);
        				}else{
        					$this->add_friend_tuisong($content,$login['t_shebei'],$login['t_leixin'],$login['t_userid']);
        				}      				
        			}
        			      
        			$rest['status'] = true;
        			$rest['msg'] = '操作成功';
        			 
        			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
        		}else{
        			$this->error2('操作失败',1,'sql错误');
        		}
        	}else{
        		$this->error2('操作失败',1,'操作非法');
        	}	
        }else{
        	$this->error2('操作失败',1,'自己不能添加自己');
        }
		
		
	}
	//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id
	private function add_friend_tuisong($content,$shebei,$type,$userid){
	
		header('content-type:text/html;charset=utf8');
		include('./Piano/Common/Common/jpush.php');
	   
		$n_content =  $content;
		$receiver_value = $shebei;
	
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
		 
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
		if($type == 1){//android发消息
			//设备
			$platform = 'android';
			//android发消息
			$content = $this->json_encode_ex(array('userid'=>$userid,'title'=>'关注通知','content'=>$n_content,'time'=>date('Y-m-d'),'type'=>2,));
			$msg_content = json_encode(array('message'=>$content));
	
				
			$res = $obj->send($sendno, 3, $receiver_value, 2, $msg_content, $platform);
		}else if($type == 2){//设备：ios,发发通知
			//设备
			$platform = 'ios';
	
			$msg_content = json_encode(array('n_builder_id'=>1, 'n_title'=>'关注通知', 'n_content'=>$n_content,'n_extras'=>array('type'=>2,'title'=>'关注通知')));
			
			$res = $obj->send($sendno, 3, $receiver_value, 1, $msg_content, $platform);
			
		}
	
		return $res;
	}
	//点击同意，添加朋友记录
	public function friends_tongyi(){
	
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$xid = (int)$_REQUEST['xid'];
		
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('操作失败',1,'尚未登录');
		// }
		
		$xiaoxi = M("User_xiaoxi")->where("xid='{$xid}'")->find();
		if($xiaoxi){
			$data = array(
				           'userid' => $xiaoxi['x_tuisong'],
					       'friend_id' => $xiaoxi['x_userid'],
			        );
			
			M("User_friends")->startTrans();
			
			//判断是否添加过
			$friends = M("User_friends")->where("((userid='{$xiaoxi['x_tuisong']}' and friend_id='{$xiaoxi['x_userid']}') or (friend_id='{$xiaoxi['x_tuisong']}' and userid='{$xiaoxi['x_userid']}')) and u_status='1'")->find();
			if($friends){
				$this->error2('已加过该好友，不能重复添加',2,'');
			}else{
				$add = M("User_friends")->add($data);
			}
			
		
			//该对朋友关系添加如果只有一方为老师，则另一方成为学生
			$role1 = M("Users")->field('role')->where("id='{$xiaoxi['x_tuisong']}'")->find()['role'];
			$role2 = M("Users")->field('role')->where("id='{$xiaoxi['x_userid']}'")->find()['role'];
			if($role1 != $role2){
				if($role1 == 2){
					M("Users")->where("id='{$xiaoxi['x_userid']}'")->setField('role',1);
					
					//建立师生关系:@parm1:老师id,@parm2:学生id
					$this->teacher_student($xiaoxi['x_tuisong'],$xiaoxi['x_userid']);
				}else if($role2 == 2){
					M("Users")->where("id='{$xiaoxi['x_tuisong']}'")->setField('role',1);
					
					//建立师生关系$xiaoxi['x_userid']
					$this->teacher_student($xiaoxi['x_userid'],$xiaoxi['x_tuisong']);
				}
			}
			
			$set = M("User_xiaoxi")->where("xid='{$xid}' and x_status='1'")->setField('x_status',2);
			// dump($set);exit;
			if($add && $set){
				M("User_friends")->commit();
				
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
			
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				M("User_friends")->rollback();
				$this->error2('操作失败',1,'sql错误');
			}
		}else{
			$this->error2('操作失败',1,'非法操作');
		}
	}
	//建立师生关系:@parm1:老师id,@parm2:学生id
	private function teacher_student($tid,$sid){
		$data = array(
			       'tid' => $tid,
				   'sid' => $sid,
				   'time' => date('Y-m-d H:i:s',time())
		        );
		
		//判断学生之前有没有添加过学生
		$list = M("Teacher_student")->where("sid='{$sid}'")->find();
		if($list){
			M("Teacher_student")->where("sid='{$sid}'")->limit(1)->delete();
		}
		M("Teacher_student")->add($data);
		return true;
	}
	//删除好友
	public function friends_del(){
		$uid = (int)$_REQUEST['uid'];
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		
		$del = M("User_friends")->where("uid='{$uid}' and (userid='{$userid}') or friend_id='{$userid}'")->limit(1)->delete();
	    
		if($del){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('操作失败',1,'sql错误');
		}
	}
	//删除消息
	public function xiaoxi_del(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		
		$xid = (int)$_REQUEST['xid'];
		$del = M('User_xiaoxi')->where("x_userid='{$userid}' and xid='{$xid}'")->limit(1)->delete();
		
		if($del){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('操作失败',1,'sql错误');
		}
	}
	//系统消息列表
	public function xiaoxi_list(){
		$time = date('Y-m-d H:i:s',time()-18000);
		//需要加上判断直播是否过时，并将过时的消息更正
		M('User_xiaoxi')->where("x_type = '7' and x_time < '$time'")->delete();
	

		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('操作失败',1,'尚未登录');
		// }
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		// $a = M('User_xiaoxi')->where("")->find();
		$list = M('User_xiaoxi')->where("x_userid = '$userid' or x_userid=1")->order('xid DESC')->limit($offset,$number)->select();
	    
	    // dump($list);exit;
		foreach($list as $k=>$v){
			//获取用户头像
			$header = M("Users")->field('headerimg')->where("id='{$v['x_tuisong']}'")->find()['headerimg'];
			$data[$k] = array(
				            'xid' => $v['xid'],
							'content' => $v['x_content'],
							'time' => $v['x_time'],
							'status' => $v['x_status'],
					        'img' => $header,
					        'type' => $v['x_type'],
					        'x_kid'=>$v['x_kid'],
					        'x_info'=>json_decode($v['x_info'])
			            );
			if(!$v['x_info']){
				$data[$k]['x_info'] = (object)array();
			}
			//这是补早期的BUG
			// if($v['x_type'] == 1){
			// 	$data[$k]['status'] = $v['x_info']?$v['x_info']:1;
			// }
		}
		
		if($data){
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
		
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'暂无系统消息');
		}
		
	}
	
	//添加与取消关注
	public function foucs(){
		$tid = (int)$_REQUEST['tid'];  //被关注的人id
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		if($tid == $userid){
			$this->error2('操作失败',2,'自己不能关注自己');
		}
		
		$user = M("Users")->field('id')->where("id='{$tid}'")->find();//检验关注的用户是否存在
		if($user){
			$status = M("Focus")->field('f_status')->where("f_userid='{$tid}' and f_fansid='{$userid}'")->find()['f_status'];
		    if($status){
		    	//修改关注状态
		    	if($status == 1){
		    		$status = 2;	
		    	}else{
		    		$status = 1;	
		    	}
		    	
		    	$set = M("Focus")->where("f_userid='{$tid}' and f_fansid='{$userid}'")->setField('f_status',$status);
                if($set){
                	if($status == 1){
                		//关注成功
                		$rest['status'] = true;
                		$rest['msg'] = '关注成功';
                		$rest['f_status'] = $status;
                		 
                		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
                	}else{
                		//取消成功
                		$rest['status'] = true;
                		$rest['msg'] = '取消成功';
                		$rest['f_status'] = $status;
                		 
                		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
                	}
                }else{
                	$this->error2('操作失败',1,'sql错误');
                }
		    }else{
		    	//添加关注
		    	$add = M("Focus")->add(array(
		    		        'f_userid' => $tid,
		    			    'f_fansid' => $userid
		    	));
		    	if($add ){
		    		$rest['status'] = true;
		    		$rest['msg'] = '关注成功';
		    		$rest['f_status'] = 1;
		    			
		    		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		    	}else{
		    		$this->error2('添加关注失败',1,'sql错误');
		    	}	
		    }
		}else{
			$this->error2('操作失败',1,'关注的用户不存在');
		}
	}
	//基础练习--识谱练习题
	public function title_shipu(){
		$pubiao = (int)$_REQUEST['pubiao'];
		$diaohao = trim($_REQUEST['diaohao']);
		$yinfu = (int)$_REQUEST['yinfu'];
		
		if($pubiao && $diaohao && $yinfu){
			$list = M("Pblx")->field('pid as title_id,file_url')->where("lianxi='1' and pubiao='{$pubiao}' and yinfu='{$yinfu}' and diaohao in ($diaohao)")->order("rand()")->limit(10)->select();
			
			if($list){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $list;
				 
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error1();
		}
	}
	//基础练习--音阶练习题
	public function title_yinjie(){
		$pubiao = (int)$_REQUEST['pubiao'];
		$diaohao = trim($_REQUEST['diaohao']);
		$yinfu = (int)$_REQUEST['yinfu'];
		
		if($pubiao && $diaohao && $yinfu){
			$list = M("Pblx")->field('pid as title_id,file_url')->where("lianxi='2' and pubiao='{$pubiao}' and yinfu='{$yinfu}' and diaohao in ($diaohao)")->order("rand()")->limit(10)->select();
				
			if($list){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $list;
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error1();
		}
	}
	//基础练习--音程练习题
	public function title_yincheng(){
		$moshi = (int)$_REQUEST['moshi'];
		$nandu = trim($_REQUEST['nandu']);
		
		if($moshi && $nandu){
			$list = M("Pblx")->field('pid as title_id,file_url')->where("lianxi='3' and yinfu='{$moshi}' and nandu='{$nandu}'")->order("rand()")->limit(10)->select();
			
			if($list){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $list;
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error1();
		}
	}
	//基础练习--听音练习题
	public function title_tingyin(){
		$yinyu = (int)$_REQUEST['yinyu'];
		$fuyin = (int)$_REQUEST['fuyin'];
		if($yinyu && $fuyin){
			$list = M("Pblx")->field('pid as title_id,file_url')->where("lianxi='4' and yinyu='{$yinyu}' and yinfu='{$fuyin}'")->order("rand()")->limit(10)->select();
				
			if($list){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $list;
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',2,'亲，暂时没有数据噢');
			}
		}else{
			$this->error1();
		}
	}
	//基础乐理教学
	public function music_list(){
		$cid = (int)$_REQUEST['cid'];
				
		$list = M("Music_course")->field("mcid,mc_name")->where("mc_status='1' and mc_cid='{$cid}'")->select();	
		foreach($list as $k=>$val){
			$clist = M("Music_course_list")->field('cl_name,cl_url')->where("cl_status='1' and cl_mcid='{$val['mcid']}'")->select();
		    foreach($clist as $key=>$v){
		    	$arr[$k]['title'] = $val['mc_name'];
		    	$arr[$k]['list'][$key]['name'] = $v['cl_name'];
		    	$arr[$k]['list'][$key]['url'] = $v['cl_url'];
		    }
		}
		
		if($arr){	
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $arr;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败', 1, '亲，暂时没有数据噢');
		}
		
	}
	//基础乐理简介
	public function music_jianjie(){
		$cid = (int)$_REQUEST['cid'];
		$userid = (int)$_REQUEST['userid'];
		
		$list = M("Music_cat")->where("c_status='1' and cid='{$cid}'")->find();	
		
		if($list){
			$data['cid'] = $list['cid'];
			$data['name'] = $list['c_name'];
			$data['img'] = $list['c_img'];
			
			$data['content'] = $list['c_content'];
			$data['dlevel'] = $list['c_dlevel'];
			$data['degree'] = $list['c_degree'];
			$data['is_cost'] = $list['c_is_cost'];
			
			$data['teacher_id'] = $list['c_teacher_id'];
			
			$teacher = M("Users")->field('headerimg,nickname')->where("id='{$list['c_teacher_id']}' and role='2'")->find();
			
			$truename = M("Teacher")->field('t_truename')->where("t_userid='{$list['c_teacher_id']}'")->find()['t_truename'];
			
			$data['headerimg'] = $teacher['headerimg'];
			$data['nickname'] = $truename;
			$data['text'] = $list['c_text'];
			
			//判断用户身份关注过该主讲老师
			if($userid){
				$status = M("Focus")->field('f_status')->where("f_userid='{$list['c_teacher_id']}' and f_fansid='{$userid}'")->find()['f_status'];
			    if($status){
			    	$data['status'] = $status;
			    }else{
			    	$data['status'] = 2;
			    }
			}else{
				$data['status'] = 2;
			}
			
			
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败', 1, '亲，暂时没有数据噢');
		}
		
	}
	//基础乐理
	public function music_cat(){
		$list = M("Music_cat")->field('cid,c_name,c_img')->where("c_status='1'")->select();
		
		if($list){
			foreach($list as $k=>$val){
				$data[$k]['cid'] = $val['cid'];
				$data[$k]['name'] = $val['c_name'];
				$data[$k]['img'] = $val['c_img'];
			}
			
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
			 
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败', 1, '亲，暂时没有数据噢');
		}
	}

	//统计播放下载曲目次数
	public function tongji(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('提交失败',1,'尚未登隶');
		}
		$lid = (int)$_REQUEST['lid'];
		$type = (int)$_REQUEST['type'];//播放，2下载
		
		if($lid && $type){
			$data = array(
				        'tongji_userid' => $userid,
						'type' => $type,
						'tongji_addtime' => date('Y-m-d H:i',time()),
					    'tongji_lid' =>$lid
			        );
			M("Tongji")->startTrans();
			$add = M("Tongji")->add($data);
			if($type == 1){
				$set1 = M("Songs_list")->where("lid='{$lid}'")->setInc('list_bofang',1);
			}else if($type == 2){
				$set1 = M("Songs_list")->where("lid='{$lid}'")->setInc('list_xiazai',1);
			}
			
			if($add && $set1){
				$rest['status'] = true;
				$rest['msg'] = '提交成功';
			
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('提交失败',1,'sql错误');
			}
		}else{
			$this->error1();
		}
	}

	//提交练琴日志
	public function practice_log_add(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('提交失败',1,'尚未登录');
		}
		$lid = (int)$_REQUEST['lid'];
		$long = (float)$_REQUEST['long'];
		$point = (float)$_REQUEST['point'];
		
		// echo $long;exit;   时间好无语
		if($lid && $long ){
			$data = array(
				        'log_userid' => $userid,
						'log_lid' => $lid,
						'log_long' => $long,
						'log_point' => $point,
						'log_time' => date('Y-m-d H:i:s',time())
			        );
			
			$add = M("Practice_log")->add($data);
			if($add){

				$a = M('Users')->where("id = '$userid'")->find();
				$time = bcadd($a['last_time'],$long,1);
				if(bccomp($time,60,1) != '-1'){
					$newtime = bcsub($time,60,1);

					M('Users')->where("id = '$userid'")->setField('last_time',$newtime);
					M('Users')->where("id = '$userid'")->setInc('score',20);
				}


				$rest['status'] = true;
				$rest['msg'] = '提交成功';
				 
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
			}else{
				$this->error2('提交失败',1,'sql错误');
			}
		}else{
			$this->error1();
		}
	}

	//提交曲谱浏览历史
	public function songs_history_add1(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('提交失败',1,'尚未登录');
		}
		
		$lid = (int)$_REQUEST['lid'];
		$list = M("Songs_list")->where("lid='{$lid}'")->find();
		if($lid){
			$data = array(
				       'his_userid' => $userid,
					   'his_lid' => $lid,
					   'his_time' =>time()
			        );
			
			$history = M("Songs_history")->where("his_userid='{$userid}' and his_lid='{$lid}'")->find();
		    if($history){
		    	//修改
		    	$set = M("Songs_history")->where("his_userid='{$userid}' and his_lid='{$lid}'")->setField('his_time',time());
		    }else{
		    	//新增
		    	$add = M("Songs_history")->add($data);
		    }
		    
		    if($set || $add){
		    	$rest['status'] = true;
		    	$rest['msg'] = '提交成功';
		    	
		    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		    }else{
		    	$this->error2('提交失败',1,'sql错误');
		    }
		}else{
			$this->error2('提交失败',1,'曲谱id不存在');
		}
	}

	public function songs_history_add(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('提交失败',1,'尚未登录');
		}
		
		$sid = (int)$_REQUEST['sid'];
		$list = M("Songs")->where("sid='{$sid}'")->find();
		if($sid){
			$data = array(
				       'his_userid' => $userid,
					   'his_sid' => $sid,
					   'his_time' =>time()
			        );
			
			$history = M("Songs_history")->where("his_userid='{$userid}' and his_sid='{$sid}'")->find();
		    if($history){
		    	//修改
		    	$set = M("Songs_history")->where("his_userid='{$userid}' and his_sid='{$sid}'")->setField('his_time',time());
		    }else{
		    	//新增
		    	$add = M("Songs_history")->add($data);
		    }
		    
		    if($set || $add){
		    	$rest['status'] = true;
		    	$rest['msg'] = '提交成功';
		    	
		    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		    }else{
		    	$this->error2('提交失败',1,'sql错误');
		    }
		}else{
			$this->error2('提交失败',1,'曲子id不存在');
		}
	}

	//上传视频或录音
	public function upload_video(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('添加失败',1,'尚未登录');
		// }
		$file = $_FILES['file'];
		$lid = (int)$_REQUEST['lid'];
		$type = (int)$_REQUEST['type'];//1视频，2录音
		
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*100 ;// 设置附件上传大小
			$upload->exts      =     array('mp3','mov','aac','mp4','wav');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/video/'; // 设置附件上传根目录
		
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
		         
				$data = array(
					        'v_userid' => $userid,
							'v_lid' => $lid,
							'v_type' => $type,
							'v_fileurl' => $file_name,
							'v_time' => time()
			         	);
				
				$video = M("Video")->where("v_userid='{$userid}' and v_lid='{$lid}' and v_type='{$type}'")->find();
		        if($video){
		        	//修改
		        	$set = M("Video")->where("v_userid='{$userid}' and v_lid='{$lid}' and v_type='{$type}'")->save($data);
		        	
		        }else{
		        	//新增
		        	$add = M("Video")->add($data);
		        }
				if($set || $add){
					$rest['status'] = true;
					$rest['msg'] = '上传成功';
					$rest['filename'] = $file_name;
					echo $this->json_encode_ex($rest);exit;
				}else{
					$this->error2('上传失败',1,'sql错误');
				}
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
		
		}
	}

	//曲谱错误反馈
	public function songs_error(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$lid = (int)$_REQUEST['lid'];
		$content = $_REQUEST['content'];
		
		
		if(!$this->check_token($userid, $token)){
			$this->error2('提交失败',2,'您尚未登录');
		}
		
		if($content && $lid){
			$list = M("Songs_list")->field('lid')->where("lid='{$lid}'")->find();
			if($list){
				$add = M("Songs_error")->add(array(
			                    'e_userid' => $userid,
								'e_lid' => $lid,
								'e_content' => $content,
								'e_addtime' => date('Y-m-d H:i:s',time())
				));
				
				if($add){
					$rest['status'] = true;
					$rest['msg'] = '提交成功';
					
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('提交失败',1,'sql错误');
				}
			}else{
				$this->error2('提交失败',1,'非法提交,反馈错误的曲谱不存在');
			}
		}else{
			$this->error1();
		}
	}

	//曲谱详情收藏--收藏教材
	public function collection_song(){
	
		$sid = (int)$_REQUEST['sid'];
		$lid = I('lid');
		$userid = (int)$_REQUEST['userid'];//登陆后要传
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',2,'您尚未登录');
		}
		
		$sc = M("Songs_collection")->where("lid='{$lid}' and sc_userid='{$userid}'")->find();
		if($sc){
			if($sc['sc_status'] == 1){
				//取消操作		
				$set = M("Songs_collection")->where("lid='{$lid}' and sc_userid='{$userid}'")->setField('sc_status',2);
				if($set){
					$rest['status'] = true;
					$rest['msg'] = '取消成功';
					$rest['sc_status'] = 2;
				
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('取消成功',1,'sql错误');
				}
			}else{
				//收藏操作
				$set = M("Songs_collection")->where("lid='{$lid}' and sc_userid='{$userid}'")->setField('sc_status',1);
				if($set){
					$rest['status'] = true;
					$rest['msg'] = '收藏成功';
					$rest['sc_status'] = 1;
				
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					$this->error2('收藏失败',1,'sql错误');
				}
			}	
		}else{
			
			$add = M("Songs_collection")->add(array(
				                             'sid' => $sid,
											 'sc_userid' => $userid,	
											 'lid' =>$lid										
			                              ));
			if($add){
				$rest['status'] = true;
				$rest['msg'] = '收藏成功';
				$rest['sc_status'] = 1;
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('收藏失败',1,'sql错误');
			}
		}
	}
	
	//曲谱详情
	public function get_songs_xiang(){
		$sid = (int)$_REQUEST['sid'];
		$userid = (int)$_REQUEST['userid'];//登陆后要传
		
		$list =  M('Songs')->field("sid,songs_name,songs_img")->where("sid='{$sid}' and songs_status='1'")->find();
		if($list){
				$data['sid'] = $list['sid'];
				$data['name'] = $list['songs_name'];
				$data['img'] = $list['songs_img'];
				$data['sc_status'] = 2;
				if($userid){
					$sc = M("Songs_collection")->field("sc_status")->where("sid='{$sid}' and sc_userid='{$userid}'")->find();
					
					if($sc){
						$data['sc_status'] = $sc["sc_status"];
					}else{
						$data['sc_status'] = 2;
					}
				}
				
				$xiang = M('Songs_list')->field('lid,list_name,list_url,list_url_music,list_bofang,list_xiazai')->where("list_sid='{$sid}' and list_status=1")->order('list_od ASC')->select();
				
				$res = array();
				foreach($xiang as $k=>$val){
					$res[$k] = array(
						'lid' => $val['lid'],
						'name' => $val['list_name'],
						'url' => $val['list_url'],
						'url_music' => $val['list_url_music'],
						'bofang' => $val['list_bofang'],
						'xiazai' => $val['list_xiazai'],
					);
				}
				
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['data'] = $data;
				$rest['list'] = $res;
				 
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;			
		}else{
			$this->error2('获取失败',1,'亲，暂时没有数据噢');
		}
	}
	
	//对应类别的教材
	public function get_songs(){
		$cid = (int)$_REQUEST['cid'];
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		// $number = empty($_REQUEST['number'])?10:$_REQUEST['number'];//每页显示数量
		// $offset = $number*($page-1);//->limit($offset,$number)
		
		$list = M('Songs')->field("sid,songs_name as name,songs_img as img")
		                  ->where("songs_cid='{$cid}' and songs_status='1'")
		                  ->order('songs_sort ASC')
		                  // ->limit($offset,$number)
		                  ->select();
	   	// dump($list);exit;
	    if($list){
	    	if($page >= 2){
	    		$list = array();
	    	}
	    	// $res = array();
	    	// foreach($list as $k=>$val){
	    	// 	$data['sid'] = $val['sid'];
	    	// 	$data['name'] = $val['songs_name'];
	    	// 	$data['img'] = $val['songs_img'];
	    	// 	$res[$k] = $data;
	    	// }
	    	
	    	$rest['status'] = true;
	    	$rest['msg'] = '获取成功';
	    	$rest['data'] = $list;
	    		
	    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    }else{
	    	$this->error2('获取失败',1,'亲，暂时没有数据噢');
	    }
	}

	//曲谱中心类别表
	public function songs_catgroy(){
	
		$userid = (int)$_REQUEST['userid'];//登陆后要传
		$token = trim($_REQUEST['token']);
		$type = I('type');
			
		$where = "(c_status=1 and cid in (2,3,4))";
		
		//判断用户属于哪个琴行，获取专属教材,跟老师有关
		$role = M("Users")->field('role')->where("id='{$userid}'")->find()['role'];
		
		if($role == '1'){//学生
			
		
			$a = M('Teacher_student')->where("sid = '$userid'")->find();
			$tid = $a['tid'];
			

			$jxid = M('Teacher')->where("t_userid = '$tid'")->getField('t_jxid');
			$catid = M('Dealers')->where("jxid = '$jxid'")->getField('jx_catid');
			
			if($catid){
				$where .= "or (c_status = 1 and cid = '$catid')";
			}
		
		
		   
		
		}elseif($role == '2'){//老师
			$jxid = M("Teacher")->field('t_jxid')->where("t_userid='{$userid}'")->find()['t_jxid'];
			
			$zhuan_catid = M("Dealers")->where("jxid='{$jxid}'")->find()['jx_catid'];
			
		    if($zhuan_catid){
		    	$where .= " or (c_status=1 and cid='{$zhuan_catid}')";
		    }
		}

		// echo $where;exit;
		$list = M("Songs_catgroy")->where($where)->order("cid DESC")->select();
		
			
		$res = array();
		foreach($list as $k=>$val){
			
			$data['cid'] = $val['cid'];
			$data['name'] = $val['c_name'];
			$res[$k] = $data;
		}
		if($res){
			if($type ==12){
				$res = 0;
				$res = M('Songs_catgroy')->where("cid ='8'")->field('cid,c_name as name')->select();
			}
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $res;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'亲，暂时没有数据噢');
		}
		
	}


	
	//首页搜索
	public function index_sousou(){
		$type = (int)$_REQUEST['type'];//曲谱:1，帖子:2，视频:3，活动:4
	    $key = trim($_REQUEST['key']);
	    $page = I('page')?I('page'):1;
	    if($type && $key){
	    	if($type == 1){
	    		$a = M("Songs_list")->field("lid,list_name as name,list_url as url,
	    			                         list_url_music as url_music")
	    		                    ->where("list_status = '1' and  list_name like '%{$key}%'")
	    		                    ->limit(($page-1)*10,10)
	    		                    ->select();	
	    		//dump($a);exit;
	    		if($a){
	    			$rest['status'] = true;
	    			$rest['msg'] = '获取成功';
	    			$rest['data'] = $a;
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}else{
	    			$rest['status'] = true;
	    			$rest['msg'] = '查无数据';
	    			$rest['data'] = array();
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}
	    	}else if($type == 2){
	    		$a = M('Luntan')->where("l_type ='1' and l_pinbi='1' and 
	    								 l_title like '%{$key}%' or l_content like '%{$key}%' ")
	    						->join('piano_users on piano_users.id = piano_luntan.l_userid')
	    						->field('piano_luntan.tiezi_id,piano_luntan.l_title,piano_users.headerimg,
	    							     piano_users.nickname,piano_luntan.l_addtime,l_history_num,
	    							     piano_luntan.l_img,piano_luntan.l_content')
	    						->limit(($page-1)*10,10)
	    					    ->select();	
	    		foreach ($a as $k => $v){
	    			$a[$k]['l_img'] = explode(',',$v['l_img']);
	    			$a[$k]['zan_num'] = M('Ltguanxi')->where("lg_zan ='2' and tz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['pinlun'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['guanzhu'] = M('Focus')->where("f_fansid = '$v[l_userid]' and f_status = '1'")
	    			                              ->count();
	    		}
	    	
	    		if($a){
	    			$rest['status'] = true;
	    			$rest['msg'] = '获取成功';
	    			$rest['data'] = $a;
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}else{
	    			$rest['status'] = true;
	    			$rest['msg'] = '查无数据';
	    			$rest['data'] = array();
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}
	    	}else if($type == 3){
	    		$a = M('Luntan')->where("l_type ='2' and l_pinbi='1' and 
	    								 (l_title like '%{$key}%' or l_content like '%{$key}%')")
	    						->join('piano_users on piano_users.id = piano_luntan.l_userid')
	    						->field('piano_luntan.tiezi_id,piano_luntan.l_title,piano_users.headerimg,
	    							     piano_users.nickname,piano_luntan.l_addtime,piano_luntan.l_photo,l_history_num,
	    							     piano_luntan.l_video,piano_luntan.l_content')
	    						->limit(($page-1)*10,10)
	    					    ->select();	
	    		foreach ($a as $k => $v){
	    		
	    			$a[$k]['zan_num'] = M('Ltguanxi')->where("lg_zan ='2' and tz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['pinlun'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['guanzhu'] = M('Focus')->where("f_fansid = '$v[l_userid]' and f_status = '1'")
	    			                              ->count();
	    		}
	    		if($a){
	    			$rest['status'] = true;
	    			$rest['msg'] = '获取成功';
	    			$rest['data'] = $a;
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}else{
	    			$rest['status'] = true;
	    			$rest['msg'] = '查无数据';
	    			$rest['data'] = array();
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}	
	    	}else if($type == 4){
	    		$a = M('Luntan')->where("l_type ='3' and l_pinbi='1' and 
	    								 l_title like '%{$key}%' or l_content like '%{$key}%' ")
	    						->join('piano_users on piano_users.id = piano_luntan.l_userid')
	    						->field('piano_luntan.tiezi_id,piano_luntan.l_title,piano_users.headerimg,
	    							     piano_users.nickname,piano_luntan.l_addtime,l_history_num,
	    							     piano_luntan.l_img,piano_luntan.l_content')
	    						->limit(($page-1)*10,10)
	    					    ->select();	
	    		foreach ($a as $k => $v){
	    			$a[$k]['l_img'] = explode(',',$v['l_img']);
	    			$a[$k]['zan_num'] = M('Ltguanxi')->where("lg_zan ='2' and tz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['pinlun'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
	    			$a[$k]['shoucang_num'] = M('Ltguanxi')->where("lg_shoucang ='2' and tz_id = '$v[tiezi_id]'")
	    			                                      ->count();
	    			$a[$k]['guanzhu'] = M('Focus')->where("f_fansid = '$v[l_userid]' and f_status = '1'")
	    			                              ->count();
	    		}
	    		if($a){
	    			$rest['status'] = true;
	    			$rest['msg'] = '获取成功';
	    			$rest['data'] = $a;
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}else{
	    			$rest['status'] = true;
	    			$rest['msg'] = '查无数据';
	    			$rest['data'] = array();
	    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit; 
	    		}	
	    	}else{
	    		$this->error2('获取失败',1,'参数非法');
	    	}
	    }else{
	    	$this->error1();
	    }
		
	}


	//获取教师认证信息
	public function teacher_data(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$list = M("Teacher")->where("t_userid='{$userid}'")->find();
		if($list){
			$data = array(
					'name' => $list['t_truename'],
					'mobile' => $list['t_mobile'],
					'zhizhao' => $list['t_license'],
					'cardimg1' => $list['t_card_img1'],
					'cardimg2' => $list['t_card_img2'],
					'parentid' => $list['t_jxid'],
					'status' =>$list['t_status'],
					// 'jxid'=>$list['t_jxid']
			);
		
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'当前用户还没有提交过教师认证信息~');
		}
	}
	//教师认证申请
	public function renzhen_teacher(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		$name = trim($_REQUEST['name']);
		$mobile = trim($_REQUEST['mobile']);
		$zhizhao = trim($_REQUEST['zhizhao']);
		$cardimg1 = trim($_REQUEST['cardimg1']);
		$cardimg2 = trim($_REQUEST['cardimg2']);
		$parentid = trim($_REQUEST['parentid']);//代理商id
		
		if($name && $mobile && $zhizhao && $cardimg1 && $cardimg2 && $parentid){
			//代理商
			$dealers = M("Dealers")->field('jxid')->where("jxid='{$parentid}' and jx_status='1'")->find();
			if($dealers){
				$data = array(
					't_userid' => $userid,
					't_truename' => $name,
					't_mobile' => $mobile ,
					't_license' => $zhizhao,
					't_card_img1' => $cardimg1,
					't_card_img2' => $cardimg2,
					't_jxid' => $parentid,
					't_addtime' => date('Y-m-d H:i:s',time()),
					't_status'	=>1
				);
				
				//检验用户提交过
				$renzhen = M('Teacher')->field('tid')->where("t_userid='{$userid}'")->find();
			
				if($renzhen){
					//修改
					$set = M('Teacher')->where("t_userid='{$userid}'")->save($data);
					$rest['status'] = true;
					$rest['msg'] = '提交成功,等待审核';
					
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					//新增
					$add = M('Teacher')->add($data);
					if($add){
						$rest['status'] = true;
						$rest['msg'] = '提交成功,等待审核';
						
						echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
					}else{
						$this->error2("提交失败",1,'sql错误');
					}
				}
			}else{
				$this->error2("提交失败",2,'请输入正确的代理商id~');
			}
		}else{
			$this->error1();
		}
	}
	//获取调律师数据
	public function tiaoer_data(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$list = M("Tiaoer")->where("tiaoer_userid='{$userid}'")->find();
		if($list){
			$data = array(
					'name' => $list['tiaoer_name'],
					'mobile' => $list['tiaoer_mobile'],
					'zhizhao' => $list['tiaoer_img'],
					'cardimg1' => $list['tiaoer_card_img1'],
					'cardimg2' => $list['tiaoer_card_img2'],
					'parentid' => $list['tiaoer_parent1'],
					'status' => $list['tiaoer_status']
			);
		
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $data;
		
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'当前用户还没有提交过调律师认证信息~');
		}
	}
	//用户提交调律师认证
	public function renzheng_tiaoer(){
		
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		$name = trim($_REQUEST['name']);
		$mobile = trim($_REQUEST['mobile']);
		$zhizhao = trim($_REQUEST['zhizhao']);
		$cardimg1 = trim($_REQUEST['cardimg1']);
		$cardimg2 = trim($_REQUEST['cardimg2']);
		$parentid = trim($_REQUEST['parentid']);//代理商id
	
		if($name && $mobile && $zhizhao && $cardimg1 && $cardimg2 && $parentid){
			//代理商
			$dealers = M("Dealers")->field('jxid')->where("jxid='{$parentid}' and jx_status='1'")->find();	
			if($dealers){
				$data = array(
						'tiaoer_userid' => $userid,
						'tiaoer_name' => $name,
						'tiaoer_mobile' => $mobile ,
						'tiaoer_img' => $zhizhao,
						'tiaoer_card_img1' => $cardimg1,
						'tiaoer_card_img2' => $cardimg2,
						'tiaoer_jxid' => $parentid,
						'tiaoer_addtime' => date('Y-m-d H:i:s',time()),
						'tiaoer_status'	=>1
				);
		
				//检验用户提交过
				$renzhen = M('Tiaoer')->field('tiaoer_id')->where("tiaoer_userid='{$userid}'")->find();
					
				if($renzhen){
					//修改
					$set = M('Tiaoer')->where("tiaoer_userid='{$userid}'")->save($data);
					$rest['status'] = true;
					$rest['msg'] = '提交成功,等待审核';
						
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}else{
					//新增
					$add = M('Tiaoer')->add($data);
					if($add){
						$rest['status'] = true;
						$rest['msg'] = '提交成功,等待审核';
		
						echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
					}else{
						$this->error2("提交失败",1,'sql错误');
					}
				}
			}else{
				$this->error2("提交失败",2,'请输入正确的代理商id~');
			}
		}else{
			$this->error1();
		}
	}
	//用户提交的认证信息
	public function shebei_data(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('获取失败',1,'尚未登录');
		}
		
		$data = M('Shebei')->where("sb_userid='{$userid}'")->find();
		
		if($data){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $data;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'该用户还没有提交设备认证信息');
		}
	}


	public function show_myrenzhen(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		$a = M('Shebei')->where("sb_userid = '$userid'")->select();	//查我的绑定
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',2,'该用户还没有绑定设备');
		}

	}

	//设备认证
	public function renzhen_shebei(){
		
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		$hao = trim(I('hao'));
		// if(!$this->check_token($userid, $token)){
		// 	$this->error2('操作失败',1,'尚未登录');
		// }
		
		$t = M('Shebei')->where("sb_userid = '$userid' and sb_status = '2'")->find();
		if($t){
			$this->error2('该账号已有绑定',2,'该账号已经绑定了设备');
		}
	    $a = M('Users')->where("id = '$userid'")->find();
			
		$find_shebei = M("Piano")->where("piano_bianhao='{$hao}' and piano_status='2'")->find();
		if(empty($find_shebei)){
			$this->error2('设备号不存在',2,'您输入的设备号不存在,请更换~');
		}
		if($find_shebei['piano_be'] ==2){
			$this->error2('该设备处于禁用状态',2,'该设备处于禁用状态');
		}
		
		$data = array(
			        'sb_userid' => $userid,
					'sb_truename' => $a['nickname'],
					'sb_mobile' => $a['username'],
					'sb_hao' => $hao,
				    'sb_status' =>2,
				    'sb_addtime'=>date('Y-m-d H:i:s',time())
		        );

		$kk = M('Shebei')->where("sb_hao = '$hao' and sb_userid = '$userid'")->find();	//查是否绑定
		if($kk){
			$this->error2('已绑定该设备',1,'已绑定该设备');
		}

		$arr = M('Piano')->where("piano_bianhao = '$hao'")->find();//查！是教学设备还是普通设备
		
		if($arr['piano_main_use'] == 2){
			//新增  普通产品只能绑定两个账号
			$count = M('Piano')->where("piano_main_use =2 and piano_bianhao = '$hao'")->count();
			if($count < 2){
				$mm = M('Users')->where("id = '$userid'")->setField('rz_status',1);  //更新用户表
				
				$dat['piano_bang_userid'] = $userid;
				$dat['piano_is_bang'] = 2;
				$dat['piano_bangtime'] = date('Y-m-d H:i:s',time());
			
				$cc = M('Piano')->where("piano_bianhao = '$hao'")->save($dat);  //更新设备表
				$add = M('Shebei')->add($data); //增加设备表记录
			
			}else{
				$this->error2('一台设备只能绑定两个账号',2,'一台设备只能绑定两个账号,如有疑问,请联系服务人员');
			}	
		}else{
				$mm = M('Users')->where("id = '$userid'")->setField('rz_status',1); //更新用户表

				$dat['piano_bang_userid'] = $userid;
				$dat['piano_is_bang'] = 2;
				$dat['piano_bangtime'] = date('Y-m-d H:i:s',time());
				$cc = M('Piano')->where("piano_bianhao = '$hao'")->save($dat);  //更新设备表
				
				$add = 	M('Shebei')->add($data);	
		}
		
		if($add){
			//这里加上绑定后的乐币增加，和乐币记录
		}

		if($cc && $add){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('操作失败',1,'sql错误');
		}
	}


	//获取个人资料
	public function my_data(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		//if(!$this->check_token($userid, $token)){
			//$this->error2('操作失败',1,'尚未登录');
		//}

		$score = M('Users')->where("id = '$userid'")->getField('score');
		$level = M('Lv_list')->where("lv_min_score <= '$score' and lv_max_score >= '$score'")
                     ->getField('lv_name');		//根据积分查等级，再更新等级

    	M('Users')->where("id = '$userid'")->setField('lv',$level);

    	$k = M('Lv_list')->where("lv_name = '$level'")->find();

    	$precent = ($score-$k['lv_min_score'])/($k['lv_max_score']-$k['lv_min_score']);

    	$b = M("Goods_order")->where("go_userid = '$user[id]' and go_status = '3'")->sum('go_lebi');//查询扣除的乐币
    	if($b){
    		$c = M('Users')->where("id = '$user[id]'")->setInc('money',$b);	//查询最新乐币
    	}
		
		
		$user = M("Users")->where("id='{$userid}'")->find();
		$fans = M('Focus')->where("f_userid = '$userid' and f_status = '1'")->count();
		$refans = M('Focus')->where("f_fansid = '$userid' and f_status = '1'")->count();
		
		
		//返回登录用户信息
		$data = array(
				'userid' =>$user['id'] ,
				'username' => $user['username'],
				'nick' => $user['nickname'],
				'headerimg' =>$user['headerimg'],
				'sex' => $user['sex'],
				'age' => $user['age'],
				'sign' => $user['sign'],
				'address' =>$user['address'],
				'juese' =>$user['role'],
				'fans_num' =>$fans,
				'guanzhu_num' =>$refans,
				'money'=>$user['money'],
				'level' =>$user['lv'],
				'fans' =>$fans,
				'guanzhu'=>$refans,	
				'score' =>$user['score'],
				'precent' => $precent,		 
		);

		$data['peixun_name'] = M('Zhubo_reg')->where("zb_id = '$user[id]' and zb_kind = '2'")
	                                         ->getField('zhubo_truename');
		$data['jiaoxue_name'] = M('Zhubo_reg')->where("zb_id = '$user[id]' and zb_kind = '1'")
		                                      ->getField('zhubo_truename');
		if(!$data['peixun_name']){
			$data['peixun_name'] = '';
		}
		if(!$data['jiaoxue_name']){
			$data['jiaoxue_name'] = '';
		}

		
		$rest['status'] = true;
		$rest['msg'] = '获取成功';
		$rest['data'] = $data;
		// $rest['data'] = $data;
		// dump($rest['data']['money']);exit();
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	//修改个人资料
	public function edit_userdata(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		
		if(trim($_REQUEST['headerimg'])){
			$data['headerimg'] = trim($_REQUEST['headerimg']);
			$old_url = M("Users")->field('headerimg')->where("id='{$userid}'")->find()['headerimg'];
			@unlink($old_url);
		}
		if(trim($_REQUEST['sex'])){
			$data['sex'] = trim($_REQUEST['sex']);
		}
		if(trim($_REQUEST['age'])){
			$data['age'] = trim($_REQUEST['age']);
		}
		if(trim($_REQUEST['address'])){
			$data['address'] = trim($_REQUEST['address']); 
		}
		if(trim($_REQUEST['sign'])){
			$data['sign'] = trim($_REQUEST['sign']);
		} 
		if(trim($_REQUEST['nickname'])){
			$data['nickname'] = trim($_REQUEST['nickname']);
		}
		


		M('Users')->where("id='{$userid}'")->save($data);


		$a = M('Users')->where("id='{$userid}'")->find();
		if($a['headerimg'] != '' && $a['sex'] != '' && $a['age'] != '' && $a['address'] != ''
			&& $a['sign'] != '' && $a['nickname'] != '' && $a['full_info'] == '1'){
			M('Users')->where("id='{$userid}'")->setField('full_info',2);
			M('Users')->where("id='{$userid}'")->setInc('score',10);
		}
		
		$rest['status'] = true;
		$rest['msg'] = '操作成功';
		
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

	public function show_app(){
		$kind = I('kind');
		$a = M('App')->where("app_kind = '$kind'")->order('app_id DESC')->find();

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';
			$rest['data'] = $a;
		}
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	
	//退出登录
	public function login_out(){
		$userid = (int)$_REQUEST['userid'];
		if($userid){
			$out = M("Token")->where("t_userid='{$userid}'")->limit(1)->delete();
			
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			
		}else{
			$this->error1();
		}
		
	}
	//用户账号在另一设备已经登录，推送消息告诉之前设退出
	//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id
	private function login_tuisong($content,$shebei,$type,$userid){
		header('content-type:text/html;charset=utf8');
		include('./Piano/Common/Common/jpush.php');
	
		//$n_title   = $title;
		$n_content =  $content;
		$receiver_value = $shebei;
	
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
	    
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
		if($type == 1){//android发消息
			//设备
			$platform = 'android';
			//android发消息
			$content = $this->json_encode_ex(array('userid'=>$userid,'title'=>'登陆通知','content'=>$n_content,'time'=>date('Y-m-d'),'type'=>1,));
			$msg_content = json_encode(array('message'=>$content));
				
			
			$res = $obj->send($sendno, 3, $receiver_value, 2, $msg_content, $platform);
		}else if($type == 2){//设备：ios,发发通知
			//设备
			$platform = 'ios';
	
			$msg_content = json_encode(array('n_builder_id'=>$sendno, 'n_title'=>'登陆通知', 'n_content'=>$n_content,'n_extras'=>array('type'=>1,'title'=>'登陆通知')));
			$res = $obj->send($sendno, 3, $receiver_value, 1, $msg_content, $platform);
		}
		return $res;
	}

	//登录
	public function login(){

		$phone = trim($_REQUEST['phone']);
		$pwd = trim($_REQUEST['password']);
		$shebei = trim($_REQUEST['shebei']);
		$leixin = (int)$_REQUEST['leixin'];
	
		if($phone && $pwd != '' && $shebei && $leixin){
			$pwd = md5(MA.$pwd);
			$a = M("Users")->where("username='{$phone}'")->find();
			if($a){
				$user = M("Users")->where("username='{$phone}' and pwd='{$pwd}'")->find();
				if($user){
				   //生成token，记录登陆
				   $token = md5($phone.time());
				   $t_data = array(
				   	    't_userid'=> $user['id'],
				   		't_token'=> $token,
				   		't_shebei'=> $shebei,
				   		't_leixin'=> $leixin,
				   		't_time' => time()
				   );
				   //检验当前账号是否登录
				    $login = M("Token")->where("t_userid='{$user['id']}'")->find();

				   

				    if($login){

				    	$today = strtotime(date('Y-m-d  00:00:00',time()));
				    	$yeday = $today-86400;
				    	$login['t_time'] = strtotime(date('Y-m-d 00:00:00',$login['t_time']));

				    	if($login['t_time'] < $yeday){
				    		M('Users')->where("id = '$user[id]'")->setField('days',0);
				    	}//断了连续天数

				   		if(date('Y-m-d',$login['t_time']) != date('Y-m-d',time())){
				   			if($user['days'] < 7){//不到7天，
				   				M('Users')->where("id = '$user[id]'")->setInc('score',5);
				   				M('Users')->where("id = '$user[id]'")->setInc('days',1);
				   			}else{
				   				M('Users')->where("id = '$user[id]'")->setInc('score',10);
				   				M('Users')->where("id = '$user[id]'")->setInc('days',1);
				   			}
				   		}

					   	if($login['t_shebei'] == $shebei){

					   		M("Token")->where("t_userid='{$user['id']}'")->setField('t_token',$token);
					   	}else{

					   		//极光推送下线消息
					   		$content = "您的账号已经在另一个设备登录了";
					   		//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id
					   		if($login['t_leixin'] == 2 && $login['t_shebei']){
					   			$this->ios_msg_send($content,$login['t_shebei']);
					   		}else{
					   		
						   		$this->login_tuisong($content,$login['t_shebei'],$login['t_leixin'],$login['t_userid']);
						   	}
					   		//修改登录设备号和登陆token
					   		M("Token")->where("t_userid='{$user['id']}'")->save(array(
														   		't_token'=> $token,
														   		't_shebei'=> $shebei,
														   		't_leixin'=> $leixin,
														   		't_time' => time()
					   		                                ));
					        } 
				    }else{
				   	  //插入登陆记录
				      M("Token")->add($t_data);
				      M('Users')->where("id = '$user[id]'")->setInc('score',5);
				      M('Users')->where("id = '$user[id]'")->setInc('days',1);
				    }
	$score = M('Users')->where("id = '$user[id]'")->getField('score');
	$level = M('Lv_list')->where("lv_min_score <= '$score' and lv_max_score >= '$score'")
                     ->getField('lv_name');		//根据积分查等级，再更新等级

    M('Users')->where("id = '$user[id]'")->setField('lv',$level);

    $k = M('Lv_list')->where("lv_name = '$level'")->find();

    $precent = ($score-$k['lv_min_score'])/($k['lv_max_score']-$k['lv_min_score']);

    $b = M("Goods_order")->where("go_userid = '$user[id]' and go_status = '3'")->sum('go_lebi');
    //查询扣除的乐币
    if($b){
    	M('Users')->where("id = '$user[id]'")->setInc('money',$b);	
    }
	


	//查询最新信息	  
    $user = M("Users")->where("username='{$phone}' and pwd='{$pwd}'")->find();
	
	 
				   //返回登录用户信息
				   $data = array(
				   	    'userid' =>$user['id'] ,
				   		'username' => $user['username'],
				   		'nick' => $user['nickname'],
				   		'headerimg' =>$user['headerimg'],
				   		'sex' => $user['sex'],
				   		'age' => $user['age'],
				   		'sign' => $user['sign'],
				   		'address' =>$user['address'],
				   		'juese' =>$user['role'],
				   		'money' =>$user['money'],
				   		'level' => $user['lv'],
				   		'score' =>$user['score'],
				   		'precent' =>$precent,

				   );
	$data['peixun_name'] = M('Zhubo_reg')->where("zb_id = '$user[id]' and zb_kind = '2'")
	                                     ->getField('zhubo_truename');
	$data['jiaoxue_name'] = M('Zhubo_reg')->where("zb_id = '$user[id]' and zb_kind = '1'")
	                                      ->getField('zhubo_truename');
	if(!$data['peixun_name']){
		$data['peixun_name'] = '';
	}
	if(!$data['jiaoxue_name']){
		$data['jiaoxue_name'] = '';
	}
	
	$data['fans_num'] = M('Focus')->where("f_status = '2' and f_userid = '$user[id]'")->count();
	$data['guanzhu_num'] = M('Focus')->where("f_status = '2' and f_fansid = '$user[id]'")->count();
				   $rest['status'] = true;
				   $rest['msg'] = '登陆成功';
				   $rest['data'] = $data;
				   $rest['token'] = $token;
				   	
				   echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				   
				}else{
					$this->error2('登录失败,账号密码错误',2,'账号密码错误~');
				}
			}else{
				$this->error2('登录失败,当前账号还没有注册',2,'当前账号还没有注册~');
			}	
		}else{
			$this->error1();
		}
	}
	//校验token
	private function check_token($userid,$token){
		$list = M("Token")->where("t_userid='{$userid}' and t_token='{$token}'")->find();
		
		if($list){
			return true;
		}else{
			return false;
		}
	}
	//生成邀请码
	public function creat_yaoqingma(){
		$userid = (int)$_REQUEST['userid'];
		$token = trim($_REQUEST['token']);
		if($userid && $token){
			//校验token 
			if(!$this->check_token($userid,$token)){
				$this->error2('获取失败',1,'尚未登录');
			}
			$ma = M("Yaoqingma")->Max("y_ma");
			$ma = $ma+1;
			$ma = sprintf('%08s', $ma);
			
			$data = array(
					'y_userid' => $userid,
					'y_ma' => $ma,
			);
			
			if(M("Yaoqingma")->add($data)){
				$rest['status'] = true;
				$rest['msg'] = '获取成功';
				$rest['ma'] = $ma;
					
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('获取失败',1,'sql错误');
			}
		}else{
			$this->error1();
		}	
	}
    //校验邀请码
    public function check_yaoqingma(){
    	$ma = trim($_REQUEST['ma']);
    	if($ma){
    		if(M("Yaoqingma")->where("y_ma='{$ma}' and y_status=1")->find()){
    			$rest['status'] = true;
    			$rest['msg'] = '校验通过';
    			
    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
    		}else{
    			$this->error2('校验不通过',2,'邀请码无效');
    		}
    	}else{
    		$this->error1();
    	}
    }
    //注册环信
    public function huanxin(){
    	$ids = M('Users')->field('id')->select();
    	
    	$Hx = new HxController();
    	
    	foreach($ids as $v){
    		$options['username'] = $v['id'];
    		$options['password'] = $v['id'];
    		$Hx->openRegister($options);
    	}
    	
	
    }
	//注册
	public function register(){

		$phone = trim($_REQUEST['phone']);
		if(!preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$phone)){
			$this->error2('发送失败',2,'请输入有效的手机号');		
		}
		$password = trim($_REQUEST['password']);
		// $yaoqingma = trim($_REQUEST['yaoqingma']);
		$parent_id = 0;
		
		M('Users')->startTrans();
		// if($yaoqingma){
		// 	$parent_id = M('Yaoqingma')->where("y_ma='{$yaoqingma}' and y_status=1")->find()['y_userid'];
		// 	M('Yaoqingma')->where("y_ma='{$yaoqingma}' and y_status=1")->setField("y_status",2);
		// }
		$nickname = trim($_REQUEST['nickname']);
		$sex = trim($_REQUEST['sex']);
		$headerimg = trim($_REQUEST['headerimg']);
		if($phone && $nickname && $password){

            $find_user = M('Users')->where("username='{$phone}'")->find();
		    if($find_user){
		      $this->error2('注册失败',1,'账号已存在');	
		    }

			$data = array(
				'username' => $phone,
				'pwd' => md5(MA.$password),
				'headerimg' => $headerimg,
				'nickname' => $nickname,
				'sex' => $sex,
				'parent_id' => $parent_id,
				// 'yaoqingma' =>$yaoqingma,
				'add_time' => date('Y-m-d H:i:s',time()),
			);
			
			// dump($data);exit;
			$add = M('Users')->add($data);
			
			//注册环信
			$Hx = new HxController();
			$options['username'] = $add;
			$options['password'] = $add;
			$res = $Hx->openRegister($options);
			$res = json_decode($res,true);
		//	echo '<pre/>';
		//var_dump($res);exit;
			if($add && $res['entities']){
				
				M('Users')->commit();
				$rest['status'] = true;
				$rest['msg'] = '注册成功';
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				M('Users')->rollback();
				$this->error2('注册失败',1,'请重试');		
			}
		}else{
			$this->error1();
		}
	}
	//忘记密码，重置密码
	public function rest_pwd(){
		$phone = trim($_POST['phone']);
		$pwd = trim($_POST['password']);

	    if($phone && $pwd !=''){
	    	cookie($phone,null);
	    	$set = M('Users')->where("username='{$phone}'")->setField('pwd',md5(MA.$pwd));
	    	 
	    	$rest['status'] = true;
	    	$rest['msg'] = '重置密码成功';
	    
	    	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    	/* if($verify != $_COOKIE[$phone]){
	    		$this->error2('校验失败',2,'验证码错误');   		
	    	}else{
	    		cookie($phone,null);
	    		$set = M('Users')->where("username='{$phone}'")->setField('pwd',md5(MA.$pwd));
	    		
    			$rest['status'] = true;
    			$rest['msg'] = '重置密码成功';
    			$rest['res'] = '重置密码成功';
    			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    	}	 */
	    }else{
	    	$this->error1();
	    }
	}
	//检验账号是否注册
	public function check_phone(){
		$phone = trim($_POST['phone']);
		if(M("Users")->where("username='{$phone}'")->find()){
			$rest['status'] = true;
			$rest['msg'] = '当前账号已经注册';

			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('当前账号还没有注册',1,'当前账号还没有注册');
			
		}
	}
	//校验验证码
	public function check_verify(){
		$phone = trim($_POST['phone']);
		$verify = trim($_POST['verify']);
		if($phone && $verify != ''){
			if($verify != $_COOKIE[$phone]){
				$this->error2('校验失败',2,'验证码错误');
			}else{
				cookie($phone,null);
					
				$rest['status'] = true;
				$rest['msg'] = '校验通过';
				$rest['res'] = '校验通过';
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}
		}else{
			$this->error1();
		}
			
	}

	public function homework_sou(){
		$key = I('key');
		$a = M('Songs')->where("songs_name like '%$key%'")
					   ->field('songs_name as name,sid')
		               ->select();
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '查无数据';
			$rest['data'] = array();
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}
	}

	//获取验证码：type=1;注册获取，type=2；忘记密码获取
	public function get_verify(){	
		
		$phone = I('phone');
	
		//echo $phone;exit;
		if($phone){
			
			if(!preg_match("/^13[0-9]{1}[0-9]{8}$|14[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/",$phone)){
				$this->error2('发送失败',2,'请输入有效的手机号');		
			}
			
		
			//随机生成6个数字验证码
			for($i=0;$i<6;$i++){
				$verify .= mt_rand(0,9);
			}
			
			$msg = "您好！您的验证码为：".$verify."【乐乐GO在线音乐教育平台】";
			$result = $this ->sendMessage($phone,$msg);
			
			if($result->respcode==0){
				//保存验证码至cookie
				cookie($phone,$verify,array('expire'=>60*2));//两分钟
				
				$rest['status'] = true;
				$rest['msg'] = '发送成功';
				$rest['verify'] = $verify;
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{
				$this->error2('发送失败',2,$result->respdesc);		
			}
		}else{
		    $this->error1();
		}
		
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
	private function sendMessage($phone,$msg,$sendtime='',$port='',$needstatus=''){
		$username = "zihao2"; //在这里配置你们的发送帐号
		$passwd = "zihao99";    //在这里配置你们的发送密码
		
		$ch = curl_init();
		$post_data = "username=".$username."&passwd=".$passwd."&phone=".$phone.
					 "&msg=".urlencode($msg)."&needstatus=true&port=".$port."&sendtime=".$sendtime;
		
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
		// var_dump($post_data);exit;
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
	//这个是E美给的测试账号，现保存备用
	private function sendMessage2($phone,$msg,$sendtime='',$port='',$needstatus=''){
		$username = "sdzxqy"; //在这里配置你们的发送帐号
		$passwd = "sdzxqy26";    //在这里配置你们的发送密码
		
		$ch = curl_init();
		$post_data = "username=".$username."&passwd=".$passwd."&phone=".$phone.
					 "&msg=".urlencode($msg)."&needstatus=true&port=".$port."&sendtime=".$sendtime;
		
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
		// var_dump($post_data);exit;
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
	//上传身份证
	public function upload_cardimg(){
		$file = $_FILES['file'];
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(1,9);
			$upload->rootPath  =     './Public/Uploads/cardimg/'; // 设置附件上传根目录
		
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				$rest['status'] = true;
				$rest['file_name'] = $file_name;
				$rest['msg'] = '上传成功';
				echo $this->json_encode_ex($rest);exit;
				/* for($i=0;$i<count($info);$i++){
				 $file[$i]='/Uploads/'.$info[$i]['savepath'].$info[$i]['savename'];
				}
				return $file;exit; */
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
		
		}
	}
	//上传执照
	public function upload_zhizhao(){
		$file = $_FILES['file'];
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/zhizhao/'; // 设置附件上传根目录
				
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				$rest['status'] = true;
				$rest['file_name'] = $file_name;
				$rest['msg'] = '上传成功';
				echo $this->json_encode_ex($rest);exit;
				/* for($i=0;$i<count($info);$i++){
				 $file[$i]='/Uploads/'.$info[$i]['savepath'].$info[$i]['savename'];
				}
				return $file;exit; */
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
				
		}
	}
	//上传头像图片
	public function upload_headerimg(){
		$file = $_FILES['file'];
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/headerimg/'; // 设置附件上传根目录
			
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
	
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));		
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				$rest['status'] = true;
				$rest['file_name'] = $file_name;
				$rest['msg'] = '上传成功';
				echo $this->json_encode_ex($rest);exit;
				/* for($i=0;$i<count($info);$i++){
				 $file[$i]='/Uploads/'.$info[$i]['savepath'].$info[$i]['savename'];
				}
				return $file;exit; */
			}
		}else{
			//$data['file_name'] = $file_name;
			 $this->error2('上传失败',2,'未选择文件');
			
		}
	
	}
	
	/*错误提示二：@msg：状态
	 *         @type：使用错误提示：//1自己写提示，2使用返回提示
	*         @error:错误原因
	* */
	private function error2($msg,$type,$error){
		$rest['status'] = false;
		$rest['msg'] = $msg;
		$rest['type'] = $type;
		$rest['error'] = $error;
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	//错误提示一：参数缺少
	private function error1(){
		$rest['status'] = false;
		$rest['msg'] = '操作失败';
		$rest['type'] = 2;//1自己写提示，2使用返回提示
		$rest['error'] = '缺少必填参数';
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	
	public function aa(){
		$this->display('upload');
	}
	
	public function upload_headerimg_re(){
		$file = $_FILES;
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'png', 'jpeg');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/headerimg/'; // 设置附件上传根目录
				
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->upload();
		//	echo '<pre/>';
	    //  var_dump($info);exit;
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['file']['savepath'].$info['file']['savename'];
				$rest['status'] = true;
				$rest['file_name'] = $file_name;
				$rest['msg'] = '上传成功';
				echo $this->json_encode_ex($rest);exit;
				/* for($i=0;$i<count($info);$i++){
				 $file[$i]='/Uploads/'.$info[$i]['savepath'].$info[$i]['savename'];
				}
				return $file;exit; */
			}
		}else{
			//$data['file_name'] = $file_name;
			$this->error2('上传失败',2,'未选择文件');
				
		}
	
	}

//蓝牙连接设备前检测
	public function check_lanya(){
		$username = I('phone');
		// $phone = I('phone');
		$hao =I('hao');

		// $fp = fopen('/mnt/record.txt','a+');
		// fwrite($fp,json_encode($_REQUEST)."\r\n");
		// fclose($fp);
		
		$user = M('Users')->where("username = '$username'")->find();
		$a = M('Piano')->where("piano_bianhao = '$hao'")->find();
		if($a['piano_main_use'] == 1){
			$rest['status'] = true;
			$rest['join'] =1;
			$rest['msg'] = '检测通过,可以连接';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}//这里是5.16日修改的，教学产品可以直接连

		$b = M("Shebei")->where("sb_hao = '$hao' and sb_mobile ='$username'")->find();

		if(empty($a)){
			$rest['status'] = false;
			$rest['join'] =0;
			$rest['msg'] = '没有找到该设备';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
				if($b){
					if($a['piano_be']==1){
						$rest['status'] = true;
						$rest['join'] =1;
						$rest['msg'] = '检测通过,可以连接';
						echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
					}else{
						$rest['status'] = false;
						$rest['join'] =0;
						$rest['msg'] = '连接不许可，设备已禁用';
						echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
					}
				}else{
					$rest['status'] = false;
					$rest['join'] =0;
					$rest['msg'] = '连接不许可，没有绑定该设备';
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}
		}	
	}	
	
	//获取直播sing
	private function signature($identifier, $sdkappid, $private_key_path){
	
		//这里需要写绝对路径，开发者根据自己的路径进行调整
	
		//  $command =__DIR__.'\tls_sig_api-windows-64\bin\signature.exe' //win系统的
		$command =__DIR__.'/tls_sig_api-linux-64/bin/signature'
	
				. ' ' . escapeshellarg($private_key_path)
				. ' ' . escapeshellarg($sdkappid)
				. ' ' . escapeshellarg($identifier);
		$ret = exec($command, $out, $status);
		// echo '</pre>';
		 
		// var_dump($command, $out, $status);exit;
		if ($status == -1)
		{
			return null;
		}
		 
		return $out;
	}
	
	public function get_usersing(){
	
		$userid = trim($_REQUEST['userid']);
		$token = trim($_REQUEST['token']);
	
		if(!$this->check_token($userid, $token)){
			$this->error2('操作失败',1,'尚未登录');
		}
		if($userid){
			//$usersing =  $this->signature($userid,'1400023343', __DIR__.'/tls_sig_api-windows-64/tools/private_key'); // win系统的
			$usersing =  $this->signature($userid,'1400023343', __DIR__.'/tls_sig_api-linux-64/tools/private_key');
	

			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data']['usersig'] = $usersing[0];
	
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error1();
		}
	}

//我的关注和我的粉丝	
	public function my_fans_refan(){
		$id = I('userid');
		$type = I('type')?I('type'):1;   //1我的粉丝  2我的关注
		$page = I('page')?I('page'):1;

		if($type == 1){
			$a = M('Focus')->where("f_userid = '$id' and f_status = '1'") //被关注的人是我s
			               ->join('piano_users on piano_users.id = piano_focus.f_fansid')
			               ->field('id,nickname,headerimg,sex,lv,sign')
			               ->limit(($page-1)*10,10)
			               ->select();  
			                //我的粉丝  他们的头像，昵称等信息
			foreach($a as $k => $v){
				if(empty($v['sign'])){$a[$k]['sign'] = '';}   //前端不能解析NULL
				$a[$k]['status'] = M('Focus')->where("f_fansid = '$id' and f_userid = '$v[id]'")
				                             ->getField('f_status');
				if($a[$k]['status'] == NULL){
					$a[$k]['status'] = 1;   //他关注我了吗？ 1没有  2有
				}
			}

		}else{
			$a = M('Focus')->where("f_fansid = '$id' and f_status = '1'")//我是粉丝
			               ->join('piano_users on piano_users.id = piano_focus.f_userid')
			               ->field('id,nickname,headerimg,sex,lv,sign')
			               ->limit(($page-1)*10,10)
			               ->select();  
//我关注的人  他们的头像，昵称等信息

			foreach($a as $k => $v){
				if(empty($v['sign'])){$a[$k]['sign'] = '';} //前端不能解析NULL
				$a[$k]['status'] = M('Focus')->where("f_userid = '$id' and f_fansid = '$v[id]'")
				                             ->getField('f_status');
				if($a[$k]['status'] == NULL){
					$a[$k]['status'] = 1;   //我关注他了没  1没有  2有
				}

			}

		}
		
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';
			$rest['data'] = array();
		}
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
	
//房间名搜索
	public function room_sou(){
		$name = I('key');
		$a = M('Room')->where("(title_name like '%{$name}%' or 
			                    room_id like '%$name%'   or
			                    zhubo_name like '%name%' or
			                    zhubo_id  like '%name%') and 
			                    status != '2'")
		              ->select();
		
		
	//	dump($a);exit;
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';	
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';	
			$rest['data'] = array();
		}
	echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
	}

// 这个做琴行直播认证的人   他的身份必须是老师 
// 用户身份role=2

	public function show_daili(){
		$id = I('userid');
		$a = M('Teacher')->where("t_userid = '$id'")->find();
		if($a){
			$jxid = $a['t_jxid'];
			$b=M('Dealers')->where("jxid = '$jxid'")
			               ->field('jx_fzr,jx_phone,jxid,jx_zhiboid,jx_zhizhao,
			               	        jx_cardimg1,jx_cardimg2')
			               ->find();
		}

		if(!$b){
			$this->error2('查无数据',2,'');
		}

		if($b['jx_zhiboid'] != 4){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';	
			$rest['data'] = $b;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
		
		}
	echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
	}


//认证琴行直播
	public function daili_renzhen(){
		$jxid = trim(I('jxid'));
		$data['jx_userid'] = I('userid');
		$data['jx_fzr'] = trim(I('truename'));
		$data['jx_phone'] = trim(I('phone'));
		$data['jx_zhizhao'] = I('zhizhao');
		$data['jx_cardimg1'] = I('card1');
		$data['jx_cardimg2'] = I('card2');
		$data['jx_zhiboid'] = 1;

		// if(!I('zhizhao') || !I('card1') || !I('card2') || !I('turename') || !I('phone')){
		// 	$this->error1();
		// }

		$a = M('Dealers')->where("jxid = '$jxid'")->find();
		if(!$a){
			$this->error2('没有此经销商ID',2,'没有对应此ID的经销商');
		}
		
	

		$c = M('Teacher')->where("t_userid = '$data[jx_userid]'")->find();
		if(!$c){
			$this->error2('该用户不是老师,不能认证',2,'该用户不是老师,不能认证');
		}

		$b = M('Dealers')->where("jxid = '$jxid'")->save($data);
		if($b){
			$rest['status'] = true;
			$rest['msg'] = '提交成功,我们会在三个工作日内完成审核，并消息通知您~谢谢您的配合';	
		}else{
			$rest['status'] = false;
			$rest['msg'] = '提交失败';	
		}
	echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
	}


//查询主播认证
	public function show_zhubo(){
		$id = I('userid');
		$kind = I('kind')?I('kind'):1;
		
		$a = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->find();
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';	
			$rest['data'] = $a;
		}else{

			$rest['status'] = false;
			$rest['msg'] = '查无数据';

		}
	echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;	
	}



//主播认证     5-20新需求
	public function zhubo_renzhen(){
		$id = I('userid');
		// if(!I('phone') || !I('truename') || !I('zhizhao') || !I('card1') ||
		//    !I('card2') || !I('rzid')){
		// 	$this->error1();
		// }
	

		$data['zhubo_phone'] = I('phone');
		$data['zhubo_truename'] = I('truename');
		$data['r_zbid'] = $jxid = I('rzid');
		$data['zb_kind'] = I('kind')?I('kind'):1;
		$data['zb_zhizhao'] = I('zhizhao');
		$data['zb_cardimg1'] = I('card1');
		$data['zb_cardimg2'] = I('card2');
		$data['zb_id'] = $id;
		$data['zbrz_status'] = 1;
		$data['acc_on'] = 1;
	
		
		if($data['zb_kind'] == 1){
			$b = M('Teacher')->where("t_userid = '$id'")->find();
			if($b){
				$data['zb_zhizhao'] = $b['t_license'];
				$data['zb_cardimg1'] = $b['t_card_img1'];
				$data['zb_cardimg2'] = $b['t_card_img2'];

				$d = M('Dealers')->where("jxid = '$jxid'")->find();
				if(!$d){
					$this->error2('没有此直播间ID',2,'没有对应此ID的经销商');
				}

				if($d['jx_zhiboid'] != '3'){
					$this->error2('操作失败',2,'所属琴行直播认证尚未获取');
				}//在我的认知中  所谓的琴行直播间ＩＤ　其实就是它的jxid  所以没有比对输入值与查询值是否相等
			}
		}


		$a =  M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$data[zb_kind]'")->find();
		if($a){
			$c = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$data[zb_kind]'")->save($data);
		}else{
			$c = M('Zhubo_reg')->add($data);
		}
		

        //申请成功，等待审核
		if($c){
			$rest['status'] = true;
			$rest['msg'] = '申请成功，等待审核,三天内有答复';	
		}else{
			$this->error2('操作失败',1,'请联系管理员');
		}	
				
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}



	public function new_room(){
		$str = time().rand(100,999);
		$arr = substr($str,-11);  
		if(M('Room')->where("room_id = '$room_id'")->find()){
			$arr = $this->new_room();
		}
		// echo $arr;exit;
		return $arr;
	}

//主播发布直播  
	public function fabu_zhibo(){
		$id = I('userid');  
		// $room_id = $this->new_room();
		$room_id = I('room_id');
		$kind = I('kind')?I('kind'):0;      //0show房  1 教学课  2大师级课
		$type = I('type')?I('type'):0;      //是否私播
		if(!$id || !$room_id){
			$this->error1();
		}

		$a = M('Room')->where("zhubo_id = '$id' and status = '1'")->order('r_id')->find();
		if($a){
			M('Room')->where("zhubo_id = '$id' and status = '1'")->order('r_id')->setField('status',2);
		}

		if($kind == 0){// show房  可以直接开
			if($type == 1){
				$data['pwd'] = I('pwd');
				$data['type'] = $type;
			}

			$data['room_id'] = $room_id;
			$data['zhubo_id'] = $id;
			$data['title_name'] = I('title_name');
			$data['role_name'] = $id;
			$data['status'] = 1;
			$data['s_time'] = date('Y-m-d H-i-s',time());
			$data['total_num'] = 1;
			$data['kind'] = $kind;
			$data['activitytime'] = date('Y-m-d H-i-s',time());
// dump($data);exit;
			$c = M('Room')->add($data);	
		}else{
			$now = date('Y-m-d H:i:s',time()-18000);
			$b = M('Yuyue')->where("zhubo_id = '$id' and y_status = '1' and kind = '$kind' and y_time > '$now'")
			               ->find();

			//查相应的预约记录
			if(!$b){
				$rest['status'] = false;
				$rest['msg'] = '需要预约';
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
			}else{//有记录，对比时间
			
				$time = date('Y-m-d H:i:s',time()+1800);
				$etime = date('Y-m-d H:i:s',time()-18000);
				
				if($b['y_time'] > $time){
					$rest['status'] = false;
					$rest['msg'] = '预约时间未到';
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}
				if($b['y_time'] < $etime){
					$rest['status'] = false;
					$rest['msg'] = '超过预约时间5小时，请重新预约';	
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
				}
				if($type == 1){
					$data['pwd'] = I('pwd');
					$data['type'] = $type;
				}
				//时间符合，就改成开播状态
				$data['status'] = 1;
				$data['activitytime'] = date('Y-m-d H-i-s',time());
				$data['total_num'] = 1;

				$c = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id' and kind = '$kind'")
				              ->order('r_id')
				              ->save($data);	
			}
		}

		$usersing = $this->signature($id,'1400023343',__DIR__.'/tls_sig_api-linux-64/tools/private_key');
	

		if($kind == 0){
			$d = M('Room')->where("piano_room.zhubo_id = '$id' and piano_room.room_id ='$room_id' and status = '1'")
						  ->join('piano_users on piano_users.id = piano_room.zhubo_id')
						  ->field('title_name,total_num,type,total_money,r_id,s_time,nickname,headerimg,piano_room.room_id')
						  ->find();
		}else{
			$d = M('Room')->where("piano_room.zhubo_id = '$id' and piano_room.room_id ='$room_id' and status = '1'")
			              ->join('piano_yuyue on piano_yuyue.zhubo_id = piano_room.zhubo_id')
			              ->join('piano_users on piano_users.id = piano_room.zhubo_id')
			              ->field('title_name,total_num,type,total_money,r_id,s_time,y_truename,y_shoufei,headerimg,piano_room.room_id')
			              ->find();
		}
		// dump($d);exit;
					
		if($c){
			$rest['status'] = true;
			$rest['msg'] = '发布成功';
			$test['data'] = $d;
			$rest['data']['usersing'] = $usersing[0];
		}else{
			$rest['status'] = false;
			$rest['msg'] = '操作失败，请联系管理员';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

//观众进直播室
	public function add_guanzhong(){
		//考虑到进入失败后需要跳转到不同页面，$this->error2()里的type类型分成5种 1,2,3,4,5
		$user_id = I('userid');
		$room_id = I('room_id');
		$zhubo_id = I('zhubo_id');
		$pwd = I('pwd');
		//防止主播掉线 观众任然进直播间 看不到画面
		$x = M('Room')->where("room_id = '$room_id' and status !='1'")->find();
		if($x){
			$this->error2("直播已关闭",1,"直播已关闭");
		}
		//首先看要不要收费，然后再看密码是不是正确 
 		$find = M('Room')->where("room_id = '$room_id' and pinbi = '0'")->find();
 		if($find['kind'] != 1){  //培训  和show房  才会收费
 			if($find['status'] != 2){
 				$money = $find['live_shoufei'];
 			}else{
 				$money = $find['video_shoufei'];
 			}

 			if($find['zhubo_id'] != $user_id && $money != 0){ //要收费  并且是其他用户才去看订单
 				$x = M('Goods_order')->where("go_status = '2' and go_userid = '$user_id' and 
			                          go_name like '%$room_id%'")
			                         ->find();

				if(!$x){
					$this->error2('没有购买本节直播课',2,'没有购买');
				}
 			}	
 		}
		
		$a = M('Room')->where("room_id = '$room_id' and zhubo_id = '$zhubo_id'")->find();

		//看房间是否正常 密码是否正确
		if($a['type'] == 1 && $pwd != $a['pwd']){
			$this->error2('操作失败,密码不正确',3,'密码不正确');
		}

		if($a['pinbi'] == 1){
			$this->error2('操作失败',4,'该房间被屏蔽，不能进入');
		}

		$b = M('Ub_guanxi')->where("user_id = '$user_id' and 
								    room_id = '$room_id' and 
								    zhubo_id = '$zhubo_id'")->find();  

		//查找主播与用户的关系
		if($b['ti'] == 1){
			$this->error2('操作失败',5,'被踢，不能进');	
		}

		$usersing = $this->signature($user_id,'1400023343',__DIR__.'/tls_sig_api-linux-64/tools/private_key');

		if($b){
			if($b['in_out'] == 1){
			
				M('Room')->where("room_id = '$room_id'and zhubo_id = '$zhubo_id' and status = '1'")
			             ->setInc('total_num',1);  //房间人气加1	

				M('Ub_guanxi')->where("user_id = '$user_id' and 
									   room_id = '$room_id' and 
									   zhubo_id = '$zhubo_id'")
							  ->setField('in_out',0);  //改成进状态
			}
		}else{
			//新观众进直播间
			$data['user_id'] = $user_id;
			$data['zhubo_id'] = $zhubo_id;
			$data['room_id'] = $room_id;
			$d = M('Ub_guanxi')->add($data);	//添加关系表

			$c = M('Room')->where("room_id = '$room_id' and zhubo_id = '$zhubo_id'")
					 	  ->setInc('total_num',1);  //房间人气加1

		}
				
		$rest['status'] = true;
		$rest['msg'] = '操作成功';
		$rest['data']['usersig'] = $usersing[0];
		$rest['data']['jinyan'] = $b['jinyan']?$b['jinyan']:0;	
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
	}


//刷新在场观众
	public function show_guanzhong(){
		$room_id = I('room_id');
		$zhubo_id = I('zhubo_id');

		$a = M('Ub_guanxi')->order('gx_id DESC')
		                   ->where("room_id = '$room_id' and zhubo_id = '$zhubo_id' and in_out = '0'")
						   ->join('piano_users on piano_users.id = piano_ub_guanxi.user_id')
						   ->field('piano_users.headerimg,piano_users.nickname,piano_users.id')	
						   ->select();

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';	
			$rest['data'] = $a;
			// $rest['admin'] = $b;
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';	
			$rest['data'] = $a;
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
		}
	}

//直播间的轮播图
	public function zhibo_lubotu(){
		$a = M('banner')->where("b_set='2'")->select();
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$this->error2('查无数据',2,'请联系后台');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
	}

//观众退出直播室	
	public function del_guanzhong(){
		$id = I('userid');
		$zhubo_id = I('zhubo_id');
		$room_id = I('room_id');	

		M('Ub_guanxi')->where("user_id = '$id' and room_id = '$room_id' and zhubo_id = '$zhubo_id'")
					  ->setField('in_out',1);
	
		$b = M('Ub_guanxi')->where("user_id = '$id' and room_id = '$room_id' and zhubo_id = '$zhubo_id'")
						   ->find();

		if($b['in_out'] == 1){
			$rest['status'] = true;
			$rest['msg'] = '退出成功';
		}else{
			$this->error2('退出失败',2,'请联系管理员');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

//结束直播
	public function finish_zhibo(){

		$room_id = I('room_id');
		$zhubo_id  = I('zhubo_id');
		$vid = I('vid');
		
		$info = M('Room')->where("room_id ='$room_id' and zhubo_id ='$zhubo_id'")->order('r_id DESC')->find();
		
		//查该房间的状态
		if($info['kind'] == '2'){
			if($vid){

 				// $b = $this->PlayInfoimg($vid);//通过这个接口去查地址
 				// $c = $b['fileSet'][0]['playSet'][0];
 				// $url = $c['url'];

 				$e = M('Room')->where("room_id = '$room_id'")->setField('url',$vid);


				
				$data['e_time'] = date('Y-m-d H-i-s',time());
				$data['status'] = 2;
			
				$a = M('Room')->where("room_id = '$room_id'")->save($data);
				$d = M('Room')->where("room_id = '$room_id'")->find();
				
			    if($e){
					$rest['status'] = true;
					$rest['msg'] = '操作成功';
					$rest['data'] = '历史观看人数：'.$d['total_num'].'人';
				}else{
					$this->error2('操作失败',2,'请联系管理员');
				}
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
			}else{
				$b = M('Room')->where("room_id = '$room_id'")->save($data);
				$d = M('Room')->where("room_id = '$room_id'")->find();

				if($b){
					$rest['status'] = true;
					$rest['msg'] = '操作成功';
					$rest['data'] = '历史观看人数：'.$d['total_num'].'人';
				}else{
					$this->error2('操作失败',2,'请联系管理员');
				}
				
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
			}
			
		}else{
			$data['e_time']  = date('Y-m-d H-i-s',time());
			$data['status'] = 2;

			$a = M('Room')->where("r_id = '$info[r_id]'")->save($data);
			 //更改直播间结束状态
			$d = M('Room')->where("room_id='$room_id' and zhubo_id='$zhubo_id' and e_time='$data[e_time]'")
			 	          ->find();
		    if($a){
			 	$rest['status'] = true;
			 	$rest['msg'] = '操作成功';
			 	$rest['data'] = '历史观看人数：'.$d['total_num'].'人';
			}else{
			 	$this->error2('操作失败',2,'请联系管理员');
			}
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
		}
	}


//发表评论
	public function add_comments(){
		$data['user_id'] = I('userid');
		$data['room_id'] = I('room_id');
		$data['commnent'] = I('commnent');
		$data['time'] = date('Y-m-d H-i-s',time());
		$zhubo_id = I('zhubo_id');
	
		$a = M('Room')->where("room_id = '$data[room_id]'")->order('s_time DESC')->find();
		$b = M('Ub_guanxi')->where("user_id = '$data[user_id]'
								    and room_id ='$data[room_id]'
								    and zhubo_id = '$zhubo_id'")->find();
	
		if($b['jinyan'] == 0){
			$c = M('Comments')->add($data);
			if($c){
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
			}else{
				$this->error2('操作失败',2,'请联系管理员');
			}
		}else{
			$this->error2('操作失败',2,'被禁言');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}


// 直播活动时间心跳
    public function activityTime(){
        $roomid = I('room_id');//直播间id
        $zhubo_id = I('zhubo_id');//直播者id

        $list = M('Room')->where("zhubo_id= '$zhubo_id' and room_id = '$roomid' and status = '1'")->find();
        // dump($list);
        if($list){
        	$time = date('Y-m-d H:i:s',time());
        	$set = M('Room')->where("zhubo_id= '$zhubo_id' and room_id = '$roomid' and status = '1'")
        	                ->setField("activitytime",date('Y-m-d H:i:s',time()));
        }	
        //dump($set);exit;

    	if($set){
    		$rest['status'] = true;
    		$rest['msg'] = '请求成功';
    		echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
    	}else{
			$rest['status'] = false;
    		$rest['msg'] = '请求失败';
    		echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
    	}
    }



    public function finish_room(){
    	$oldtime = date('Y-m-d H:i:s',time()-120); 
    	$finishtime = date('Y-m-d H:i:s',time()-3600); 
        $a = M('Room')->where("activitytime <= '$oldtime' and status != '2' and kind != '2' and 
        	                   s_time <= '$finishtime'")
                      ->select();

        //show房关掉,教学关掉
        foreach ($a as $k => $v){
        	$data['e_time']  = date('Y-m-d H:i:s',time());
			$data['status'] = 2;    
			M('Room')->where("r_id = '$v[r_id]'")->save($data);
			//更改直播间结束状态

			$b = M('Ub_guanxi')->where("zhubo_id = '$v[zhubo_id]' and room_id = '$v[room_id]'")->select();
			//查找这些房间的关系表
			foreach ($b as $k => $val){
				M('Ub_guanxi')->where("user_id = '$val[user_id]' and in_out = '0'")->delete('in_out',1);
			}//把每一个还没出去的观众状态都改成 不在直播间
        }

        $c = M('Room')->where("kind ='2' and activitytime <= '$oldtime' and status != '2'")
   		              ->setField('status',0);

    }

//直播列表   这个是以前的
	public function zhibo_list(){
		$this->finish_room();
	
		$page = I('page')?I('page'):1;
		$kind = I('kind')?I('kind'):0; 
		$order = 'tui DESC ,s_time';

		$today =  date('Y-m-d 00:00:00',time());  //把以前的预约排除
		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		
		$a = M('Room')->order($order)
					  ->join($join1)
					  ->limit(($page-1)*20,20)
					  ->field('piano_room.*,piano_users.headerimg,piano_users.nickname')
				      ->where("status != '2' and piano_room.kind = '$kind' and pinbi = '0'
				      	       and piano_room.s_time >= '$today'")
				      ->select(); //有预约的

		foreach ($a as $k => $v){
			if($v['kind'] != 0){
				// $a[$k]['y_truename'] = M('Yuyue')->where("zhubo_id = '$v[zhubo_id]' and 
				// 	                                      y_title_name = '$v[title_name]' and 
				// 	                                      kind = '$v[kind]' and y_status = '1'")
				//                                  ->getField('y_truename');
				$a[$k]['shoufei'] = M('Yuyue')->where("zhubo_id = '$v[zhubo_id]' and 
					                                   y_title_name = '$v[title_name]' and 
					                                   kind = '$v[kind]' and y_status = '1'")
											  ->order('yid DESC')
				                              ->getField('y_shoufei');

			}	
		}	
		
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';	
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';	
			$rest['data'] = $a;
			//$this->error2('操作失败',2,'暂无数据');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}


//我关注的列表
	public function my_focus_zhibo_list(){
		$id = I('userid');
		
		$a = M('Focus')->field('piano_room.room_id,piano_room.zhubo_id,piano_room.title_name,piano_room.status')
					   ->join('piano_room on piano_focus.f_fansid  = piano_room.zhubo_id')
				 	   ->where("f_userid = '$id' and f_status = 1")
				 	   ->select();

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$this->error2('操作失败',2,'亲，暂时没有数据噢');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}



//预约直播
	public function yuyue_zhibo(){
		$id = I('userid');
		$truename = I('truename');
		$phone = I('phone');
		$shoufei = I('shoufei');
		$titlename = I('titlename');
		$content = I('content');
		$kind = I('kind');
		$time = I('time');

		$now = date('Y-m-d H:i:s',time()+18000);
		$a = M('Yuyue')->where("zhubo_id = '$id' and kind ='$kind' and y_time >'$now' and 
			                    (y_status = '1' or y_status = '0')")->find();
		if($a){
		    $this->error2('操作失败',2,'已有同类预约');
		}
		// dump($a);exit;

		if($id && $titlename && $content && $kind && $phone){
			$data['zhubo_id'] = $id;
			$data['y_title_name'] = $titlename;
			$data['y_time'] = date('Y-m-d H:i:s',$time);
			$data['kind'] = $kind;
			$data['y_status'] = 0;
			$data['y_content'] = $content;
			$data['y_truename'] = $truename;
			$data['y_phone'] = $phone;
			$data['y_shoufei'] = $shoufei;
			$info = array('titlename'=>$titlename,'content'=>$content,'time'=>$time,'shoufei'=>$shoufei);
			$data['y_info'] = json_encode($info);

			$b = M('Yuyue')->add($data);
			if($b){
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
			}else{
				$this->error2('操作失败',2,'请联系管理员');
			}
		}else{
			$this->error1();
		}	
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}
	

//预约直播列表
	public function my_yuyue_list(){
		// M('Yuyue')->where("y_status = '3'")->delete();
		$id = I('userid');
		$page = I('page')?I('page'):1;
	
		$join = 'piano_yuyue on piano_yuyue.zhubo_id = piano_room.zhubo_id';
	
		$etime = date('Y-m-d H:i:s',time()-5*3600);
		M('Yuyue')->where("y_time <= '$etime' and zhubo_id = '$id'")->setField('y_status',3);

		//查所有没过期的预约  
		$a = M('Yuyue')->where("zhubo_id = '$id' and y_status != '3'")
		               ->order('yid DESC')
		               ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
		               ->field('y_truename, UNIX_TIMESTAMP(piano_yuyue.y_time) as time,y_status,
		               	        y_title_name,kind,headerimg')
		               ->limit(($page-1)*20,20)
		               ->select();

    	foreach ($a as $k => $v){
    		if($v['y_status'] == 1){
    			$a[$k]['room_id'] = M('Room')->where("piano_room.zhubo_id = '$id' and 
    				                                  title_name = '$v[y_title_name]' and 
    				                                  piano_room.kind  = '$v[kind]'")
    										 ->order('r_id DESC')
    							             ->getField('room_id');
  	                             
    		}
    	}
	    	
    	
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';
			$rest['data'] =array();
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}	


//打赏
	public function dashang(){
		$data['user_id'] = I('userid');
		$data['zhubo_id'] = I('zhubo_id');
		$data['room_id'] = I('room_id');
		$data['money_num'] = I('money_num');
		$data['pay_time'] = date('Y-m-d H-i-s',time());
		M('Users')->startTrans();

		$a = M('Users')->where("id = '$data[user_id]'")->find();
		$max = bccomp($a['money'], $data['money_num'],1);
		if($max == '-1'){
			$this->error2('操作失败',2,'余额不足');
		}

		if(!$data['user_id'] || !$data['zhubo_id'] || !$data['room_id'] || !$data['money_num']){
			$this->error2('打赏失败',2,'缺少参数');
		}
		$b = M('Enjoypay')->add($data);   //添加到打赏表

		$usermoney = M('Users')->where("id = '$data[user_id]'")->getField('money');
		$usernew = bcsub($usermoney,$data['money_num'],1);  //相减
		$c = M('Users')->where("id = '$data[user_id]'")->setField('money',$usernew);//用户钱更新

		$zhu = M('Users')->where("id = '$data[zhubo_id]'")->getField('money');
		$zhunew = bcadd($zhu,$data['money_num'],1);
		$d = M('Users')->where("id = '$data[zhubo_id]'")->setField('money',$zhunew);//主播钱更新

		$room = M('Room')->where("zhubo_id = '$data[zhubo_id]' and room_id = '$data[room_id]'")
		                 ->getField('total_money');
		$roomnew = bcadd($room,$data['money_num'],1);
		$e = M('Room')->where("zhubo_id = '$data[zhubo_id]' and room_id = '$data[room_id]'")
					  ->setField('total_money',$roomnew);  //房间收入更新


		if($b && $c && $d && $e ){
			M('Users')->commit();
			$zhubo_money = M('Users')->where("id = '$data[zhubo_id]'")->getField('money');
			$user_money = M('Users')->where("id = '$data[user_id]'")->getField('money');
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data']['zhubo'] = $zhubo_money;
			$rest['data']['user'] = $user_money;
		}else{
			M('Users')->rollback();
			$this->error2('操作失败',2,'请联系管理员');
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

	public function show_shouru(){
		$room_id = I('room_id');
		$a = M('Room')->where("room_id = '$room_id'")->order('r_id DESC')->getField('total_money');
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = true;
			$rest['msg'] = '亲，暂时没有数据噢';
			$rest['data'] = "";
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}

//禁言与解禁
	public function jinyan(){
		$user_id = I('userid');
		$zhubo_id = I('zhubo_id');
		$room_id = I('room_id');

		if($user_id == $zhubo_id){
			$this->error2('主播不可能禁言或举报自己',2,'主播不可能禁言或举报自己');
		}


		$a = M('Ub_guanxi')->where("user_id = '$user_id' and
								    zhubo_id = '$zhubo_id' and 
								    room_id = '$room_id'")
						   ->find();

		if($a['jinyan'] == 0){
			$data['jinyan'] = 1;
			$data['j_time'] = date('Y-m-d H-i-s',time());
			$b = M('Ub_guanxi')->where("user_id = '$user_id' and
								    	zhubo_id = '$zhubo_id' and 
								   		room_id = '$room_id'")
							   ->save($data);
			$rest['msg'] = '禁言成功';
			$rest['type'] = 1;
		}else{
			$b = M('Ub_guanxi')->where("user_id = '$user_id' and
								    	zhubo_id = '$zhubo_id' and 
								   		room_id = '$room_id'")
							   ->setField('jinyan',0);
			$rest['msg'] = '解禁成功';
			$rest['type'] = 0;

		}			   
		if($b){
			$rest['status'] = true;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '操作失败，请联系管理员';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
	}


//踢人
	public function tiren(){
		
		$user_id = I('userid');
		$zhubo_id = I('zhubo_id');
		$room_id = I('room_id');

		$a = M('Ub_guanxi')->where("user_id = '$user_id' and
								    zhubo_id = '$zhubo_id' and 
								    room_id = '$room_id'")
						   ->find();
					

		if($a['ti'] == 0 && $a['inout'] ==0){
			$data['ti'] = 1;
			$data['in_out'] = 1;
			$data['t_time'] = date('Y-m-d H-i-s',time());

			$b = M('Ub_guanxi')->where("user_id = '$user_id' and
									    zhubo_id = '$zhubo_id' and 
									    room_id = '$room_id'")
							   ->save($data);
		
		}
		if($b){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
		}else{
			$rest['status'] = false;
			$rest['msg'] = '操作失败，请联系管理员';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
	}

	

//点击头像查看资料
	public function show_user(){
		$id = I('userid');
		$room_id = I('room_id');
		$zb = M('Room')->where("room_id = '$room_id'")->getField('zhubo_id');
		$zhubo_id = I('zhubo_id')?I('zhubo_id'):$zb;
		

		$a = M('Users')->where("id = '$zhubo_id'")->field('nickname,id as userid,sex,headerimg,sign,lv as level')->find();

		$a['guanzhu'] = M('Focus')->where("f_fansid = '$zhubo_id' and f_status = '1'")->count();           
		$a['fans'] = M('Focus')->where("f_userid = '$zhubo_id' and f_status = '1'")->count();
		$a['send'] = M('Enjoypay')->where("user_id = '$zhubo_id'")->sum('money_num');
		if(!$a['send']){$a['send'] = 0;}
		$a['get'] = M('Enjoypay')->where("zhubo_id = '$zhubo_id'")->sum('money_num');
		if(!$a['get']){$a['get'] = 0;}

		$b = M('Ub_guanxi')->where("room_id = '$room_id'")->getField('zhubo_id');
		if($b == $zhubo_id){//如果看的是主播 主播不可能禁言或举报自己 所以禁言与举报是'我'
			$where = "room_id = '$room_id' and user_id = '$id'";
		}else{//禁言举报是其他用户
			$where = "room_id = '$room_id' and user_id = '$zhubo_id' ";
		}


		$d = M('Ub_guanxi')->where($where)
		                   ->find();
		    
		//在关系表里找到对应的关系 
		if($d){
			$a['jinyan'] = $d['jinyan'];
			$a['jiubao'] = $d['jiubao'];
		}
		
		$c = M('Focus')->where("f_fansid = '$id' and f_userid = '$zhubo_id'")->find();
		if($c){
			$a['gzzb'] = $c['f_status'];
		}else{
			$a['gzzb'] = "2";
		}
		//dump($a);exit;
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '操作失败，请联系管理员';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
	}

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

	public function upload_tiezi(){
		$file = $_FILES['file'];
		if($file){
			$upload = new \Think\Upload();// 实例化上传类
			//$upload->maxSize   =     1024*1024*5 ;// 设置附件上传大小
			$upload->exts = array('jpg','png','jpeg','mp4','rvmb','wmv','avi','mpeg','mov');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =  './Public/Uploads/tiezi/'; // 设置附件上传根目录
			
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
	
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));		
			}else{// 上传成功 获取上传文件信息

				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];

				// $a = stripos($file_name,'.jpeg');
				// $b = stripos($file_name,'.jpg');
				// $c = stripos($file_name,'.png');
				// $d = stripos($file_name,'.gif');    
				
				// if($a || $b || $c || $d){   //如果是图片，就把它处理下，变成200*200大小
				// 	$image = new \Think\Image(); 
				// 	$image->open($file_name);
				//  	$image->thumb(200, 200)->save($file_name);
				// }
				
				$rest['status'] = true;
				$rest['file_name'] = $file_name;
				$rest['msg'] = '上传成功';
				echo $this->json_encode_ex($rest);exit;			
			}
		}else{
			 $this->error2('上传失败',2,'未选择文件');	
		}
	}

	public function add_tiezi(){

		$id = I('userid');
		$data['l_type'] = I('type');
		$data['l_title'] = I('title');
		$data['l_content'] = I('content');
		$data['l_addtime'] = date('Y-m-d H:i:s',time());
		$img =I('img');
		if(is_array($img)){
			$img = implode(',',I('img'));
		}else{
			$img = $img;
		}
		// if($data['l_type'] == 1){
			$data['l_img'] = $img;
		// }elseif($data['l_type'] == 2){
			$data['l_video'] = I('video');
			$data['l_photo'] = I('photo');
		// }else{
			// $data['l_img'] = $img;
			$data['l_wadr'] = I('address');
			$data['l_wtime'] = I('wtime');
			$data['l_etime'] = I('etime');
		// }
	
		$a = M('Luntan')->where("l_userid = '$id' and l_title = '$data[l_title]'")->find();

		if($a){
			$this->error2('提交失败',2,'重复的提交');	
		}else{
			$data['l_userid'] = $id;
			$b = M('Luntan')->add($data);
		}

		if($data['l_type'] == 3){
			$c = M('Luntan')->where("l_userid = '$id' and l_title = '$data[l_title]'")->find();
			$d = M('Users')->where("id = '$id'")->find(); 
		}

		if($b){
			if($c && $d){
				$da['bm_tzid'] = $c['tiezi_id'];
				$da['bm_userid'] = $id;
				$da['bm_name'] =$d['nickname'];
				$da['bm_phone'] = $d['username'];
				$da['bm_num'] = 1;
				$da['bm_time'] = date('Y-m-d H:i:s',time());
				M('Baoming')->add($da);
			}
			
			M('Users')->where("id = '$id'")->setInc('score',4);

			$rest['status'] = true;
			$rest['msg'] = '发布成功';
			$rest['data'] = $b;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '操作失败，请联系管理员';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
	}

//帖子列表
	public function show_tiezi_list(){
		$id = I('userid');
		
		$type = I('type')?I('type'):1;
		$where = "l_type = '$type' and l_pinbi = '1' and l_content != '此贴已被删除'";
		$page = I('page')?I('page'):1;

		$order = I('order');
		if($order == 1){
			$where .= " and l_tuijian = '2'";
		}
		if($order == 2){
			$where .= " and l_jinhua = '2'";
		}
		if($order == 3){
			$where .= " and l_new = '2'";
		}
	
		$count = M('Luntan')->where($where)->count();

		$join ='piano_users on piano_users.id = piano_luntan.l_userid';

		$a = M('Luntan')->where($where)
						->join($join)
						->order('tiezi_id DESC')
						->limit(($page-1)*20,20)
						->field('piano_users.headerimg,piano_users.nickname,piano_luntan.tiezi_id,
								 piano_luntan.l_addtime,piano_luntan.l_title,piano_luntan.l_img
								 ,piano_luntan.l_video,piano_luntan.l_photo,piano_luntan.l_userid,
								 piano_luntan.l_history_num,piano_users.id,piano_luntan.l_content,piano_luntan.l_title')
		                ->select();
		foreach ($a as $k => $v){
			if($v['l_img']){
				$a[$k]['l_img'] = explode(',',$v['l_img']);
			}else{
				$a[$k]['l_img'] = array();
			}
			
			
			$a[$k]['shoucang_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_shoucang = '2'")->count();
			$a[$k]['zan_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$a[$k]['pinlun'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
			if($id){
				$b = M('Focus')->where("f_userid = '$v[l_userid]' and f_fansid = '$id'")
                               ->find();
                if($b){
                	if($b['f_status'] == 1){
                		$a[$k]['guanzhu'] = 1;
                	}else{
                		$a[$k]['guanzhu'] = 2;
                	}
                }else{
                	$a[$k]['guanzhu'] = 2;
                } 

                $c = M('Ltguanxi')->where("lg_userid = '$id' and tz_id = '$v[tiezi_id]' and lg_shoucang = '2'")->find();
                if($c){
                	$a[$k]['shoucang'] = 2;
                }else{
                	$a[$k]['shoucang'] = 1;
                }
			}
		}
		// dump($a);exit;
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data']['count'] = $count;
			$rest['data'] = $a;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
	}

	public function tiezi_xiang(){
		$userid = I('userid');
		$page = I('page')?I('page'):1;
		$id = I('tz_id');
		$first = I('first');

		if($first == 1){
			M('Luntan')->where("tiezi_id = '$id'")->setInc('l_history_num',1);//进来一个人数加1
		}
		

		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$a = M('Luntan')->where("tiezi_id = '$id'")
						->join($join)
						->field('piano_users.headerimg,piano_users.nickname,piano_luntan.*')
		                ->find();


		if($a['l_img']){
			$a['l_img'] = explode(',',$a['l_img']);
		}else{
			$a['l_img'] = array();
		}

		$a['zan_num'] = M('Ltguanxi')->where("tz_id = '$id' and lg_zan = '2'")->count();
		$d =  M('Ltguanxi')->where("tz_id = '$id' and lg_userid = '$userid'")->find();
		if(!$d){
			$a['shoucang'] = 1;
			$a['zan'] = 1;
		}else{
			$a['shoucang'] = $d['lg_shoucang'];
			$a['zan'] = $d['lg_zan'];
		}
		
		$e = M('Focus')->where("f_userid = '$a[l_userid]' and f_fansid = '$userid' and f_status = '1'")
		               ->find();
	
        if($e){
        	$a['guanzhu'] = 1;
        }else{
        	$a['guanzhu'] = 2;
        }

		
		$c= M('Baoming')->where("bm_tzid = '$id' and bm_userid = '$userid'")->find();
		if($c){
			$a['baoming'] = 1;
		}else{
			$a['baoming'] = 2;
		}

		$g = M('Baoming')->where("bm_tzid = '$id'")->field('bm_name,bm_time')->select();
		foreach ($g as $k => $v) {
			$h[$k] = $v['bm_name'].'   '.$v['bm_time'].'\n\n';
			$a['baoming_list'] .=$h[$k];
		}
		if(!$a['baoming_list']){
			$a['baoming_list'] = "";
		}
		
		$join1 = 'piano_users on piano_users.id = piano_reply.re_userid';
		$b = M('Reply')->where("retz_id = '$id' and re_fen ='1'")
					   ->join($join1)
					   ->field('piano_users.headerimg,piano_users.nickname,piano_reply.*')
					   ->limit(($page-1)*10,10)
		               ->select();


		$rest['reply'] = $b;
		$a['reply_num'] = count($b);
		$a['zan_num'] = M('Ltguanxi')->where("tz_id = '$id' and lg_zan ='2'")->count();


		// dump($a);exit;
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
		}
	echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
	}



	public function huitie(){
		$data['retz_id'] = I('tz_id');
		$data['re_userid'] = I('userid');
		$data['re_duixiang'] = I('duixiang');
		$data['re_receiveid'] = I('receiveid');
		$data['re_content'] = I('content');
		$data['re_time'] = date('Y-m-d H:i:s',time());

		if(I('tz_id') && I('userid') && I('content')){
			$a = M('Reply')->add($data);
			M('Users')->where("id = '$data[re_userid]'")->setInc('score',2);

			$b = M('Luntan')->where("tiezi_id = '$data[retz_id]'")->find();

			$list['x_userid'] = $b['l_userid'];        //发贴人id
			$list['x_tuisong'] = $data['re_userid'];   //回贴人id
			$list['x_content'] = '您的贴子有人回复了，请点击查看详情';
			$list['x_type'] = 4;
			$list['x_kid'] = $data['retz_id'];
			$list['x_time'] = date('Y-m-d H:i:s',time());
		
			if($b['l_type'] == 1){
				$list['x_info'] =json_encode(array('l_type'=>1));
			}elseif($b['l_type'] == 2){
				$list['x_info'] =json_encode(array('l_type'=>2));
			}else{
				$list['x_info'] =json_encode(array('l_type'=>3));
			}
			
			$c = M('User_xiaoxi')->add($list);

			if($a){
				$rest['status'] = true;
				$rest['msg'] = '操作成功';
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
			}else{
				$this->error2('操作失败',2,'请联系管理员');
			}
		}else{
			$this->error2('操作失败',2,'缺少必填参数');
		}
	}

	public function tiezi_zan(){
		$data['tz_id'] = I('tz_id');
		$data['lg_userid'] = I('userid');
		$a = M('Ltguanxi');

		$b = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")->find();
		if($b){
			if($b['lg_zan'] ==1){
				$c = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")
				       ->setField('lg_zan',2);   //点赞
				$rest['num'] = 1;
				M('Users')->where("id = '$data[lg_userid]'")->setInc('score',2);
				$rest['msg'] = '点赞成功';
			}else{
				$c = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")
				       ->setField('lg_zan',1);   //取消点赞
				$rest['num'] = -1; 
				M('Users')->where("id = '$data[lg_userid]'")->setDec('score',2);  
				$rest['msg'] = '取消点赞';
			}	
		}else{
			$data['lg_zan'] =2;
			$c = $a->add($data);   //新用户点赞
			$rest['num'] = 1;
			M('Users')->where("id = '$data[lg_userid]'")->setInc('score',2);
			$rest['msg'] = '点赞成功';
		}

		if($c){
			$rest['status'] = true;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
		}else{
			$this->error2('操作失败',2,'请联系管理员');
		}
	}

	public function tiezi_shoucang(){
		$data['tz_id'] = I('tz_id');
		$data['lg_userid'] = I('userid');
		$a = M('Ltguanxi');

		$d = M('Luntan')->where("tiezi_id = '$data[tz_id]'")->getField('l_userid');
		if($d == $data['lg_userid']){
			$this->error2('不能收藏自己的帖子',2,'不能收藏自己的帖子');
		}

		$b = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")->find();
		if($b){
			if($b['lg_shoucang'] ==1){
				$c = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")
				       ->setField('lg_shoucang',2);   //收藏
				$rest['msg'] = '收藏成功';
			}else{
				$c = $a->where("tz_id = '$data[tz_id]' and lg_userid = '$data[lg_userid]'")
				       ->setField('lg_shoucang',1);   //取消收藏
				$rest['msg'] = '取消收藏成功';
			}	
		}else{
			$data['lg_shoucang'] =2;
			$c = $a->add($data);   //新用户收藏
			$rest['msg'] = '收藏成功';
		}

		if($c){
			$rest['status'] = true;
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
		}else{
			$this->error2('操作失败',2,'请联系管理员');
		}
	}


	public function baoming(){
		$data['bm_tzid'] = I('tiezi_id');
		$data['bm_userid'] = I('userid');
		$data['bm_phone'] = I('phone');
		$data['bm_name'] = I('name');
		$data['bm_sex'] = I('sex');
		$data['bm_age'] = I('age');
		$data['bm_num'] = I('num')?I('num'):1;
		$data['bm_text'] = I('text');
		$data['bm_time'] = date('Y-m-d H:i:s',time());

		if(I('tiezi_id') && I('userid')){
			$b = M('Baoming')->where("bm_tzid = '$data[bm_tzid]' and bm_userid = '$data[bm_userid]'")->find();
			if($b){
				$rest['status'] = false;
				$rest['msg'] = '不能重复报名';
				echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
			}
			$a= M('Baoming')->add($data);
		}else{
			$this->error1();
		}
		
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '报名成功';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;		
		}else{
			$this->error2('报名失败',2,'请联系管理员');
		}

	}

//生成唯一订单号
	public function new_order_num(){
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn = $yCode[(intval(date('Y')) - 2000)%10] .$_SESSION['piano_user']['id'].substr(time(), -5).
						   strtoupper(dechex(date('m'))) .date('d') .dechex(date('ym')). 
						   rand(100,999). substr(microtime(),2,5) . 
						   sprintf('%02d', rand(10, 99));
		$a = M('Xnb_record')->where("xf_num = '$orderSn'")->find();
		if($a){
			$this->new_order_num();
		}
		return $orderSn;
		
}

//充值
	public function chongzhi(){
	

 		$data['xf_userid'] =I('userid');//充值者
        $data['xf_money'] = I('money');//金额
        $data['xf_type'] = 1;
        $data['xf_point'] = I('point');
        $data['xf_time'] = date('Y-m-d H:i:s',time());//时间
  		$data['xf_num'] = $this->new_order_num();
		$data['xf_status'] = 1;           //不成功
		$data['xf_kind'] = I('kind');    //1支付宝   2微信   
		$c = M('Convert')->where("c_money <= '$data[xf_money]' and c_type = '1'")
		                 ->order('convert_id DESC')
		                 ->find();
		                 // dump($c);exit;
		$num = bcdiv($data['xf_money'],$c['c_money'],1);
		$point = bcmul($num,$c['c_point'],1);   //计算得到的点数
		$k = bccomp($point,$data['xf_point'],1);  //比较算出来的点数和前端传过来的点数
	/*	if($k != 0){
			$result['status']=false;
            $result['message']='乐币数量不对';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
		}*/
		
		$a = M('Users')->where("id = '$data[xf_userid]'")->find();
		if($a['role'] == 2){
			$data['xf_turename'] = M('Teacher')->where("t_userid = '$data[xf_userid]'")->getField('t_truename');
		}else{
			$data['xf_turename'] = M('Users')->where("id = '$data[xf_userid]'")->getField('nickname');
		}
		$data['xf_phone'] = $a['username'];
		
		// dump($data);exit;
		$b = M('Xnb_record')->add($data);
		if($b){
			if($data['xf_kind'] ==2){
				$result['Wxpay'] = $this->careat_Wxpay_sn($data['xf_num'], $data['xf_money'], '乐乐gogo支付');
			}
			
            $result['status'] = true;
            $result['message'] = '记录添加成功';
            $result['orderSn'] = $data['xf_num'];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }else{
            $result['status']=false;
            $result['message']='记录添加失败';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }
	}


//生成微信预付单号
    public function careat_Wxpay_sn($order_sn,$price,$type){
        require_once "./Piano/Home/Common/WxPay/lib/WxPay.Api.php";
        require_once "./Piano/Home/Common/WxPay/lib/WxPay.Config.php";
        require_once "./Piano/Home/Common/WxPay/lib/WxPay.Data.php";
        require_once "./Piano/Home/Common/WxPay/lib/WxPay.Exception.php";
        require_once "./Piano/Home/Common/WxPay/lib/WxPay.Notify.php";
        $price =$price*100;
        $input = new \WxPayUnifiedOrder();

        $input->SetBody("乐乐gogo--".$type);
        $input->SetAttach("乐乐gogo");
        $input->SetOut_trade_no($order_sn);
        $input->SetTotal_fee($price);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("乐乐gogo");

        $input->SetNotify_url("http://123.207.28.75/gangqing/Wxpay_callback.php");
            
        $input->SetTrade_type("APP");
        $order = \WxPayApi::unifiedOrder($input);
        $order = \WxPayApi::unifiedOrder($input);

        $data['appid'] = $order['appid'];
        $data['partnerid'] = $order['mch_id'];
        $data['package'] = "Sign=WXPay";
        $data['noncestr'] = $order['nonce_str'];
        $data['prepayid'] = $order['prepay_id'];
        $time = time();    //哪个狗日的啊，把时间戳改成了日期，把我坑的

        $data['timestamp'] = $time;
        //签名步骤一：按字典序排序参数
        ksort($data);
        $buff = "";
        foreach($data as $k => $v){
            $buff .= $k . "=" . $v . "&";
        }
        $buff = trim($buff, "&");
        //签名步骤二：在string后加入KEY
        $string = $buff . "&key=".\WxPayConfig::KEY;
       
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $order['sign'] = strtoupper($string);
        $order['timestamp'] = $time;
        $pay_order = array();
        $pay_order['noncestr'] = $order['nonce_str'];
        $pay_order['sign'] = $order['sign'];
        $pay_order['timestamp'] = $time;
        $pay_order['prepayid'] = $order['prepay_id'];
        $pay_order['partnerid'] = $order['mch_id'];
        $pay_order['package'] = $data['package'];
        $pay_order['appid'] = $order['appid'];
        //重新签名
        return $pay_order;
    }


//充值记录
    public function chongzhi_record(){
        $userid=I('userid');
        $Ch=M('Xnb_record');
        $page = I('page')?I('page'):1;
        $num = I('num')?I('num'):10;
        $data=$Ch->where("xf_userid = '$userid' and xf_type = '1'")
                 ->field('xf_time,xf_point,xf_status')
                 ->order('xf_time desc')
                 ->limit(($page-1)*$num,$num)
                 ->select();

        if($data){
          	$result['status']=true;
          	$result['message']='查询充值记录成功';
          	$result['data']=$data;
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }else{
          	$result['status']=true;
          	$result['message']='查无数据';
          	$result['data']=array();
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }
    }

    public function show_convert(){
    	$type = I('type');
    	$a = M('Convert')->where("c_type = '$type'")->select(); 
    	if($a){
          	$result['status']=true;
          	$result['message']='查询成功';
          	$result['data']=$a;
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }else{
          	$result['status']=true;
          	$result['message']='查无数据';
          	$result['data']=array();
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }
    }

//申请提现接口
    public function tixian(){
		$orderSn = $this->new_order_num();         //订单号
        $userid=I('userid');				 //提现者ID  
        $data['xf_userid']=$userid;
        $data['xf_num'] = $orderSn;
        $data['xf_point']=I('point');    //本次提现需要的点数
        $money = I('money');
        $ss = M('Convert')->where("c_type = '2'")->find();
        $data['xf_money'] = bcdiv($data['xf_point'],$ss['c_point'],2);  //可提现出来的现金数额

        $data['xf_acc']=I('account');    //提现对应的账户
        $data['xf_kind'] = 1;   //支付宝才能做提现  微信不行
        $data['xf_turename'] = I('turename');  //支付宝账户的真实姓名
        $data['xf_time']=date('Y-m-d H:i:s',time());
        $data['xf_status'] = 3;   //申请中
        $data['xf_type'] = 3;	  //提现

        $max = bccomp($money, $data['xf_money'],2);
        if($max != 0){
        	$result['status']=false;
            $result['message']='金额不符合提现兑换率';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }

        if(!I('account') || !I('turename') || !I('money') || !I('point')){
        	$this->error1();
        }
        M('Users')->startTrans();
        $a = M('Xnb_record')->where("xf_userid='$userid'")->find();

        $max = bccomp($a['money'],$point,1);  //浮点数比较 用特殊方法
        if($max == '-1'){
        	$this->error2('申请失败',2,'余额不足');
        }
        
        $b = M('Xnb_record')->add($data);
        $c = M('Users')->where("id = '$userid'")->find();

        $money = bcsub($c['money'],$data['xf_point'],1);
        $d = M('Users')->where("id = '$userid'")->setField('money',$money);//能申请就先扣钱
        if($b && $d){    
        	M('Xnb_record')->commit();
            $result['status']=true;
            $result['message']='提现申请提交成功';
            $result['orderSn'] = $orderSn;
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }else{
        	M('Xnb_record')->rollback();
            $result['status']=false;
            $result['message']='提现申请提交失败，SQL错误';
            echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }
    }

//提现记录
    public function tixian_record(){
        $userid=I('userid');
        $Tixian=M('Xnb_record');
        $page = I('page')?I('page'):1;
        
        $a = $Tixian->where("xf_userid = '$userid' and xf_type = '3'")
                    ->limit(($page-1)*10,10)
                    ->order('xf_time desc')
                    ->select();
      
        if($a){
          	$result['status'] = true;
          	$result['message'] = '查询提现记录成功';
          	$result['data'] = $a;
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }else{
          	$result['status']=true;
          	$result['message']='查无数据';
          	$result['data']=array();
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
        }
    }





//展示我的订单
    public function show_my_order(){
    	$id = I('userid');
    	$where = "go_userid = '$id'";
    	$type = I('status');   //我的侍支付 1 已完成 2    还有全部页面 不传
    	$page = I('page')?I('page'):1;
    	if($type == 1){
    		$where .= " and go_status = 1 ";
    	}
    	if($type == 2){
    		$where .= " and go_status = 2 ";
    	}

    	$field = 'go_name,go_num,go_money,go_userid,go_time,go_status,go_kind,go_price';

    	$a = M('Goods_order')->where($where)
    	                     ->limit(($page-1)*10,10)
    	                     ->order('go_time DESC')
    	                     ->field($field)
    	                     ->select();
    	//查找符合条件的订单  
    	// dump($a);exit;
    	foreach ($a as $k => $v) {
    		$name = explode(',',$v['go_name']);
    		$good_id = $name[0];   //得到第1个的room_id
   			// dump($name);exit;

    		$b = M('Yuyue')->where("y_roomid = '$good_id'")->find();

    		if($b['kind'] == 0){
    			$a[$k]['go_name'] = $b['y_title_name'];
    		}else{
    			$c = M('Yuyue')->where("yid = '$b[y_part]'")->find();
    			$a[$k]['go_name'] = $c['y_title_name'];
    			$a[$k]['img'] = $c['y_img'];
    		}	
    	}

    	if($a){
			$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
  	}

  	public function order_xiang(){

  		$userid = I('userid');
  		$num = I('orderSn');//通过订单找到go_name  来判断 它是show  还是培训
        $g = M('Goods_order')->where("go_num = '$num'")->getField('go_name');

        $g = explode(',',$g);


        $a = M('Yuyue')->where("y_roomid = '$g[0]'")->getField('y_part');
      
        $b = M('Yuyue')->where("yid = '$a'")->find();
        $b['headerimg'] = M('Users')->where("id = '$b[zhubo_id]'")->getField('headerimg');
        $b['name'] = M('Zhubo_reg')->where("zb_id = '$b[zhubo_id]'")->getField('zhubo_truename');

        foreach ($g as $k => $v){
        	$b['ke'][$k] = M('Yuyue')->where("y_roomid = '$v'")
        	                         ->join('piano_room on piano_room.room_id = piano_yuyue.y_roomid')
        	                         ->find();

        	$b['ke'][$k]['headerimg'] = M('Users')->where("id = '$b[zhubo_id]'")->getField('headerimg');
            $b['ke'][$k]['name'] = M('Zhubo_reg')->where("zb_id = '$b[zhubo_id]'")
                                                 ->getField('zhubo_truename');
           
            $c = M('Room')->where("room_id = '$v'")->getField('url');

            $d = $this->PlayInfoimg($c);//通过这个接口去查地址
			$e = $d['fileSet'][0]['playSet'][0];
			$b['ke'][$k]['url'] = $e['url'];
        }
       
		
  		if($b){
			$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$b;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
  	}

//取消订单
  // 	public function del_my_order(){
  // 		$oid = I('oid');
  // 		$a = M('Goods_order')->where("oid = '$oid'")->find();
  // 		if($a['go_status'] == 2){
  // 			$this->error2('操作失败',2,'已付款，只能申请退款');
  // 		}

  // 		$b = M('Goods_order')->where("oid = '$oid'")->setField('go_type',5);
  		
		// if($b){
		// 	$result['status']=true;
		// 	$result['message']='取消成功';
		// 	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
  //   	}else{
  //   		$result['status']=false;
		// 	$result['message']='取消失败';
		// 	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
  //   	}
  // 	}

//展示我收藏的帖子
    public function show_tiezi_shoucang(){
    	$id = I('userid');
    	$type = I('l_type');
    	$page = I('page')?I('page'):1;
    	$a = M('Ltguanxi')->where("l_type = '$type' and lg_userid = '$id' and lg_shoucang = '2' and l_content != '此贴已被删除'")
    					  ->join('piano_luntan on piano_luntan.tiezi_id = piano_ltguanxi.tz_id')
    					  ->join('piano_users on piano_users.id = piano_luntan.l_userid')
    					  ->field('piano_luntan.*,piano_users.headerimg,piano_users.nickname')
    					  ->limit(($page-1)*20,20)
    					  ->group('tiezi_id')
    					  ->select();
    	foreach ($a as $k => $v){
    		if($v['l_img']){
    			$a[$k]['l_img'] = explode(',',$v['l_img']);
    		}else{
    			$a[$k]['l_img'] =array();
    		}	
    		if($v['l_type'] == 3){
    			$a[$k]['shoucang_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and 
    				                                           lg_shoucang = '2'")
    			                                      ->count();
    		}
    		$b = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_userid = '$id' and lg_zan = '2'")
    		                  ->find();
    		if($b){
    			$a[$k]['zan'] = 2;
    		}else{
    			$a[$k]['zan'] = 1;
    		}

    		$c = M('Focus')->where("f_userid = '$v[l_userid]' and f_fansid = '$id'")
                           ->find();
            if($c){
            	if($c['f_status'] == 1){
            		$a[$k]['guanzhu'] = 1;
            	}else{
            		$a[$k]['guanzhu'] = 2;
            	}
            }else{
            	$a[$k]['guanzhu'] = 2;
            } 

            $a[$k]['zan_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")
    		                                 ->count();

    		$a[$k]['pinlun'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
    	}
    	//dump($a);exit;
    	if($a){
			$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
    }


//Top10系列   
    public function hot_tiezi(){
    	$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
    	$a = M('Luntan')->order('l_history_num DESC , l_addtime DESC')
    	                ->where("l_pinbi = '1' and l_type = '1' and l_content != '此贴已被删除'")
    	                ->join($join)
    	                ->field('id,headerimg,nickname,tiezi_id,l_addtime,l_title')
    	                ->limit(10)
    	                ->select();
    	foreach($a as $k =>$v){
    		$a[$k]['zan_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")
    		                                 ->count();
    		if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}  
    	}             
    		     

    	if($a){
    		$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
    }

    public function hot_shipin(){
    	$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$a = M('Luntan')->order('l_history_num DESC , l_addtime DESC')
    	                ->where("l_pinbi = '1' and l_type = '2'")
    	                ->join($join)
    	                ->field('id,headerimg,nickname,tiezi_id,l_title,l_video,
    	                	     l_photo,l_history_num')
    	                ->limit(10)
    	                ->select();
    	foreach($a as $k =>$v){
    		$a[$k]['zan_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")
    		                                 ->count();
    		if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}  
    	}
    	if($a){
    		$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
    }

    public function hot_huodong(){
    	$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$a = M('Luntan')->order('l_history_num DESC , l_addtime DESC')
    	                ->where("l_pinbi = '1' and l_type = '3'")
    	                ->join($join)
    	                ->field('id,headerimg,nickname,tiezi_id,l_img,l_title,l_addtime')
    	                ->limit(10)
    	                ->select();
    	foreach($a as $k => $v){
    		if($v['l_img']){
    			$a[$k]['l_img'] = explode(',',$v['l_img']);
    		}else{
    			$a[$k]['l_img'] = array();
    		}
    		$a[$k]['zan_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")
    		                                 ->count();
    		$a[$k]['shoucang_num'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and 
    			                                           lg_shoucang = '2'")
    		                                      ->count();
    		if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}  
    	}
    	
    	if($a){
    		$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
    }

   public function hot_shoucang(){
		$a = M('Songs_list')->order('list_bofang DESC ,list_xiazai DESC , list_shoucang DESC')
    	                    ->limit(10)
    	                    ->where("list_status=1")
    	                    ->field('lid,list_name as name,list_url as url,
    	                    	     list_url_music as music')
    	                    ->select();
    	if($a){
    		$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}else{
    		$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
    	}
    }
//查看我的绑定设备
	public function show_bang_shebei(){
		$id = I('id');
		$a = M('Shebei')->where("sb_userid = '$id'")->field('sb_userid,sb_hao')->select();
		if($a){
			$result['status']=true;
			$result['message']='查询成功';
			$result['data']=$a;
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
		}else{
			$result['status']=false;
			$result['message']='查无结果';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
		}
	}

//删除设备已认证过的账号
  	public function del_renzhen_shebei(){
	    $id = I("id");
	//    $hao = I('sb_hao');
	    $hao = M('Shebei')->where("sb_userid = '$id'")->getField('sb_hao');
	    $a = M("Shebei")->where("sb_userid = '$id'")->delete();   //删除这个记录
	    $b= M('Shebei')->where("sb_hao ='$hao'")->order('sb_addtime DESC')->limit(1)->select();  
	    //查找这个设备的新记录
	  	if($b){
	      	$data['piano_bang_userid'] = $b[0]['sb_userid'];
	      	$data['piano_bangtime'] = $b[0]['sb_addtime'];  
	  	}else{
	      	$data['piano_bang_userid'] = NULL;
	      	$data['piano_bangtime'] = NULL;
	      	$data['piano_is_bang'] = 1;
	        //如果设备表里找不到该设备的记录，则判定它没有绑用户了
	  	}
		M('Piano')->where("piano_bianhao = '$hao'")->save($data);  //更新设备表

	    $user = M("Shebei")->where("sb_userid = '$id'")->find();   
	        if(!$user){
	            M('Users')->where("id = '$id'")->setField('rz_status',2);  
	            //当设备记录里没有该用户后，更改认证状态
	      	}
	    if($a){
	        $result['status']=true;
			$result['message']='删除成功';
	    }else{
	    	$result['status']=false;
			$result['message']='删除失败，请与管理员联系';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	   
  	}

  	public function jiubao(){
  		$id = I('userid');
  		$room_id = I('room_id');
  		$zhubo_id = I('zhubo_id');
  		$text = I('text');
  		if(!$id || !$room_id || !$zhubo_id){
  			$this->error('操作失败，缺少参数');
  		}

  		if($id == $zhubo_id){
  			$this->error2('主播不可能禁言或举报自己',2,'主播不可能禁言或举报自己');
  		}
  		$a = M('Ub_guanxi')->where("user_id = '$id' and zhubo_id = '$zhubo_id' and room_id = '$room_id'")
  		                   ->find();

  		if($a){
  			$data['jiubao'] = 2; $data['jiubao_text'] = $text; 
  			$b = M('Ub_guanxi')->where("user_id = '$id' and zhubo_id = '$zhubo_id' and room_id = '$room_id'")
  		                       ->save($data);
  		}else{
  			$data['user_id'] = $id; $data['room_id'] = $room_id;$data['jiubao'] = 2;
  			$data['zhubo_id'] = $zhubo_id; $data['jiubao_text'] = $text;
  			$b = M('Ub_guanxi')->add($data);
  		}

  		if($b){
	        $result['status']=true;
			$result['message']='操作成功';
	    }else{
	    	$result['status']=false;
			$result['message']='操作失败';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

//风云榜  财富top10
  	public function money_top10(){
  		$a = M('Users')->order('money DESC')
  		               ->limit(10)
  		               ->field('id as userid,nickname,sex,headerimg,sign,money')
  		               ->select();

  		foreach ($a as $k => $v) {
  			if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}
  		}

		if($a){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $a;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

  	public function fans_top10(){
  		$a = M('Focus')->where("f_status = '1'")
  					   ->field('f_userid as userid,count(*) as fans_number,nickname,sex,sign,headerimg,lv as level')
  					   ->group('f_userid')
  					   ->join('piano_users on piano_users.id = piano_focus.f_userid')
  					   ->order('count(*) DESC')
  					   ->limit(10)
  					   ->select();
  		// dump($a);exit;

		foreach ($a as $k => $v) {
			if(empty($a[$k]['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($a[$k]['sign'])){
				$a[$k]['sign'] = '';
			}	
		}

  		if($a){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $a;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

//勤奋榜
  	public function work_top10(){
  		$a = M('Practice_log')->field('sum(log_long) as total,log_userid as id')
  							  ->group('log_userid')
  							  ->order('sum(log_long) DESC')
  							  ->limit(10)
  							  ->select();

  		foreach ($a as $k => $v){
  			$b[$k] = M('Users')->where("id = '$v[id]'")->field('id as userid,nickname,headerimg,sex,sign')->find();
  			$b[$k]['total'] = $v['total'];
  			if(empty($b[$k]['nickname'])){
				$b[$k]['nickname'] = '';
			}
			if(empty($b[$k]['sign'])){
				$b[$k]['sign'] = '';
			}
			
  		}

  		if($b){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $b;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

//满分榜
  	public function full_work_top10(){
        $a = M('Practice_log')->field('count(*) as count,log_userid as id')
                              ->where("log_point = '100'")
	                          ->group('log_userid')
	                          ->order('count(log_point) DESC')
	                          ->limit(10)
	                          ->select();


     	foreach ($a as $k => $v) {
     		$b[$k] = M('Users')->where("id = '$v[id]'")->field('id as userid,nickname,headerimg,sex,sign')->find();
     		$b[$k]['count'] = $v['count'];
     		if(empty($b[$k]['nickname'])){
				$b[$k]['nickname'] = '';
			}
			if(empty($b[$k]['sign'])){
				$b[$k]['sign'] = '';
			}
			
     	}
       
		if($b){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $b;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

  	public function dianpin_top10(){
  		$a = M('Advice')->group('ad_user')
  		                ->order('count(ad_user) DESC')
  		                ->join('piano_users on piano_users.id = piano_advice.ad_user')
  		                ->field('id as userid,nickname,sex,headerimg,count(ad_user) as count')
  		                ->limit(10)
  		                ->select();
  		foreach ($a as $k => $v) {
  			if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}
  		}
  		            
  		if($a){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $a;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}

  	public function luntan_top10(){
  		$a = M('Luntan')->where("l_jinhua = '2'")
  						->group('l_userid')
  						->join('piano_users on piano_users.id = piano_luntan.l_userid')
  						->order('count(l_jinhua) DESC')
  						->field('id as userid,nickname,sex,headerimg,count(l_jinhua) as count')
  						->limit(10)
  						->select();
  		foreach ($a as $k => $v) {
  			if(empty($v['nickname'])){
				$a[$k]['nickname'] = '';
			}
			if(empty($v['sign'])){
				$a[$k]['sign'] = '';
			}
  		}

        if($a){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $a;
	    }else{
	    	$result['status']=false;
			$result['message']='亲，暂时没有数据噢';
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}


//我收藏的曲子
  	public function show_my_songs(){
  		$id = I('userid');
  		$page =I('page')?I('page'):1;
  		$num = I('num')?I('num'):10;

  		$a = M('Songs_collection')->where("sc_userid = '$id' and sc_status = '1'")
  								  ->join('piano_songs_list on piano_songs_list.lid = piano_songs_collection.lid')
  								  ->field('piano_songs_list.lid,piano_songs_list.list_url,
  								  		   piano_songs_collection.sc_status,
  								  	       piano_songs_list.list_name,piano_songs_list.list_url_music')
  								  ->limit(($page-1)*$num,$num)
  		                          ->select();

  		if($a){
	        $result['status']=true;
			$result['message']='查询成功';
			$result['data'] = $a;
	    }else{
	    	$result['status']=true;
			$result['message']='亲，暂时没有数据噢';
			$result['data'] = array();
	    }
	    echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}


//检查是否收藏曲子
   	public function check_shoucang(){
 
  		$id = I('userid');
  		$lid = I('lid');
  		if(!$id || !$lid){
  			$this->error1();
  		}
  		
  		$a = M('Songs_collection')->where("lid = '$lid' and sc_userid = '$id'")->find();
  		if($a){
  			if($a['sc_status'] == 1){
  				$result['status']=true;
				$result['message']='已收藏';
  			}else{
  				$result['status']=false;
				$result['message']='没有收藏';
  			}
  		}else{
  			$result['status']=false;
			$result['message']='没有收藏';
  		}
  		echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
  	}



  // 	public function tixin(){
  		
  // 		ignore_user_abort(TRUE);//关掉浏览器，PHP脚本也可以继续执行.   
  //   	set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去   
  //  		$interval = 1800;// 每隔Xs运行 
				
  // 		$time = time()+3600;
  // 		$now = time();
  // 		$a = M('Memo')->where("memo_stime <= '$time' and memo_stime > '$now'")->select();//查找所有时间临近的备忘录
  // 		foreach ($a as $k => $v){
  // 			$b = M('Token')->where("t_userid = '$v[memo_userid]'")->find();
  // 			$shebei = $b['t_shebei'];
  // 			$type = $b['t_leixin'];
  // 			$userid = $v['memo_userid'];
  // 			$mini = ($v['memo_stime']-$now)/60;
  // 			$content = "您的备忘录有一条记录，离开始时间还剩".$mini."分钟";
  // 			if($shebei && $type){
  // 				$this->message_tuisong($content,$shebei,$type,$userid);
  // 			}
  // 		}
  		
  // 		$c = M('Course_list')->where("cl_status = '1' and cl_stime <='$time' and cl_stime >'$now'")->select();  //查找所有时间临近的有课学生
  // 		foreach ($c as $k => $v){
  // 			$name = explode(',',$v['cl_stuid'].','.$v['cl_tid']);
  // 			$mini = ($v['cl_stime']-$now)/60;

  // 			foreach ($name as $key => $value) {
  // 				$d = M('Token')->where("t_userid = '$value'")->find();
  // 				$shebei = $d['t_shebei'];
	 //  			$type = $d['t_leixin'];
	 //  			$userid = $value;
	 //  			$content = "您有一堂课就快要开始上课了，时间还剩".$mini."分钟";
	 //  			if($shebei && $type){
		//   			$this->message_tuisong($content,$shebei,$type,$userid);
		//   		}
  // 			}
  // 		}


  // 		$e = M('Room')->where("status = '0' and s_time <= '$time'")->select();
  // 		foreach ($e as $k => $v) {
  // 			$mini = (strtotime($v['s_time'])-$now)/60;
  // 			$f = M('Token')->where("t_userid = '$v[zhubo_id]'")->find();

  // 			$shebei = $f['t_shebei'];
	 //  		$type = $f['t_leixin'];
	 //  		$userid = $v['zhubo_id'];
	 //  		$content = "您有一次预约马上就要开播了，时间还剩".$mini."分钟";
	 //  		if($shebei && $type){
	 //  			$this->message_tuisong($content,$shebei,$type,$userid);
	 //  		}
  // 		}

  // 		//$g = M('Banner')->select();   //防止它为false?
		// sleep($interval);
   		
  // 	}
 

 	public function msg_tuisong(){
 		header('content-type:text/html;charset=utf8');
		require_once('./Piano/Common/Common/jpush.php');

 		$content = I('content');
 		$id = I('id');
 		$a = M('Token')->where("t_userid = '$id'")->find();
 		$shebei = $a['t_shebei'];
 		$type = $a['t_leixin'];
		// echo $shebei;exit;
 		$b = $this->message_tuisong1($content,$shebei,$type,$id);
 		dump($b);exit;
 	}

//参数,@内容、@设备号、@类型：1安卓，2苹果、@用户id
	private function message_tuisong($content,$shebei,$type,$userid){
		header('content-type:text/html;charset=utf8');
		require_once('./Piano/Common/Common/jpush.php');
	   
		$n_content =  $content;
		$receiver_value = $shebei;
	
		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');
		 
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
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

	private function message_tuisong1($content,$shebei,$type,$userid){
		header('content-type:text/html;charset=utf8');
		require_once('./Piano/Common/Common/jpush.php');
	   
		$n_content =  $content;
		$receiver_value = $shebei;
	
		$appkeys = C('D_APPKEY1');
		$masterSecret = C('D_MAS1');
		 
		$sendno = $userid;
		$obj = new \jpush($masterSecret,$appkeys);
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

	public function test(){
	
		$this->display();
	}



	public function add_advice(){
		$id = I('userid'); 
		$content = I('content');
		if(!$id || !$content){
			$this->error1();
		}
		$time = M('Advice')->where("ad_user = '$id'")->order('ad_time DESC')->getField('ad_time');
		$time = strtotime($time);

		if($time <= (time()-1)){
			$data['ad_user'] = $id;
			$data['ad_text'] = $content;
			$data['ad_time'] = date('Y-m-d H:i:s',time());


			$a = M('Advice')->add($data);
			M('Users')->where("id = '$id'")->setInc('score',100);
		}
		
		if($a){
			$result['status']=true;
			$result['message']='反馈成功';
  		}else{
  			$result['status']=false;
			$result['message']='防反复注入';
  		}
  		echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
		
	}


	public function my_money_new(){
		$id = I('userid');
		$b = M("Goods_order")->where("go_userid = '$id' and go_status = '3'")->sum('go_lebi');//查询扣除的乐币
		if($b){
			$c = M('Users')->where("id = '$id'")->setInc('money',$b);//返还总计乐币	
		}
		
		$a = M('Users')->where("id = '$id'")->getField('money');//查询最新乐币
		
		$score = M('Users')->where("id = '$id'")->getField('score');
		$level = M('Lv_list')->where("lv_min_score <= '$score' and lv_max_score >= '$score'")
                     ->getField('lv_name');		//根据积分查等级，再更新等级

    	M('Users')->where("id = '$id'")->setField('lv',$level);
    	

		$result['status']=true;
		$result['message']='查询成功';
		$result['money'] = $a;
  		echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  

	}

	public function luo(){
		$url = I('url');
		$url = substr($url,1);

		// $file = get($url);
		// $url =base64_encode($file);

		// echo $url;exit;
		$url ='http://lelego.net.cn/'.$url;
		$this->assign('url',$url);
		$this->display();
	}

	public function creat_preson_code($a){
		require_once "./Piano/Home/Common/phpqrcode/phpqrcode.php";

		$errorCorrectionLevel = intval(3);  
        //生成图片大小  
        $matrixPointSize = intval(4);  
        //生成二维码图片  
        $object = new \QRcode();  
        //第二个参数false的意思是不生成图片文件，如果你写上‘picture.png’则会在根目录下生成一个png格式的图片文件  
       
		$b = M('App')->where("app_kind = '$a'")->order('app_id DESC')->find();

        $url = "http://lelego.net.cn/".$b['app_url'];
       	// $url = "http://www.baidu.com";

        return $object->png($url, $a.'android.png', $errorCorrectionLevel, $matrixPointSize, 2);  	
	}


	public function tiexiang(){
		$id = I('id');
		$userid = I('userid');
		if($userid){
			M('Users')->where("id = '$userid'")->setInc('score',5);
		}

		$a = M('Luntan')->where("tiezi_id = '$id'")
						->join('piano_users on piano_users.id = piano_luntan.l_userid')
		                ->find();

		if($a['l_img']){
			$a['l_img'] = explode(',',$a['l_img']);
		}
		if($a['l_type'] ==3){
			$list = M('Baoming')->where("bm_tzid = '$a[tiezi_id]'")
			                    ->join('piano_users on piano_users.id = piano_baoming.bm_userid')
			                    ->select();
		}

		

		$url1 = '1499065848.png';
		$this->assign('url1',$url1);//苹果二维码

		$this->creat_preson_code(2);
		$url2 = '2android.png';
	
		$this->assign('url2',$url2);//安卓手机二维码
		
		$this->creat_preson_code(1);
		$url3 = '1android.png';
		$this->assign('url3',$url3);//安卓平板二维码

		$this->assign('a',$a);
		$this->assign('list',$list);

		if($a['l_type'] != 3){
			$this->display();
		}else{
			$this->display('huodongxiang');
		}
		

	}

	public function get_banner(){

		$a = '《中国风钢琴系列教程》让钢琴说中文， 用钢琴传播中国文化，《中国风钢琴入门教程》3册、 《中国风钢琴进阶教程》5册、《中国风钢琴教法研究》《中国风钢琴四手联弹曲集》3册 淘宝有售';
		$result['status'] = true;
		$result['msg'] = '查询成功';
		$result['data'] = $a;
		echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
	}

//预约直播   5-20新需求
	public function yuyue_peixun(){
		
		$list = json_decode($_POST['data'],true); 
		
		$data['zhubo_id'] = $userid = $list['k0']['userid'];
		
		
		$user = M('Zhubo_reg')->where("zb_id = '$userid' and zb_kind = '2'")->find();
		
		if($user['zbrz_status'] != '2'){
			$this->error2('预约失败,主播认证没通过',2,'主播认证没通过');
		}
		if($user['acc_on'] == 0){
			$this->error2('预约失败,主播账号被封',2,'主播账号被封');
		}

		if($user['zb_kind'] != '2'){
			$this->error2('预约失败,用户认证的不是培训老师',2,'用户认证的不是培训老师');
		}

		$data['y_title_name'] = $list['k0']['title_name'];
		$data['y_content'] = $list['k0']['content'];
		$data['y_shoufei'] = $list['k0']['shoufei'];
		$data['y_teacher_info'] = $list['k0']['teacher_info'];
		$data['y_img'] = $list['k0']['img'];
		$data['y_part'] = 0;
		$data['kind'] = 2;
		$data['y_info'] = $_POST['data'];//提交过来的信息，原封不动的存储一个，在查看我的预约时需要
		$data['y_addtime'] = date('Y-m-d H:i:s',time());
		$a = M('Yuyue')->add($data);

		$count = count($list);
		
		for($i=1;$i<=$count-1;$i++){
			$x = 'k'.$i;

			$data1 = array();
			$data1['y_kind'] = 2;
			
			$data1['zhubo_id'] = $list['k0']['userid'];
			$data1['y_title_name'] = $list[$x]['title_name'];
			$data1['y_time'] = $list[$x]['time'];
			$data1['y_content'] = $list[$x]['content'];
			$data1['y_shoufei'] = $list[$x]['shoufei'];
			$data1['y_video_shoufei'] = $list[$x]['video_shoufei'];
			$data1['y_part'] = $a;
			$data1['kind'] = 2;
            M('Yuyue')->add($data1);
		}
		if($a){
			$result['status'] = true;
			$result['msg'] = '提交成功';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('提交失败',2,'SQL错误');
		}	
	}

	public function yuyue(){
		$data['zhubo_id'] = $userid =I('userid');
		$data['y_title_name'] = I('title_name');
		$data['y_content'] = I('content');
		$data['y_shoufei'] = I('shoufei');
		$data['y_time'] = I('time');
		$data['kind'] = 0;
		$data['y_part'] = 0;
		$data['y_type'] = I('type')?I('type'):0;
		$data['y_addtime'] = date('Y-m-d H:i:s',time());
		if(I('pwd'))$data['y_pwd'] = I('pwd');

		$a = M('Yuyue')->where("zhubo_id = '$userid'")->getField('y_addtime');
		$a = strtotime($a);
		if($a >= (time()-30)){
			$this->error2('请不要频繁预约,防反复注入',2,'防反复注入');
		}
		
		$b = M('Yuyue')->add($data);
		if($b){
			$result['status'] = true;
			$result['msg'] = '提交成功';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('提交失败',2,'SQL错误');
		}
	}

//发布直播  5-20新需求
	public function start_live(){
		$data['zhubo_id'] = $id = I('userid');
		$room_id = I('room_id')?I('room_id'):$this->new_room();

		$kind = I('kind')?I('kind'):0;      //0show房  1 教学课  2培训课
		//现在新需求  1 才能直接开播   0,2需要预约
		$x = M('Room')->where("zhubo_id = '$id' and status = '1' and kind != '2'")->find();
		if($x){
			M('Room')->where("r_id = '$x[r_id]'")->setField('status',2);
		}//允许主播掉线后马上重新开直播

		$y = M('Room')->where("zhubo_id = '$id' and status = '1' and kind = '2'")->find();
		if($y){
			M('Room')->where("r_id = '$y[r_id]'")->setField('status',0);
		}//允许主播掉线后马上重新开直播

		if($kind != 0){
			$a = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->find();
			if(!$a || $a['zbrz_status'] != 2){
				$this->error2('发起直播失败,主播认证没通过',2,'主播认证没通过');
			}
			if($a['acc_on'] == 0){
				$this->error2('发起直播失败,主播被封号',2,'主播被封号');
			}	
		}

		if($kind != 1){
	
			$b = M('Room')->where("room_id = '$room_id' and kind = '$kind' and 
				                   status != '2' and zhubo_id = '$id'")
			              ->find();

			if(!$b){
				$this->error2('发起直播失败,没有预约',2,'没有预约');
			}

			$time = date('Y-m-d H:i:s',time()+1800);

			if($b['s_time'] > $time){
				$this->error2('发起直播失败,时间未到',2,'时间未到');
			}

			$data['title_name'] = I('title');
			$data['type'] = I('type')?I('type'):0;
			$data['pwd'] = I('pwd')?I('pwd'):'';
			$data['status'] = 1;
			$data['s_time'] = date('Y-m-d H:i:s',time());
			$data['activitytime'] = date('Y-m-d H:i:s',time());
			$c = M('Room')->where("room_id = '$room_id'")->save($data);
		}else{ //教学课程不需要预约
			// if($a['zb_kind'] == 2){
			// 	$this->error2('未经过直播间认证',2,'未经过直播间认证');
			// }

			$data['zhubo_id'] = $id;
			$data['zhubo_name'] = M('Users')->where("id = '$id'")->getField('nickname');
			$data['type'] = I('type')?I('type'):0;
			$data['pwd'] = I('pwd')?I('pwd'):'';
			$data['room_id'] = $room_id;
			$data['title_name'] = I('title');
			$data['kind'] = 1;
			$data['status'] = 1;
			$data['s_time'] = date('Y-m-d H:i:s',time());
			$data['activitytime'] = date('Y-m-d H:i:s',time());
			$c = M('Room')->add($data); 
		}

		$d = M('Room')->where("zhubo_id = '$id' and room_id ='$room_id' and status = '1'")
			          ->join('piano_users on piano_users.id = piano_room.zhubo_id')
			          // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id')
			          ->field('room_id,zhubo_name,headerimg,title_name,total_money')
			          ->find();
		if(!$d['headerimg']){
			$d['headerimg'] = '';
		}
	
		if($c){
			$usersing = $this->signature($id,'1400023343',__DIR__.'/tls_sig_api-linux-64/tools/private_key');
			$result['status'] = true;
			$result['msg'] = '直播开始';
			$result['data'] = $d;
			$result['data']['usersing'] = $usersing[0];
			
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	  
		}else{
			$this->error2('发起直播失败',2,'SQL错误');
		}
	}




//直播列表
	public function room_list(){
		$this->finish_room();
		$page = I('page')?I('page'):1;
		$kind = I('kind')?I('kind'):0;
		$id = I('userid');
		$user = M('Users')->where("id = '$id'")->getField('address');

		if($user){
			$ad = explode(' ',$user);
			$c  = $ad[1];
		}

		$city = I('city')?I('city'):$c;
	
		if($kind == 0){
			$a = M('Room')->where("pinbi = '0' and status != '2' and kind = '0'")
			              // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_room.zhubo_id')
			              ->limit(($page-1)*10,10)
			              ->order('s_time')
			              ->select();
			//dump($a);exit;           
			foreach($a as $k=>$v){
				if($v['status'] == 0){
					$f = 0;
				}else{
					$f = 1;
				}

				$b[$k]['status'] = $f;
				$b[$k]['live_shoufei'] = $v['live_shoufei'];
				$b[$k]['video_shoufei'] = $v['video_shoufei'];
				$b[$k]['headerimg'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('headerimg');
				$b[$k]['room_id'] = $v['room_id'];
				$b[$k]['zhubo_id'] = $v['zhubo_id'];
				$b[$k]['zhubo_truename'] = $v['zhubo_name'];
				$b[$k]['title_name'] = $v['title_name'];
				$b[$k]['s_time'] = $v['s_time'];
				$b[$k]['type'] = $v['type']?$v['type']:0;
				$b[$k]['pwd'] = $v['pwd']?$v['pwd']:'';
				$b[$k]['part'] = $v['part']?$v['part']:0;
				$b[$k]['status'] = $v['status'];
				$b[$k]['addtime'] = $v['addtime'];
				$b[$k]['total_money'] = $v['total_money'];
				$b[$k]['img'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('headerimg');
				$b[$k]['sign'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('sign');
				$b[$k]['kind'] = 0;
				if($id){
					$where = "go_userid = '$id' and go_type = '1' and 
				              go_name like '%$v[room_id]%'";
				          
					if($id != $v['zb_id']){
						$buy = M('Goods_order')->where($where)->find();
					}//自己的课，不用购买就能看
				}
			
				
				if($buy){
					if($buy['go_status'] == 2){
						$b[$k]['buy'] = '2';
					}else{
						$b[$k]['buy'] = '1';
					}
				}else{
					$b[$k]['buy'] = '0';
				}		

			}
		}//用feild查出来，有些字段会有NULL值 ，安卓无法解析，所用这种方法更省事
		
		if($kind == 1){ //如果是教学  则先显示不同的琴行
			$b = M('Dealers')->where("jx_zhiboid = '3' and jx_city like '%$city%'")
			                 ->limit(($page-1)*10,10)
			                 ->order('jxid')
			                 ->field('jx_name as title_name,jxid as kid,jx_img as img')
			                 ->select();  
			// dump($b);exit;
		}	

		if($kind == 2){
			$c = M('Yuyue')->where("kind = '2' and y_part = '0' and y_status = '1'")
			               
			               ->limit(($page-1)*10,10)
			               ->order('yid DESC')
			               ->select();   //所有的总课
			//dump($c);exit;
			foreach ($c as $k => $v){	
				$d = M('Room')->where("part = '$v[yid]' and status = '1'")->find();
				if($d){
					$b[$k]['room_id'] = $d['room_id'];
					$b[$k]['status'] = '1';
					$b[$k]['total_money'] = $d['total_money'];
				}else{
					$b[$k]['room_id'] = '';
					$b[$k]['status'] = '0';
					$b[$k]['total_money'] = 0;
				}//有直播就把正在直播的room_id查找出来

				$b[$k]['kid'] = $v['yid'];
				$b[$k]['zhubo_id'] = $v['zhubo_id'];
				$b[$k]['zhubo_truename'] = M('Zhubo_reg')->where("zb_id = '$v[zhubo_id]' and zb_kind = '2'")->getField('zhubo_truename');
				$b[$k]['title_name'] = $v['y_title_name'];
				$b[$k]['s_time'] = $v['y_time'];
				$b[$k]['headerimg'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('headerimg');
				$b[$k]['addtime'] = $v['y_addtime'];
				$b[$k]['img'] = $v['y_img'];
				$b[$k]['teacher_info'] = $v['y_teacher_info'];//用老师介绍代替签名
				$b[$k]['sign'] = $v['y_content'];
				$b[$k]['shoufei'] = $v['y_shoufei'];
				// $b[$k]['sign'] = M('Yuyue')->where("zhubo_id = '$v[zhubo_id]'")->getField('y_teacher_info');
				$b[$k]['type'] = 0;
				$b[$k]['pwd']= '';
				$b[$k]['kind']= 2;
			}
			
		}

		if($b){
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['data'] = $b;
		}else{
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['data'] = array();
		}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
	}

//由琴行进入直播列表
	public function room_list1(){
		$this->finish_room();
		$id = I('jxid');  
		$userid = I('userid');
		$page = I('page')?I('page'):1;


		$a= M('Room')->where("pinbi = '0' and jxid = '$id' and status != '2' and kind = '1' and 
			                  r_zbid = '$id' and zb_kind = '1'")
		             ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_room.zhubo_id')
		             ->join('piano_dealers on piano_dealers.jxid = piano_zhubo_reg.r_zbid')
		             ->limit(($page-1)*10,10)
		             ->order('s_time')
		             ->select();
	
		             // dump($a);exit;
		foreach($a as $k=>$v){
			$b[$k]['status'] = $v['status'];
			$b[$k]['live_shoufei'] = $v['live_shoufei'];
			$b[$k]['video_shoufei'] = $v['video_shoufei'];
			$b[$k]['room_id'] = $v['room_id'];
			$b[$k]['zhubo_id'] = $v['zhubo_id'];
			$b[$k]['zhubo_truename'] = $v['zhubo_name'];
			$b[$k]['title_name'] = $v['title_name'];
			$b[$k]['s_time'] = $v['s_time'];
			$b[$k]['type'] = $v['type']?$v['type']:0;
			$b[$k]['pwd'] = $v['pwd']?$v['pwd']:'';
			$b[$k]['total_money'] = $v['total_money'];
			$b[$k]['kind'] = 1;
			$b[$k]['headerimg'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('headerimg');
			
			if($userid){
				$where = "go_userid = '$userid' and go_type = '1' and 
			              go_name like '%$v[room_id]%'";

				if($userid != $v['zb_id']){
					$buy = M('Goods_order')->where($where)->find();
				}else{

				}
				//自己的课，不用购买就能看
			}


			if($buy){
				if($buy['go_status'] == 2){
					$b[$k]['buy'] = '2';
				}else{
					$b[$k]['buy'] = '1';
				}
			}else{
				$b[$k]['buy'] = '0';
			}	

		}	//没看到琴行下老师的直播有封面

		$img = M('Dealers')->where("jxid = '$id'")->getField('jx_img1');//广告横幅
		
		if($a){
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['img'] = $img;
			$result['data'] = $b;

		}else{
			$result['status'] = false;
			$result['msg'] = '查无数据';
			$result['data'] = array();
			$result['img'] = $img;
			
		}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
	}


	public function peixun_list(){
		$this->finish_room();
		$userid = I('userid');
		// $page = I('page')?I('page'):1;
		$part = I('part');

		$a = M('Room')->where("pinbi = '0' and  part = '$part' and kind = '2'")
			          ->field('room_id,zhubo_id,zhubo_name,title_name,s_time,url,status,
			          	       live_shoufei,video_shoufei')
			          ->select();

		foreach ($a as $k => $v){
			$b = $this->PlayInfoimg($v['url']);//通过这个接口去查地址
			$c = $b['fileSet'][0]['playSet'][0];
			$a[$k]['url'] = $c['url'];

			if($userid){
				$where = "go_userid = '$userid' and go_type = '1' and 
			          	  go_name like '%$v[room_id]%'";

				if($userid != $v['zhubo_id']){
					$buy = M('Goods_order')->where($where)->find();
				
				}//自己的课，不用购买就能看

			}
		// dump($buy);exit;

			if($buy){
				if($buy['go_status'] == 2){
					$a[$k]['buy'] = '2';
				}else{
					$a[$k]['buy'] = '1';
				}
			}else{
				$a[$k]['buy'] = '0';
			}	
		}
		
		

		if($a){
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['data'] = $a;
		}else{
			$result['status'] = true;
			$result['msg'] = '查无数据';
			$result['data'] = array();
		}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;	
	}

	public function room_list_sou(){
		$key = trim(I('key'));
		$page = I('page')?I('page'):1;
		$userid = I('userid');
 
		$a = M('Room')->where("pinbi = '0' and (title_name like '%$key%' or 
		                       room_id like '%$key%') and ((kind = '2' and status != '4') 
		                       or (kind != '2' and status != '2'))")
		              // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_room.zhubo_id')
		              ->join('piano_users on piano_users.id = piano_room.zhubo_id')
		              ->limit(($page-1)*10,10)
		              ->order('s_time')
		              ->select();
		              // dump($a);exit;
		foreach($a as $k=>$v){
			$b[$k]['status'] = $v['status'];
			$b[$k]['room_id'] = $v['room_id'];
			$b[$k]['zhubo_id'] = $v['zhubo_id'];
			$b[$k]['zhubo_truename'] = $v['zhubo_name'];
			$b[$k]['title_name'] = $v['title_name'];
			$b[$k]['s_time'] = $v['s_time'];
			$b[$k]['type'] = $v['type']?$v['type']:0;  //公开或私密
			$b[$k]['pwd'] = $v['pwd']?$v['pwd']:'';
			$b[$k]['kid'] = $v['part']?$v['part']:0;
			$b[$k]['headerimg'] = M('Users')->where("id = '$v[zhubo_id]'")->getField('headerimg');
			$b[$k]['kind'] = $v['kind'];
		
			if($v['status'] != 3){
				$b[$k]['live_shoufei'] = $v['live_shoufei'];	
			}else{
				$b[$k]['live_shoufei'] = $v['video_shoufei'];
			}
			$d = $this->PlayInfoimg($v['url']);//通过这个接口去查地址
 			$c = $d['fileSet'][0]['playSet'][0];
 			$b[$k]['url'] = $c['url'];

			if($userid){
				$where = "go_userid = '$userid' and go_type = '1' and 
			          go_name like '%$v[room_id]%'";

				if($userid != $v['zb_id']){
					$buy = M('Goods_order')->where($where)->find();
				}//自己的课，不用购买就能看
			}
			

			if($buy){
				if($buy['go_status'] == 2){
					$b[$k]['buy'] = '2';
				}else{
					$b[$k]['buy'] = '1';
				}
			}else{
				$b[$k]['buy'] = '0';
			}	
		}

		if($b){
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['data'] = $b;
		}else{
			$result['status'] = true;
			$result['msg'] = '查无数据';
			$result['data'] = array();
		}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
	}

//看直播前检测购买过没有
	// public function check_buy(){
	// 	$id = I('userid');
	// 	$room_id  = I('room_id');


	// 	$a = M('Goods_order')->where("go_status = '2' and go_userid = '$id' and 
	// 		                              go_name = '$room_id'")
	// 		                 ->find();//收费show房  和  单节课程 的直接购买

	// 	if(!$a){//全本购买，所以通过要进入的房间号找到全本的书号
	// 		$b = M('Yuyue')->where("y_roomid = '$room_id'")->getField('y_part');
	// 		$a = M('Goods_order')->where("go_status = '2' and go_userid = '$id' and 
	// 		                              go_name = '$b'")
	// 		                     ->find();
	// 	}	
		
	
	// 	if($a){
	// 		$result['status'] = true;
	// 		$result['msg'] = '已购买';
	// 	}else{
	// 		$result['status'] = false;
	// 		$result['msg'] = '未购买';
	// 	}
	// echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
	// }

//获取唱谱文件
	Public function get_music(){
		$lid = I('lid');
		$url = M('Songs_list')->where("lid = '$lid'")
		                      ->field('lid,list_url2,list_url_music,list_url_music2')
		                      ->find();
		

		if($url){
			$result['status'] = true;
			$result['msg'] = '查询成功';
			$result['data'] = $url;
		}else{
			$result['status'] = false;
			$result['msg'] = '查无数据';
		}
	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
	}



	public function creat_num(){
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn = $yCode[(intval(date('Y')) - 2000)%10] .$_SESSION['piano_user']['id'].substr(time(), -5).
						   strtoupper(dechex(date('m'))) .date('d') .dechex(date('ym')). 
						   rand(100,999). substr(microtime(),2,5) . 
						   sprintf('%02d', rand(100, 999));
		$a = M('Goods_order')->where("go_num = '$orderSn'")->find();
		if($a){
			$this->creat_num();
		}
		return $orderSn;
	}


//提交订单
    public function add_goods(){

		$data['go_userid'] = $id = I('userid');
    	$data['go_name'] = I('name');
    	$data['go_number'] = 1;
    	$data['go_money'] = I('money');    //现金额
    	$data['go_price	'] = I('price');   //单价
    	$data['go_kind']  = I('type');     //1   现金   2   非现金
    	$data['go_point'] = I('point');    //乐币数
    	$data['go_num'] = $this->creat_num();
    	$data['go_time'] = date('Y-m-d',time());
    	$data['go_status'] = 1;   //未付款
  

    	$a = M('Goods_order')->add($data);
    	
    	
    	if($a){
    		$result['status']=true;
    		$result['message']='订单添加成功';
    		$result['orderSn']=$data['go_num'];	
          	echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
    	}else{
    		$result['status']=false;
	        $result['message']='订单添加失败';
	        echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
    	}
    }


//支付页面
    public function show_pay(){
    	$num = I('orderSn');
    	$type = I('type');
    	//1现金 2乐币 3混合
    	$pay_mode = I('pay_mode');
    	//乐币抵扣
    	$lebi_num = I('lebi_num');
    	$a = M('Goods_order')->where("go_num = '$num'")->find();
    	if(!$a){
    		$this->error2('订单号不正确',2,'查无数据');
    	}

    	//标明是属于哪个代理商的买卖   
    	//基于上次客户想在后台开发经销商也能查询‘自己’范围内的营业额 而加的
    	//后台部分还没完善相应的jxid，如果客户下次又想加上来，请补完后台的部分
    	$name = explode(',',$a['go_name']);    	
		$room_id = $name[0];
		$t_id = M('Room')->where("room_id = '$room_id'")->getField('zhubo_id');
		$jxid = M('Teacher')->where("t_userid = '$t_id'")->getField('t_jxid');
		M('Goods_order')->where("go_num = '$num'")->setField('go_jxid',$jxid); 

		$stuid = $a['go_userid'];
		if($pay_mode == 3){
			$point = M('Users')->where("id = '$stuid'")->getField('money');
			
			if($point < $lebi_num){
				//乐币不够的话,表示前台判断错误，只需返回失败即可
				$this->error2('乐币不够',2,'乐币不够');	
			}else{
				M('Users')->where("id = '$stuid'")->setDec('money',$lebi_num);
				$yu_money = $a['go_money']-$point/10;

				//混合支付，需要更新订单里的现金数和乐币数
				$data = array('go_status'=>3,'go_lebi'=>$point,'go_money'=>$yu_money);
				M('Goods_order')->where("go_num = '$num'")->save($data);
				
				if($type ==1){//支付宝
    				$result['orderSn'] = $a['go_num'];
		    	}elseif($type == 2){//微信
		    		$result['Wxpay'] = $this->careat_Wxpay_sn($num,$yu_money,'乐乐gogo支付');
		    	}

		    	$result['status']=true;
				$result['message']='订单生成';
				echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
			}	
		}

		if($pay_mode == 2){//如果这里是浮点型数据  请改用bcadd之类的函数
			$point = M('Users')->where("id = '$stuid'")->getField('money');
			
			if($point < $a['go_money']){
				$this->error2('亲，您的乐币不够，快去充值吧~',2,'');
			}else{
				M('Users')->where("id = '$stuid'")->setDec('money',$lebi_num);
				M('Goods_order')->where("go_num = '$num'")->setField('go_status',2);

				$result['status']=true;
				$result['message']='支付完成';
				echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
			}
			
		}

		if($pay_mode == 1){
			if($type ==1){//支付宝
    			$result['orderSn'] = $a['go_num'];
    		}elseif($type == 2){//微信
    			$result['Wxpay'] = $this->careat_Wxpay_sn($num,$a['go_money'],'乐乐gogo支付');
    			// dump($result['Wxpay']);exit;
    		}
    		$result['status']=true;
			$result['message']='订单生成';
			echo json_encode($result,JSON_UNESCAPED_UNICODE);exit;
		}
    }


//成交
    public function sure_order(){
    	$num = I('orderSn');
    	
    	$a = M('Goods_order')->where("go_num = '$num'")->find();
		$stuid = $a['go_userid'];


		$name = explode(',',$a['go_name']);    	
		$room_id = $name[0];
		$t_id = M('Room')->where("room_id = '$room_id'")->getField('zhubo_id');
		//加用户与老师的关系
		if(M('User_friends')->where("u_status = '2' and (
			                         (userid = '$t_id' and friend_id = '$stuid') or 
			                         (userid = '$stuid' and friend_id = '$t_id'))")->find()){
			M('User_friends')->where("u_status = '2' and (
			                         (userid = '$t_id' and friend_id = '$stuid') or 
			                         (userid = '$stuid' and friend_id = '$t_id'))")
		                     ->setField('u_status',1);
		}
		if(!M('User_friends')->where("u_status = '1' and (
			                         (userid = '$t_id' and friend_id = '$stuid') or 
			                         (userid = '$stuid' and friend_id = '$t_id'))")->find()){
			M('User_friends')->add(array('userid'=>$t_id,'friend_id'=>$stuid,'u_status'=>1));
		}


		if(!M('Teacher_student')->where("tid = '$t_id' and sid = '$stuid'")->find()){
			M('Teacher_student')->add(
				array(
					'tid'=>$t_id,'sid'=>$stuid,'time'=>date('Y-m-d H:i:s',time())
					)
				);
		}


//如果是这样，就自动加入群
		$yid = M('Room')->where("room_id = '$room_id'")->getField('part');


		$group = M('Group')->where("g_classid = '$yid'")->getField('g_stuids');
		if(stripos($group,$stuid) === false){
			$this->join_group($stuid,$yid);
		}
    }

//提交作业
    public function homework_up1(){
		$userid = (int)$_REQUEST['userid'];
		$hid = (int)$_REQUEST['hid'];
		$lid = (int)$_REQUEST['lid'];
		$point = (float)$_REQUEST['point'];
		$speed = (float)$_REQUEST['speed'];
		$url = I('url');
		$long = I('long');

		if(!$hid || !$lid || !$speed){
			$this->error1();
		}

		$a = M('Homework')->where("hid = '$hid'")->find();
		$etime = strtotime($a['etime'].' 23:59:59');
			
		if($etime < time()){
			$this->error2('作业期限已过，不能再提交了',2,'作业期限已过，不能再提交了');
		}

		$time = date('Y-m-d',time());  //今天
		$where1 = "w_userid = '$userid' and w_time = '$time' and hid = '$hid'";
		$count = M("Homework_stu")->where($where1)->count();//当天的提交作业数量
	
		if($count >= $a['count']){//先判断，再决定是否添加新的作业  
			$rest['status'] = false;
			$rest['msg'] = '今日作业已完成,无需再再提交';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}

		$data = array(
					'lid' => $lid,
			        'hid' => $hid,
			        'status' => $a['h_status'],
					'w_userid' => $userid,
					'w_point' => $point,
				    'w_speed' =>$speed,
				    'w_time' => date('Y-m-d',time()),
				    'w_url' => $url,
				    'w_long' =>$long
	           	);

		$add = M("Homework_stu")->add($data);
		M('Users')->where("id= '$userid'")->setInc('score',5);

		$days = $this->days($a['stime'],$a['etime']);
		$total_num = $a['count'] * $days;

		$today_time = date('Y-m-d',time()); 
	
		$count = M("Homework_stu")->where($where1)->count();//当天的提交作业数量
		
		if($count < $a['count']){
			$num = $a['count']-$count;
			$rest['status'] = false;
			$rest['msg'] = '作业还差'.$num.'次';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}


		
		$where = "hid='{$hid}' and w_userid='{$userid}'";
		$total_homework = M("Homework_stu")->where($where)->count();   //总提交数
		
		if($total_homework >= $total_num){
			//给布置作业的老师添加消息提示
			$teacher = M("Teacher")->where("t_userid='{$a['t_id']}'")->find();
			//提交作业的学生
			$user_stu = M("Users")->where("id='{$userid}'")->find();
			$content = $teacher['t_truename']."老师,您的学生：".$user_stu['nickname'].' 提交了作业，请批改';
		
			$songs_name = M('Songs_list')->where("lid = '$lid'")->getField('list_name');
			$data = array(
					'x_userid' => $a['t_id'],
					'x_content' => $content,
					'x_tuisong' => $userid,
					'x_type' => 3,
					'x_time' => date('Y-m-d H:i:s',time()),
					'x_kid'=> $add,
					'x_info' => json_encode(array('id'=>$hid,'type'=>1,'stu_id'=>$userid,'lid'=>$lid,
						                          'nickname'=>$user_stu['nickname'],'name'=>$songs_name))
					);
//x_info 里的字段是前端做消息跳转的依据，type=1表示作业还未点评，可以点消息跳转去评论作业
//id老师布置的作业ID，学生ID,曲子ID，曲子名称					
			M("User_xiaoxi")->add($data);

			
			$stu_loing = M("Token")->where("t_userid='{$a['t_id']}'")->find();
			if($stu_loing){
				if($stu_loing['t_leixin'] == 2){//新版本后，IOS消息推送升到V3
					$this->ios_msg_send($content,$stu_loing['t_shebei']);
				}else{
				
					$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$tid,'批改作业提醒',5);
				}
			}

			
		}
		$rest['status'] = true;
		$rest['msg'] = '作业提交完成';	

		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;

	}

	function days($time1,$time2){
		$second1 = strtotime($time1);
		$second2 = strtotime($time2);

		if ($second1 < $second2) {
    		$tmp = $second2;
    		$second2 = $second1;
    		$second1 = $tmp;
  		}
  		$days = ($second1 - $second2) / 86400;
  		return $days+1;
	}


//下课
	public function course_end(){
		$id = (int)$_REQUEST['userid'];
		$kid = I('kid');
		$a = M('Course_list')->where("id='{$kid}'")->getField('cl_tid');
		if($a != $id){
			$this->error2('该用户不是带班老师',2,'不是带班老师');
		}

		$data['cl_xin'] = I('num');	
		$data['cl_pin'] = I('pinlun');
		$data['cl_status'] = 2;
	
		$set = M('Course_list')->where("id='{$kid}'")->save($data);
		if($set){
			$rest['status'] = true;
			$rest['msg'] = '操作成功';
				
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('操作失败',1,'sql错误');
		}		
	}

//数组排序
	function array_sort($array,$keys,$type='asc'){
		//$array为要排序的数组,$keys为要用来排序的键名,$type默认为升序排序
		$keysvalue = $new_array = array();
		foreach ($array as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}

		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}

		reset($keysvalue);
			foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $array[$k];
		}
		return $new_array;
	}

//我的班级
	public function show_my_class(){
		
		$id = I('userid');
		$class_id = I('class_id');
		// $page = I('page')?I('page'):1;
		$key = I('key');

		$a = M('Users')->where("id = '$id'")->getField('role');
		
		$time1 = date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));  
    	$time2 = date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));  
		
		if($a == 1){
			if(!$class_id){
				$b= M('Class')->where("class_stuids like '%$id%'")
			    		      ->field('class_id,class_name,class_img,class_teacher,t_truename,headerimg')
			    		      ->join('piano_users on piano_users.id = piano_class.class_teacher')
			    		      ->join('piano_teacher on piano_teacher.t_userid= piano_users.id')
			                  ->select();
			             
			    if($b){
			    	$rest['status'] = true;
					$rest['msg'] = '查询成功';
					$rest['data'] = $b;			
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
			    }else{
			    	$rest['status'] = false;
					$rest['msg'] = '亲，暂时没有数据噢';
					$rest['data'] = array();			
					echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
			    }
			}
			

			$b = M('Class')->where("class_id = '$class_id'")
			               ->field('class_id,class_name,class_stuids,class_teacher,class_img')
			               ->find();

			$b['teacher'] = M('Teacher')->where("t_userid = '$b[class_teacher]'")
			                            ->getField('t_truename');
			               
			if($b['class_stuids'] != '' ||$b['class_stuids'] != null){
				$c = explode(',',$b['class_stuids']);
				if($key){
					$x = M('Users')->where("username like '%$key%' and id in($b[class_stuids])")
					               ->field('id')
					               ->select();

					foreach ($x as $k => $v) {
						$y .= $v['id'].',';
					}
					
					$c = array_unique(explode(',',trim($y,',')));
					//得到所有搜出来的 去掉重复的 通过转换数组，然后去掉数组里相同的值，再换回字符串
					$c = explode(',',implode(',',$c));
				}
				
				foreach ($c as $k => $v){
					$d[$k]['id'] = $v;
					$d[$k]['username'] = M('Users')->where("id = '$v'")->getField('username');
					$d[$k]['headerimg'] = M('Users')->where("id = '$v'")->getField('headerimg');
					$d[$k]['nickname'] = M('Users')->where("id = '$v'")->getField('nickname');
					$long = M('Practice_log')->where("log_userid = '$v' and 
						                              log_time BETWEEN '$time1' and '$tim2'")
					                         ->sum('log_long');
					$d[$k]['long_time'] = ceil($long/60);
					if(!$d[$k]['headerimg']){
						$d[$k]['headerimg'] = '';
					}
					if(!$d[$k]['nickname']){
						$d[$k]['nickname'] = '';
					}
					if(!$d[$k]['long_time']){
						$d[$k]['long_time'] = 0;
					}
				}
			}

			$this->array_sort($d,'long_time','DESC');//按练琴时间的长短排序
			// array_multisort($d,SORT_DESC,SORT_NUMERIC); 
			// array_slice($d,($page-1)*10,10);
			$b['students'] = $d?$d:array();
		}elseif($a == 2){
			if(!$class_id){
				$b = M('Class')->where("class_teacher = '$id'")
			                   ->field('class_id,class_name,class_img')
			                   ->select();
			}else{
			
				$c = M('Class')->where("class_id = '$class_id'")->find();
				$b['class_name'] = $c['class_name'];

				if($c['class_stuids']){
					$d = explode(',',$c['class_stuids']);
					if($key){

						$x = M('Users')->where("username like '%$key%' and id in($c[class_stuids])")
						               ->field('id')
						               ->select();
						               // dump(M('Users')->getLastSql());exit;
						foreach ($x as $k => $v) {
							$y .= $v['id'].',';
						}
						$d = explode(',',trim($y,','));
					}

					foreach ($d as $k => $v){
						$e[$k]['id'] = $v;
						$e[$k]['username'] = M('Users')->where("id = '$v'")->getField('username');
						$e[$k]['headerimg'] = M('Users')->where("id = '$v'")->getField('headerimg');
						$e[$k]['nickname'] = M('Users')->where("id = '$v'")->getField('nickname'
							);
						if(!$e[$k]['username']){
							$e[$k]['username'] = '';
						}

						if(!$e[$k]['headerimg']){
							$e[$k]['headerimg'] = '';
						}
						if(!$e[$k]['nickname']){
							$e[$k]['nickname'] = '';
						}
					}
				}
				$this->array_sort($e,'long_time','DESC');
				// array_multisort($e,SORT_DESC,SORT_NUMERIC);
				// array_slice($e,($page-1)*10,10);
				$b['students'] = $e?$e:array();
			} 
		}
		if(!$b){
			$this->error2('亲，暂时没有数据噢',2,'暂无数据');
		}
		$rest['status'] = true;
		$rest['msg'] = '操作成功';
		$rest['data'] = $b?$b:array();			
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}


//创建班级
	public function creat_class(){
		$data['class_name'] = trim(I('name'));

		$file = $_FILES['img'];
		
		if(!$_FILES['img']){
			$data['class_img'] = I('img');
		}else{

			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*20 ;// 设置附件上传大小
			$upload->exts      =     array('jpg','png','jpeg');// 设置附件上传类型
			// $upload->savePath  =      './Public/Uploads/'; // 设置附件上传目录// 上传文件
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     './Public/Uploads/video/'; // 设置附件上传根目录
		
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($file);
		
			if(!$info) {// 上传错误提示错误信息
				$this->error2('上传失败',2,$this->error($upload->getError()));
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
				$data['class_img'] = $file_name;
			}
		}
		
		if(M('Class')->where("class_name = '$data[class_name]'")->find()){
			$this->error2('已有相同名字的班级',2,'已有相同名字的班级');
		}

		$data['class_teacher'] = $id = I('userid');
		$a = M('Users')->where("id = '$id'")->getField('role');
		if($a != 2){
			$this->error2('该用户不是老师',2,'不是老师');
		}

		$data['class_jxid'] = M('Teacher')->where("t_userid = '$id'")->getField('t_jxid');
		$data['class_addtime'] = date('Y-m-d H:i:s',time());
		$b = M('Class')->add($data);

		if($b){
			$rest['status'] = true;
			$rest['msg'] = '创建班级成功';			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('创建失败',2,'SQL错误');
		}
	}



//获取可拉入班级的人员
	public function  get_person(){

		$id = I('userid');
		$class_id = I('class_id');
		
		$a = M('Class')->where("class_teacher != '$id'")->select();
		foreach ($a as $k => $v) {
			$idss .= $v['class_stuids'].',';
		}
		$idss = trim($idss,',');
		$idss = array_unique(explode(',',$idss));
		$idss = implode(',',$idss);
		//其他老师的所有学生 不重复

		$ids = M('Class')->where("class_id = '$class_id'")->getField('class_stuids');

		$b = M('User_friends')->where("u_status='1' and (userid = '$id' or friend_id = '$id')")
		                      ->select();
		//该老师的所有好友  这里本应该加 or friend_id = '$id'的 但之前的数据太乱，又不让清，所以暂时不加
		                     
		foreach ($b as $k => $v){
			if($v['userid'] == $id){
				$c[$k] = $v['friend_id']; 
			}else{
				$c[$k] = $v['userid']; //该老师的朋友ID
			}
			
			$b = M('Users')->where("id = '$c[$k]'")->getField('role');
			
			if($b == 2){
				unset($c[$k]);
			} //剔掉老师	
			if(stripos($idss,$c[$k]) !== false){//为什么这里的stripos  又可以呢？
				unset($c[$k]);
			}//其他班的学生
			
		} 
		
		if($c){
			$c = implode(',',$c);  
			$c = explode(',',$c);   //这里是重新配好键值对，方便循环
			
			foreach ($c as $k => $v) {
				$d = M('Users')->where("id = '$v'")->find();
				if(stripos($ids,$v) !== false){//这时候又行了，我蛋疼
					$e[$k]['is_student'] = 1;
				}else{
					$e[$k]['is_student'] = 2;
				}

				$e[$k]['userid'] = $v;
				$e[$k]['username'] = $d['username'];
				$e[$k]['headerimg'] = $d['headerimg']?$d['headerimg']:'';
				$e[$k]['nickname'] = $d['nickname']?$d['nickname']:'';
			}
		}
		// dump($e);
		// exit;
		
		if($e){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $e;			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '亲，暂时没有数据噢';
			$rest['data'] = array();			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}
	}

//添加学生
	public function add_students(){
		$id = I('userid');
		$class_id = I('class_id');
		$stuid = I('stuid');

		$x = M('Class')->where("class_teacher != '$id'")->select();
		
		foreach ($x as $k => $v) {
			if($v['class_stuids']){
				$ids .= $v['class_stuids'].',';
			}	
		}
		$ids = trim($ids,',');


		$a = M('Class')->where("class_id = '$class_id'")->find();
		if(!$a){
			$this->error2('该班级不存在',2,'该班级不存在');
		}

		if($a['class_teacher'] != $id){
			$this->error2('该用户不是带班老师',2,'不是带班老师');
		}

		if($a['class_stuids']){
			$stu = $a['class_stuids'].','.$stuid;
		}else{
			$stu = $stuid;
		}

		$stuid = explode(',',$stuid);
		foreach ($stuid as $k => $v){
			if(stripos($ids,$v) !== false){
				$this->error2('不能添加其他老师的学生',2,'');
			}

			if(stripos($a['class_stuids'],$v) !== false){
				$name = M('Users')->where("id = '$v'")->getField('nickname');
				$this->error2('添加失败，学生'.$name.'已在该班级',2,'学生'.$name.'已存在');
			}
		}

		$b = M('Class')->where("class_id = '$class_id'")->setField('class_stuids',$stu);


		if($b){
			foreach ($stuid as $k => $v) {
				if(!M('Teacher_student')->where("tid = '$id' and sid = '$v'")->find()){
					M('Teacher_student')->add(array('tid'=>$id,'sid'=>$v,'time'=>date('Y-m-d H:i:s')));
				}

				$where = "u_status = '1' and  ((userid = '$v' and friend_id = '$id') or
				                               (userid = '$id' and friend_id = '$v'))";
				if(!M('User_friends')->where($where)->find()){
					M('User_friends')->add(array('u_status'=>1,'userid'=>$id,'friend_id'=>$v));
				}
			}


			$rest['status'] = true;
			$rest['msg'] = '添加学生成功';			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('添加失败',2,'SQL错误');
		}
	}

//删除学生	 
	public function del_stu(){
		$id = I('userid');
		$class_id = I('class_id');
		$stuid = I('stuid');

		$a = M('Class')->where("class_id = '$class_id'")->find();
		if(!$a){
			$this->error2('该班级不存在',2,'该班级不存在');
		}
		if($a['class_teacher'] != $id){
			$this->error2('该用户不是带班老师',2,'不是带班老师');
		}

		// $a['class_stuids']='1,2,3,4,5,6,7';
		// $stuid = '2,5';
		
		$del_stu = explode(',',$stuid);
		$old_ids = explode(',',$a['class_stuids']);
			
		foreach($del_stu as $key => $val){
			foreach($old_ids as $k => $v){
				if($val == $v){
					unset($old_ids[$k]);
				}	
			}
			M('Users')->where("id = '$val'")->setField('role',3);
			if(M('Teacher_student')->where("sid = '$val' and tid = '$id'")->find()){
				M('Teacher_student')->where("sid = '$val' and tid = '$id'")->delete();
			}

			$where = "u_status = '1' and  ((userid = '$v' and friend_id = '$id') or
				                           (userid = '$id' and friend_id = '$v'))";
			if(M('User_friends')->where($where)->find()){
				M('User_friends')->where($where)->setField('u_status',2);
			}
		}	
		
		if($old_ids){
			$old_ids = implode(',',$old_ids);
		}else{
			$old_ids = '';
		}
		
		$b = M("Class")->where("class_id='{$class_id}'")->setField('class_stuids',$old_ids);
		if($b){
			$rest['status'] = true;
			$rest['msg'] = '删除学生成功';			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('删除学生失败',2,'SQL错误');
		}
	}

//查找-搜索用户
	public function search_user(){
		$phone = trim(I('phone'));
		$id = I('userid'); 
		$class_id = I('class_id');
		$page = I('page')?I('page'):1;


		$stu = M('Class')->where("class_teacher = '$id' and class_id = '$class_id'")
		                 ->getField('class_stuids');

		$c = M('Class')->where("class_teacher != '$id'")->select();
		foreach ($c as $k => $v) {
			if($v['class_stuids']){
				$other_stu .= $v['class_stuids'].',';
			}
		}

		$other_stu = trim($other_stu,',');
		//其他老师的学生 去掉重复的  通过转换数组，然后去掉数组里相同的值，再换回字符串
		$other_stu = array_unique(explode(',',$other_stu));
		$other_stu = implode(',',$other_stu);
		

		$b = M('Users')->where("username like '%$phone%' and role != '2' and id not in ($other_stu)")
		               ->field('id as userid,nickname,headerimg,role,username')
		               ->limit(($page-1)*10,10)
		               ->select();

		foreach ($b as $k => $v){
			if(stripos($stu,$v['userid']) !== false){
				$b[$k]['is_student'] = 1;  //表示是本班的学生
			}else{
				$b[$k]['is_student'] = 2;  //不是
			}
		}

		if($b){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';	
			$rest['data'] = $b;		
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '查无数据';	
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}	
	}


//删除班级
	public function del_class(){
		$id = I('userid');
		$class_id = I('class_id');

		$a = M('Class')->where("class_id = '$class_id'")->find();
		if($a['class_teacher'] != $id){
			$this->error2('该用户不是带班老师',2,'不是带班老师');
		}

		@unlink($a['class_img']);
		$b = M('Class')->where("class_id = '$class_id'")->delete();

		$ids = explode(',',$a['class_stuids']);

		foreach ($ids as $k => $v) {
			if(M('Teacher_student')->where("tid = '$id' and sid = '$v'")->find()){
				M('Teacher_student')->where("tid = '$id' and sid = '$v'")->delete();
			}
			M('Users')->where("id = '$v'")->setField('role',3);
		}

		if($b){
			$rest['status'] = true;
			$rest['msg'] = '删除成功';	
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '删除失败';	
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}	
	}

//我的直播  
	public function show_my_live(){
		$id = I('userid');
		$kind = I('kind')?I('kind'):0;
		$page = I('page')?I('page'):1;
		$part = I('part');
		$status = I('status')?I('status'):0;    //0表示预约  1表示直播

	if($status == 0){ //预约情况
		if(!$kind || $kind == 0){
			$a = M('Yuyue')->where("zhubo_id = '$id' and kind = '0'")
		                   ->limit(($page-1)*10,10)
		                   ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
		                   // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id')
		                   ->field('zhubo_id,headerimg,
		                   	        y_time as s_time,y_title_name as title_name,
		                  	        y_roomid as room_id,y_status,yid,
		                  	        y_addtime as addtime,y_img as img,
		                  	        y_shoufei as live_shoufei,y_content as content,
		                  	        y_video_shoufei as video_shoufei')
		                   ->order('s_time DESC')
		                   ->select();
		    foreach ($a as $k => $v) {
		    	$a[$k]['zhubo_truename'] = M('Users')->where("id = '$id'")->getField('nickname');
		    	$a[$k]['status'] = M('Room')->where("room_id = '$v[room_id]'")->getField('status');

		    	if($v['s_time'] == '0000-00-00 00:00:00'){
		    		M('Room')->where("room_id = '$v[room_id]'")->setField('status',2);
		    	}
		    }

		    if($part){
		    	$a = M('Yuyue')->where("yid = '$part' and zhubo_id = '$id'")
			                   ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
	                           ->field('zhubo_id,y_roomid as room_id,y_time as time,yid,
	                           	        y_title_name as title_name,y_status,y_content as content,
	                           	        y_shoufei as shoufei,y_video_shoufei as video_shoufei,
	                           	        nickname as zhubo_name,headerimg,username as phone')
			                   ->find();

				// $a = M('Yuyue')->where("yid = '$part'")->field('y_info,y_status')->find();
			}
		}

		if($kind == 2){
			$a = M('Yuyue')->where("kind = '2' and y_part = '0' and zhubo_id = '$id'")
			               ->limit(($page-1)*10,10)
			               ->order('yid DESC')
			               ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
			               // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id')
		                   ->field('zhubo_id,headerimg,kind,yid,
		                   	        y_roomid as room_id,y_status,
		                   	        y_shoufei as shoufei,y_img as img,
		                   	        y_title_name as title_name,yid,y_img as img,
		                   	        y_addtime as addtime,y_teacher_info as teacher_info,
		                   	        y_content as content')
			               ->select();
		
			foreach($a as $k => $v){
				$b = $v['yid'];
				$a[$k]['s_time'] = M('Room')->where("part = '$v[yid]'")->order('r_id')->getField('s_time');
				$a[$k]['finish_num'] = M('Room')->where("status = '2' and part = '$b'")->count();
				$a[$k]['total_num'] = M('Room')->where("part = '$b'")->count();
				$a[$k]['percent'] = ($a[$k]['finish_num'] / $a[$k]['total_num'])*100;
				$a[$k]['zhubo_name'] = M('Zhubo_reg')->where("zb_id = '$v[zhubo_id]' and zb_kind = '$kind'")->getField('zhubo_truename');
			
			}
			if($part){
				$a = M('Yuyue')->where("yid = '$part'")->field('y_info,y_status')->find();
			}
		}

		
			// $x = M('Yuyue')->where("yid = '$part'")->getField('y_status');
			
			// if($x == 1){
			// 	$a = M('Room')->where("part = '$part' and zhubo_id = '$id'")
			//               ->limit(($page-1)*10,10)
			//               ->join('piano_users on piano_users.id = piano_room.zhubo_id')
			//               ->order('r_id')
	  //                     ->field('zhubo_id,room_id,s_time,title_name,status,live_shoufei as shoufei,video_shoufei,url,video_shoufei,zhubo_name,headerimg,username as phone')
			//               ->select();

			// 	foreach ($a as $k => $v){
			// 		$b = $this->PlayInfoimg($v['url']);//通过这个接口去查地址
			// 		$c = $b['fileSet'][0]['playSet'][0];
			// 		$a[$k]['url'] = $c['url'];
 		// 			$a[$k]['content'] = M('Yuyue')->where("y_roomid = '$v[room_id]'")
 		// 			                              ->getField('y_content');
 					

			// 	}
			// }else{
			// 	$a = M('Yuyue')->where("yid = '$part'")
			// 	               ->field('y_info,y_status,yid,y_title_name as title_name,y_content as
			// 	               	        content,y_time as time,y_shoufei as shoufei,zhubo_id,kind,
			// 	               	        y_teacher_info')
			// 	               ->find();
			// 	$user_id = $a['zhubo_id'];
			// 	$kind = $a['kind'];
			// 	$a['phone'] = M('Users')->where("id = '$user_id'")->getField('username');
			// 	if($kind == 0){
			// 		$a['zhubo_name'] = M('Users')->where("id = '$user_id'")->getField('nickname');
			// 	}else{
			// 		$a['zhubo_name'] = M('Zhubo_reg')->where("zb_id = '$user_id'")
			// 		                                 ->getField('zhubo_truename');
			// 	}
				
			// }
				
				// $a = array_merge($c,$b);
			
		
	}else{//直播列表
		if(!$kind || $kind == 0){
			$a = M('Yuyue')->where("zhubo_id = '$id' and kind = '0' and y_status = '1'")
		                   ->limit(($page-1)*10,10)
		                   ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
		                   // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id')
		                   ->field('zhubo_id,headerimg,yid,
		                   	        y_time as s_time,y_title_name as title_name,
		                  	        y_roomid as room_id,y_status,
		                  	        y_addtime as addtime,y_img as img,
		                  	        y_shoufei as live_shoufei,y_content as content,
		                  	        y_video_shoufei as video_shoufei')
		                   ->order('s_time DESC')
		                   ->select();
	
		    foreach ($a as $k => $v) {
		    	$a[$k]['zhubo_truename'] = M('Users')->where("id = '$id'")->getField('nickname');
		    	$a[$k]['status'] = M('Room')->where("room_id = '$v[room_id]'")->getField('status');

		    	if($v['s_time'] == '0000-00-00 00:00:00'){
		    		M('Room')->where("room_id = '$v[room_id]'")->setField('status',2);
		    	}
		    }

		}


		
		if($kind == 2){
			$a = M('Yuyue')->where("kind = '2' and y_part = '0' and zhubo_id = '$id' and 
				                    y_status = '1'")
			               ->limit(($page-1)*10,10)
			               ->order('yid DESC')
			               ->join('piano_users on piano_users.id = piano_yuyue.zhubo_id')
			               // ->join('piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id')
		                   ->field('zhubo_id,headerimg,kind,
		                   	        y_roomid as room_id,y_status,
		                   	        y_shoufei as shoufei,y_img as img,
		                   	        y_title_name as title_name,yid,y_img as img,
		                   	        y_addtime as addtime,y_teacher_info as teacher_info,
		                   	        y_content as content')
			               ->select();
		
			foreach($a as $k => $v){
				$b = $v['yid'];
				$a[$k]['s_time'] = M('Room')->where("part = '$v[yid]'")->order('r_id')->getField('s_time');
				$a[$k]['finish_num'] = M('Room')->where("status = '2' and part = '$b'")->count();
				$a[$k]['total_num'] = M('Room')->where("part = '$b'")->count();
				$a[$k]['percent'] = ($a[$k]['finish_num'] / $a[$k]['total_num'])*100;
				$a[$k]['zhubo_name'] = M('Zhubo_reg')->where("zb_id = '$v[zhubo_id]' and zb_kind = '$kind'")->getField('zhubo_truename');
			}

			if($part){

				$a = M('Room')->where("part = '$part' and zhubo_id = '$id'")
				              ->limit(($page-1)*10,10)
				              ->order('r_id')
		                      ->field('zhubo_id,room_id,s_time,title_name,status,live_shoufei as shoufei,video_shoufei,url,video_shoufei,kind,part')
				              ->select();

				foreach ($a as $k => $v){
					$b = $this->PlayInfoimg($v['url']);//通过这个接口去查地址
					$c = $b['fileSet'][0]['playSet'][0];
					$a[$k]['url'] = $c['url'];
 					$a[$k]['content'] = M('Yuyue')->where("y_roomid = '$v[room_id]'")
 					                              ->getField('y_content');
 					if($v['kind'] == 2){
 						$a[$k]['zhubo_name'] = M('Zhubo_reg')->where("zb_id = '$v[zhubo_id]'")
 						                                     ->getField('zhubo_truename');
 					}else{
 						$a[$k]['zhubo_name'] = M('Users')->where("id = '$v[zhubo_id]'")
 						                                 ->getField('nickname');
 					}
 					$a[$k]['phone'] = M('Users')->where("id = '$v[zhubo_id]'")
 						                        ->getField('username');

					$a[$k]['y_teacher_info'] = M('Yuyue')->where("yid = '$v[part]'")
 					                                     ->getField('y_teacher_info');
				}
				
			}
		}
	}

		

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';	
			$rest['data'] = $a;		
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '查无数据';		
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}
	}






//添加作业  5-20 新版需求
	public function homework_add1(){
	
		$userid = (int)$_REQUEST['userid'];	
		$lid = (int)$_REQUEST['lid'];
		$speed = (float)$_REQUEST['speed'];   
		$count = (int)$_REQUEST['count'];      //每天几次
		$point = (int)$_REQUEST['point']?I('point'):0;
		$stuid = I('stuid');
		$status = I('status');  //模式  1识谱  2跟弹
		$stime = I('stime');    //开始日期
		$etime = I('etime');    //结束日期

		//‘我’的学生 去掉重复的  通过转换数组，然后去掉数组里相同的值，再换回字符串
		$stu = array_unique(explode(',',$stuid));
		$stuid = implode(',',$stu);

		
		$stu_arr = explode(',',$stuid);
		foreach ($stu_arr as $k => $v) {
			$v1 = $v[$k];
			$tea = M('Teacher')->where("t_userid = '$v1'")->find();
			if($tea){
				$this->error2('选择的对像不能包含其他老师',2,'');
			}
		}
        
		$stime = date('Y-m-d',strtotime($stime));
		$etime = date('Y-m-d',strtotime($etime));
		
		if(!$lid || !$speed || !$count || !$status || !$stime || !$etime){
			$this->error1();
		}
		$sid = M('Songs_list')->where("lid = '$lid'")->getField('list_sid');

		$data = array(
			'lid' => $lid,
			'sid' => $sid,
			'speed' => $speed,
			'count' => $count,
			'point' => $point,
			'stime' => $stime,
			'etime' => $etime,
			'h_status' => $status,
			't_id' =>$userid,
			'stu_id' => $stuid
		);
				
		$add = M('Homework')->add($data);

		if(!$add){
			$this->error2('添加失败',1,'sql错误');
		}
		//给做作业的学生添加消息提示
		

		$teacher = M("Teacher")->where("t_userid='$userid'")->find();
		$content = '亲~'.$teacher['t_truename']."老师给你布置了一个作业,请留意,记得完成哦~";

		$join1 = 'piano_songs_list on piano_songs_list.lid = piano_homework.lid';
	
		$info = M('Homework')->where("hid = '$add'")
							 ->join($join1)
							 ->field('hid,piano_songs_list.lid,list_name as name,
							 	      list_url as url,list_url_music as url_music,
							 	      h_status,speed,count,point')
		                     ->find();
		if(!$info){
			$info = array();
		}

		$info = json_encode($info);
		
		foreach($stu_arr as $v){
			$data = array(
				'x_userid' => $v,
				'x_content' => $content,
				'x_tuisong' => $userid,
				'x_type' => 5,
				'x_time' => date('Y-m-d H:i:s',time()),
				'x_info'=> $info,
				'x_kid'=> $add
				);

			M("User_xiaoxi")->add($data);

			//给登陆学生推送消息
			$stu_loing = M("Token")->where("t_userid='{$v}'")->find();
			if($stu_loing){
				if($stu_loing['t_leixin'] == 2){

					$this->ios_msg_send($content,$stu_loing['t_shebei']);
				}else{
					$this->course_add_tuisong($content,$stu_loing['t_shebei'],$stu_loing['t_leixin'],$v,'作业提醒',3);
				}
				
				
			}

		}
		
		$rest['status'] = true;
		$rest['msg'] = '添加成功';
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;	
	}

//获取课程的老师点评
	public function get_course_pin(){
		$id = I('kid');
		$a = M('Course_list')->where("id = '$id'")->field('cl_xin,cl_pin')->find();
		$b = M('Course_list')->where("id = '$id'")->getField('cl_etime');

		if($b < time()){
			$rest['status'] = false;
			$rest['msg'] = '查无数据';
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '查无数据';
		}
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}


	public function show_zhubo_renzhen(){
		$id = I('userid');
		$kind = I('kind');

		$a = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->find();
		if(!$a){
			$rest['status'] = false;
			$rest['msg'] = '查无数据';
		}else{
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;		
		}
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	}





































	public function upload(){
		$this->display();
	}






    public function PlayInfoimg($vid){
        /*DescribeInstances 接口的 URL地址为 cvm.api.qcloud.com，可从对应的接口说明 “1.接口描述” 章节获取该接口的地址*/
        $HttpUrl="vod.api.qcloud.com";
           // $fileid  =$_REQUEST['fileid'];
      
            // exit();
      	/*除非有特殊说明，如MultipartUploadVodFile，其它接口都支持GET及POST*/
      	$HttpMethod="GET"; 

		/*是否https协议，大部分接口都必须为https，只有少部分接口除外（如MultipartUploadVodFile）*/
		$isHttps =true;

		//从云ＡＰＩ密钥中获取
		/*需要填写你的密钥，可从  https://console.qcloud.com/capi 获取 SecretId 及 $secretKey*/
		$secretKey='HQQFsJXYN0R0aDrV6azQlvtgHqQ1eHk0';


		// 下面这五个参数为所有接口的 公共参数；对于某些接口没有地域概念，则不用传递Region（如DescribeDeals）
		$COMMON_PARAMS = array(
		      'Nonce'=> rand(),
		      'Timestamp'=>time(),
		      'Action'=>'DescribeRecordPlayInfo',
		      'SecretId'=> 'AKIDALNG2eiHI7lOxLSWM0RgidLD731qBv9P',
		      'Region' =>'gz',

		);

		/*下面这两个参数为 DescribeInstances 接口的私有参数，用于查询特定的虚拟机列表*/
		// 存放其他参数
		$PRIVATE_PARAMS = array(
		  'vid' =>$vid,
		);

		$info = $this->CreateRequest($HttpUrl,$HttpMethod,$COMMON_PARAMS,$secretKey,$PRIVATE_PARAMS,$isHttps );
		return $info;exit;
		// $FullHttpUrl = $HttpUrl."/v2/index.php";
	}


	private function CreateRequest($HttpUrl,$HttpMethod,$COMMON_PARAMS,$secretKey,
		                           $PRIVATE_PARAMS, $isHttps){
    $FullHttpUrl = $HttpUrl."/v2/index.php";

    /***************对请求参数 按参数名 做字典序升序排列，注意此排序区分大小写*************/
    $ReqParaArray = array_merge($COMMON_PARAMS, $PRIVATE_PARAMS);
    ksort($ReqParaArray);

    /**********************************生成签名原文**********************************
     * 将 请求方法, URI地址,及排序好的请求参数  按照下面格式  拼接在一起, 生成签名原文，此请求中的原文为 
     * GETcvm.api.qcloud.com/v2/index.php?Action=DescribeInstances&Nonce=345122&Region=gz
     * &SecretId=AKIDz8krbsJ5yKBZQ    ·1pn74WFkmLPx3gnPhESA&Timestamp=1408704141
     * &instanceIds.0=qcvm12345&instanceIds.1=qcvm56789
     * ****************************************************************************/
    $SigTxt = $HttpMethod.$FullHttpUrl."?";

    $isFirst = true;
    foreach ($ReqParaArray as $key => $value){
        if (!$isFirst) 
        { 
            $SigTxt = $SigTxt."&";
        }
        $isFirst= false;

        /*拼接签名原文时，如果参数名称中携带_，需要替换成.*/
        if(strpos($key, '_'))
        {
            $key = str_replace('_', '.', $key);
        }

        $SigTxt=$SigTxt.$key."=".$value;
    }

    /*********************根据签名原文字符串 $SigTxt，生成签名 Signature******************/
    $Signature = base64_encode(hash_hmac('sha1', $SigTxt, $secretKey, true));


    /***************拼接请求串,对于请求参数及签名，需要进行urlencode编码********************/
    $Req = "Signature=".urlencode($Signature);
    foreach ($ReqParaArray as $key => $value){
        $Req=$Req."&".$key."=".urlencode($value);
    }

    /*********************************发送请求********************************/
    if($HttpMethod === 'GET'){
        if($isHttps === true){
            $Req="https://".$FullHttpUrl."?".$Req;
        }
        else{
            $Req="http://".$FullHttpUrl."?".$Req;
        }

        $Rsp = file_get_contents($Req);

    }else{
        if($isHttps === true){
            $Rsp= $this->SendPost("https://".$FullHttpUrl,$Req,$isHttps);
        }
        else{
            $Rsp= $this->SendPost("http://".$FullHttpUrl,$Req,$isHttps);
        }
    }

    //var_export(json_decode($Rsp,true));exit;
    return json_decode($Rsp,true);

	}

	private function SendPost($FullHttpUrl,$Req,$isHttps){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $Req);

        curl_setopt($ch, CURLOPT_URL, $FullHttpUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($isHttps === true) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,  false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  false);
        }

        $result = curl_exec($ch);
        return $result;
	}



	public function join_group($id,$yid){
		// $id = I('userid');
		// $yid = I('classid');

		$a = M('Group')->where("g_classid = '$yid'")->find();
		
		if(!$a){
			$data['g_tid'] = M('Yuyue')->where("yid = '$yid'")->getField('zhubo_id');
			$data['g_stuids'] = $id;
			$data['g_classid'] = $yid;
			$b = M('Group')->add($data);
		}else{
			if(stripos($a['g_stuids'],$id) !== false ){
				exit;
			}

			if($a['g_stuids']){
				$stu = $a['g_stuids'].','.$id;
			}else{
				$stu = $id;
			}

			$b = M('Group')->where("g_classid = '$yid'")->setField('g_stuids',$stu);

		}
		$c = M('Users')->where("id = '$id'")->getField('role');
		if($c == 3){
			M('Users')->where("id = '$id'")->setField('role',1);
		}

		
	}


	public function show_group(){
		$id = I('classid');
		$a = M('Group')->where("g_classid = '$id'")->find();

		if(!$a){
			$this->error2('没有该班级',2,'没有该班级');
		}

		if($a['g_stuids']){
			$user = $a['g_tid'].','.$a['g_stuids'];
		}else{
			$user = $a['g_tid'];
		}
		$user = explode(',',$user);
		
		foreach ($user as $k => $v) {
			$b[$k] = M('Users')->where("id = '$v'")->field('id,nickname,headerimg,role as type')->find();
			
		}

		if(!$b){
			$rest['status'] = false;
			$rest['msg'] = '查无数据';
		}else{
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $b;
		}
		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;

	}


	public function check_zhubo(){
		$id = I('userid');
		$kind = I('kind')?I('kind'):2;

		$a = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->find();
		//dump($a);exit;
		if(!$a){
			if($kind == 1){
				$this->error2('您没有进行过教学直播认证',2,'');
			}else{
				$this->error2('您没有进行过培训直播认证',2,'');
			}
			
		}


		if($a['zbrz_status'] != 2){
			$this->error2('不能预约,审核还没通过',2,'');
		}else{
			$rest['status'] = true;
			$rest['msg'] = '通过';
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}
	}


	public function show_jx_banner(){
		$a = M('Banner')->where("b_set = '3'")->select();
		$b = M('Lunbotu')->where("id = '1'")->find;
		if($a){
			$rest['status'] = true;
			$rest['msg'] = '查询成功';
			$rest['data'] = $a;
			$rest['data']['speed'] = $b['speed'];
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$rest['status'] = false;
			$rest['msg'] = '查无数据';
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}


	}


	public function del_tiezi(){
		$id = I('userid');
		$tz_id = I('tz_id');


		$a = M('Luntan')->where("tiezi_id = '$tz_id'")->find();
		if(!$a){
			$this->error2('该贴子不存在',2,'');
		}

		if($a['l_userid'] != $id){
			$this->error2('不是发贴人，不能删除',2,'');
		}

		$data['l_content'] = '此贴已被删除';
		$data['l_img'] = '';
		$data['l_video'] = '';
		$data['l_photo'] = '';
		$data['l_wadr'] = '';
		$data['l_wtime'] = '';
		$data['l_etime'] = '';


		$b= M('Luntan')->where("tiezi_id = '$tz_id'")->save($data);
		if($b){
			$rest['status'] = true;
			$rest['msg'] = '删除成功';
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('删除失败',2,'');
		}

	}




	public function get_news(){
		$id = I('userid');
		$a = M('User_xiaoxi')->where("x_userid = '$id' and x_kind = '1'")
							 ->count();
		
		$rest['status'] = true;
		$rest['msg'] = '查询成功';
		$rest['data'] = $a?$a:0;
		echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
	}


	public function read_news(){
		$id = I('userid');
		if(M('User_xiaoxi')->where("x_userid = '$id' and x_kind = '1'")->find()){
			$a = M('User_xiaoxi')->where("x_userid = '$id' and x_kind = '1'")
							     ->setField('x_kind',2);
		}else{
			$a = 1;
		}
		

		if($a){
			$rest['status'] = true;
			$rest['msg'] = '消息读取成功';
			echo json_encode($rest,JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('消息修改失败',2,'');
		}
	}





//这里是升级到V3的极光推送，实际运用的只有IOS   代码根据example修改
	public function ios_msg_send($content,$shebei){
		require_once './Piano/Home/Common/jpush-api-php-client-3.5.12/autoload.php';
		header('content-type:text/html;charset=utf8');

		$appkeys = C('D_APPKEY');
		$masterSecret = C('D_MAS');

		$client = new \JPush\Client($appkeys, $masterSecret);

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
                
  //前台不做手机绑定极光，所以发过来的IOS还要先检测下，看它有没有对应的registration_id           
		$a = $client->device()->getAliasDevices($shebei);
		                        
		if(!$a){
			return false;
		}

		if(!$a['body']['registration_ids']){
			return false;
		}
		
        $b =   $client->push()
               ->setPlatform(array('ios'))
               // ->setNotificationAlert('人生自古多艰难')
               ->addAlias($shebei)
               ->iosNotification($content, array(
					             'sound' => 'sound.caf',
					             'badge' => '+1',
					             'content-available' => true,
					             'mutable-content' => true,
					             'category' => 'jiguang',
					             'extras' => array(
					                'key' => 'value',
					                'jiguang'
                                 ),
                                ))
                ->options(array(
		            // sendno: 表示推送序号，纯粹用来作为 API 调用标识，
		            // API 返回时被原样返回，以方便 API 调用方匹配请求与返回
		            // 这里设置为 100 仅作为示例

		            // 'sendno' => 100,

		            // time_to_live: 表示离线消息保留时长(秒)，
		            // 推送当前用户不在线时，为该用户保留多长时间的离线消息，以便其上线时再次推送。
		            // 默认 86400 （1 天），最长 10 天。设置为 0 表示不保留离线消息，只有推送当前在线的用户可以收到
		            // 这里设置为 1 仅作为示例

		            // 'time_to_live' => 1,

		            // apns_production: 表示APNs是否生产环境，
		            // True 表示推送生产环境，False 表示要推送开发环境；如果不指定则默认为推送生产环境

		            'apns_production' => false,

		            // big_push_duration: 表示定速推送时长(分钟)，又名缓慢推送，把原本尽可能快的推送速度，降低下来，
		            // 给定的 n 分钟内，均匀地向这次推送的目标用户推送。最大值为1400.未设置则不是定速推送
		            // 这里设置为 1 仅作为示例

		            // 'big_push_duration' => 1
                ))

               ->send();


               // dump($b);exit;

	}





	public function roomxiang(){
		$url1 = M('App')->where("app_kind = '1'")->order('app_id DESC')->getField('app_url');
		$url2 = M('App')->where("app_kind = '2'")->order('app_id DESC')->getField('app_url');

		$this->assign('url1',$url1);
		$this->assign('url2',$url2);

		$params = I('params');
		// echo $params;exit;

		$this->assign('room_url',$params);
		$this->display();
	}


//对应类别的教材
	public function get_songs1(){
		$cid = (int)$_REQUEST['cid'];
		
		$page = empty($_REQUEST['page'])?1:$_REQUEST['page'];//页码
		$number = empty($_REQUEST['number'])?30:$_REQUEST['number'];//每页显示数量
		$offset = $number*($page-1);//->limit($offset,$number)
		
		$list = M('Songs')->field("sid,songs_name as name,songs_img as img")
		                  ->where("songs_cid='{$cid}' and songs_status='1'")
		                  ->order('songs_sort ASC')
		                  ->limit($offset,$number)
		                  ->select();
	   
	    if($list){
	    	$rest['status'] = true;
    		$rest['msg'] = '获取成功';
    		$rest['data'] = $list;
    		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    }else{
	    	$rest['status'] = false;
    		$rest['msg'] = '亲，暂时没有数据噢';
    		echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
	    }	
    	
	   
	}



	//曲谱中心类别表
	public function songs_catgroy1(){
	
		$userid = (int)$_REQUEST['userid'];//登陆后要传
		$type = I('type');
			
		$where = "(c_status=1 and cid in (2,3,4))";
		
		//判断用户属于哪个琴行，获取专属教材,跟老师有关
		$role = M("Users")->field('role')->where("id='{$userid}'")->find()['role'];
		
		if($role == '1'){//学生
		//之所以分开查询，是因为以前的数据混乱，用联合查询join  会导致查出来的zhuan_catid中有空白	
			$a = M("Class")->where("class_stuids like '%$userid%'")->select();
			
			if($a){
				foreach ($a as $k => $v) {
				//这里真心蛋疼  用stripos($v['class_stuids'],$userid) 居然会出问题  
				//if(stripos($v['class_stuids'],$userid) !== false){
				//		$tid .= $v['class_teacher'].',';
				//}
					$x = explode(',',$v['class_stuids']);
					foreach ($x as $key => $value) {
						if($value == $userid){
							$is_stu = 1; 
							break;
						}
					}

				    if($is_stu){
				    	$tid .= $v['class_teacher'].',';
				    }else{
				    	$tid = 0;
				    }                 	
				}    
				
				$tid = trim($tid,',');  
				$tid = array_unique(explode(',',$tid));
				$tid = implode(',',$tid);

				$b =  M('Teacher')->where("t_userid in ($tid)")->select();

				foreach ($b as $k => $v) {
				    $jxid .= $v['t_jxid'].',';    
				}  

	            $jxid = trim($jxid,',');
	           
	            if($jxid){
	            	$c = M('Dealers')->where("jxid in ($jxid)")->select();
	            }
			    
			    foreach ($c as $k => $v) {
			    	$zhuan_catid .= $v['jx_catid'].',';
			    }
			   		
			    $zhuan_catid = trim($zhuan_catid,',');  
				$zhuan_catid = array_unique(explode(',',$zhuan_catid));
				$zhuan_catid = implode(',',$zhuan_catid);

				if($zhuan_catid){
		    		$where .= " or (c_status=1 and cid in ($zhuan_catid))";
		    	}

			}
		
		   
		
		}elseif($role == '2'){//老师
			$jxid = M("Teacher")->field('t_jxid')->where("t_userid='{$userid}'")->find()['t_jxid'];
			
			$zhuan_catid = M("Dealers")->where("jxid='{$jxid}'")->find()['jx_catid'];
			
		    if($zhuan_catid){
		    	$where .= " or (c_status=1 and cid='{$zhuan_catid}')";
		    }
		}

		//echo $where;exit;
		$list = M("Songs_catgroy")->where($where)->order("cid DESC")->select();
		
			
		$res = array();
		foreach($list as $k=>$val){
			
			$data['cid'] = $val['cid'];
			$data['name'] = $val['c_name'];
			$res[$k] = $data;
		}
		if($res){
			if($type ==12){
				$res = 0;
				$res = M('Songs_catgroy')->where("cid ='8'")->field('cid,c_name as name')->select();
			}
			$rest['status'] = true;
			$rest['msg'] = '获取成功';
			$rest['data'] = $res;
			
			echo json_encode($rest, JSON_UNESCAPED_UNICODE);exit;
		}else{
			$this->error2('获取失败',1,'亲，暂时没有数据噢');
		}
		
	}




















}

