<?php
/*认证管理
 * */
namespace Admin\Controller;
use Think\Controller;
class RenzhengController extends CommonController {
	
	//教师认证
	public function renzheng_teacher(){
	   $tid = $_REQUEST['tid'];
	   $status = $_POST['status'];
	   // echo $tid;exit;
	   $t_userid = M("Teacher")->field('t_userid')->where("tid='$tid'")->find()['t_userid'];  //查找对应的教师信息
	   //  dump($t_userid);exit;
	   M("Teacher")->startTrans();

	    $c = M('Token')->where("t_userid = '$t_userid'")->find();
	   $set1 = M("Teacher")->where("tid='$tid'")->setField('t_status',$status);   //更新教师的审核状态
	 	// dump($set1);exit;
	   if($set1){
	   		if($status == 2){
	   			$content = '您申请的教师认证已同意';
	   	   	  if($c['t_shebei'] && $c['t_leixin']){
	   	   	  	if($c['t_leixin'] == 2){
	   	   	  		$f= $this->ios_msg_send($content,$c['t_shebei'],$t_userid);
	   	   	  	}else{
					$f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$t_userid);
				}
				$data = array(
				'x_userid' => $t_userid,       //接收消息的id
				'x_content' => $content,  //内容
				'x_tuisong' => 1,    //推送方id
				'x_type' => 8,				//消息类型
				'x_time' => date('Y-m-d H:i:s',time()),   //时间
				'x_info' => json_encode(array('kind'=>3))
				);

				M("User_xiaoxi")->add($data);
	   	   	  }
	   		}
	   		if($status == 3){
	   			$content = '您申请的教师认证已拒绝';
	   	   	  if($c['t_shebei'] && $c['t_leixin']){
	   	   	  	if($c['t_leixin'] == 2){
	   	   	  		$f= $this->ios_msg_send($content,$c['t_shebei'],$t_userid);
	   	   	  	}else{
					$f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$t_userid);
				}
				$data = array(
				'x_userid' => $t_userid,       //接收消息的id
				'x_content' => $content,  //内容
				'x_tuisong' => 1,    //推送方id
				'x_type' => 8,				//消息类型
				'x_time' => date('Y-m-d H:i:s',time()),   //时间
				'x_info' => json_encode(array('kind'=>3))
				);

				M("User_xiaoxi")->add($data);
	   	   	  }
	   		}
	   }
	   if($status == 2){
	   	 	$role = M("Users")->where("id='$t_userid'")->getField('role');
	   	 	if($role != 2){
	   	 		$set2 = M("Users")->where("id='$t_userid'")->setField('role',2);    //更改用户表里用户的身份
	   	 	}
	     	
			$del = M("Teacher_student")->where("sid='{$t_userid}'")->limit(1)->delete();//假如申请前是学生，删除其绑定的老师
	     	if($set1){
	     		M("Teacher")->commit();
	     		echo 1;exit;
	     	}else{
	     		M("Teacher")->rollback();
	     		echo '操作失败';exit;
	     	}
	   }else{
		   	if($set1){
		   		M("Teacher")->commit();
		   		echo 1;exit;
		   	}else{
		   		M("Teacher")->rollback();
		   		echo '操作失败';exit;
		   	}
	   }
	  
	}
	//教师认证搜索
	public function teacher_renzheng_list_sou(){
		$mod = I('mod');
		$this->assign('mod',$mod);

		if($mod == 1){
   			$where = "t_status != '2'";
   		}elseif($mod == 2){
   			$where = "t_status = '1'";
   		}else{
   			$where = "t_status = '3'";
   		}

	    if($_SESSION['piano_user']['role'] == 1){
	   		
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
	   		$where .= " and piano_teacher.t_status != 2 and piano_teacher.t_jxid in ({$ids})";
	   	}else if($_SESSION['piano_user']['role'] == 3){
	   		$where = "piano_teacher.t_status != 2 and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
	   	}else{
	   		echo '无权限';
	   	}
		
		$name = trim($_POST['name']);
		if($name){
			$where .= " and piano_teacher.t_truename='{$name}'";
			$this->assign('name',$name);
		}
		 
		$username = trim($_POST['username']);
		if($username){
			$where .= "and piano_users.username='{$username}'";
			$this->assign('username',$username);
		}
		 
		$jxid = trim($_POST['jxid']);
		if($jxid){
			$where .= " and piano_teacher.t_jxid='{$jxid}'";
			$this->assign('jxid',$jxid);
		}
		 
		$jx_name = trim($_POST['jx_name']);
		 
		if($jx_name){
			$where .= " and piano_dealers.jx_name='{$jx_name}'";
			$this->assign('jx_name',$jx_name);
		}
			 
			 
		$stime = trim($_POST['stime']);
		if($stime){
		$where .= " and UNIX_TIMESTAMP(piano_teacher.t_addtime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
	
				$this->assign('stime',$stime);
		}
		 
		$etime = trim($_POST['etime']);
		if($etime){
		$where .= " and UNIX_TIMESTAMP(piano_teacher.t_addtime) <= UNIX_TIMESTAMP('$etime 00:00:00')";
	
		$this->assign('etime',$etime);
		}
		 
		$button = $_POST['button'];
		if(empty($name) && empty($username) && empty($jxid) && empty($jx_name) && empty($stime) && empty($etime)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['teacher_renzheng_list_sou']){
					$where = $_SESSION['teacher_renzheng_list_sou'];
				}
			}
		}
		$_SESSION['teacher_renzheng_list_sou'] = $where;
			
   	   $field = "piano_users.id,piano_users.username,piano_users.headerimg,";
   	   $field .= "piano_teacher.*,";
   	   $field .= "piano_dealers.jx_name";
   	   $join1 = "piano_users on piano_teacher.t_userid= piano_users.id";
   	   $join2 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
   	    
   	   $count = M("Teacher")->field('piano_teacher.tid')
					   	   ->join($join1)
					   	   ->join($join2)
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
   	   
   	   $list = M("Teacher")->field($field)
   	                       ->join($join1)
					   	   ->join($join2)
					   	   ->where($where)
					   	   ->limit($Page->firstRow.','.$Page->listRows)
					   	   ->order("UNIX_TIMESTAMP(piano_teacher.t_addtime) DESC")->select();
   	  
		// echo '<pre/>';
		// var_dump($list);exit;
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display('teacher_renzheng_list');
	}
   //教师认证
   public function teacher_renzheng_list(){

		$mod = I('mod')?I('mod'):1; 
   		if($mod == 1){
   			$where = "t_status != '2'";
   		}elseif($mod == 2){
   			$where = "t_status = '1'";
   		}else{
   			$where = "t_status = '3'";
   		}
   		$this->assign('mod',$mod);

	   	if($_SESSION['piano_user']['role'] == 1){
	   		
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
	   		$where = "piano_teacher.t_status != 2 and piano_teacher.t_jxid in ({$ids})";
	   	}else if($_SESSION['piano_user']['role'] == 3){
	   		$where = "piano_teacher.t_status != 2 and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
	   	}else{
	   		echo '无权限';
	   	}
   	
   	
   	   $field = "piano_users.id,piano_users.username,piano_users.headerimg,";
   	   $field .= "piano_teacher.*,";
   	   $field .= "piano_dealers.jx_name";
   	   $join1 = "piano_users on piano_teacher.t_userid= piano_users.id";
   	   $join2 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
   	    
   	   $count = M("Teacher")->field('piano_teacher.tid')
					   	   ->join($join1)
					   	   ->join($join2)
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
   	   
   	   $list = M("Teacher")->field($field)
   	                       ->join($join1)
					   	   ->join($join2)
					   	   ->where($where)
					   	   ->limit($Page->firstRow.','.$Page->listRows)
					   	   ->order("UNIX_TIMESTAMP(piano_teacher.t_addtime) DESC")->select();
   	    
   	    
   	  
   	   //dump($list);exit;
   	   $this->assign('list',$list);
   	   $this->assign('page',$show);
   	   $this->display();

   }
   //调律师认证操作
   public function tiaoer_renzheng_caozuo(){
   	   $tiaoer_id = $_POST['tiaoer_id'];
   	   $status = $_POST['status'];
   	   // dump($status);
   	   // die;
   	   $user = M('Tiaoer') -> where("tiaoer_id='{$tiaoer_id}'") ->find();
   	   $userid = $user['tiaoer_userid'];
   	   $c = M('Token')->where("t_userid = '$userid'")->find();
   	   // dump($c['t_leixin']);
   	   // die;
   	   $zz = M('Tiaoer')->where("tiaoer_id='{$tiaoer_id}'")->setField("tiaoer_status",$status);
   	   if($zz){
   	   		if($status == '2'){
   	   			$content = '您申请的调律师认证已同意';
	   	   	  if($c['t_shebei'] && $c['t_leixin']){
	   	   	  	if($c['t_leixin'] == 2){
	   	   	  		$f= $this->ios_msg_send($content,$c['t_shebei'],$userid);
	   	   	  	}else{
					$f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$userid);
				}
				$data = array(
				'x_userid' => $userid,       //接收消息的id
				'x_content' => $content,  //内容
				'x_tuisong' => 1,    //推送方id
				'x_type' => 8,				//消息类型
				'x_time' => date('Y-m-d H:i:s',time()),   //时间
				'x_info' => json_encode(array('kind'=>4)),
				);

				M("User_xiaoxi")->add($data);
	   	   	  }
   	   		}
   	   		if($status == '3'){
   	   			$content = '您申请的调律师认证已拒绝';
	   	   	  if($c['t_shebei'] && $c['t_leixin']){
	   	   	  	if($c['t_leixin'] == 2){
	   	   	  		$f= $this->ios_msg_send($content,$c['t_shebei'],$userid);
	   	   	  	}else{
					$f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$userid);
				}
				$data = array(
				'x_userid' => $userid,       //接收消息的id
				'x_content' => $content,  //内容
				'x_tuisong' => 1,    //推送方id
				'x_type' => 8,				//消息类型
				'x_time' => date('Y-m-d H:i:s',time()),   //时间
				'x_info' => json_encode(array('kind'=>4)),
				);

			M("User_xiaoxi")->add($data);
	   	   	  }
   	   		}
	   	   	  
   	   	  echo 1;exit;
   	   }else{

   	   	  echo '操作失败,请联系管理员~';exit;
   	   }
   	   //var_dump($_POST);exit;
   }
   //调律师搜
   public function tiaoer_renzheng_list_sou(){
   		$mod = I('mod');
		$this->assign('mod',$mod);

		if($mod == 1){
   			$where = "tiaoer_status != '2'";
   		}elseif($mod == 2){
   			$where = "tiaoer_status = '1'";
   		}else{
   			$where = "tiaoer_status = '3'";
   		}


	   	$status = $_POST['status']?$_POST['status']:1;
	   	
        if($_SESSION['piano_user']['role'] == 1){
	   	
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
	   		$where .= " and piano_tiaoer.tiaoer_status = '{$status}' and piano_tiaoer.tiaoer_jxid in ({$ids})";
	   	}else if($_SESSION['piano_user']['role'] == 3){
	   		$where .= " and piano_tiaoer.tiaoer_status = '{$status}' and piano_tiaoer.tiaoer_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
	   	}else{
	   		echo '无权限';
	   	}
	   	
	   	$name = trim($_POST['name']);
	   	if($name){
	   		$where .= " and piano_tiaoer.tiaoer_name='{$name}'";
	   		$this->assign('name',$name);
	   	}
	   	
	   	$username = trim($_POST['username']);
	   	if($username){
	   		$where .= " and piano_users.username='{$username}'";
	   		
	   		$this->assign('username',$username);
	   	}
	   	
	   	$jxid = (int)$_POST['jxid'];
	   	if($jxid){
	   		$where .= " and piano_tiaoer.tiaoer_jxid='{$jxid}'";
	   		$this->assign('jxid',$jxid);
	   	}
	   	
	   	$stime = trim($_POST['stime']);
	   	if($stime){
	   		$where .= " and UNIX_TIMESTAMP(piano_tiaoer.tiaoer_addtime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
	   	
	   		$this->assign('stime',$stime);
	   	}
	   		
	   	$etime = trim($_POST['etime']);
	   	if($etime){
	   		$where .= " and UNIX_TIMESTAMP(piano_tiaoer.tiaoer_addtime) <= UNIX_TIMESTAMP('$etime 00:00:00')";
	   	
	   		$this->assign('etime',$etime);
	   	}
	   		
	   	$button = $_POST['button'];
	   	if(empty($name) && empty($username) && empty($jxid) && empty($stime) && empty($etime)){
	   		//如果是点击页码发起的请求，则按只保存的条件搜索
	   		if(!$button){
	   			if($_SESSION['tiaoer_renzheng_list_sou']){
	   				$where = $_SESSION['tiaoer_renzheng_list_sou'];
	   			}
	   		}
	   	}
	   	$_SESSION['tiaoer_renzheng_list_sou'] = $where;
	   		
	   	
	   		
	   		
	   	$field = "piano_users.id,piano_users.username,piano_users.headerimg,";
   	   $field .= "piano_tiaoer.*,";
   	   $field .= "piano_dealers.jx_name";
   	   $join1 = "piano_users on piano_tiaoer.tiaoer_userid= piano_users.id";
   	   $join2 = "piano_dealers on piano_dealers.jxid = piano_tiaoer.tiaoer_jxid";
   	    
   	   $count = M("Tiaoer")->field('piano_tiaoer.tiaoer_id')
					   	   ->join($join1)
					   	   ->join($join2)
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
   	   
   	   $list = M("Tiaoer")->field($field)
					   	   ->join($join1)
					   	   ->join($join2)
					   	   ->where($where)
					   	   ->limit($Page->firstRow.','.$Page->listRows)
					   	   ->order("UNIX_TIMESTAMP(piano_tiaoer.tiaoer_addtime) DESC")->select();
   	    
   	   				   	
	   	
	   	// echo '<pre/>';
	   	// var_dump($list);exit;
	   	$this->assign('status',$status);
	   	$this->assign('list',$list);
	   	$this->assign('page',$show);
	   	$this->display('tiaoer_renzheng_list');
   }
   //调律师认证列表
   public function tiaoer_renzheng_list(){
   		$mod = I('mod');
		$this->assign('mod',$mod);

		if($mod == 1){
   			$where = "tiaoer_status != '2'";
   		}elseif($mod == 2){
   			$where = "tiaoer_status = '1'";
   		}else{
   			$where = "tiaoer_status = '3'";
   		}


       $status = $_GET['status']?$_GET['status']:1;
      
        if($_SESSION['piano_user']['role'] == 1){
	   		
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
	   		$where .= " and piano_tiaoer.tiaoer_status = '{$status}' and piano_tiaoer.tiaoer_jxid in ({$ids})";
	   	}else if($_SESSION['piano_user']['role'] == 3){
	   		$where .= " and piano_tiaoer.tiaoer_status = '{$status}' and piano_tiaoer.tiaoer_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
	   	}else{
	   		echo '无权限';
	   	}
	   	 
   	   $field = "piano_users.id,piano_users.username,piano_users.headerimg,";
   	   $field .= "piano_tiaoer.*,";
   	   $field .= "piano_dealers.jx_name";
   	   $join1 = "piano_users on piano_tiaoer.tiaoer_userid= piano_users.id";
   	   $join2 = "piano_dealers on piano_dealers.jxid = piano_tiaoer.tiaoer_jxid";
   	    
   	   $count = M("Tiaoer")->field('piano_tiaoer.tiaoer_id')
					   	   ->join($join1)
					   	   ->join($join2)
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
   	   
   	   $list = M("Tiaoer")->field($field)
					   	   ->join($join1)
					   	   ->join($join2)
					   	   ->where($where)
					   	   ->limit($Page->firstRow.','.$Page->listRows)
					   	   ->order("UNIX_TIMESTAMP(piano_tiaoer.tiaoer_addtime) DESC")->select();
   	    
   	    
   	  // echo '<pre/>';
   	  // var_dump($list);exit;
   	   $this->assign('status',$status);
   	   $this->assign('list',$list);
   	   $this->assign('page',$show);
   	   $this->display();
   }
   
   public function del_teacher(){

   		$tid = I('tid'); //教师唯一区别id  
   		
   		if($_SESSION['piano_user']['role']==1){
	   		$a = M('Teacher')->where("tid = '$tid'")->find();
	   		if($a){
	   			M('Teacher')->where("tid = '$tid'")->delete();
	   			echo 1; exit;
	   		}else{
	   			echo "查无此人";exit;
	   		}
	   	}


   }
   
   //编辑教师认证资料
 //编辑教师认证资料
   public function renzheng_teacher_bianji(){

   		$tid = $_GET['tid'];
   	    $where ="piano_teacher.tid = '$tid' ";
   	   
	   	if($_SESSION['piano_user']['role'] == 1){
	   		$where .= " and piano_teacher.t_status != '2'";
	   	}else if($_SESSION['piano_user']['role'] == 2 || $_SESSION['piano_user']['role'] == 3){
	   		$where .= " and piano_teacher.t_status != '2' 
	   		and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jxid']}'";
	   	}else{
	   		echo '无权限';exit;
	   	}
   	   
   	   
   	    $join1 = "piano_users on piano_teacher.t_userid= piano_users.id";

   	   
   	    $list = M("Teacher")->join($join1)
					   	   ->where($where)
   	                       ->find();
   	 	$a =M('Dealers')->where("jxid = '$list[t_jxid]'")->find();
   		$list['jx_name'] = $a['jx_name'];
   	  // dump($list);exit;
   	    $this->assign('list',$list);
   	    $this->display();
   }


	public function save_teacher(){
		if(IS_POST){
			$tid = I('tid');
			// $songs = M("Teacher")->where("t_userid='{$id}'")->find();
			
			$data['t_truename'] = trim($_POST['t_truename']);
			if(empty($data['t_truename'])){
				echo '姓名不能为空';exit;
			}
			
			$data['t_mobile'] = trim($_POST['mobile']);
			if(empty($data['t_mobile'])){
				echo '联系方式不能为空';exit;
			}
			
			$data['t_license'] = trim($_POST['t_license']);
			if(empty($data['t_license'])){
				echo '没有上传照片，无法提交';exit;
			}
			$data['t_card_img1'] = trim($_POST['t_card_img1']);
			if(empty($data['t_card_img1'])){
				echo '没有上传照片，无法提交';exit;
			}
			$data['t_card_img2'] = trim($_POST['t_card_img2']);	
			if(empty($data['t_card_img2'])){
				echo '没有上传照片，无法提交';exit;
			}	

			
			$a = M('Teacher')->where("tid = '$tid'")->find();
			if($a){
				unlink($a['t_license']);
				unlink($a['t_card_img1']);
				unlink($a['t_card_img2']);
			}
			
			if(M("Teacher")->where("tid = '$tid'")->save($data)){
				echo 1;exit;
			}else{
				echo '修改失败，资料不齐';exit;
			}
		}

	}
	
	public function renzheng_tiaoer_bianji(){
	
		$id = $_GET['id'];
		$where ="piano_tiaoer.tiaoer_userid = '$id' ";
			
		if($_SESSION['piano_user']['role'] == 1){
			$where .= " and piano_tiaoer.tiaoer_status != '2'";
		}else if($_SESSION['piano_user']['role'] == 2 || $_SESSION['piano_user']['role'] == 3){
			$where .= " and piano_teacher.tiaoer_status != '2'
			and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jxid']}'";
		}else{
			echo '无权限';exit;
			}
				
				
			$join1 = "piano_users on piano_tiaoer.tiaoer_userid= piano_users.id";
   	    $join2 = "piano_dealers on piano_dealers.jxid = piano_tiaoer.tiaoer_jxid";
   	
   	    $list = M("Tiaoer")
			->join($join1)
			->join($join2)
			->where($where)
			->find();
	
	
			// dump($list);exit;
	
			$this->assign('list',$list);
			$this->display();
	}
	
	
	 
	public function save_tiaoer(){
		if(IS_POST){
		    $id = I('id');
		// $songs = M("Teacher")->where("t_userid='{$id}'")->find();
		
			$tiaoer_name = trim($_POST['tiaoer_name']);
			if($tiaoer_name){
			  $data['tiaoer_name'] = $tiaoer_name;
			}
				
			$tiaoer_mobile = trim($_POST['tiaoer_mobile']);
			if($tiaoer_mobile){
			    $data['tiaoer_mobile'] = $tiaoer_mobile;
			}
			
			$tiaoer_img= trim($_POST['tiaoer_img']);
			if($tiaoer_img){
			  $data['tiaoer_img'] = $tiaoer_img;
			}
			
			$tiaoer_card_img1 = trim($_POST['tiaoer_card_img1']);
			if($tiaoer_card_img1){
			    $data['tiaoer_card_img1']  = $tiaoer_card_img1;
			}
			
			$tiaoer_card_img2 = trim($_POST['tiaoer_card_img2']);
			if($tiaoer_card_img2){
					$data['tiaoer_card_img2'] = $tiaoer_card_img2 ;
			}
		
		    $a = M('Tiaoer')->where("tiaoer_userid = '$id'")->find();
		
			if($a){
				@unlink($a['tiaoer_img']);
				@unlink($a['tiaoer_card_img1']);
				@unlink($a['tiaoer_card_img2']);
		    }
		
			if(M("Tiaoer")->where("tiaoer_userid = '$id'")->save($data)){
			           echo 1;exit;
			}else{
						echo '修改失败，资料不齐';exit;
					}
			}
		
	}





   
  


}