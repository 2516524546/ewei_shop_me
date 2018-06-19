<?php 
/**
 * 论坛管理
 */
namespace Admin\Controller;
use Think\Controller;
class LuntanController extends CommonController {

	public function show_tiezi_list(){
			
		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where("l_type = '1'")->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where("l_type = '1'")
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['pin'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}


	public function show_shipin_list(){
		
		
		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where("l_type = '2'")->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where("l_type = '2'")
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['pin'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function show_tiezi_add(){
		$this->display();
	}

	public function tiezi_add(){
		$img1 = I('pdf');
		$img2 = I('yinping');
		$img3 = I('img3');
		$img4 = I('img4');
		$img5 = I('img5');
		$img6 = I('img6');
		$data['img'] = $img1.','.$img2.','.$img3.','.$img4.','.$img5.','.$img6;
		$data['l_type'] = 1;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		$data['l_userid'] = '后台';
		$data['l_addtime'] = date('Y-m-d H:i:s',time());

		$a = M('Luntan')->add($data);
		if($a){
			echo 1;exit;
		}else{
			echo '添加失败';exit;
		}
	}

	public function show_shipin_add(){
		$this->display();
	}

	public function shipin_add(){
		$data['l_type'] = 2;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		$data['l_userid'] = '后台';
		$data['l_addtime'] = date('Y-m-d H:i:s',time());
		$data['l_video'] = I('pdf');
		$data['l_photo'] = I('yinping');

		$a = M('Luntan')->add($data);
		if($a){
			echo 1;exit;
		}else{
			echo '添加失败';exit;
		}
	}	

	public function show_huodong_add(){
		$this->display();
	}

	public function huodong_add(){
		$img1 = I('pdf');
		$img2 = I('yinping');
		$img3 = I('img3');
		$img4 = I('img4');
		$img5 = I('img5');
		$img6 = I('img6');
		$data['img'] = $img1.','.$img2.','.$img3.','.$img4.','.$img5.','.$img6;
		$data['l_type'] = 1;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		$data['l_wadr'] = I('adress');
		$data['l_wtime'] = I('stime');
		$data['l_userid'] = '后台';
		$data['l_addtime'] = date('Y-m-d H:i:s',time());

		$a = M('Luntan')->add($data);
		if($a){
			echo 1;exit;
		}else{
			echo '添加失败';exit;
		}
	}

	public function upload_img(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','mp4','rvmb','wmv','avi','mpeg','mov');
			// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/tiezi/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
			//var_dump($info);exit;
			if(!$info) {// 上传错误提示错误信息
				echo $upload->getError();exit;
	
			}else{// 上传成功 获取上传文件信息
				$file_name= $upload->rootPath.$info['savepath'].$info['savename'];
					
				$image = new \Think\Image(); 
				$image->open($file_name);
				$image->thumb(200, 200)->save($file_name);	
				echo $file_name;exit;
					
			}
		}else{
			echo 1;exit;
		}
		}else{
			echo 1;exit;
		}
	
	}

	public function show_huodong_list(){
		$time = date('Y-m-d H:i:s',time());
		$where = "l_type = '3' and l_wtime > '$time'";
	
		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();


		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();


		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['pin'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();

			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');

			if($v['role'] == 2){
				$list[$k]['jxid'] = M('Teacher')->where("t_userid = '$v[id]'")->getField('t_jxid');
			}
		}
	
		$status = 0;
		$this->assign('status',$status);

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}



	public function show_huodong_list1(){
		$time = date('Y-m-d H:i:s',time());
		$where = "l_type = '3' and l_wtime <= '$time' and l_etime > '$time'";
		
		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');
		}

		$status = 1;
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}

	public function show_huodong_list2(){
		$time = date('Y-m-d H:i:s',time());
		$where = "l_type = '3' and l_etime <= '$time'";
		
		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();


		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');
			$list[$k]['end'] = 1;
		}

		$status = 2;
		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}


	public function tiezi_list_sou(){
		$where ="l_type = '1'";
		$name = I('name');

		if($name){
			$this->assign('name',$name);
			$where .=" and nickname like '%{$name}%'";
		}
		$stime = I('stime');
		if($stime){
			$this->assign('stime',$stime);
			$where .=" and l_addtime >= '$stime'";
		}
		$etime = I('etime');
		if($etime){
			$this->assign('etime',$etime);
			$where .=" and l_addtime <= '$etime'";
		}

		$order = I('order');
		if($order){
			$this->assign('order',$order);
			if($order == 1){
				$where .=" and l_tuijian = '2'";
			}elseif($order == 2){
				$where .=" and l_jinhua = '2'";
			}elseif($order == 3){
				$where .=" and l_new = '2'";
			}elseif($order == 4){
				$where .= " and l_pinbi = '2'";
			}
		}

		$button = $_POST['button'];
		if(empty($name)  && empty($stime) && empty($etime) && empty($order)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['tiezi_list_sou']){
					$where = $_SESSION['tiezi_list_sou'];
				}
			}
		}
		$_SESSION['tiezi_list_sou'] = $where;



		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['pin'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_tiezi_list');

	}

	public function shipin_list_sou(){
		$where ="l_type = '2'";
		$name = I('name');

		if($name){
			$this->assign('name',$name);
			$where .=" and nickname like '%{$name}%'";
		}
		$stime = I('stime');
		if($stime){
			$this->assign('stime',$stime);
			$where .=" and l_addtime >= '$stime'";
		}
		$etime = I('etime');
		if($etime){
			$this->assign('etime',$etime);
			$where .=" and l_addtime <= '$etime'";
		}
		$order = I('order');
		if($order){
			$this->assign('order',$order);
			if($order == 1){
				$where .= " and l_pinbi = '2'";
			}
		}

		$button = $_POST['button'];
		if(empty($name)  && empty($stime) && empty($etime) && empty($order)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['shipin_list_sou']){
					$where = $_SESSION['shipin_list_sou'];
				}
			}
		}
		$_SESSION['shipin_list_sou'] = $where;


		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['pin'] = M('Reply')->where("retz_id = '$v[tiezi_id]'")->count();
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_shipin_list');

	}

	public function huodong_list_sou(){
		$where ="l_type = '3'";

		$status = 0;
		$this->assign('status',$status);

		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .=" and nickname like '%{$name}%'";
		}
		$stime = I('stime');
		if($stime){
			$this->assign('stime',$stime);
			$where .=" and l_addtime >= '$stime'";
		}
		$etime = I('etime');
		if($etime){
			$this->assign('etime',$etime);
			$where .=" and l_addtime <= '$etime'";
		}
		$order = I('order');
		if($order){
			$this->assign('order',$order);
			if($order == 1){
				$where .= " and l_pinbi = '2'";
			}
		}

		$button = $_POST['button'];
		if(empty($name)  && empty($stime) && empty($etime) && empty($order)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['huodong_list_sou']){
					$where = $_SESSION['huodong_list_sou'];
				}
			}
		}
		$_SESSION['huodong_list_sou'] = $where;



		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_huodong_list');

	}

	public function huodong_list_sou1(){
		$where ="l_type = '3'";

		$status = 1;
		$this->assign('status',$status);

		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .=" and nickname like '%{$name}%'";
		}
		$stime = I('stime');
		if($stime){
			$this->assign('stime',$stime);
			$where .=" and l_addtime >= '$stime'";
		}
		$etime = I('etime');
		if($etime){
			$this->assign('etime',$etime);
			$where .=" and l_addtime <= '$etime'";
		}
		$order = I('order');
		if($order){
			$this->assign('order',$order);
			if($order == 1){
				$where = " and l_pinbi = '2'";
			}
		}

		$button = $_POST['button'];
		if(empty($name)  && empty($stime) && empty($etime) && empty($order)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['huodong_list_sou1']){
					$where = $_SESSION['huodong_list_sou1'];
				}
			}
		}
		$_SESSION['huodong_list_sou1'] = $where;



		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');
		}


		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_huodong_list1');

	}

	public function huodong_list_sou2(){
		$where ="l_type = '3'";

		$status = 2;
		$this->assign('status',$status);

		$name = I('name');
		if($name){
			$this->assign('name',$name);
			$where .=" and nickname like '%{$name}%'";
		}
		$stime = I('stime');
		if($stime){
			$this->assign('stime',$stime);
			$where .=" and l_addtime >= '$stime'";
		}
		$etime = I('etime');
		if($etime){
			$this->assign('etime',$etime);
			$where .=" and l_addtime <= '$etime'";
		}
		$order = I('order');
		if($order){
			$this->assign('order',$order);
			if($order == 1){
				$where = " and l_pinbi = '2'";
			}
		}

		$button = $_POST['button'];
		if(empty($name)  && empty($stime) && empty($etime) && empty($order)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['huodong_list_sou2']){
					$where = $_SESSION['huodong_list_sou2'];
				}
			}
		}
		$_SESSION['huodong_list_sou2'] = $where;



		$join = 'piano_users on piano_users.id = piano_luntan.l_userid';
		$count = M('Luntan')->where($where)->join($join)->count();

				//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    
		$list = M('Luntan')->join($join)
						   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('l_addtime DESC')
		                   ->select();

		foreach ($list as $k => $v) {
			$list[$k]['zan'] = M('Ltguanxi')->where("tz_id = '$v[tiezi_id]' and lg_zan = '2'")->count();
			$list[$k]['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');
		}

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('show_huodong_list2');

	}

//查看帖子详情
	public function luntan_xiang(){
		$id = I('id');

		$join= 'piano_users on piano_users.id = piano_luntan.l_userid';
		$list = M('Luntan')->where("tiezi_id = '$id'")->join($join)->find();
		if($list['l_img']){
			$list['l_img'] = explode(',',$list['l_img']);
		}
		

		$count = M('Baoming')->where("bm_tzid = '$id'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

		
		$info = M('Baoming')->where("bm_tzid = '$id'")
							->order('bm_time DESC')
							->limit($Page->firstRow.','.$Page->listRows)
							->select();

		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->assign('info',$info);
		$this->display();
	}

//查看帖子详情
	public function tiezi_xiang(){
	
		$id = I('id');
		$join= 'piano_users on piano_users.id = piano_luntan.l_userid';
		$list = M('Luntan')->where("tiezi_id = '$id'")->join($join)->find();
		if($list['l_img']){
			$list['l_img'] = explode(',',$list['l_img']);
		}
		 //dump($list['l_img']);exit;
		$count = M('Reply')->where("retz_id = '$id' and re_fen = '1'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   	    // echo $count;exit;

		$info = M('Reply')->where("retz_id = '$id' and re_fen = '1'")
						  ->order('re_time')
						  ->limit($Page->firstRow.','.$Page->listRows)
						  ->join('piano_users on piano_users.id = piano_reply.re_userid')
		                  ->select();
		        
		foreach($info as $k => $v){
			if($v['re_duixiang'] ==1){
				$b = M('Reply')->join('piano_luntan on piano_luntan.tiezi_id = piano_reply.retz_id')
							   ->join('piano_users on piano_users.id = piano_luntan.l_userid')
							   ->where("retz_id = '$id'")
							   ->find();

				$info[$k]['re_nickname'] = $b['nickname'];
			}else{
				$b = M('Reply')->where("retz_id = '$id'")
						       ->join('piano_users on piano_users.id = piano_reply.re_receiveid')
						       ->find();

				$info[$k]['re_nickname'] = $b['nickname'];
			}
		}
		
		$this->assign('page',$show);
		$this->assign('info',$info);
		$this->assign('list',$list);
		$this->display();
	}

	public function show_tiezi_save(){
		$id = I('id');
		$join= 'piano_users on piano_users.id = piano_luntan.l_userid';
		$list = M('Luntan')->where("tiezi_id = '$id'")->join($join)->find();
		$list['l_img'] = explode(',',$list['l_img']);

		$count = M('Reply')->where("retz_id = '$id'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)


		$info = M('Reply')->where("retz_id = '$id'")
						  ->order('re_time')
						  ->limit($Page->firstRow.','.$Page->listRows)
						  ->join('piano_users on piano_users.id = piano_reply.re_userid')
		                  ->select();
		foreach($info as $k => $v){

			if($v['re_duixiang'] ==1){
				$b = M('Reply')->join('piano_luntan on piano_luntan.tiezi_id = piano_reply.retz_id')
				               ->join('piano_users on piano_users.id = piano_luntan.l_userid')
							   ->where("retz_id = '$id'")
							   ->find();

				$info[$k]['re_nickname'] = $b['nickname'];
			}else{
				$b = M('Reply')->where("retz_id = '$id'")
						       ->join('piano_users on piano_users.id = piano_reply.re_receiveid')
						       ->find();
				$info[$k]['re_nickname'] = $b['nickname'];
			}
		}

		$this->assign('page',$show);
		$this->assign('info',$info);
		$this->assign('list',$list);
		$this->display();
	}

	public function tiezi_save(){

		$id = I('id');
		$img1 = I('pdf');
		$img2 = I('yinping');
		$img3 = I('img3');
		$img4 = I('img4');
		$img5 = I('img5');
		$img6 = I('img6');
		if($img1){
			$data['img'] = $img1.','.$img2.','.$img3.','.$img4.','.$img5.','.$img6;
		}
		$data['l_type'] = 1;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		
		$a = M('Luntan')->where("tiezi_id = '$id'")->save($data);
		
		if($a){
			echo 1;exit;
		}else{
			echo '修改失败';exit;
		}
	}

	public function show_huodong_save(){
		$id = I('id');
		$join= 'piano_users on piano_users.id = piano_luntan.l_userid';
		$list = M('Luntan')->where("tiezi_id = '$id'")->join($join)->find();
		$list['l_img'] = explode(',',$list['l_img']);

		$count = M('Reply')->where("retz_id = '$id'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)		

		$info = M('Baoming')->where("bm_tzid = '$id'")
							->limit($Page->firstRow.','.$Page->listRows)
							->order('bm_time DESC')
		                    ->select();

		$this->assign('list',$list);
		$this->assign('page',$shwo);
		$this->assign('info',$info);
		$this->display();
	}

	public function huodong_save(){
		$id = I('id');
		$img1 = I('pdf');
		$img2 = I('yinping');
		$img3 = I('img3');
		$img4 = I('img4');
		$img5 = I('img5');
		$img6 = I('img6');
		$data['img'] = $img1.','.$img2.','.$img3.','.$img4.','.$img5.','.$img6;
		$data['l_type'] = 3;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		$data['l_wtime'] = I('stime');
		$data['l_wadr'] = I('adress');

		$a = M('Luntan')->where("tiezi_id = '$id'")->save($data);
		if($a){
			echo 1;exit;
		}else{
			echo '修改失败';exit;
		}


	}



	public function show_shipin_save(){
		$id = I('id');
		$join= 'piano_users on piano_users.id = piano_luntan.l_userid';
		$list = M('Luntan')->where("tiezi_id = '$id'")->join($join)->find();

		
		$count = M('Reply')->where("retz_id = '$id'")->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)


		$info = M('Reply')->where("retz_id = '$id'")
						  ->order('re_time')
						  ->limit($Page->firstRow.','.$Page->listRows)
						  ->join('piano_users on piano_users.id = piano_reply.re_userid')
		                  ->select();

		foreach($info as $k => $v){

			if($v['re_duixiang'] ==1){
				$b = M('Reply')->join('piano_luntan on piano_luntan.tiezi_id = piano_reply.retz_id')
				               ->join('piano_users on piano_users.id = piano_luntan.l_userid')
							   ->where("retz_id = '$id'")
							   ->find();

				$info[$k]['re_nickname'] = $b['nickname'];
			}else{
				$b = M('Reply')->where("retz_id = '$id'")
						       ->join('piano_users on piano_users.id = piano_reply.re_receiveid')
						       ->find();
				$info[$k]['re_nickname'] = $b['nickname'];
			}
		}

		$this->assign('page',$show);
		$this->assign('info',$info);
		$this->assign('list',$list);
		$this->display();
	}

	public function shipin_save(){

		$id = I('id');

		$data['l_type'] = 2;
		$data['l_title'] = I('title');
		$data['l_content'] = I('text');
		$data['l_photo'] = I('photo');
		$data['l_video'] = I('video');
		
		$a = M('Luntan')->where("tiezi_id = '$id'")->save($data);
		
		if($a){
			echo 1;exit;
		}else{
			echo '修改失败';exit;
		}
	}


//推荐，精华，创新等
	public function luntan_tuijian(){
		$id = I('id');
		$a = M('Luntan')->where("tiezi_id = '$id'")->find();

		if($a['l_tuijian'] == 1){
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_tuijian',2);
			M('Users')->where("id = '$a[l_userid]'")->setInc('score',3);
		}else{
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_tuijian',1);
			M('Users')->where("id = '$a[l_userid]'")->setDec('score',3);
		}

		if($b){
			echo 1;exit;
		}else{
			echo "操作失败，请联系管理员";exit;
		}	
	}


	public function luntan_jinhua(){
		$id = I('id');
		$a = M('Luntan')->where("tiezi_id = '$id'")->find();

		if($a['l_jinhua'] == 1){
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_jinhua',2);
			M('Users')->where("id = '$a[l_userid]'")->setInc('score',10);
		}else{
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_jinhua',1);
			M('Users')->where("id = '$a[l_userid]'")->setDec('score',10);
		}

		if($b){
			echo 1;exit;
		}else{
			echo "操作失败，请联系管理员";exit;
		}	
	}

	public function luntan_new(){
		$id = I('id');
		$a = M('Luntan')->where("tiezi_id = '$id'")->find();

		if($a['l_new'] == 1){
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_new',2);
			M('Users')->where("id = '$a[l_userid]'")->setInc('score',10);
		}else{
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_new',1);
			M('Users')->where("id = '$a[l_userid]'")->setDec('score',10);
		}

		if($b){
			echo 1;exit;
		}else{
			echo "操作失败，请联系管理员";exit;
		}	
	}
/////////////////////删贴///////////////////////////////////////////////////////////
	public function del_luntan(){

		$id = I('id');
		$a = M('Luntan')->where("tiezi_id = '$id'")->find();

		if($a){
			$b = M('Luntan')->where("tiezi_id = '$id'")->delete();
			if($b){
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员';exit;
			}
		}else{
			echo "查无数据";exit;
		}

	}
//帖子屏蔽
	public function pinbi_tiezi(){
		$id = I('id');
		$a = M('Luntan')->where("tiezi_id = '$id'")->find();

		if($a['l_pinbi'] == 1){
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_pinbi',2);
		}else{
			$b = M('Luntan')->where("tiezi_id = '$id'")->setField('l_pinbi',1);
		}

		if($b){
			echo 1;exit;
		}else{
			echo "操作失败，请联系管理员";exit;
		}	
	}

//回复屏蔽
	public function reply_pinbi(){
		$id = I('id');
	
		//var_dump($_POST);exit;
		$a = M('Reply')->where("re_id = '$id'")->delete();
	
		if($a){
			echo 1;exit;
		}else{
			echo "操作失败，请联系管理员";exit;
		}

	}

	public function show_msg_add(){
		$id = I('id');
		$this->assign('id',$id);
		$this->display();
	}



	public function add_msg(){


		$id = I('id');
		$data['x_kid'] = $id;    //帖子id
		$data['x_title'] = I('title');
		$data['x_content'] = I('text');
		$data['x_time'] = date('Y-m-d H:i:s',time());
		$data['x_type'] = 4;
		$kind = I('kind');
		
		if($kind == 1){
			$data['x_tuisong'] = $_SESSION['piano_user']['role'];   //推送方id
			$data['x_userid'] = '0';
			$c = M('User_xiaoxi')->add($data);

			$sendno = $_SESSION['piano_user']['aid'];
			$title = $data['x_title'];
			$content = $data['x_content'];
			$b = $this->send_msg($sendno,$title,$content);   //给全部在线人发消息
			
		}else{
			$user = M('Baoming')->where("bm_tzid = '$id'")->select();

			foreach ($user as $k => $v) {  //分部给报名的人发消息
				$data['x_userid'] = $v['bm_userid'];    //接收报名方id
				$data['x_tuisong'] = $_SESSION['piano_user']['aid'];  //推送方id
				$c = M('User_xiaoxi')->add($data);

				$a ='';
				$a = M('Token')->where("t_userid = '$v[bm_userid]'")->find();
				// var_dump($a);
				if($a['t_shebei'] && $a['t_leixin']){
					if($a['t_leixin'] == 2){
						$this->message_tuisong($data['x_content'],$a['t_shebei'],
						                        $a['t_leixin'],$v['bm_userid']);
					}else{
						$b[$k] = $this->message_tuisong($data['x_content'],$a['t_shebei'],
						                        $a['t_leixin'],$v['bm_userid']);
					}
					
					
				}//给报名用户发消息
			}
			// var_dump($b);exit;
			
		}
		
		if($c){
			echo 1;exit;
		}else{
			echo '消息添加失败';exit;
		}
	}

	public function show_msg_list(){
		$id = I('id');
		$count = M('User_xiaoxi')->where("x_type = '4' and x_kid = '$id'")->group('x_time')->count();
		//实例化分页类
   	    $Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
   	    $Page->setConfig('prev', '上一页');
   	    $Page->setConfig('next', '下一页');
   	    $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
   	    //显示分页信息
   	    $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

		$a = M('User_xiaoxi')->where("x_type = '4' and x_kid = '$id'")
							 ->limit($Page->firstRow.','.$Page->listRows)
							 ->group('x_time')
							 ->select();
		$this->assign('page',$show);
		$this->assign('list',$a);
		$this->display();
	}



	public function huodong_daochu(){
		$stime = I('stime');
		$etime = I('etime');
		$now = date('Y-m-d H:i:s',time());
		$stime = date('Y-m-d 00:00:00',strtotime($stime));
		$etime = date('Y-m-d 23:59:59',strtotime($etime));

      	$a = M('Luntan')->where("l_wtime >= '$stime' and l_wtime < '$etime' and l_etime <= '$now'")
                        ->join('piano_users on piano_users.id = piano_luntan.l_userid')
                        ->order('l_etime DESC')
                        ->select();
                          

        foreach ($a as $k=>$v){
            $v['zan_num'] = M('Ltguanxi')->where("lg_zan = '2' and tz_id = '$v[tiezi_id]'")->count();
            $v['join_num'] = M('Baoming')->where("bm_tzid = '$v[tiezi_id]'")->sum('bm_num');


            $data[$k] = array('1'=>$v['id'],'2'=>$v['nickname'],'3'=>$v['l_title'],'4'=>$v['l_wtime'],
            	              '5'=>$v['l_etime'],'6'=>$v['l_wadr'],'7'=>$v['l_history_num'],
            	              '8'=>$v['zan_num'],'9'=>$v['join_num']);
        }

        // dump($a);exit;

        $today = '活动列表'.date('Y-m-d',time());
        $title = array('发贴人ID','发贴人','标题','开始时间','结束时间','活动地点','人气','点赞数','参与人数');
        $this->exportexcel($data,$title,$filename = $today);



    }









}