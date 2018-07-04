<?php
/*设置
 * */
namespace Admin\Controller;
use Think\Controller;
class ConfController extends CommonController {

	public function admin_edit(){
		$aid = (int)$_POST['aid'];
		$user = M("Piano_admin")->where("aid='{$aid}'")->find();
		
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
			                    $supper =  M("Piano_admin")->where("role='{$_SESSION['piano_user']['role']}' and juese='1'")->find();
			                    $supper_pid = explode(",",$supper['m_pid']);
			                    $supper_cid = $supper['m_cid'];
					 			//当前管理员的权限菜单	
								$m_cid = $user['m_cid'];

								foreach($supper_pid as $k=>$val){
									$menus[$k]['m_name'] = M('Piano_admin_menu')->where("mid='{$val}'")->find()['m_name'];
									$menus[$k]['child'] = M('Piano_admin_menu')->where("m_parentid='{$val}' and mid in ({$supper_cid})")->select();
								}

                                foreach($menus as $val){
                                   $str.= '<tr><td><img src="./Public/Admin/admin/images/images/u6380.png">'.$val['m_name'].'</td>
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

	public function ajax_conf_del(){
        if (IS_POST) {

            $aid = $_POST['aid'];
            $res = M("Piano_admin")->where('aid = '.$aid)->delete();
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('admin_list_delok'))));
            }else{
                die(json_encode(array('str' => 2, 'msg' => L('admin_list_delerror'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }

	//添加，修改账号管理员
	public function admin_add(){
		if(IS_POST){
			$is_edit = $_POST['edit'];//等于1为修改，空为添加
			
			$username = trim($_POST['username']);
			if(empty($username)){
				echo '请输入账号';exit;
			}else{
				$user = M('Piano_admin')->where("username='{$username}'")->find();
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
		
			if(!$is_edit){
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
			}else{

				$pwd = trim($_POST['pwd']);
				$repwd = trim($_POST['repwd']);

				if($pwd != $repwd){
					echo '两次密码不一致,请重新输入~';exit;
				}
				
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
					$m_parentid = M("Piano_admin_menu")->field("m_parentid")->where("mid='{$v}'")->find()['m_parentid'];
					
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
						'pwd' => $pwd?$pwd:$user['pwd'],
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
				
				$caozuo = M("Piano_admin")->add($data);
			}else if($is_edit == 1){
				$caozuo = M("Piano_admin")->where("username='{$username}'")->save($data);
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

        $count = M("Piano_admin")->where($where)
            ->count();

		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		$list = M("Piano_admin")->where($where)
		                  ->order('juese ASC,aid DESC')
		                  ->limit($Page->firstRow.','.$Page->listRows)
		                  ->select();
		
		
		//权限菜单
		$m_pids = explode(',',$_SESSION['piano_user']['m_pid']);
		$m_cid = $_SESSION['piano_user']['m_cid'];
		foreach($m_pids as $k=>$val){
			$menus[$k]['m_name'] = M('Piano_admin_menu')->where("mid='{$val}'")->find()['m_name'];
			$menus[$k]['child'] = M('Piano_admin_menu')->where("m_parentid='{$val}' and mid in ({$m_cid})")->select();
		}

		$this->assign('menus',$menus);
        $this->assign('juese',$_SESSION['piano_user']['juese']);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

}