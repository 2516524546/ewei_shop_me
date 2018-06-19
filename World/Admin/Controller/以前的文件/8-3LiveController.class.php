<?php 
/**
 * 直播管理
 */
namespace Admin\Controller;
use Think\Controller;
class LiveController extends CommonController {

/////////////////////////////////直播室页面/////////////////////////////////////////////////////////	

	public function show_rooms_list(){
		$status =I('status')?I('status'):0;

		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
	
	
		$count = M('Room')->where("status = '$status' and kind = '0'")
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

		$list = M('Room')->where("status = '$status' and kind = '0'")
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();
	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
		// dump($list);exit;
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function rooms_list_sou(){
		if($_SESSION['piano_user']['role'] != 1){
			echo '无权限';exit;
		}
		$status = I('status');

		$where = "status = '$status' and kind = '0'";
		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .= " and (zhubo_name like '%{$name}%' or nickname like '%$name%')";
		}
		$room_id = I('room_id');
		if($room_id){
			$this->assign('room_id',$room_id);
			$where .=" and room_id like '%{$room_id}%'";
		}
		$title_name = I('title_name');
		if($title_name){
			$this->assign('title_name',$title_name);
			$where .=" and title_name like '%{$title_name}%'";
		}

		$button = $_POST['button'];
		if(empty($name) && empty($room_id) && empty($title_name)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['rooms_list_sou']){
					$where = $_SESSION['rooms_list_sou'];
				}
			}
		}
		$_SESSION['rooms_list_sou'] = $where;


		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		
		$count = M('Room')->where($where)
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
			
		$list = M('Room')->where($where)
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();

	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
	
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_rooms_list');  
	}


























	public function show_jiaoxue_list(){
		$status =I('status')?I('status'):1;

		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		$join2 = 'piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id';
	
		$count = M('Room')->where("status = '$status' and kind = '1' and zb_kind = '1'")
					  	  ->join($join1)
					  	  ->join($join2)
					  	  ->count();
		
		
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

		$list = M('Room')->where("status = '$status' and kind = '1' and zb_kind = '1'")
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->join($join2)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();
	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']); 
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
		// dump($list);exit;
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function jiaoxue_list_sou(){
		if($_SESSION['piano_user']['role'] != 1){
			echo '无权限';exit;
		}
		$status = I('status');

		$where = "status = '$status' and kind = '1' and zb_kind = '1'";
		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .= " and (zhubo_name like '%{$name}%' or nickname like '%$name%')";
		}
		$room_id = I('room_id');
		if($room_id){
			$this->assign('room_id',$room_id);
			$where .=" and room_id like '%{$room_id}%'";
		}
		$title_name = I('title_name');
		if($title_name){
			$this->assign('title_name',$title_name);
			$where .=" and title_name like '%{$title_name}%'";
		}

		$button = $_POST['button'];
		if(empty($name) && empty($room_id) && empty($title_name)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['jiaoxue_list_sou']){
					$where = $_SESSION['jiaoxue_list_sou'];
				}
			}
		}
		$_SESSION['jiaoxue_list_sou'] = $where;


		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		$join2 = 'piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id';
		$count = M('Room')->where($where)
					  	  ->join($join1)
					  	  ->join($join2)
					  	  ->count();
		
			
		
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
			
		$list = M('Room')->where($where)
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->join($join2)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();

	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
	
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_jiaoxue_list');  
	}




















	public function show_peixun_list(){
		$status =I('status')?I('status'):0;

		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		$join2 = 'piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id';
	
		$count = M('Room')->where("status = '$status' and kind = '2' and zb_kind = '2'")
					  	  ->join($join1)
					  	  ->join($join2)
					  	  ->count();
		
		
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

		$list = M('Room')->where("status = '$status' and kind = '2' and zb_kind = '2'")
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->join($join2)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();
	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
		// dump($list);exit;
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function peixun_list_sou(){
		if($_SESSION['piano_user']['role'] != 1){
			echo '无权限';exit;
		}
		$status = I('status');

		$where = "status = '$status' and kind = '2' and zb_kind = '2'";
		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .= " and (zhubo_name like '%{$name}%' or nickname like '%$name%')";
		}
		$room_id = I('room_id');
		if($room_id){
			$this->assign('room_id',$room_id);
			$where .=" and room_id like '%{$room_id}%'";
		}
		$title_name = I('title_name');
		if($title_name){
			$this->assign('title_name',$title_name);
			$where .=" and title_name like '%{$title_name}%'";
		}

		$button = $_POST['button'];
		if(empty($name) && empty($room_id) && empty($title_name)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['peixun_list_sou']){
					$where = $_SESSION['peixun_list_sou'];
				}
			}
		}
		$_SESSION['peixun_list_sou'] = $where;


		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		$join2 = 'piano_zhubo_reg on piano_zhubo_reg.zb_id = piano_users.id';
		$count = M('Room')->where($where)
					  	  ->join($join1)
					  	  ->join($join2)
					  	  ->count();
		
			
		
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
			
		$list = M('Room')->where($where)
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
			 		 	 ->join($join2)
			 		 	 ->limit($Page->firstRow.','.$Page->listRows)
					 	 ->select();

	
		foreach ($list as $k => $v) {
			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$list[$k]['long'] = 0;
				}else{
					$list[$k]['long'] = $this->Sec2Time($time);
				}
			}else{
				$list[$k]['long'] = '未开播';
			}
		}
	
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_peixun_list');  
	}














































	public function show_rooms_xiang(){
		$id = I('id');	
		$room_id = I('room_id');

		$list = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id'")
						 ->join('piano_users on piano_users.id = piano_room.zhubo_id')
		                 ->find();

		$list['online_num'] = M('Ub_guanxi')->where("zhubo_id = '$id' and room_id = '$room_id' and in_out = '0'")
											->count();

		if($list['status'] ==1){
			$list['online_time'] = date('H:i:s',time()-$list['s_time']);
		}elseif($list['status'] ==2){
			$list['online_time'] = date('H:i:s',$list['e_time']-$list['s_time']);
		}
		
		$this->assign('list',$list);
		$this->display();

	}

	public function zhibo_tuijian(){
		$id = I('id');	
		$room_id = I('room_id');

		$a = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id'")->find();
		if($a){
			if($a['tui'] == 0){
				$b = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id'")->setField('tui',1);
			}else{
				$b = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id'")->setField('tui',0);
			}
			if($b){
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}

		}else{
			echo '查无数据';exit;
		}
	}


	public function zhibo_pinbi(){
		$id = I('id');
		$room_id = I('room_id');

		$a = M('Room')->where("zhubo_id = '$id' and room_id = '$room_id'")->order('r_id DESC')->find();
		if(!$a){
			echo '查无数据';exit;
		}
		if($a['pinbi'] == 0){
			$b = M('Room')->where("r_id = '$a[r_id]'")->setField('pinbi',1);
		}else{
			$b = M('Room')->where("r_id = '$a[r_id]'")->setField('pinbi',0);
		}

		if($b){
			echo 1;exit;
		}else{
			echo '操作失败';exit;
		}
		
	}

///////////////////////////////////预约列表页面////////////////////////////////////////////////////

	public function show_yuyue_list(){

		// $join1 = 'piano_users on piano_users.id = piano_yuyue.zhubo_id';
		$join1 = 'piano_users on piano_users.id = piano_yuyue.zhubo_id';
		$count = M('Yuyue')->where("y_status != '3' and y_part = '0'")
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

		$list = M('Yuyue')->where("y_status != '3' and y_part = '0'")
						  ->join($join1)
						  ->limit($Page->firstRow.','.$Page->listRows)
						  ->order('y_addtime DESC')
						  ->select();

	   	foreach ($list as $k => $v) {
   	    	if($v['kind'] == 2){
   	    		$list[$k]['y_time'] = M('Yuyue')->where("y_part = '$v[yid]'")->getField('y_time');
   	    	}	
   	    	if($v['role'] == 2){
   	    		$list[$k]['name'] = M('Teacher')->where("t_userid = '$v[id]'")->getField('t_truename');
   	    		$list[$k]['phone'] = M('Teacher')->where("t_userid = '$v[id]'")->getField('t_mobile');
   	    	}else{
   	    		$list[$k]['name'] = $v['nickname'];
   	    		$list[$k]['phone'] = $v['username'];
   	    	}
		}

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();

	}



	public function show_yuyue_sou(){
		$where="y_status != '3' and y_part = '0'";
		$join1 = 'piano_users on piano_users.id = piano_yuyue.zhubo_id';

		$zhubo_id = I('zhubo_id');
		if($zhubo_id){
			$this->assign('zhubo_id',$zhubo_id);
			$where .= " and y_zbid like '%{$zhubo_id}%'";
		}

		$button = $_POST['button'];
		if(empty($zhubo_id)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['show_yuyue_sou']){
					$where = $_SESSION['show_yuyue_sou'];
				}
			}
		}
		$_SESSION['show_yuyue_sou'] = $where;

		$count = M('Yuyue')->where($where)
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


   	    $list = M('Yuyue')->where($where)
   	    				  ->join($join1)
   	    				  ->limit($Page->firstRow.','.$Page->listRows)
   	    				  ->select();

   	    foreach ($list as $k => $v) {
   	    	if($v['kind'] == 2){
   	    		$list[$k]['y_time'] = M('Yuyue')->where("y_part = '$v[yid]'")->getField('y_time');
   	    	}	
   	    	if($v['role'] == 2){
   	    		$list[$k]['name'] = M('Teacher')->where("t_userid = '$v[id]'")->getField('t_truename');
   	    		$list[$k]['phone'] = M('Teacher')->where("t_userid = '$v[id]'")->getField('t_mobile');
   	    	}else{
   	    		$list[$k]['name'] = $v['nickname'];
   	    		$list[$k]['phone'] = $v['username']; 
   	    	}
		}				  

   	    $this->assign('page',$show);
   	    $this->assign('list',$list);
   	    $this->display('show_yuyue_list');

	}

	public function new_room(){
		$str = time()+rand(100,500);
		$arr = substr($str,-8);  
		if(M('Room')->where("room_id = '$room_id'")->find()){
			$arr = $this->new_room();
		}
		return $arr;
	}


	public function yuyue_shenhe(){
		$id = I('id');
		$sta = I('status');

		M('Room')->startTrans();
		if($_SESSION['piano_user']['role'] !=1){
			echo '无权限';exit;
		}
		
		$a = M('Yuyue')->where("yid = '$id'")->find();	
		$b = M('Yuyue')->where("yid = '$id'")->setField('y_status',$sta);//更改审核状态			
		$c = M('Token')->where("t_userid = '$a[zhubo_id]'")->find();
	
		if($sta ==1){

			if($a['kind'] == 2){
				$room_find = M('Yuyue')->where("y_part = '$id'")->select();

				//给培训课下的每节课都通过审核,并给他们专属房间号
				foreach ($room_find as $k => $v) {
					$roomid = $this->new_room();
					M('Yuyue')->where("yid = '$v[yid]'")->setField('y_status',1);
					M('Yuyue')->where("yid = '$v[yid]'")->setField('y_roomid',$roomid);

					$r['room_id'] = $roomid;
					$r['zhubo_name'] = M('Zhubo_reg')->where("zb_id = '$v[zhubo_id]'")
					                                 ->getField('zhubo_truename');
					$r['kind']  = $v['kind'];
					$r['s_time'] = $v['y_time'];
					$r['zhubo_id'] = $v['zhubo_id'];
					$r['title_name'] = $v['y_title_name'];
					$r['role_name'] = $v['zhubo_id'];
					$r['status'] = 0;
					$r['live_shoufei'] = $v['y_shoufei'];
					$r['video_shoufei'] = $v['y_video_shoufei'];
					$r['part'] = $v['y_part'];
					$x[$k] = M('Room')->add($r);
				}
				$content = '您的培训课直播'.$a['title_name'].'预约申请已同意';
				$title = '预约直播申请回复';

			}else{
				$room_id = $this->new_room();    //随机生成不重复字符串充过房间号
				$content = '您的show房预约申请已同意，您的直播房间号是'.$room_id;
				$title = '预约直播申请回复';

				$r['room_id'] = $room_id;
				$r['zhubo_name'] = M('Users')->where("id = '$a[zhubo_id]'")->getField('nickname');
				$r['kind']  = $a['kind'];
				$r['s_time'] = $a['y_time'];
				$r['zhubo_id'] = $a['zhubo_id'];
				$r['title_name'] = $a['y_title_name'];
				$r['role_name'] = $a['zhubo_id'];
				$r['live_shoufei'] = $a['y_shoufei'];
				$r['video_shoufei'] = $a['y_video_shoufei'];
				$r['part'] = $id;
				$r['status'] = 0;
				
				M('Room')->add($r);
				
				M('Yuyue')->where("yid = '$id'")->setField('y_roomid',$room_id);
			}
			
		}else{
			$content = '您的预约申请已被拒绝，如有疑问，请联系客服';
			$title = '预约直播申请回复';

			$room_find = M('Yuyue')->where("y_part = '$id'")->select();

			
			foreach ($room_find as $k => $v) {
				M('Yuyue')->where("yid = '$v[yid]'")->setField('y_status',2);
			}

		}	

		$data['x_userid'] = $a['zhubo_id'];
		$data['x_content'] = $content;
		$data['x_title'] = $title;
		$data['x_tuisong'] = 1;
		$data['x_time'] = date('Y-m-d H:i:s',time());
		
		if($sta ==1){
			$start_time = M('Room')->where("part = '$id'")->getField('s_time');
			$t = strtotime($start_time);  //第一场的开播时间
			$data['x_type'] = 7;

			$data['x_kid'] = $room_id?$room_id:$roomid;
			$data['x_info'] = json_encode(array('room_id'=>$room_id?$room_id:$roomid,
				                                'kind'=>$a['kind'],'yid'=>$id,'title'=>$a['y_title_name'],
				                                'time'=>$t,'y_status'=>$sta)
			                             );
		}else{
			$data['x_type'] = 7;
			$data['x_kid'] = $id;
			$data['x_info'] = json_encode(array('y_status'=>$sta,'kind'=>$a['kind'],'yid'=>$id,'title'=>$a['y_title_name']));
		}
				
		
		$d = M('User_xiaoxi')->add($data);
	
		if($c['t_shebei'] && $c['t_leixin']){
			if($c['t_leixin'] == 2){
				$this->ios_msg_send($content,$c['t_shebei']);
			}else{
				$f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$a['zhubo_id']);
			}
			
		}	

		if($b && $d){
			M('Room')->commit();
			echo 1; exit;
		}else{
			M('Room')->rollback();
			echo '消息发送失败';exit;
		}
	}


	public function show_video_list(){
		$count = M('Video')->where("v_type = '1'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

   	    $a = M('Video')->where("v_type = '1'")
   	    			   ->order('vid DESC')
   	    			   ->limit($Page->firstRow.','.$Page->listRows)
   	    			   ->join('piano_users on piano_users.id = piano_video.v_userid')
   	                   ->select();

   	                 //  dump($a);exit;
   	    $this->assign('list',$a);
   	    $this->assign('page',$show);
		$this->display();
	}

	public function video_list_sou(){
		$where = "v_type = '1'";
		$id = I('id');
		if($id){
			$this->assign('id',$id);
			$where .= " and piano_users.id like '%$id%'";
		}
		$button = $_POST['button'];
		if(empty($id)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['show_yuyue_sou']){
					$where = $_SESSION['show_yuyue_sou'];
				}
			}
		}
		$_SESSION['show_yuyue_sou'] = $where;
		$join = 'piano_users on piano_users.id = piano_video.v_userid';

		$count = M('Video')->where($where)->join($join)->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

   	    $a = M('Video')->where($where)
   	    			   ->order('vid DESC')
   	    			   ->limit($Page->firstRow.','.$Page->listRows)
   	    			   ->join($join)
   	                   ->select();

   	                 //  dump($a);exit;
   	    $this->assign('list',$a);
   	    $this->assign('page',$show);
		$this->display('show_video_list');

	}

	public function del_video(){
		$id = I('id');
		$a = M('Video')->where("vid = '$id'")->delete();
		if($a){
			echo 1;exit;
		}else{
			echo '删除失败';exit;
		}
	}



	public function room_daochu(){  //暂时导出已结束了的直播
		$status = I('time_status');
		$stime = I('stime');
		$etime = I('etime');
		$kind = I('kind')?I('kind'):0;
		
		$where = "status = '$status' and kind = '$kind'";
		$join1 = 'piano_users on piano_users.id = piano_room.zhubo_id';
		if($stime){
			$month1 = date('Y-m-d 00:00:00', strtotime($stime));
			$where .=" and s_time >= '$month1'";
		}else{
			echo '请选择起始时间';exit;
		}
		if($etime){
			$month2 = date('Y-m-d 23:59:59', strtotime($etime));
			$where .=" and s_time < '$month2'";
		}else{
			echo '请选择结束时间';exit;
		}
		
		$list = M('Room')->where($where)
			 		 	 ->order('s_time DESC')
			 		 	 ->join($join1)
					 	 ->select();

		//dump($list);exit;
		foreach ($list as $k => $v){

			if($v['status'] == 2){
				$time = strtotime($v['e_time'])-strtotime($v['s_time']);
				
				if($time < 0){
					$v['long'] = 0;
				}else{
					$v['long'] = $this->Sec2Time($time);
				}
			}elseif($v['status'] == 1){
				$time = time()-strtotime($v['s_time']);
				
				if($time < 0){
					$v['long'] = 0;
				}else{
					$v['long'] = $this->Sec2Time($time);
				}
			}else{
				$v['long'] = '未开播';
			}
		

			if($v['role'] == 1){
				$v['role'] = '学生';
			}elseif($v['role'] == 2){
				$v['role'] = '老师';
			}else{
				$v['role'] = '普通用户';
			}//身份

			if($v['kind'] ==0){
				$v['kind'] = 'show房';
				$v['zhubo_name'] = $v['nickname'];
			}elseif($v['kind'] ==1){
				$v['kind'] = '教学课程';
			}else{
				$v['kind'] = '培训课程';
			}

			if(!$v['zhubo_name']){
				$v['zhubo_name'] = $v['nickname'];
			}

			$data[$k] = array('id'=>$v['id'],'zhubo_name'=>$v['zhubo_name'],'sex'=>$v['sex'],
				              'username'=>$v['username'],'role'=>$v['role'],
				              'title_name'=>$v['title_name'],'room_id'=>$v['room_id'],'s_time'=>$v['s_time'],
				              'kind'=>$v['kind'],'total_num'=>$v['total_num'],
				              'total_money'=>$v['total_money'],'long'=>$v['long']);

			
		}

		if($status == 0){
			$today = '未开播列表'.date('Y-m-d',time());
		}elseif($status == 1){
			$today = '正在直播列表'.date('Y-m-d',time());
		}else{
			$today = '直播已结束列表'.date('Y-m-d',time());
		}

		$title = array('用户ID','姓名','性别','手机号','身份','直播标题','房间号','开播时间','直播种类',
			           '历史人数','直播收入','直播时长');
        $this->exportexcel($data,$title,$filename = $today);
        // echo 1;exit;
	} 	

	
	public function show_rz_zhubo(){
		$status = I('status');
		$this->assign('status',$status);

		if($status == 1){
			$where = "zbrz_status != '4'";
		}elseif($status == 2){
			$where = "zbrz_status = '1'";
		}elseif($status == 3){
			$where = "zbrz_status = '2'";
		}else{
			$where = "zbrz_status = '3'";
		}

		$count = M('Zhubo_reg')->where($where)->count();
					  	 
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

		$list = M('Zhubo_reg')->order('reg_id DESC')
			 		          ->limit($Page->firstRow.','.$Page->listRows)
			 		          ->where($where)
					 	      ->select();

		foreach ($list as $k => $v) {
			$list[$k]['role'] = M('Users')->where("id = '$v[zb_id]'")->getField('role');
			$list[$k]['jx_name'] = M('Dealers')->where("jxid = '$v[r_zbid]'")->getField('jx_name');
		}

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}


	public function renzheng_zhubo(){
		$id = I('zhubo_id');
		$kind = I('kind');
		$status = I('status');

		$a = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->setField('zbrz_status',$status);
		//给用户发消息
		$e = M('Token')->where("t_userid = '$id'")->find();
		
		if($status == 2){
			if($kind == 1){
				$content = "恭喜您,您的教学直播资格申请已通过审核";
			}else{
				$content = "恭喜您,您的培训直播资格申请已通过审核";
			}
			
		}elseif($status == 3){
			if($kind == 1){
				$content = "很遗憾,后台拒绝了您的教学直播资格";
			}else{
				$content = "很遗憾,后台拒绝了您的培训直播资格";
			}
			
		}	
		
		if($e['t_shebei'] && $e['t_leixin']){
			if($e['t_leixin'] == 2){
				$this->ios_msg_send($content,$e['t_shebei']);
			}else{
				$this->message_tuisong($content,$e['t_shebei'],$e['t_leixin'],$id);
			}
			
			
		}
		

		$list['x_userid'] = $id;
		$list['x_content'] = $content;
		$list['x_tuisong'] = 1;
		$list['x_time'] = date('Y-m-d H:i:s',time());
		$list['x_status'] = 1;
		$list['x_type'] = 8;
		$list['x_info'] = json_encode(array('kind'=>$kind));
		$list['x_title'] = '后台审核直播老师通知';
		M('User_xiaoxi')->add($list);
		
		if($status == 2){
			$b = M('Zhubo_reg')->where("zb_id = '$id' and zb_kind = '$kind'")->find();
			$c = M('Users')->where("id = '$id'")->find();
			if($c && $c['role'] !=2){
				M('Users')->where("id = '$id'")->setField('role',2);
			}

			$d = M('Teacher')->where("t_userid = '$id'")->find();
			//主播审核通过，就自动把他（她）变成老师
			if(!$d){
				$data['t_userid'] = $id;
				$data['t_truename'] = $b['zhubo_truename'];
				$data['t_mobile'] = $b['zhubo_phone'];
				$data['t_license'] = $b['zb_zhizhao'];
				$data['t_card_img1'] = $b['zb_cardimg1'];
				$data['t_card_img2'] = $b['zb_cardimg2'];
				$data['t_jxid'] = $b['r_zbid'];
				$data['t_status'] = 2;
				$data['t_addtime'] = date('Y-m-d H:i:s',time());
				$data['t_caozuo'] = $_SESSION['piano_users']['aid'];
				$data['t_caozuo_time'] = date('Y-m-d H:i:s',time());
			
				M('Teacher')->add($data);

			}else{
				if($d['status'] != 2){
					M('Teacher')->where("t_userid = '$id'")->setField('status',2);
				}	
			}
			
		}


		if($a){
			if($status == 2){
				echo 1;exit;
			}elseif($status == 3){
				echo 2;exit;
			}
			
		}else{
			echo '修改失败';exit;
		}
	}

	public function feng(){
		$id = I('id');
		// echo $id;exit;
		$a = M('Zhubo_reg')->where("zb_id = '$id'")->getField('acc_on');
		if($a == 0){
			$b = M('Zhubo_reg')->where("zb_id = '$id'")->setField('acc_on',1);
		}else{
			$b = M('Zhubo_reg')->where("zb_id = '$id'")->setField('acc_on',0);
		}

		if($b){
			echo 1;exit;
		}else{
			echo '修改失败';exit;
		}
	}


	public function zhubo_rz_sou(){

		$status = I('status');
		$this->assign('status',$status);

		if($status == 1){
			$where = "zbrz_status != '4'";
		}elseif($status == 2){
			$where = "zbrz_status = '1'";
		}elseif($status == 3){
			$where = "zbrz_status = '2'";
		}else{
			$where = "zbrz_status = '3'";
		}


		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .= " and zhubo_truename like '%$name%'";
		}

		$hao = I('hao');
		if($hao){
			$this->assign('hao',$hao);
			$where .= " and zhubo_phone like '%$hao%'";
		}

		$kind = I('kind');
		if($kind){
			$this->assign('kind',$kind);
			$where .= "and zb_kind = '$kind'";
		}
		

		$button = $_POST['button'];
		if(empty($hao) && empty($name) && empty($kind)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['zhubo_rz_sou']){
					$where = $_SESSION['zhubo_rz_sou'];
				}
			}
		}
		$_SESSION['zhubo_rz_sou'] = $where;
		

		$count = M('Zhubo_reg')->where($where)->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

   	    $a = M('Zhubo_reg')->where($where)
   	    			       ->order('reg_id DESC')
   	    			       ->limit($Page->firstRow.','.$Page->listRows)
   	                       ->select();

   	    foreach ($a as $k => $v) {
   	        if($v['r_zbid']){
   	        	$a[$k]['role'] = M('Users')->where("id = '$v[zb_id]'")->getField('role');
   	        	$a[$k]['jx_name'] = M('Dealers')->where("jxid = '$v[r_zbid]'")->getField('jx_name');
   	        }
   	    }           

   	    $this->assign('list',$a);
   	    $this->assign('page',$show);
		$this->display('show_rz_zhubo');
	}



	public function show_dealers_list(){
		$status = I('status');
		$this->assign('status',$status);

		if($status == 1){
			$where = "jx_zhiboid != '4'";
		}elseif($status == 2){
			$where = "jx_zhiboid = '1'";
		}elseif($status == 3){
			$where = "jx_zhiboid = '3'";
		}else{
			$where = "jx_zhiboid = '2'";
		}

		// $where = "jx_zhiboid != '3' and jx_zhiboid != '4'";

		$count = M('Dealers')->where($where)->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)


		$a = M('Dealers')->where($where)
		                 ->limit($Page->firstRow.','.$Page->listRows)
		                 ->order('jxid DESC')
		                 ->select();

		$this->assign('page',$show);
		$this->assign('list',$a);
		$this->display();
	}


	public function dealers_rz_sou(){
		$status = I('status');
		$this->assign('status',$status);

		if($status == 1){
			$where = "jx_zhiboid != '4'";
		}elseif($status == 2){
			$where = "jx_zhiboid = '1'";
		}elseif($status == 3){
			$where = "jx_zhiboid = '3'";
		}else{
			$where = "jx_zhiboid = '2'";
		}


		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .= " and jx_name like '%$name%'";
		}

		$hao = I('hao');
		if($hao){
			$this->assign('hao',$hao);
			$where .= " and jx_phone like '%$hao%'";
		}
		$button = $_POST['button'];
		if(empty($hao) && empty($name)){
		//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['dealers_rz_sou']){
					$where = $_SESSION['dealers_rz_sou'];
				}
			}
		}
		$_SESSION['dealers_rz_sou'] = $where;
		
		
		$count = M('Dealers')->where($where)->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
   	    //设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)


		$a = M('Dealers')->where($where)
		                 ->limit($Page->firstRow.','.$Page->listRows)
		                 ->order('jxid DESC')
		                 ->select();


   	    $this->assign('list',$a);
   	    $this->assign('page',$show);
		$this->display('show_dealers_list');
	}


	

	public function rz_dealers(){
		$id = I('jxid');
		$type = I('type');

		$a = M('Dealers')->where("jxid = '$id'")->setField('jx_zhiboid',$type);
		if($a){
			if($type == 3){
				echo 1;exit;
			}else{
				echo 2;exit;
			}
			
		}else{
			echo '修改失败';exit;
		}
		
	}

















}	