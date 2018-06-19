<?php
/*设置
 * */
namespace Admin\Controller;
use Think\Controller;
class ConfController extends CommonController {
	//编辑轮播图
	public function banner_edit(){
		if(IS_POST){
			$bid = $_POST['bid'];
			$url = $_POST['imgurl'];
			if(empty($url)){
				echo '请选择要上传的轮播图';exit;
			}

			$link = trim($_POST['link']);
			if(empty($link)){
				echo '请输入跳转链接';exit;
			}else{
				if(!$this->url_exists($link)){
					echo '请输入有效的跳转链接';exit;
				}
			}

			$b_set = trim($_POST['b_set']);
			if(empty($b_set)){
				echo '请输入播放位置';exit;
			}	
			
			$old_banner = M("Banner")->where("bid='{$bid}'")->find();
			if($url == $old_banner['b_url'] && $link == $old_banner['b_link'] && $b_set == $old_banner['b_set']){
				echo '1';exit;
			}
			
			$data = array(
					'b_url' => $url,
					'b_link' => $link,	
					'b_set' =>$b_set	
			);
				
			$save = M("Banner")->where("bid='{$bid}'")->save($data);
			if($save){
				if($url != $old_banner['b_url']){
					@unlink($old_banner['b_url']);
				}
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}
		}
		$bid = $_GET['bid'];
		$banner = M("Banner")->where("bid='{$bid}'")->find();
		
		$this->assign("banner",$banner);
		$this->display();
	}
	//添加轮播图
	public function lunbo_add(){
		if(IS_POST){
			$url = $_POST['imgurl'];
			if(empty($url)){
				echo '请选择要上传的轮播图';exit;
			}
			$link = trim($_POST['link']);
			if(empty($link)){
				echo '请输入跳转链接';exit;
			}else{
				if(!$this->url_exists($link)){
					echo '请输入有效的跳转链接';exit;
				}
			}
			$b_set = $_POST['b_set'];
			if(empty($b_set)){
				echo '请设置播放位置';exit;
			}
			
			$data = array(
				        'b_url' => $url,
						'b_link' => $link,
						'b_set' => $b_set
			        );
			
			$add = M("Banner")->add($data);
			if($add){
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}
		}
		$this->display();
	}
	//删除轮播图
	public function banner_del(){
		if(IS_POST){
			$bid = $_POST['bid'];
			$find_banner = M("Banner")->where("bid='{$bid}'")->find();
			if($find_banner){
				$del = M("Banner")->where("bid='{$bid}'")->limit(1)->delete();
				if($del){
					@unlink($find_banner['b_url']);
					echo 1;exit;
				}else{
					echo '操作失败，请联系管理员';exit;
				}
			}else{
				echo '该轮播图不存在';exit;
			}
		}
	}
	//轮播图
	public function lunbo_list(){
		$count = M("Banner")->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		$list = M("Banner")->limit($Page->firstRow.','.$Page->listRows)
						   ->select();

		$speed = M('lunbotu')->where("id =1")->find();

		$this->assign('speed',$speed);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	
	public function admin_ajaxadd(){
		$str ='<div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="name">账号:</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" value="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">密码:</label>
                        <div class="col-sm-8">
                            <input type="password" name="pwd" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="name">确认密码:</label>
                        <div class="col-sm-8">
                            <input type="password" name="repwd" value="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">姓名:</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="" class="form-control">
                        </div>
                    </div>
                     <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">联系方式:</label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">权限菜单:</label>
                        <div class="col-sm-8">
                            <table id="add-table" class="table table-bordered" style="margin-bottom: 0px;font-size:13px;">
                                <tr>
                                    <th>导航名称</th>
                                    <th>选择</th>
                                </tr>';
                               
							//权限菜单
							$m_pids = explode(',',$_SESSION['piano_user']['m_pid']);
							$m_cid = $_SESSION['piano_user']['m_cid'];
							foreach($m_pids as $k=>$val){
								$menus[$k]['m_name'] = M('piano_Admin_menu')->where("mid='{$val}'")->find()['m_name'];
								$menus[$k]['child'] = M('piano_Admin_menu')->where("m_parentid='{$val}' and mid in ({$m_cid})")->select();
							}
						
                               foreach($menus as $val){

                                 $str .='   <tr><td><img src="./Public/Admin/admin/images/images/u6376.png">'.$val['m_name'].'</td>
                                        <td></td>
                                    </tr>';
                                   foreach($val['child'] as $v){	
	                                   $str .='   <tr>
	                                        <td><img style="margin-left: 10px;" src="./Public/Admin/admin/images/images/u6380.png">'.$v['m_name'].'</td>
	                                        <td><input type="checkbox"  value="'.$v['mid'].'" name="cid[]"> </td>
	                                    </tr>';
                                        }
                                    }
                                 $str .=' 
                            </table>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">状态:</label>
                        <div class="col-sm-8">
                            <div class="radio1">
								<label>
									<input name="status" type="radio" value="1" class="ace" checked/>
									<span class="lbl">启用</span>
								</label>
								<label>
									<input name="status" type="radio" value="2" class="ace" />
									<span class="lbl">禁用</span>
								</label>
								
							</div>
                        </div>
                    </div>';
                  if($_SESSION['piano_user']['role']==1){  

	                  	$str .='  <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
	                        <label class="col-sm-3 control-label" for="admin">角色:</label>
	                        <div class="col-sm-8">
	                            <div class="radio1">
									<label>
										<input name="juese" type="radio" value="2" class="ace" checked/>
										<span class="lbl">普通管理员</span>
									</label>
									<label>
										<input name="juese" type="radio" value="1" class="ace" />
										<span class="lbl">超级管理员</span>
									</label>
									
								</div>
	                        </div>
	                    </div>';
                    }
                    
                    echo $str;exit;
	}
	
	public function admin_edit(){
		$aid = (int)$_POST['aid'];
		$user = M("piano_Admin")->where("aid='{$aid}'")->find();
		
		$str = '<div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="name">账号:</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" value="'.$user['username'].'" class="form-control" readonly/>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">密码:</label>
                        <div class="col-sm-8">
                            <input type="password" name="pwd" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="name">确认密码:</label>
                        <div class="col-sm-8">
                            <input type="password" name="repwd" value="" class="form-control">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">姓名:</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="'.$user['fzr_name'].'" class="form-control">
                        </div>
                    </div>
                     <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">联系方式:</label>
                        <div class="col-sm-8">
                            <input type="text" name="mobile" value="'.$user['mobile'].'" class="form-control">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">权限菜单:</label>
                        <div class="col-sm-8">
                            <table id="add-table" class="table table-bordered" style="margin-bottom: 0px;font-size:13px;">
                                <tr>
                                    <th>导航名称</th>
                                    <th>选择</th>
                                </tr>';
			                    //当前管理员类型超级管理员的权限
			                    $supper =  M("piano_Admin")->where("role='{$_SESSION['piano_user']['role']}' and juese='1'")->find();
			                    $supper_pid = explode(",",$supper['m_pid']);
			                    $supper_cid = $supper['m_cid'];
					 			//当前管理员的权限菜单	
								$m_cid = $user['m_cid'];
							
								foreach($supper_pid as $k=>$val){
									$menus[$k]['m_name'] = M('piano_Admin_menu')->where("mid='{$val}'")->find()['m_name'];
									$menus[$k]['child'] = M('piano_Admin_menu')->where("m_parentid='{$val}' and mid in ({$supper_cid})")->select();
								}
								
                                foreach($menus as $val){
                                   $str.= '<tr><td><img src="./Public/Admin/admin/images/images/u6376.png">'.$val['m_name'].'</td>
                                        <td></td></tr>';
                                  foreach($val['child'] as $v){	
	                                       $str.= '<tr><td><img style="margin-left: 10px;" src="./Public/Admin/admin/images/images/u6380.png">'.$v['m_name'].'</td>
	                                        <td><input type="checkbox"  value="'.$v['mid'].'" name="cid[]" ';
	                                    
	                                       if(strpos(','.$m_cid.',',','.$v['mid'].',') !== false){
	                                       	  $str.= 'checked';
	                                       }
	                                       
	                                       $str.='/> </td></tr>';
                                  }
                               }
                               $str.= '</table></div></div>
                    <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">状态:</label>
                        <div class="col-sm-8">
                            <div class="radio1">
								<label>
									<input name="status" type="radio" value="1" class="ace" ';
									
									if($user['status']==1){ 
										$str.='checked';
									}
									
									$str.= '/>
									<span class="lbl">启用</span>
								</label>
								<label>
									<input name="status" type="radio" value="2" class="ace"  ';
									
									if($user['status']==2){ 
										$str.='checked';
									}
									$str.= '/><span class="lbl">禁用</span></label></div></div></div>';
                    
                  if($_SESSION['piano_user']['role']==1){  
                   $str.= ' <div class="form-group" style="margin-bottom: 20px;overflow: hidden;">
                        <label class="col-sm-3 control-label" for="admin">角色:</label>
                        <div class="col-sm-8">
                            <div class="radio1">
								<label>
									<input name="juese" type="radio" value="2" class="ace" ';
									
									if($user['juese']==2){ 
										$str.='checked';
									}
									$str.= '/>
									<span class="lbl">普通管理员</span>
								</label>
								<label>
									<input name="juese" type="radio" value="1" class="ace" ';
									
									if($user['juese']==1){ 
										$str.='checked';
									}
									$str.= '/>
									<span class="lbl">超级管理员</span>
								</label>
								
							</div>
                        </div>
                    </div>';
                   }
                $str.= '</div><input type="hidden" name="edit" value="1">';//标记修改
                
                echo $str;exit;
	}
	//添加，修改账号管理员
	public function admin_add(){
		if(IS_POST){
			$is_edit = $_POST['edit'];//等于1为修改，空为添加
			
			$username = trim($_POST['username']);
			if(empty($username)){
				echo '请输入账号';exit;
			}else{
				$user = M('piano_Admin')->field('aid')->where("username='{$username}'")->find();
				if(empty($is_edit)){
					if($user){
						echo '该账号已存在,请更换~';exit;
					}					
				}else if($is_edit == 1){
					if(empty($user)){
						echo '该账号已存在,请更换~';exit;
					}	
				}
			}
			//添加的时候才需要验证密码
		
                $pwd = trim($_POST['pwd']);
				if(empty($pwd)){
					echo '密码不能为空';exit;
				}
				$repwd = trim($_POST['repwd']);
				if($pwd != $repwd){
					echo '两次密码不一致,请重新输入~';exit;
				}else{
					$pwd = md5(MA.$pwd);
				}
			
			
			
			$name = trim($_POST['name']);
			if(empty($name)){
				echo '请输入姓名';exit;
			}
			$mobile= trim($_POST['mobile']);
			if(!$this->ckeck_mobile($mobile)){
				echo '请输入有效的手机号';exit;
			}
			$cid = $_POST['cid'];
			if(empty($cid)){
				echo '请勾选账号拥有的权限';exit;
			}else{
				//拼接权限菜单
				$pid = '';
				foreach($cid as $v){
					$m_parentid = M("piano_Admin_menu")->field("m_parentid")->where("mid='{$v}'")->find()['m_parentid'];
					
					if(strpos(','.$pid,','.$m_parentid.',') === false){
						$pid .=$m_parentid.',';
					}
				}
				$pid = rtrim($pid,',');
				$cid = implode(',', $cid);
				
			}
			if($_SESSION['piano_user']['role']==1){
			   $juese = $_POST['juese'];
			}else{
				$juese = 2;
			}
			$status = $_POST['status'];
			
			$data = array(
				        'username' => $username,
						'pwd' => $pwd,
						'role' => $_SESSION['piano_user']['role'],
						'm_pid' => $pid,
						'm_cid' => $cid,
						'juese' => $juese,
						'fzr_name' => $name,
						'mobile' => $mobile,
						'status' => $status,
					    'jx_jigou' => $_SESSION['piano_user']['jx_jigou']
			        );
			
			if(empty($is_edit)){
				$data['careater_username'] = $_SESSION['piano_user']['username'];
				$data['add_time'] = date('Y-m-d H:i:s',time());
				
				$caozuo = M("piano_Admin")->add($data);
			}else if($is_edit == 1){
				$caozuo = M("piano_Admin")->where("username='{$username}'")->save($data);
			}

			if($caozuo){
				echo '1';exit;
			}else{
				echo '操作失败,请联系管理员~';exit;
			}
		}
	}
	
	//后台登陆账号列表
	public function admin_list(){
		if($_SESSION['piano_user']['role']==1){
			$where = "role='1'";
		}else if($_SESSION['piano_user']['role']==2){
			$where = "role='2' and jx_jigou='{$_SESSION['piano_user']['jx_jigou']}'";
		}else if($_SESSION['piano_user']['role']==3){
			$where = "role='3' and jx_jigou='{$_SESSION['piano_user']['jx_jigou']}'";
		}else{
			echo '无权限';exit;
		}
		
		$count = M("piano_Admin")->where($where)
						   ->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		$list = M("piano_Admin")->where($where)
		                  ->order('juese ASC,aid DESC')
		                  ->limit($Page->firstRow.','.$Page->listRows)
		                  ->select();
		
		
		//权限菜单
		$m_pids = explode(',',$_SESSION['piano_user']['m_pid']);
		$m_cid = $_SESSION['piano_user']['m_cid'];
		foreach($m_pids as $k=>$val){
			$menus[$k]['m_name'] = M('piano_Admin_menu')->where("mid='{$val}'")->find()['m_name'];
			$menus[$k]['child'] = M('piano_Admin_menu')->where("m_parentid='{$val}' and mid in ({$m_cid})")->select();
		}	
		$this->assign('menus',$menus);
	
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
	
	
	
	
	
	
	
	
	
	
	
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
    				        'pwd' => md5(MA.md5('123456')),
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
    			$contetn = "亲~,子昊钢琴给您注册了账号:".$phone.",初始密码：123456,欢迎下载使用。";
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
    		$where = "piano_users.role='2'";
    	}else if($_SESSION['piano_user']['role'] == 2){
    		$where = "piano_users.role='2' and piano_teacher.t_parent3 = '{$_SESSION['piano_user']['agent_id']}'";
    	}else if($_SESSION['piano_user']['role'] == 3){
    		$where = "piano_users.role='2' and piano_teacher.t_parent2 = '{$_SESSION['piano_user']['fid']}'";
    	}else if($_SESSION['piano_user']['role'] == 4){
    		$where = "piano_users.role='2' and piano_teacher.t_parent1 = '{$_SESSION['piano_user']['dom_id']}'";
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
	
	//学生列表
	public function student_list(){
	    if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$dom = M("Dom")->select();
			$this->assign('dom',$dom);
			
			$where = "piano_users.role = '1'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			$dom = M("Dom")->where("d_parent2='{$_SESSION['piano_user']['agent_id']}'")->select();
			$this->assign('dom',$dom);
			
			$where = "piano_users.role = '1' and piano_teacher.t_parent3='{$_SESSION['piano_user']['agent_id']}'";
		}else if($_SESSION['piano_user']['role'] == 3){
			//分销商看
			$dom = M("Dom")->where("d_parent1='{$_SESSION['piano_user']['fid']}'")->select();
			$this->assign('dom',$dom);
			
			$where = "piano_users.role = '1' and piano_teacher.t_parent2='{$_SESSION['piano_user']['fid']}'";
		}else if($_SESSION['piano_user']['role'] == 4){
			$where = "piano_users.role = '1' and piano_teacher.t_parent1='{$_SESSION['piano_user']['dom_id']}'";
		}else{
			echo '权限不够';exit;
		}
		
		//搜索条件
		if(IS_POST){
			$dom_id = $_POST['dom_id'];
			if($dom_id != ''){
                 $where .= " and piano_dom.dom_id = '{$dom_id}'";
				
				$this->assign('dom_id',$dom_id);
			}
			$name = trim($_POST['name']);
			if($name){
				$tid = M('Class')->field('class_teacher')->where("class_name='{$name}'")->find()['class_teacher'];
				$where .= " and piano_teacher.t_userid='{$tid}'";	
				$this->assign('name',$name);
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
			if(empty($name) && empty($dom_id) && empty($stime) && empty($etime)){
				//如果是点击页码发起的请求，则按只保存的条件搜索
				if(!$button){
					if($_SESSION['class_list_sou']){
						$where = $_SESSION['class_list_sou'];
					}
				}
			}
			$_SESSION['class_list_sou'] = $where;
		}

    	//学生列表
    	$field = "piano_users.*,piano_teacher_student.time,piano_teacher_student.tid,piano_teacher.t_truename,";
    	$field .= "piano_dom.d_name";
    	
    	    	
    	$join1 = "piano_users on piano_users.id=piano_teacher_student.sid";
    	$join2 = "piano_teacher on piano_teacher.t_userid=piano_teacher_student.tid";
    	$join3 = "piano_dom on piano_dom.dom_id = piano_teacher.t_parent1";
    	 
    	
    	$count = M("Teacher_student")->field($field)
								    	->join($join1)
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
    	
    	$students = M("Teacher_student")->field($field)
    	                                ->join($join1)
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
    		$students[$k]['class_name'] = M('Class')->field('class_name')->where("class_teacher='{$v['tid']}'")->find()['class_name'];
    		//弹奏总次数
    		$students[$k]['count'] = M("Practice_log")->where("log_userid='{$v['id']}'")->count();
    	}
    	
		//echo '<pre/>';
		//var_dump($students);exit;
		$this->assign('page',$show);
		$this->assign('list',$students);
		$this->display();
	}
	


    public function up_speed(){
    	$data['speed'] = I('speed');
    	if($data['speed']){
    		$a = M('lunbotu')->where("Id =1")->find();
    		if($a['speed'] == $data['speed']){
    			echo "选择速度没有改变";exit;
    		}else{
    			$b = M('lunbotu')->where("Id =1")->save($data);
		    	if($b){
		    		echo 1;exit;
		    	}else{
		    		echo "修改失败";exit;
		    	}
    		}
	    	
    	}else{
    		echo "请选择一个速度";exit;
    	}
    }

        public function show_advice_list(){

    	$count = M('Advice')->count();

    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

    	$join = 'piano_users on piano_users.id = piano_advice.ad_user';
    	$a = M('Advice')->order('ad_time DESC')
    					->join($join)
    	                ->select();


    	$this->assign('list',$a);
    	$this->assign('page',$show);
    	$this->display();
    }


    public function show_app_list(){
    	$count = M('App')->count();

    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

    	$a = M('App')->limit($Page->firstRow.','.$Page->listRows)->order('app_id DESC')->select();

    	$this->assign('page',$show);
    	$this->assign('list',$a);
    	$this->display();
    }

    public function show_app_add(){
    	$this->display();
    }

    public function app_add(){
    	if($_POST['pdf'] && $_POST['name'] && $_POST['num'] && $_POST['info']){
    		$data['app_url'] = I('pdf');
    		$data['app_name'] = I('name');
    		$data['app_time'] = date('Y-m-d H:i:s',time());
    		$data['app_type'] = I('type')?I('type'):2;
    		$data['app_num'] = I('num');
    		$data['app_info'] = I('info');
    		$data['app_kind'] = I('kind');
    		$a = M('App')->add($data);
    		if($a){
    			echo 1;exit;
    		}else{
    			echo '添加失败';exit;
    		}
    	}else{
    		echo '缺少必填参数';exit;
    	}

    }
	
    public function upload_app(){
    	
		// ini_set("memory_limit","100M");
		// ini_set('post_max_size','100M');
		// ini_set('upload_max_filesize','100M');   最终在ini文件里改过  
   		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*100;// 设置附件上传大小
			$upload->exts      =     array('apk');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);
			$upload->rootPath  =     'Public/Uploads/app/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				echo $upload->getError();exit;
	
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
					
				echo $file_name;exit;
					
			}
		}else{
			echo 1;exit;
		}
		
	}
    




}