<?php
/*班级管理
 * */
namespace Admin\Controller;
use Think\Controller;
class BanjiController extends CommonController {
	//班级添加学生
	public function class_add_student_ok(){
		if(IS_POST){
			$class_id = $_POST['class_id'];
			$ids = $_POST['ids'];
			if(empty($ids)){
				echo '请选择需要添加的学生';exit;
			}
			
			$old_stuid = M("Class")->where("class_id='{$class_id}'")->find();
			if($old_stuid['class_stuids']){
				$oldids = $old_stuid['class_stuids'].',';
			}else{
				$oldids = '';
			}
			
		   
			foreach($ids as $v){
				if(strrpos($oldids, $v) === false){
					$oldids .= $v.',';
					//修改的师生关系，并建立朋友关系
					$set = M("Teacher_student")->where("sid='{$v}'")->save(array(
							'tid' => $old_stuid['class_teacher']
					));
					$is_friend = M("User_friends")->where("(userid='{$v}' and friend_id='{$old_stuid['class_teacher']}') 
						or (userid='{$old_stuid['class_teacher']}' and friend_id='{$v}')")->find();
					if($is_friend){
						if($is_friend['u_status'] == 2){
							M("User_friends")->where("(userid='{$v}' and friend_id='{$old_stuid['class_teacher']}') 
								or (userid='{$old_stuid['class_teacher']}' and friend_id='{$v}')")->setField('u_status',1);
						}
					}else{
						$add = M("User_friends")->add(array(
								'userid' => $v,
								'friend_id' => $old_stuid['class_teacher']
						));
					}
				}	
			}
			$stuids = rtrim($oldids,',');
			
			$set_class = M("Class")->where("class_id='{$class_id}'")->setField('class_stuids',$stuids);
			if($set_class){
				echo '1';exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}
			//var_dump($stuids);exit;
		}
	}
	public function class_add_student(){	
		$class_id = I('class_id');

		if($_SESSION['piano_user']['role'] == 1){	
			$where = "piano_users.role = '1'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			$dealers = M("Dealers")->where("jx_status='1' and 
				(jx_parent='{$_SESSION['piano_user']['jx_jigou']}' 
				or jxid='{$_SESSION['piano_user']['jx_jigou']}')")->select();

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
		if(IS_POST){
						
			$username = trim($_POST['username']);
			if($username){
				$where .= " and piano_users.username like '%{$username}%'";
				$this->assign('username',$username);
			}
		
			$button = $_POST['button'];
			if(empty($username)){
				//如果是点击页码发起的请求，则按只保存的条件搜索
				if(!$button){
					if($_SESSION['class_add_student']){
						$where = $_SESSION['class_add_student'];
					}
				}
			}
			$_SESSION['class_add_student'] = $where;
		}
		
          //班级里学生的id集
	   $class_id = $_GET['class_id'];
	   $field = "piano_class.class_id,piano_class.class_name,piano_class.class_stuids,piano_dealers.jx_name";
	   $join = "piano_dealers on piano_dealers.jxid=piano_class.class_jxid";
	   $where1 = "piano_class.class_id='{$class_id}'";
	   $class = M("Class")->field($field)->join($join)->where($where1)->find();
		
		if($class['class_stuids']){
			$where .= " and piano_teacher_student.sid not in ({$class['class_stuids']})"; 
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


		//echo '<pre/>';
		//var_dump($class);exit;
	   $this->assign('class',$class);
		$this->assign('page',$show);
		$this->assign('list',$students);
		$this->display();
		
		
	}
	//添加班级
	public function class_add(){
		if(IS_POST){
			$tid = (int)$_POST['tid'];
			if(empty($tid)){
				echo '请选择带班老师';exit;
			}
			$name = trim($_POST['name']);
			if(empty($name)){
				echo '请输入班级名称';exit;
			}
			
			$teacher =  M("Teacher")->where("t_userid='{$tid}'")->find();
			$data = array(
				        'class_name' => $name,
						'class_teacher' => $tid,
						'class_jxid' => $teacher['t_jxid'],
						'class_addtime' => date('Y-m-d H:i:s',time())
		        	);
			$naru = $_POST['naru'];
			if($naru == 1){//是
			    $stu_arr = M("Teacher_student")->field('sid')->where("tid='{$tid}'")->select();
			    $stu_ids = '';
			    foreach($stu_arr as $v){
			    	$stu_ids .= $v.',';
			    }
			    if($stu_ids){
			    	$data['class_stuids'] = rtrim($stu_ids,',');
			    }
			    
			}
			
			//var_dump($data);exit;
			if(M("Class")->add($data)){
				echo 1;exit;
			}else{
				echo '添加失败,请联系管理员~';exit;
			}
			
		}
		//获取带班老师
	    if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_teacher.t_status= 2 ";
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
    		$where = "piano_teacher.t_jxid in ({$ids}) and piano_teacher.t_status= 2 ";
    
    	}else if($_SESSION['piano_user']['role'] == 3){
    		$where = "piano_teacher.t_jxid = '{$_SESSION['piano_user']['jx_jigou']}' and piano_teacher.t_status= 2 ";
    	}else{
    		echo '无权限';
    	}
		
		$list = M("Teacher")->where($where)->select();
		
		foreach($list as $k=>$v){
			$class = M("Class")->where("class_teacher='{$v['t_userid']}'")->find();
			if($class){
				//带过班的老师不能再带班
				unset($list[$k]);
			}	
		}
	
	
		$this->assign('list',$list);
		$this->display();
	}
	//班级列表搜
//班级列表搜
	public function class_list_sou(){
		if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$dealers = M("Dealers")->where("jx_status='1'")->select();
			$this->assign('dealers',$dealers);
				
			$where = "class_id > '0'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			$dealers = M("Dealers")->where("jx_status='1' and 
				(jx_parent='{$_SESSION['piano_user']['jx_jigou']}' or
				 jxid='{$_SESSION['piano_user']['jx_jigou']}')")->select();
			$this->assign('dealers',$dealers);			
			
			foreach($dealers as $v){
				$ids.= $v['jxid'].',';
			}
			if($ids){
				$ids = rtrim($ids,',');
			}else{
				$ids = 0;
			}
			
			$where = "class_jxid in ({$ids})";

		}else if($_SESSION['piano_user']['role'] == 3){
			//分销商看
			$where = "class_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
				
		}else{
			echo '权限不够';exit;
		}

		
		$jxid = $_POST['jxid'];
		if($jxid != ''){
			if($where){
				$where .= " and piano_dealers.jxid = '{$jxid}'";
			}else{
				$where = "piano_dealers.jxid = '{$jxid}'";
			}
			
			$this->assign('jxid',$jxid);
		}
		
		$name = trim($_POST['name']);
		if($name){
			if($where){
				$where .= " and piano_class.class_name='{$name}'";
			}else{
				$where = "piano_class.class_name='{$name}'";
			}
			
			$this->assign('name',$name);
		}
		$stime = trim($_POST['stime']);
		if($stime){
			if($where){
				$where .= " and UNIX_TIMESTAMP(piano_class.class_addtime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
				
			}else{
				$where = "UNIX_TIMESTAMP(piano_class.class_addtime) >= UNIX_TIMESTAMP('$stime 00:00:00')";
				
			}
			
			$this->assign('stime',$stime);
		}
			
		$etime = trim($_POST['etime']);
		if($etime){
			if($where){
				$where .= " and UNIX_TIMESTAMP(piano_class.class_addtime) <= UNIX_TIMESTAMP('$etime 00:00:00')";
				
			}else{
				$where = "UNIX_TIMESTAMP(piano_class.class_addtime) <= UNIX_TIMESTAMP('$etime 00:00:00')";
				
			}
			
			$this->assign('etime',$etime);
		}
		
		$button = $_POST['button'];
		if(empty($name) && empty($jxid) && empty($stime) && empty($etime)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['class_list_sou']){
					$where = $_SESSION['class_list_sou'];
				}
			}
		}
		$_SESSION['class_list_sou'] = $where;
	
		$field = "piano_class.*,";
		$field .= "piano_teacher.t_truename,piano_teacher.t_mobile,piano_dealers.*";
		$join1 = "piano_teacher on piano_teacher.t_userid = piano_class.class_teacher";
		$join2 = "piano_dealers on piano_dealers.jxid = piano_class.class_jxid";
	
		$count = M("Class")->field("piano_class.jxid")
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
	
		$list = M("Class")->field($field)
							->join($join1)
							->join($join2)
							->where($where)
							->limit($Page->firstRow.','.$Page->listRows)
							->select();
	
		foreach($list as $k=>$v){


		    if($v['class_stuids']){
				$list[$k]['count'] = count(explode(',',$v['class_stuids']));//统计学生人数
			}else{
				$list[$k]['count'] = 0;
			}
		}
	
		//echo '<pre/>';
		//var_dump($dom);exit;
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('class_list');
	}
	//班级列表
	public function class_list(){
	   if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$dealers = M("Dealers")->where("jx_status='1'")->select();
			$this->assign('dealers',$dealers);
			
			$where = "class_id > '0'";
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
			
			$where = "class_jxid in ({$ids})";
		}else if($_SESSION['piano_user']['role'] == 3){
			
			$where = "class_jxid = '{$_SESSION['piano_user']['jx_jigou']}'";
		}else{
			echo '权限不够';exit;
		}
			
		$count = M("Class")->where($where)
		                   ->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("Class")->where($where)
		                  ->limit($Page->firstRow.','.$Page->listRows)
		                  ->select();
		
		foreach($list as $k=>$v){
			if($v['class_stuids']){
				$list[$k]['count'] = count(explode(',',$v['class_stuids']));//统计学生人数
			}else{
				$list[$k]['count'] = 0;
			}
			$list[$k]['teacher'] = M("Teacher")->where("t_userid='{$v['class_teacher']}'")->find();
			$list[$k]['jx_name'] = M("Dealers")->where("jxid='{$v['class_jxid']}'")->find()['jx_name'];
		}
		
		
		//echo '<pre/>';
		//var_dump($list);exit;
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
	
	public function class_xiang(){
		$class_id = $_GET['class_id'];
		
		$where = "class_id='{$class_id}'";
	    $list = M("Class")->where($where)
		                  ->limit($Page->firstRow.','.$Page->listRows)
		                  ->select();
		
		foreach($list as $k=>$v){
			if($v['class_stuids']){
				$list[$k]['count'] = count(explode(',',$v['class_stuids']));//统计学生人数
			}else{
				$list[$k]['count'] = 0;
			}
			$list[$k]['teacher'] = M("Teacher")->where("t_userid='{$v['class_teacher']}'")->find();
			$list[$k]['jx_name'] = M("Dealers")->where("jxid='{$v['class_jxid']}'")->find()['jx_name'];
		}

		
		if($list[0]['class_stuids']){
			$stu_ids = explode(',',$list[0]['class_stuids']);
			//学生列表
			 
			$count = count($stu_ids);
			//实例化分页类
			$Page = new \Think\Page($count,$this->pagenum);
			//设置上一页与下一页
			$Page->setConfig('prev', '上一页');
			$Page->setConfig('next', '下一页');
			$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
			//显示分页信息
			$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
			 
			$students = M("Users")->where("id in ({$list[0]['class_stuids']})")
									->limit($Page->firstRow.','.$Page->listRows)
									->select();
			
			$this->assign('page',$show);
			$this->assign('students',$students);
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
		 
		$teacher = M("Users")->field($field)
							->join($join1)
							->where($where)
							->select();
		$this->assign('teacher',$teacher);
		
    	
		$this->assign('list',$list);
		$this->display();
	}
	
	
	
	//修改带班老师
	public function class_teacher_edit(){
		$class_id = $_POST['class_id'];
		$tid = $_POST['tid'];
		if($tid == ''){
			echo '请选择带班老师';exit;
		}
		
		$find_class = M("Class")->where("class_id='{$class_id}'")->find();
	
		if($find_class['class_teacher'] == $tid){
			echo 1;exit;
		}else{
			
			M("Class")->startTrans();
			//修改带班老师
			$set1 = M("Class")->where("class_id='{$class_id}'")->setField("class_teacher",$tid);
			
			//修改师生关系
			$set2 = M("Teacher_student")->where("sid in ({$find_class['class_stuids']})")->setField('tid',$tid);
			
			if($set1 && $set2){
				M("Class")->commit();
				echo 1;exit;
			}else{
				M("Class")->rollback();
		       echo '操作失败，请联系管理员';exit;
			}
		}
		
	}
	
	//移除班级学生
	public function class_teacher_delete(){
		if($_POST['ids']){
			$class_id = $_POST['class_id'];
			
			$ids = $_POST['ids'];
			
			$find_class = M("Class")->where("class_id='{$class_id}'")->find();
			$old_ids = explode(',',$find_class['class_stuids']);
			
			foreach($old_ids as $k=>$v){
				if(in_array($v,$ids)){
					unset($old_ids[$k]);
				}
			}
			if($old_ids){
				$old_ids = implode(',',$old_ids);
			}else{
				$old_ids = '';
			}
			
			$set = M("Class")->where("class_id='{$class_id}'")->setField('class_stuids',$old_ids);
			if($set){
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}
			
		}else{
			echo '请选择需要移除的学生';exit;
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
       
}