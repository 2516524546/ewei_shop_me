<?php
/*经销商管理
 * */
namespace Admin\Controller;
use Think\Controller;
class JinxiaoController extends CommonController {
	//新增分销商
     public function fenxiao_add(){
		if(IS_POST){
			$jxid = $_POST['jxid'];
			if($jxid == ''){
				echo '请选择代理商机构名';exit;
			}
			
			$name = trim($_POST['name']);
			if(empty($name)){
				echo '请输入分销商机构名';exit;
			}
			if(M("Dealers")->where("jx_name='{$name}'")->find()){
				echo '分销商机构名已经存在,请更换~';exit;
			}
			$pro = $_POST['location_p'];
			$city = $_POST['location_c'];
			$area = $_POST['location_a'];
			if($area == '请选择'){
				echo '请选择代理区域';exit;
			}
			$address = trim($_POST['address']);
			$fzr_name = trim($_POST['fzr_name']);
			if(empty($fzr_name)){
				echo '请输入负责人姓名';exit;
			}
			$mobile = trim($_POST['mobile']);
			if(!$this->ckeck_mobile($mobile)){
				echo '请输入有效的手机号';exit;
			}
			
			if(M("Admin")->where("mobile='{$mobile}'")->find()){
				echo '该手机号已经创建过账号了,请更换~';exit;
			}
				
			$card = trim($_POST['card']);
			if(!$this->check_identity($card)){
				echo '请输入正确的身份证号';exit;
			}
			
			$catid = M("Dealers")->where("jxid='{$jxid}'")->find();
			
			$data = array(
				'jx_name' => $name,
				'jxf_pro' => $pro,
				'jxf_city' => $city,
				'jx_area' => $area,
				'jx_address' => $area,
				'jx_addtime' => date('Y-m-d H:i:s',time()),
				'jx_careater' => $_SESSION["piano_user"]['aid'],
				'jx_parent' => $jxid,
				'jx_catid' => $catid['jx_catid']
				);
			if($_SESSION['piano_user']['role']==1){
				$data['jx_status'] = 1;
			}	
			if($_SESSION['piano_user']['role']==2){
				$data['jx_status'] = 0;
			}
			//var_dump($data);exit;
			
			M("Dealers")->startTrans();    //启动事务
			$add = M("Dealers")->add($data);   //这里只是存放到数据库，还没有通过审核
			if($add){
				
				//创建账号
				$username = 'FX'.$mobile;
				$pwd = md5(MA.'123456');
				$admin = array(		
						'username' => $username,
						'pwd' => $pwd,
						'role' => 3,										
						'juese' => 1,
						'm_pid' => '34,2,20',  //默认权限父菜单id
						'm_cid' => '9,10,11,12,13,15,21,22',//默认权限子菜单id
						'card' => $card,
						'fzr_name' =>$fzr_name,
						'mobile' => $mobile,
						'add_time' => date('Y-m-d H:i:s',time()),
				        'careater_username' => $_SESSION["piano_user"]['username'],
						'jx_jigou' =>$add
					);
				
				if($_SESSION['piano_user']['role'] == 1){
					$admin['status'] = 1;
				}
				if($_SESSION['piano_user']['role'] == 2){
					$admin['status'] = 2;
				}
				//var_dump($admin);exit;
				$add1 = M("Admin")->add($admin); 
				
				if($add && $add1){
					
					if($_SESSION['piano_user']['role']==2){
						M("Dealers")->commit();
						$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
						$contetn = "您好:您的资料已提交平台审核，请等待回复";
						//发送短信
						$msg = $contetn."【快乐琴行】";
						$this ->sendMessage($mobile,$msg);
						echo 1;exit;
					}
					if($_SESSION['piano_user']['role']==1){
						M("Dealers")->commit();
						$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
						$contetn = "您好,子昊钢琴给您启用了后台管理账号:".$username.",初始密码：123456。
						登陆地址：".$url;
						//发送短信
						$msg = $contetn."【快乐琴行】";
						$this ->sendMessage($mobile,$msg);
						echo 1;exit;
					}
				}else{
					M("Dealers")->rollback();
					echo '添加失败,请联系管理员~';exit;
				}
			}else{
				M("Dealers")->rollback();    //事务回滚
				echo '您填写的资料不齐，无法提交';exit;
			}
		}
		if($_SESSION['piano_user']['role'] == 1){
			//平台新增
			$list = M("Dealers")->where("jx_status='1' and jx_parent='0'")->select();	
		}else{
			//代理商新增
			$list = M("Dealers")->where("jxid='{$_SESSION['piano_user']['jx_jigou']}'")->find();
		}

		$this->assign('list',$list);
		$this->display();
	}
	
//分销搜
	public function fenxiao_list_sou(){
	
		if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$agent = M("Dealers")->select();
			$this->assign('agent',$agent);
			
			$where = "piano_admin.role='3' and piano_admin.juese='1'";
		}else if($_SESSION['piano_user']['role'] == 2){
			//代理商看
			/* $agent = M("Agent")->where("f_parent1 = '{$_SESSION['piano_user']['agent_id']}'")->select();
			$this->assign('agent',$agent); */
			
			$where = "piano_admin.role='3' and piano_admin.juese='1' and piano_dealers.jx_parent = '{$_SESSION['piano_user']['jxid']}'";
		}else{
			echo '权限不够！';exit;
		}
		
		$jxid = $_POST['jxid'];

		if($jxid != ''){	

			$where .=" and piano_dealers.jx_parent = '$jxid'";
			$this->assign('jxid',$jxid);
		}
		
		$name = trim($_POST['name']);
		if($name){
			$where .= " and piano_dealers.jx_name like '%{$name}%'";
			$this->assign('name',$name);
		}
		
		$username = trim($_POST['username']);
		if($username){
			$where .= " and piano_admin.username='{$username}'";
			$this->assign('username',$username);
		}
		$p = $_REQUEST['location_p'];
		$c = $_REQUEST['location_c'];
		$a = $_REQUEST['location_a'];
		if($p != '请选择'){
			if($c != '请选择'){
				if($a != '请选择'){
					$where .= " and piano_dealers.jx_area='{$c}'";
					$this->assign('a',$a);
					$this->assign('c',$c);
					$this->assign('p',$p);
				}else{
					$where .= " and piano_dealers.jx_city='{$c}'";
					$this->assign('c',$c);
					$this->assign('p',$p);
				}
			}else{
				$where .= " and piano_dealers.jx_pro='{$p}'";
				$this->assign('p',$p);
			}
		}
		


		$button = $_POST['button'];
		if(empty($name)  && empty($username) && empty($aid) && $p=='请选择' && $c=='请选择' && $a=='请选择'){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['fenxiao_list_sou']){
					$where = $_SESSION['fenxiao_list_sou'];
				}
			}
		}
		$_SESSION['fenxiao_list_sou'] = $where;
	
		$field = "piano_dealers.*,piano_admin.*";
		$join = "piano_admin on piano_admin.jx_jigou = piano_dealers.jxid";
		
			
		$count = M("Dealers")->field($field)
								->join($join)
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
	
	
		$list = M("Dealers")->field($field)
								->join($join)
								->where($where)
								->limit($Page->firstRow.','.$Page->listRows)
								->select();
		// dump($list);exit;
		foreach($list as $k=>$v){
			$list[$k]['parent_name'] = M("Dealers")->where("jxid='{$v['jx_parent']}'")->find()['jx_name'];
		}
	
		//echo '<pre/>';
		//var_dump($list);exit;
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('fenxiao_list');
	}

	//分销商账号列表
	public function fenxiao_list(){
	
		if($_SESSION['piano_user']['role'] == 1){
			//平台看
			$jinxiao = M("Dealers")->where("jx_status='1' and jx_parent='0'")->select();     //从代理商找信息
			$this->assign('jinxiao',$jinxiao);
				
			$where = "piano_admin.role='3' and piano_admin.juese='1' and piano_dealers.jx_status ='1'";
		}else if($_SESSION['piano_user']['role'] == 2){
				
			//代理商看
			$where = "piano_admin.role='3' and piano_admin.juese='1' and
			piano_dealers.jx_parent = '{$_SESSION['piano_user']['jx_jigou']}'
			and piano_dealers.jx_status ='1'";
		}else{
		    echo '权限不够！';exit;
		}
		
		
		 $field = "piano_dealers.*,";
		 $field .="piano_admin.*";
		 $join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";
		
		 $count = M("Dealers")->field($field)
								->join($join)							
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
	
	
		$list = M("Dealers")->field($field)
					          ->join($join)
							  ->where($where)
							  ->limit($Page->firstRow.','.$Page->listRows)
							  ->select();
	    
		foreach($list as $k=>$v){
			$list[$k]['parent_name'] = M("Dealers")->where("jxid='{$v['jx_parent']}'")->find()['jx_name'];
		}
	
	
	
		//dump($list);exit;
		$this->assign('page',$show);
		$this->assign('list',$list); 
		$this->display();
	}


	public function fenxiao_xiang(){
		$jxid = $_GET['jxid'];
    	$list = M("Admin")->join("piano_dealers on piano_dealers.jxid = piano_admin.jx_jigou")
    					  ->where( "jx_jigou='{$jxid}'")->find();
    		
    	$this->assign('list',$list);
    	$this->display();

	}


	public function fenxiao_edit(){
		$jxid = $_GET['jxid'];

    	$list = M("Admin")->join("piano_dealers on piano_dealers.jxid = piano_admin.jx_jigou")
    					  ->where( "jx_jigou='{$jxid}'")->find();	
		  
    	$this->assign('list',$list);
    	$this->display();


    	$aa = I('fzr_name');
    	if($aa){
    		$dat['fzr_name'] = $aa;
    	}
		$bb = I('card');
		if($bb){
			$dat['card'] = $bb;
		}
		$cc = I('mobile');
		if($cc){
			$dat['mobile'] = $cc;
		}

		$dd = I('location_p');
		if($dd){
			$data['jx_pro'] = $dd;
		}
		$ee = I('location_c');
		if($ee){
			$data['jx_city'] = $ee;
		}
		$ff = I('location_a');
		if($ff){
			$data['jx_area'] = $ff;
		}
		$gg = I('jx_address');
		if($gg){
			$data['jx_address'] = $gg;
		}

	
		if(IS_POST){
			$b = M("Dealers")->where("jxid = '$jxid'")->save($data);
			$c = M('Admin')->where("jx_jigou = '$jx_id'")->save($dat);
			if($b && $c){
				echo 1; exit;
			}else{
				echo '修改失败,请联系管理员~';exit;
			}
		}
			
		

	}
	//////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

	public function agent_add(){
		if(IS_POST){
	
			$name = trim($_POST['name']);
			if(empty($name)){
				echo '请输入代理商机构名';exit;
			}
			if(M("Dealers")->where("jx_name='{$name}'")->find()){
				echo '代理商机构名已经存在,请更换~';exit;
			}
			$pro = $_POST['location_p'];
			$city = $_POST['location_c'];
			$area = $_POST['location_a'];
			if($area == '请选择'){
				echo '请选择代理区域到最后一级';exit;
			}
			$address = trim($_POST['address']);
			$fzr_name = trim($_POST['fzr_name']);
			if(empty($fzr_name)){
				echo '请输入负责人姓名';exit;
			}
			$mobile = trim($_POST['mobile']);
			if(!$this->ckeck_mobile($mobile)){
				echo '请输入有效的手机号';exit;
			}
			if(M("Admin")->where("mobile='{$mobile}'")->find()){
				echo '该手机号已经创建过账号了,请更换~';exit;
			}
				
			$card = trim($_POST['card']);
			if(!$this->check_identity($card)){
				echo '请输入正确的身份证号';exit;
			}
				
			$data = array(
					'jx_name' => $name,
					'jx_pro' => $pro,
					'jx_city' => $city,
					'jx_area' => $area,
					'jx_address' => $address,
					'jx_addtime' => date('Y-m-d H:i:s',time()),
					'jx_careater' => $_SESSION["piano_user"]['aid'],
					'jx_parent' => 0,
					'jx_status' => 1
			);
			
			M("Dealers")->startTrans();
			$add = M("Dealers")->add($data);
			if($add){
				//创建账号
				$username = 'DL'.$mobile;
				$pwd = md5(MA.'123456');
				$admin = array(
						'username' => $username,
						'pwd' => $pwd,
						'role' => 2,
						'agent_id' => $add,
						'juese' => 1,
						'card' => $card,
						'fzr_name' =>$fzr_name,
						'mobile' => $mobile,
						'm_pid' => '1,34,2,20',  //默认权限父菜单id
						'm_cid' => '6,9,10,11,12,13,15,21,22',//默认权限子菜单id
						'add_time' => date('Y-m-d H:i:s',time()),
				        'careater_username' => $_SESSION["piano_user"]['username'],
						'jx_jigou' =>$add
				);
				$add1 = M("Admin")->add($admin);
	
				if($add && $add1){
					M("Dealers")->commit();
					$url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$contetn = $fzr_name."您好,快乐琴行给您创建了后台管理账号:".$username.",初始密码：123456。登陆地址：".$url;
					//发送短信
					$msg = $contetn."【快乐琴行】";
					$this ->sendMessage($mobile,$msg);
					echo 1;exit;
				}else{
					M("Dealers")->rollback();
					echo '添加失败,请联系管理员~';exit;
				}
			}
			//var_dump($data);exit;
		}
		$this->display();
	}

//搜用户
	public function agent_list_sou(){
	    if($_SESSION['piano_user']['role'] == 1){
			$where = "piano_admin.role='2' and piano_admin.juese='1'";
		}else{
			echo '权限不够！';exit;
		}
		
		$name = trim($_POST['name']);
		if($name){
			$where .= " and piano_dealers.jx_name like '%{$name}%'";
			$this->assign('name',$name);
		}
		
		$jxid = trim($_POST['jxid']);
		if($jxid){
			$where .= " and piano_dealers.jxid='{$jxid}'";
			$this->assign('jxid',$jxid);
		}
		$p = $_REQUEST['location_p'];
		$c = $_REQUEST['location_c'];
		$a = $_REQUEST['location_a'];
		if($p != '请选择'){
			if($c != '请选择'){
				if($a != '请选择'){
					$where .= " and piano_dealers.jx_area='{$a}'";
					$this->assign('a',$a);
					$this->assign('c',$c);
					$this->assign('p',$p);
				}else{
					$where .= " and piano_dealers.jx_city='{$c}'";
					$this->assign('c',$c);
					$this->assign('p',$p);
				}	
			}else{
				$where .= " and piano_dealers.jx_pro='{$p}'";
				$this->assign('p',$p);
			}
		}
		
     	$button = $_POST['button'];
     	if(empty($name)  && empty($username) && $p=='请选择' && $c=='请选择' && $a=='请选择'){
     		//如果是点击页码发起的请求，则按只保存的条件搜索
     		if(!$button){
     			if($_SESSION['agent_list_sou']){
     				$where = $_SESSION['agent_list_sou'];
     			}
     		}
     	}
     	$_SESSION['agent_list_sou'] = $where;
     	
		//echo $where;exit;
		
		$field = "piano_dealers.*,piano_admin.*";
		$join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";
		
		$count = M("Dealers")->field($field)
						  ->join($join)
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
		
		
		$list = M("Dealers")->field($field)
		                  ->join($join) 
		                  ->where($where)
		                  ->limit($Page->firstRow.','.$Page->listRows)
		                  ->select();
		
		//dump($list);exit;
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('agent_list');
	}



	//代理商列表
	public function agent_list(){
	    if($_SESSION['piano_user']['role'] == 1){
			$where = "piano_admin.role='2' and piano_admin.juese='1' and piano_dealers.jx_parent='0'";
		}else{
			echo '权限不够！';exit;
		}
	    

		$field = "piano_dealers.*,";
		$field .= "piano_admin.aid,piano_admin.username,piano_admin.juese,piano_admin.card,piano_admin.mobile,piano_admin.fzr_name";
		$join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";
	
		$count = M("Dealers")->field($field)
							 ->join($join)
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
	
	
		$list = M("Dealers")->field($field)
							->join($join)
							->where($where)
							->limit($Page->firstRow.','.$Page->listRows)
							->select();
		
		//专业教程
		$cat = M("Songs_catgroy")->where("c_status='1' and c_type='1'")->select();
		$this->assign('cat',$cat);
		//echo '<pre/>';
		//var_dump($list);exit;
		$this->assign('page',$show);
		$this->assign('list',$list); 
		$this->display();
	}
	

	public function agent_xiang(){
		$jxid = $_GET['jxid'];
    	$list = M("Admin")->join("piano_dealers on piano_dealers.jxid = piano_admin.jx_jigou")
    					  ->where( "jx_jigou='{$jxid}'")->find();
    		
    	$this->assign('list',$list);
    	$this->display();

	}


	public function agent_edit(){
		$jxid = $_GET['jxid'];

    	$list = M("Admin")->join("piano_dealers on piano_dealers.jxid = piano_admin.jx_jigou")
    					  ->where( "jx_jigou='{$jxid}'")->find();	
		  
    	$this->assign('list',$list);
    	$this->display();


    	$aa = I('fzr_name');
    	if($aa){
    		$dat['fzr_name'] = $aa ;
    	}
		$bb = I('card');
		if($bb){
			$dat['card'] = $bb;
		}
		$cc= I('mobile');
		if($cc){
			$dat['mobile'] = $cc;
		}

		$dd = I('location_p');
		if($dd){
			$data['jx_pro'] = $dd;
		}
		$ee = I('location_c');
		if($ee){
			$data['jx_city'] = $ee;
		}
		$ff = I('location_a');
		if($ff){
			$data['jx_area'] = $ff;
		}
		$gg = I('jx_address');
		if($gg){
			$data['jx_address'] = $gg;
		}

	
		if(IS_POST){
			$b = M("Dealers")->where("jxid = '$jxid'")->save($data);
			$c = M('Admin')->where("jx_jigou = '$jx_id'")->save($dat);
			if($b && $c){
				echo 1; exit;
			}else{
				echo '修改失败,请联系管理员~';exit;
			}
		}
			
		

	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	public function save_pwd(){
		$jxid = I('jxid');
		$list = M("Admin")->join("piano_dealers on piano_dealers.jxid = piano_admin.jx_jigou")
    					  ->where( "jx_jigou='{$jxid}'")->find();	
    	$this->assign('list',$list);
		$this->display();

		$username = I('username');     //要修改的账号  
        $pwd = md5(MA.I('pwd'));   //输入的原密码
        $data['pwd'] = md5(MA.I('newpassword'));  //这个新密码  
        $pwdag =md5(MA.I("passwordagain"));   //重复密码      
        
        $see =M('Admin')->where("jx_jigou = '$jxid'")->find();  //从数据库里查出来的原密码
         if($see['pwd'] == $pwd ){
                if($pwdag == $data['pwd']){
                    $a = M('admin')->where("username = '$username'")->save($data);

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





 	public  function jx_daochu(){
        
        $join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";

    	$list = M("Dealers")->join($join)->where("jx_status='1' and jx_parent='0'")->select();

        $data = array();
    foreach($list as $k=>$v){
    	if($v['juese'] == 1){
    		$v['juese'] = "超级管理员";
    	}else{
    		$v['juese'] = "普通管理员";
    	}

        $data[$k] = array('jxid'=>$v['jxid'], 'jx_name'=>$v['jx_name'], 'username'=>$v['username'],
                       'fzr_name'=>$v['fzr_name'], 'mobile'=>$v['mobile'], 'juese'=>$v['juese'],
                       'address'=>$v['jx_pro'].$v['jx_city'].$v['jx_area'],
                       'jx_address'=>$v['jx_address'],'card'=>",".$v['card'],
                       'add_time'=>$v['add_time']);
    }
   //  dump($data);exit;
        $this->exportexcel($data,
            array('ID','代理商机构','账号','负责人','联系电话','角色','代理区域',
                '地址','身份证号','注册时间'),
            $filename = '代理商列表');
    }

    public  function fx_daochu(){
        
        $join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";

    	$list = M("Dealers")->join($join)->where("jx_status='1' and jx_parent !='0'")->select();

        $data = array();
    foreach($list as $k=>$v){
    	if($v['juese'] == 1){
    		$v['juese'] = "超级管理员";
    	}else{
    		$v['juese'] = "普通管理员";
    	}

    	$a = M("Dealers")->where("jxid = '$v[jx_parent]'")->find()['jx_name'];
    		
        $data[$k] = array('jxid'=>$v['jxid'], 'jx_parent'=>$a,'jx_name'=>$v['jx_name'], 'username'=>$v['username'],
                       'fzr_name'=>$v['fzr_name'], 'mobile'=>$v['mobile'], 'juese'=>$v['juese'],
                       'address'=>$v['jx_pro'].$v['jx_city'].$v['jx_area'],
                       'jx_address'=>$v['jx_address'],'card'=>",".$v['card'],
                       'add_time'=>$v['add_time']);
    }
   //  dump($list);exit;
        $this->exportexcel($data,
            array('ID','代理商机构','分销商名称','账号','负责人','联系电话','角色','代理区域',
                '地址','身份证号','注册时间'),
            $filename = '分销商列表');
    }

    public function exportexcel($data=array(),$title=array(),$filename='newfile'){
    
       header("Content-Type: text/html;charset=utf-8");
            header ( "Content-type:application/vnd.ms-excel" );
            header ( "Content-Disposition:filename=".$filename.".xls" );

            $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
            <html xmlns='http://www.w3.org/1999/xhtml'>
            <head>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
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
    
























//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function fenxiao_shenhe_list(){
		//只有管理员，即权限为1的人才能查看
		if($_SESSION['piano_user']['role'] ==1){
				$where = "piano_admin.role='3' and piano_admin.juese='1' and piano_dealers.jx_status !='1'";
				
		if(IS_POST){//搜索条件
			$name = trim($_POST['name']);
				if($name){
					$where .= " and piano_dealers.jx_name='{$name}'";
					$this->assign('name',$name);
				}
			
				$username = trim($_POST['username']);
				if($username){
					$where .= " and piano_admin.username='{$username}'";
					$this->assign('username',$username);
				}
				$p = $_REQUEST['location_p'];
				$c = $_REQUEST['location_c'];
				$a = $_REQUEST['location_a'];
				if($p != '请选择'){
					if($c != '请选择'){
						if($a != '请选择'){
							$where .= " and piano_dealers.jx_area='{$a}'";
							$this->assign('a',$a);
							$this->assign('c',$c);
							$this->assign('p',$p);
						}else{
							$where .= " and piano_dealers.jx_city='{$c}'";
							$this->assign('c',$c);
							$this->assign('p',$p);
						}	
					}else{
						$where .= " and piano_dealers.jx_pro='{$p}'";
						$this->assign('p',$p);
							}
						}	
					}

				$button = $_POST['button'];
			    if(empty($name)  && empty($username) && $p=='请选择' && $c=='请选择' && $a=='请选择'){
			     		//如果是点击页码发起的请求，则按只保存的条件搜索
			     	if(!$button){
			     		if($_SESSION['agent_list_sou']){
			     				$where = $_SESSION['agent_list_sou'];
			     		}
			     	}
			    }
			     	$_SESSION['agent_list_sou'] = $where;

			
				
				$field = "piano_dealers.*,";
				$field .="piano_admin.*";
				$join = "piano_admin on piano_dealers.jxid = piano_admin.jx_jigou";
			    $data = M("Dealers")->field($field)
							        ->join($join)
									->where($where)
									->limit($Page->firstRow.','.$Page->listRows)
									->select();
		    
				foreach($data as $k=>$v){
					$data[$k]['parent_name'] = M("Dealers")->where("jxid='{$v['jx_parent']}'")->find()['jx_name'];
				}					
		}else{
			echo '无权限';exit;
		}
		 
		//dump($data);exit;
		$this->assign('data',$data);
		$this->display();
	}
    
}