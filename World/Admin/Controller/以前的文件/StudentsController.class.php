<?php
/*班级管理
 * */
namespace Admin\Controller;
use Think\Controller;
class StudentsController extends CommonController {
    //添加学生
    public function student_add(){
    	if(IS_POST){
    		$name = trim($_POST['name']);
    		if(empty($name)){
    			echo '姓名不能为空';exit;
    		}
    		$phone = trim($_POST['phone']);
    		if(!$this->ckeck_mobile($phone)){
    			echo '请输入有效的手机号';exit;
    		}else{
    			if(M('Users')->where("username='{$phone}'")->find()){
    				echo '该手机已经注册过app了，请更换~';exit;
    			}
    		}
    		$sex = trim($_POST['sex']);
    		$tid = $_POST['tid'];
    		if($tid == ''){
    			echo '请选择老师';exit;
    		}
    		
    		M('Users')->startTrans();
    		
    		$pwd = md5(MA.'123456');
    		//1.创建学生账号
    		$user_data = array(
    			            'username' => $phone,
    				        'pwd' => md5(MA.'123456'),
    				        'nickname' => $name,
    				        'sex' => $sex,
    				        'add_time'=> date('Y-m-d H:i:s',time()),
    				        'role' => 1
    		             );
    		
    		$add_user = M('Users')->add($user_data);
    		//2.建立朋友关系
    		$friend_data = array(
    			               'userid' =>$add_user,
    				           'friend_id' => $tid,
    		                );
    		$add_friend = M('User_friends')->add($friend_data);
    		//3.建立师生关系
    		$teac_stu = array(
	    			        'sid'=>$add_user,
	    				    'tid'=>$tid,
	    				    'time'=>date('Y-m-d H:i:s',time())
    		             );
    		$add_teac_stu = M("Teacher_student")->add($teac_stu);
    		
    		if($add_user && $teac_stu && $add_teac_stu){
    			M('Users')->commit();
    			
    			//发送短信通知
    			$contetn = "亲~,子昊钢琴给您注册了账号:".$phone.",初始密码：123456,欢迎下载使用http://lelego.net.cn/dowonlaod.html";
    			//发送短信
    			$msg = $contetn."【子昊钢琴】";
    			$this ->sendMessage($phone,$msg);
    			
    			echo 1;exit;
    		}else{
    			M('Users')->rollback();
    			echo '操作失败,请联系管理员~';exit;
    		}
    	}
    	
    	//老师列表
        if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_users.role='2' and piano_teacher.t_status= 2 ";
    	}else if($_SESSION['piano_user']['role'] == 2){
    		//获取代理商下所有的分销商id 
    		$jxids = M("Dealers")->where("jx_parent='{$_SESSION['piano_user']['jx_jigou']}'")->select();
    		$ids = '';
    		foreach($jxids as $v){
    			$ids.= $v['jxid'].',';	
    		}
    		if($ids){
    			$ids = rtrim($ids,',');
    		}else{
    			$ids = 0;
    		}
    		$where = "piano_users.role='2' and piano_teacher.t_jxid in ({$ids}) and piano_teacher.t_status= 2 ";
    
    	}else if($_SESSION['piano_user']['role'] == 3){
    		$where = "piano_users.role='2' and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jx_jigou']}' and piano_teacher.t_status= 2 ";
    	}else{
    		echo '无权限';
    	}
    	 

    	$field = "piano_teacher.t_userid,piano_teacher.t_truename";
    	$join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id";
    	
    	$list = M("Users")->field($field)
					    	->join($join1)
					    	->where($where)
                            ->select();
    	 
    	 
    	//echo '<pre/>';
    	//var_dump($list);exit;
    	$this->assign('list',$list);
    	$this->display();
    }
	//学生搜
	public function student_list_sou(){
		if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$dealers = M("Dealers")->where("jx_status='1'")->select();
			$this->assign('dealers',$dealers);
				
			$where = "piano_users.role = '1'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			$dealers = M("Dealers")->where("jx_status='1' and (jx_parent='{$_SESSION['piano_user']['jx_jigou']}' or jxid='{$_SESSION['piano_user']['jx_jigou']}')")->select();
			$this->assign('dealers',$dealers);
				
			foreach($dealers as $v){
				$ids.= $v['jxid'].',';
			}
			if($ids){
				$ids = rtrim($ids,',');
			}else{
				$ids = 0;
			}
				
			$where = "piano_users.role = '1' and piano_teacher.t_jxid in ({$ids})";
		}else if($_SESSION['piano_user']['role'] == 3){
				
			$where = "piano_users.role = '1' and piano_teacher.t_jxid='{$_SESSION['piano_user']['jx_jigou']}'";
		}else{
			echo '权限不够';exit;
		}
		
		//搜索条件	
			$jxid = $_POST['jxid'];
			if($jxid != ''){
				$where .= " and piano_dealers.jxid = '{$jxid}'";
		
				$this->assign('jxid',$jxid);
			}
			
				
			$username = trim($_POST['username']);
			if($username){
				$where .= " and piano_users.username like '%{$username}%'";
				$this->assign('username',$username);
			}
			
			$stime = trim($_POST['stime']);
			if($stime){
				$where .= " and UNIX_TIMESTAMP(piano_teacher_student.time) >= UNIX_TIMESTAMP('$stime 00:00:00')";
				$this->assign('stime',$stime);
			}
		
			$etime = trim($_POST['etime']);
			if($etime){
				$where .= " and UNIX_TIMESTAMP(piano_teacher_student.time) <= UNIX_TIMESTAMP('$etime 00:00:00')";
	
				$this->assign('etime',$etime);
			}
				
			$button = $_POST['button'];
			if(empty($username) && empty($jxid) && empty($stime) && empty($etime)){
				//如果是点击页码发起的请求，则按只保存的条件搜索
				if(!$button){
					if($_SESSION['class_list_sou']){
					$where = $_SESSION['class_list_sou'];
					}
				}
			}
		      $_SESSION['class_list_sou'] = $where;
		
		
			//学生列表
			$join1 = "piano_users on piano_users.id=piano_teacher_student.sid";
			$join2 = "piano_teacher on piano_teacher.t_userid=piano_teacher_student.tid";
			$join3 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
		
				 
		       $count = M("Teacher_student")->join($join1)
										     ->join($join2)
											 ->join($join3)
											 ->where($where)
											 ->count();
		    	//实例化分页类
		    	$Page = new \Think\Page($count,$this->pagenum);
		    	//设置上一页与下一页
		    	$Page->setConfig('prev', '上一页');
		    	$Page->setConfig('next', '下一页');
		    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		    	//显示分页信息
    	        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		    	 
		    	$students = M("Teacher_student")->join($join1)
				    	->join($join2)
				    	->join($join3)
		    			->where($where)
		    			->limit($Page->firstRow.','.$Page->listRows)
		    			->order("UNIX_TIMESTAMP(piano_teacher_student.time) DESC")
		    			->select();
		    			 
    			foreach($students as $k=>$v){
		    		//设备是否认证
		    		$sb = M("Shebei")->field('sb_status')->where("sb_userid='{$v['id']}'")->find();
		    		if($sb){
		    		    $students[$k]['sb_status'] = $sb['sb_status'];
		    		}else{
		    		     $students[$k]['sb_status'] = 1;
		    		}
		    		$students[$k]['class_name'] = M('Class')->field('class_name')->where("class_teacher='{$v['t_userid']}'")->find()['class_name'];
		    				//弹奏总次数
		    				$students[$k]['count'] = M("Practice_log")->where("log_userid='{$v['id']}'")->count();
		    		//弹奏总时长
		
			    		if($students[$k]['count'] != 0){
			    			$students[$k]['long'] = (int)M("Practice_log")->where("log_userid='{$v['id']}'")->sum('log_long');
			    		}else{
			    		   $students[$k]['long'] = 0;
			    		}
    	    	}
		    				 
		
		        //dump($students);exit;
				$this->assign('page',$show);
				$this->assign('list',$students);
				$this->display('student_list');
	}
	//学生列表
	public function student_list(){
	    if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$dealers = M("Dealers")->where("jx_status='1'")->select();
			$this->assign('dealers',$dealers);
			
			$where = "piano_users.role = '1'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			$dealers = M("Dealers")->where("jx_status='1' and (jx_parent='{$_SESSION['piano_user']['jx_jigou']}' or jxid='{$_SESSION['piano_user']['jx_jigou']}')")->select();
			$this->assign('dealers',$dealers);
			
			foreach($dealers as $v){
				$ids.= $v['jxid'].',';
			}
			if($ids){
				$ids = rtrim($ids,',');
			}else{
				$ids = 0;
			}
			
			$where = "piano_users.role = '1' and piano_teacher.t_jxid in ({$ids})";
		}else if($_SESSION['piano_user']['role'] == 3){
			
			$where = "piano_users.role = '1' and piano_teacher.t_jxid='{$_SESSION['piano_user']['jx_jigou']}'";
		}else{
			echo '权限不够';exit;
		}
		
		

    	//学生列表    	
    	$join1 = "piano_users on piano_users.id=piano_teacher_student.sid";
    	$join2 = "piano_teacher on piano_teacher.t_userid=piano_teacher_student.tid";
    	$join3 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
    
    	
    	$count = M("Teacher_student")->join($join1)
								    	->join($join2)
								    	->join($join3)
								    	->where($where)
    	                                ->count();
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
    	
    	$students = M("Teacher_student")->join($join1)
								    	->join($join2)
								    	->join($join3)
								    	->where($where)
								    	->limit($Page->firstRow.','.$Page->listRows)
								    	->order("UNIX_TIMESTAMP(piano_teacher_student.time) DESC")
								    	->select();
    	
    	foreach($students as $k=>$v){
    		//设备是否认证
    		$sb = M("Shebei")->field('sb_status')->where("sb_userid='{$v['id']}'")->find();
    		if($sb){
    			$students[$k]['sb_status'] = $sb['sb_status'];
    		}else{
    			$students[$k]['sb_status'] = 1;
    		}
    		$students[$k]['class_name'] = M('Class')->field('class_name')->where("class_teacher='{$v['t_userid']}'")->find()['class_name'];
    		//弹奏总次数
    		$students[$k]['count'] = M("Practice_log")
                                    ->join('piano_songs_list  on piano_songs_list.lid =piano_practice_log.log_lid')
                                    ->where("log_userid='{$v['id']}'")->count();
    		//弹奏总时长
    		
    		if($students[$k]['count'] != 0){
    			$students[$k]['long'] = (int)M("Practice_log")->where("log_userid='{$v['id']}'")->sum('log_long');
    		}else{
    			$students[$k]['long'] = 0;
    		}
    	}
    	
		
		//dump($students);exit;
		$this->assign('page',$show);
		$this->assign('list',$students);
		$this->display();
	}
	
	//修改学生
	public function student_edit(){
		if(IS_POST){
			$userid = $_POST['userid'];
			$tid = $_POST['tid'];
			$password = trim($_POST['newpassword']);
			$re_password = trim($_POST['passwordagain']);
			
			//原老师id
			$old_tid = M("Teacher_student")->where("sid='{$userid}'")->find()['tid'];
			
			if($password){//需修改密码
				if($password == $re_password){
					$password = md5(MA.md5($password));
					
					$set1 = M("Users")->where("id='{$userid}'")->setField('pwd',$password);
						
				}else{
					echo '两次密码不一致';exit;
				}
			}
					
			if($tid == $old_tid){
				echo 1;exit;
			}else{
				//建立朋友关系
				$is_friend = M("User_friends")->where("(userid='{$userid}' and friend_id='{$tid}') or (userid='{$tid}' and friend_id='{$userid}')")->find();
				if($is_friend){
					if($is_friend['u_status'] == 2){
						M("User_friends")->where("(userid='{$userid}' and friend_id='{$tid}') or (userid='{$tid}' and friend_id='{$userid}')")->setField('u_status',1);
					}
				}else{
					M("User_friends")->add(array(
						               'userid' =>$userid ,
						               'friend_id' =>$tid
					));
					
				}
				//修改师生关系
				$set2 = M("Teacher_student")->where("sid='{$userid}'")->setField('tid',$tid);
				if($set2){
					echo 1;exit;
				}else{
					echo 'sql错误，请联系管理员处理~';exit;
				}
			}
			
			
			
		}
	}
       
    public function student_show_uppwd(){
    	//老师列表
        if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_users.role='2' and piano_teacher.t_status= 2 ";
    	}else if($_SESSION['piano_user']['role'] == 2){
    		//获取代理商下所有的分销商id 
    		$jxids = M("Dealers")->where("jx_parent='{$_SESSION['piano_user']['jx_jigou']}'")->select();
    		$ids = '';
    		foreach($jxids as $v){
    			$ids.= $v['jxid'].',';	
    		}
    		if($ids){
    			$ids = rtrim($ids,',');
    		}else{
    			$ids = 0;
    		}
    		$where = "piano_users.role='2' and piano_teacher.t_jxid in ({$ids}) and piano_teacher.t_status= 2 ";
    
    	}else if($_SESSION['piano_user']['role'] == 3){
    		$where = "piano_users.role='2' and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jx_jigou']}' and piano_teacher.t_status= 2 ";
    	}else{
    		echo '无权限';
    	}
    	 

    	$field = "piano_teacher.t_userid,piano_teacher.t_truename";
    	$join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id";
    	
    	$list = M("Users")->field($field)
					    	->join($join1)
					    	->where($where)
                            ->select();
    	$this->assign('list',$list);
    	
        $data['username'] = I('username');
        $data['t_truename'] = I('t_truename');
        
        $userid = M("Users")->where("username='{$data['username']}'")->find()['id'];
        $tid = M("Teacher_student")->where("sid='{$userid}'")->find()['tid'];
   
        $this->assign('userid',$userid);
        $this->assign('tid',$tid);
        $this->assign('data',$data);
        $this->display();
    }
    
    //删除学生
    public function delete_student(){
    	if(IS_POST){
    		$userid = $_POST['userid'];
    		M("Users")->startTrans();
    	
    		//取消学生身份
    		$set = M("Users")->where("id='{$userid}'")->setField('role',3);
    		//解除师生关系
    		$delete = M("Teacher_student")->where("sid='{$userid}'")->limit(1)->delete();
    		if($set && $delete){
    			M("Users")->commit();
    			echo '1';exit;
    		}else{
    			M("Users")->rollback();
    			echo '操作失败，请联系管理员';exit;
    		}
    		 
    	}
    }


    public function student_xiang(){

    	$id = I('id');

    	$user = M('Users')->where("id = '$id'")->find();


    	$fc = M('focus')->where("f_userid = '$id' and f_status = 1")->count();    //被关注者有多少粉丝

    	$this->assign('fc',$fc);
    	$this->assign('user',$user);


        $count = M('Practice_log')->join('piano_songs_list  on piano_songs_list.lid =piano_practice_log.log_lid')
                                 ->where("log_userid = '$id'")->count();

        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        

    	$list = M('Practice_log')->join('piano_songs_list  on piano_songs_list.lid =piano_practice_log.log_lid')
    							 ->where("log_userid = '$id'")->order('log_time DESC')
                                 ->limit($Page->firstRow.','.$Page->listRows)
                                 ->select();

        
      
        
        $this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display();
    }



}