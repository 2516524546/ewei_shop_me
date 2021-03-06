<?php
/*用户、老师、学生管理
 * */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
	
	//用户详情
  //用户详情
    public function user_xiang(){
        $id = I('id');
        
        $user = M('piano_Users')->where("id = '{$id}'")->find();
        $user['fans'] = M('piano_Focus')->where("f_status ='2' and f_userid = '$id'")->count();
        $user['guanzhu'] = M('piano_Focus')->where("f_status ='2' and f_fansid = '$id'")->count();
        $user['count']= M('piano_Homework_stu')->where("w_userid = '$id'")->sum('w_long');

        $join = "piano_homework on piano_homework.hid = piano_homework_stu.hid";
        $join1 = "piano_songs_list on piano_songs_list.lid = piano_homework.lid";

        $count = M('piano_Homework_stu')->where("w_userid = '$id'")
                                  ->join($join)
                                  ->join($join1)
                                  ->count();
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

       
        $list = M('piano_Homework_stu')->where("w_userid = '$id'")
                                 ->join($join)
                                 ->join($join1)
                                 ->field('list_name,list_url')
                                 ->limit($Page->firstRow.','.$Page->listRows)
                                 ->select();

      
        $this->assign('list',$list);
        $this->assign('user',$user);
        $this->assign('page',$show);
        $this->display();
   }
	//搜用户
	public function user_list_sou(){
		$where = "add_time > '0' ";
		
		$name = trim($_POST['name']);
		if($name){
			$where .= " and nickname='{$name}'";
			$this->assign('name',$name);
		}
		
		$phone = trim($_POST['phone']);
		if($phone){
			$where .= " and username='{$phone}'";
			$this->assign('phone',$phone);
		}
		
		$status = trim($_POST['status']);
		if($status){
			if($status == 1){
				$where .=" and rz_status = 1 ";
			}else{
                $where .=" and rz_status = 2 ";
            }	
			$this->assign('status',$status);
		}
		
	   $stime = trim($_POST['stime']);
	   if($stime){
     		$where .= " and UNIX_TIMESTAMP(add_time) >= UNIX_TIMESTAMP('$stime 00:00:00')";
     		$this->assign('stime',$stime);
     	}
     	 
     	$etime = trim($_POST['etime']);
     	if($etime){
     		$where .= " and UNIX_TIMESTAMP(add_time) <= UNIX_TIMESTAMP('$etime 00:00:00')";
     		$this->assign('etime',$etime);
     	}
		
     	$button = $_POST['button'];
     	if(empty($name) && empty($phone) && empty($status) && empty($stime) && empty($etime)){
     		//如果是点击页码发起的请求，则按只保存的条件搜索
     		if(!$button){
     			if($_SESSION['user_list_sou']){
     				$where = $_SESSION['user_list_sou'];
     			}
     		}
     	}
     	$_SESSION['user_list_sou'] = $where;

		$count = M("piano_Users")->where($where)->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("piano_Users")->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("id DESC")->select();

		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display('user_list');
	}
    //用户列表
	public function user_list(){
        
		$count = M("piano_Users")->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
      //  $Page = new \Think\Page($count,20);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("piano_Users")->limit($Page->firstRow.','.$Page->listRows)->order("id DESC")->select();

		foreach($list as $k=>$v){
            if($v['role']==2){
                $a = M('piano_Teacher')->field("piano_dealers.jx_name,piano_dealers.jxid")
                                 ->join('piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid')
							     ->where("t_userid = '$v[id]'")
							     ->find();  //查找角色为老师的信息
                if($a){
                	$list[$k]['jxid'] = $a['jxid'];
	                $list[$k]['jx_name'] = $a['jx_name'];
                }
            }
		}
  
		$this->assign('list',$list);
		$this->assign('page',$show);
        $this->display();
    }
    //教师详情
    public function teacher_xiang(){
    	$userid = $_GET['id'];
    	$where = "piano_users.id='{$userid}' and piano_users.role='2'";
       
    	$join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id"; 
    	$join2 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
    	
    	$data = M("piano_Users")	->join($join1)
					    	->join($join2)
					    	->where($where)
					    	->find();


    	$data['count'] = M('piano_Practice_log')->where("log_userid='{$data['id']}'")->count();
    	$data['long'] = M('piano_Practice_log')->where("log_userid='{$data['id']}'")->sum('log_long');
       
    	//学生列表
    	$field = "piano_users.*";
    	$join = "piano_users on piano_users.id=piano_teacher_student.sid";
    	$where = "piano_teacher_student.tid='{$userid}'";
    		
    	
    	
        
        $count = M("piano_Teacher_student")->field($field)
								     ->join($join)
								     ->where($where)->count();
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        
        $students = M("piano_Teacher_student")->field($field)
								    	->join($join)
								    	->where($where)
								    	->limit($Page->firstRow.','.$Page->listRows)
								    	->select();
    	
        $this->assign('page',$show);
        $this->assign('students',$students);
    	$this->assign('data',$data);
    	$this->display();
    }
   //教师列表   
    public function teacher_list(){
        
        if($_SESSION['piano_user']['role'] == 1){
            $where = "piano_users.role=2 and piano_teacher.t_status= 2 ";
        }else{
            $where = "piano_users.role='2' and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jxid']}'
               and piano_teacher.t_status= 2 ";
        }
        
        $field = "piano_users.*,";
        $field .= "piano_teacher.*";
        $join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id";
    
        
        $count = M("piano_Users")->field('piano_users.id')
                                   ->join($join1)
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
        
        $list = M("piano_Users")->field($field)
                          ->join($join1)
                          ->join($join2)
                          ->where($where)
                          ->limit($Page->firstRow.','.$Page->listRows)
                          ->order("piano_users.id DESC")->select();
        
       foreach ($list as $k => $v) {
           $list[$k]['jx_name'] =M('piano_Dealers')->where("jxid = '$v[t_jxid]'")->field('jx_name')->find()['jx_name'];
       }
        
        
        // dump($list);exit;
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function teacher_daochu(){
   
        if($_SESSION['piano_user']['role'] == 1){
            $where = "piano_users.role='2'";
        }else{
            $where = "piano_users.role='2' and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jxid']}'
               and piano_teacher.t_status= 2";
        }
        
        $field = "piano_users.id,piano_teacher.t_truename,piano_users.username,piano_teacher.t_mobile,"; 
        $field .= "piano_dealers.jx_name,piano_dealers.jxid,piano_users.add_time,piano_teacher.t_status";
        $join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id";
        $join2 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
       
        $list = M("piano_Users")->field($field)
                          ->join($join1)
                          ->join($join2)
                          ->where($where)
                          ->limit($Page->firstRow.','.$Page->listRows)
                          ->order("piano_users.id DESC")->select();

            foreach ($list as $k=>$v) {
                if($v['t_status']==1){
                    $list[$k]['t_status'] = '认证中';
                    // $v['t_status']='认证中';              这样写就不是改变$list 的值，而是改$v 的值
                }elseif ($v['t_status']==2) {
                    $list[$k]['t_status'] = '已认证';
                    //$v['t_status']='已认证';
                }else{
                    $list[$k]['t_status']='未认证';
                }
                //如何把地址转成图片还要导到xls文件里?     
            }
           // dump($list);exit;
        $title = array('ID','老师姓名','账号','手机号','所属经销商','经销商id','加入时间','认证状态');
        $this->exportexcel($list,$title,$filename = '老师列表');
       
    }

    //教师搜索
    public function teacher_list_sou(){
        if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_users.role='2'";
    	}else{
    		$where = "piano_users.role='2' and piano_teacher.t_jxid = '{$_SESSION['piano_user']['jxid']}'";
    	}
    		
    	$name = trim($_POST['name']);
    	if($name){		
    		$where .= " and piano_teacher.t_truename like'%{$name}%' and piano_teacher.t_status='2'";
    		$this->assign('name',$name);
    	}
    	
    	$username = trim($_POST['username']);
    	if($username){
    		$where .= "and piano_users.username like'%{$username}%'";
    		$this->assign('username',$username);
    	}
    	
    	$jx_name = trim($_POST['jx_name']);
    	if($jx_name){
            $a = M('piano_Dealers')->where("jx_name = '$jx_name'")->find();

    		$where .= " and piano_teacher.t_jxid='$a[jx_id]' and piano_teacher.t_status='2'";
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
    	if(empty($name) && empty($username) && empty($jx_name)  && empty($stime) && empty($etime)){
    		//如果是点击页码发起的请求，则按只保存的条件搜索
    		if(!$button){
    			if($_SESSION['teacher_list_sou']){
    				$where = $_SESSION['teacher_list_sou'];
    			}
    		}
    	}
    	$_SESSION['teacher_list_sou'] = $where; 
    	
        
    	$join1 = "piano_teacher on piano_teacher.t_userid= piano_users.id";
    	$join2 = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
    	
    	$count = M("piano_Users")->join($join1)
                           ->join($join2)
                           ->where($where)
                           ->count();
                    // dump(M('Users')->getLastSql());            
                                
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
        
    	$list = M("piano_Users")->join($join1)
    	                  ->join($join2)
    	                  ->where($where)
    	                  ->limit($Page->firstRow.','.$Page->listRows)
    	                  ->order("piano_users.id DESC")->select();
    	//dump($list);exit;
       
    	//echo '<pre/>';
    	//var_dump($list);exit;
    	$this->assign('list',$list);
    	$this->assign('page',$show);	
    	$this->display('teacher_list');
    }
      public function course_teacher_sou(){
    	if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_users.role='2' and piano_teacher.t_status= 2 ";
    	}else if($_SESSION['piano_user']['role'] == 2){
    		//获取代理商下所有的分销商id
    		$jxids = M("piano_Dealers")->where("jx_parent='{$_SESSION['piano_user']['jx_jigou']}'")->select();
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
    	 
    	
    		$name = trim($_POST['name']);
    		if($name){
    			$where .= " and piano_teacher.t_truename='{$name}'";
    			$this->assign('name',$name);
    		}
    
    		$username =trim($_POST['username']);
    		if($username){
    			$where .= " and piano_users.username='{$username}'";
    			$this->assign('username',$username);
    		}
    		$button = $_POST['button'];
    		if(empty($name) && empty($username)){
    			//如果是点击页码发起的请求，则按只保存的条件搜索
    			if(!$button){
    				if($_SESSION['course_teacher_sou']){
    					$where = $_SESSION['course_teacher_sou'];
    				}
    			}
    		}
    		$_SESSION['course_teacher_sou'] = $where;
    	
    	 
    	// $field = "piano_teacher.t_truename,piano_teacher.t_mobile,piano_teacher.t_userid,";
    	// $field .= "piano_users.username";
    	 
    	$join1 = "piano_users on piano_users.id = piano_teacher.t_userid";
    	 
    	$count = M("piano_Teacher")
    	->join($join1)
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
    	 
    	$list = M("piano_Teacher")
    	->join($join1)
    	->where($where)
    	->select();
    	 
    	foreach($list as $k=>$v){
            $list[$k]['num1'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '1'")
                                                ->count();
            $list[$k]['num2'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '2'")
                                                ->count();
            $list[$k]['num3'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '3'")
                                                ->count();
            $list[$k]['num4'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '4'")
                                                ->count();
    		//上课节数
    		$list[$k]['count'] = $list[$k]['num1']+$list[$k]['num2']+$list[$k]['num3']+$list[$k]['num4'];
    	}
    
    	//dump($list);exit;
    
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display('course_teacher');
    }

   
     //老师课程详情
     public function course_xiang(){
     	$id = $_GET['id']; 

        $wherea = "piano_users.id='{$id}' and piano_users.role='2'";
       
        $joina = "piano_teacher on piano_teacher.t_userid= piano_users.id"; 
        $joinb = "piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid";
        
        $data = M("piano_Users")->join($joina)
                          ->join($joinb)
                          ->where($wherea)
                          ->find();


        $data['count'] = M('piano_Practice_log')->where("log_userid='{$data['id']}'")->count();
        $data['long'] = M('piano_Practice_log')->where("log_userid='{$data['id']}'")->sum('log_long');
        $this->assign('data',$data);  


        $join1 = "piano_teacher on piano_teacher.t_userid = piano_course_list.cl_tid";    
        $join2 = "piano_course on piano_course.course_id = piano_course_list.cid";
     
        $count = M("piano_Course_list")->where("cl_tid = '$id' and cl_status = '2'")
                                 ->count();       

            //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)               
 
  
        $list = M("piano_Course_list")->limit($Page->firstRow.','.$Page->listRows)
                                ->order('cl_stime DESC')
                                ->join($join1)
                                ->join($join2)
                                ->where("cl_tid = '$id' and cl_status = '2'")
                                ->select();

        foreach ($list as $k => $v){
            $v['file_url'] = M('piano_Course_file')->where("kid = '$v[id]'")->getField('file_url');
            $list[$k]['file_url'] = $v['file_url'];
        }

       
       // dump($list);exit; 
       
        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();

     }



     
     
     //老师课程列表
    public function course_teacher(){
    	if($_SESSION['piano_user']['role'] == 1){
    		$where = "piano_users.role='2' and piano_teacher.t_status= 2 ";
    	}else if($_SESSION['piano_user']['role'] == 2){
    		//获取代理商下所有的分销商id
    		$jxids = M("piano_Dealers")->where("jx_parent='{$_SESSION['piano_user']['jx_jigou']}'")->select();
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
    	
    	
    	
        $field = "piano_teacher.t_truename,piano_teacher.t_mobile,piano_teacher.t_userid,";
        $field .= "piano_users.username";
    	
    	$join1 = "piano_users on piano_users.id = piano_teacher.t_userid";
    	
    	$count = M("piano_Teacher")->field($field)
    	                        ->join($join1)
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
    	
    	$list = M("piano_Teacher")->field($field)
    	                        ->join($join1)
    	                        ->where($where)
                                ->limit($Page->firstRow.','.$Page->listRows)
    	                        ->select();
    	
    	foreach($list as $k=>$v){
    		$list[$k]['num1'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '1'")
                                                ->count();
            $list[$k]['num2'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '2'")
                                                ->count();
            $list[$k]['num3'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '3'")
                                                ->count();
            $list[$k]['num4'] = M("piano_Course_list")->where("cl_tid='{$v['t_userid']}' and cl_status='2' and cl_kind = '4'")
                                                ->count();                                   
            //上课节数
            $list[$k]['count'] = $list[$k]['num1']+$list[$k]['num2']+$list[$k]['num3']+$list[$k]['num4'];
    	}
    
    	//dump($list);exit;
    
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }

/**
 * 添加一个教师和学生的修改密码的操作
 */
    public function show_uppwd(){
        $data['username'] = I('username');
        $data['t_truename'] = I('t_truename');
        $this->assign('data',$data);
        $this->display();

    }
 

    public function up_info(){
    
        $username = I('username');     //要修改的账号  
        $pwd = md5(MA.md5(I('pwd')));   //输入的原密码
        $data['pwd'] = md5(MA.md5(I('newpassword')));  //这个新密码  
        $pwdag =md5(MA.md5(I("passwordagain")));   //重复密码      
        

        $see =M('piano_users')->where("username = '$username'")->find();  //从数据库里查出来的原密码
         if($see['pwd'] == $pwd ){
                if($pwdag == $data['pwd']){
                    $a = M('piano_users')->where("username = '$username'")->save($data);
                        if($a){
                            echo 1;exit;
                        }else{
                           echo'修改失败,参数不齐或与原密码一样';exit;
                        }
                }else{
                   echo'两次密码不一致';exit;
                }           
        }else{
            echo'原密码不正确'; 
        }
    }   
//查看我自己的信息页面
    public function my_info(){
     
        $id = $_SESSION['piano_user']['aid'];  
        $list = M('piano_Admin')->where("aid = '$id'")->find();
        $this->assign('list',$list);               
        $this->display();         
    }     
           
//修改我的个人信息页面
    public function up_myinfo(){
        $id = $_SESSION['piano_user']['aid'];  
        $user = M('piano_Admin')->where("aid = '$id'")->find();
        $this->assign('user',$user); 
        $this->display();
    }

//改信息
    public function saveinfo(){
        $id = $_SESSION['piano_user']['aid']; 

        $fzr_name = I('fzr_name');
        if($fzr_name){
           $data['fzr_name'] = $fzr_name;
        }
        $card = I('card');
        if($card){
           $data['card'] = $card;
        }
        $mobile = I('mobile');
        if($mobile){
           $data['mobile'] = $mobile;
        }

        $user = M('piano_Admin')->where("aid = '$id'")->find();
        if($user){
            $a = M('piano_Admin')->where("aid = '$id'")->save($data);
            if($a){
                echo 1; exit;
            }else{
                echo '没有更新';exit;
            }
        }else{
         echo '此人信息不在数据库';exit;
        }

    }
//修改我的密码页面
    public function my_pwd(){
        $id = $_SESSION['piano_user']['aid'];  
        $user = M('piano_Admin')->where("aid = '$id'")->find();
        $this->assign('user',$user);               
        $this->display();  
    }


    public function up_mypwd(){

        $username = I('username');     //要修改的账号  
        $pwd = md5(MA.I('pwd'));   //输入的原密码
        $data['pwd'] = md5(MA.I('newpassword'));  //这个新密码  
        $pwdag =md5(MA.I("passwordagain"));   //重复密码      
        
        $see =M('piano_admin')->where("username = '$username'")->find();  //从数据库里查出来的原密码
         if($see['pwd'] == $pwd ){
                if($pwdag == $data['pwd']){
                    $a = M('piano_admin')->where("username = '$username'")->save($data);
                        if($a){
                            echo 1;exit;
                        }else{
                           echo'修改失败,参数不齐或与原密码一样';exit;
                        }
                }else{
                   echo'两次密码不一致';exit;
                }           
        }else{
            echo'原密码不正确'; 
        }
    }   

    public  function user_daochu(){
      
        $arr = M ('piano_Users')->order("id DESC")->select();
        foreach($arr as $k=>$v){
            if($v['role']==2){
                $a = M('piano_Teacher')->join('piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid')
                                 ->where("t_userid = '$v[id]'")
                                 ->find();  //查找角色为老师的信息
                if($a){
                    $v['jxid']= $a['jxid'];
                    $v['jx_name'] = $a['jx_name'];
                }
            } 
            
            if($v['rz_status']==1){
                $v['rz_status'] ='已认证';
            }else {
                $v['rz_status'] ='未认证';
            }

            if($v['role']==1){
                    $v['role'] = '学生';
            }elseif ($v['role']==2){
                   $v['role'] = '老师';
            }else{
                    $v['role'] = '普通用户';
            }  
            $data[$k] = array('id'=>$v['id'], 'username'=>$v['username'], 'nickname'=>$v['nickname'],
            		'sex'=>$v['sex'], 'age'=>$v['age'], 'address'=>$v['address'],
            		'rz_status'=>$v['rz_status'],'role'=>$v['role'],'jxid'=>$v['jxid'],
            		'jx_name'=>$v['jx_name'],'add_time'=>$v['add_time']);
        }
     
        
    // dump($data);  exit;
        $this->exportexcel($data,
            array('ID','账号','昵称','性别','年龄','所在地','是否认证设备',
                '用户身份','所属经销商ID','所属经销商','注册时间'),
            '用户列表');
    }
    
   

   
    public function del_teacher(){
        $id = I('id');

        M('piano_Users')->startTrans();
        $a = M('piano_Users')->join('piano_teacher on piano_teacher.t_userid = piano_users.id')
        ->where("id = '$id'")->find();   //查有此人


        if($a){
            $t['t_status'] = 3;
            $b = M('piano_Teacher')->where("t_userid ='$id' ")->save($t);  //教师表中改

            $m['role'] = 3;
            $c = M('piano_Users')->where("id = '$id'")->save($m);  //用户表中改

            if($b && $c ){
                M('piano_Users')->commit();
                echo 1;exit;
            }else{
                M('piano_Users')->rollback();
                echo '删除失败';exit;
            }

        }
    }


    public function show_change(){
        $data['sid'] = I('id');
        $find = M('Users')->where("id = '$data[sid]'")->find();
        $list = M('Class')->join('piano_teacher on piano_teacher.t_userid = piano_class.class_teacher')
                          ->select();

        $this->assign('list',$list);
        $this->assign('find',$find);
        $this->display();


    }
    public function user_change(){

        $data['sid'] = I('id');
        $class_id = I('class_id');

        if(empty($class_id)){
            echo '请选择班级';exit;
        }

        $find = M('Users')->where("id = '$data[sid]'")->find();         //查找用户信息
        $class = M('Class')->where("class_id = '$class_id'")->find();   //查找班级信息

        M('Users')->startTrans();
        if($find['role'] == 3){

            $m = M('Users')->where("id = '$data[sid]'")->setField('role',1);   //更改成学生身份


            if(empty($class['class_stuids'])){
                $class['class_stuids'] =$data['sid'];
            }else{
                $class['class_stuids'] .=','.$data['sid'];      
            }
            $ad = M('Class')->where("class_id = '$class_id'")->setField('class_stuids',$class['class_stuids']);                     
                                                 //账号添加到班级
               


            $data['tid'] = $class['class_teacher'];
            $data['time'] = date('Y-m-d H-i-s',time());
            $d =  M('Teacher_student')->where("tid = '$data[tid]' and sid = $data[sid]")->find();
            if(empty($d)){
                $a = M('Teacher_student')->add($data);       //增加师生关系表   
            }

 
            $friend['userid'] = $data['sid'];
            $friend['friend_id'] = $class['class_teacher'];
            $where = "(userid ='$friend[userid]' and friend_id = '$friend[friend_id]') or 
            (userid = '$friend[friend_id]' and friend_id = '$friend[userid]')";
            $c = M('User_friends')->where($where)->find();
       
            if(empty($c)){
                $b = M('User_friends')->add($friend);   //增加朋友关系表
            }else{
                M('Users')->where($where)->setField('u_status',1);
            }

            if($m && $ad){
                M('Users')->commit();
                echo 1;exit;
            }else{
                M('Users')->rollback();
                echo "sql错误！请联系管理员";
            }
        }
          
    }





}

