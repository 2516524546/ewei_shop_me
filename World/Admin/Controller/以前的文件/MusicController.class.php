<?php
/*基础乐理--课程管理
 * */
namespace Admin\Controller;
use Think\Controller;
class MusicController extends CommonController {
	//题目列表
	public function timu_list(){
		$pages = M("Set")->getField('page');
		$ids = M("Set")->getField('id');
		$status = $_REQUEST['status']?$_REQUEST['status']:1;
		
		$count = M("Pblx")->where("lianxi='{$status}'")->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("Pblx")->where("lianxi='{$status}'")->order('pid DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($list as $k=>$v){
			$data[$k]['pid'] = $v['pid'];
			$data[$k]['fname'] = $v['fname'];
			$data[$k]['nandu'] = $v['nandu'];
			$data[$k]['url'] = $v['file_url'];
			if($v['pubiao'] == 1){
				$data[$k]['pubiao'] = '高音谱表';
			}else if($v['pubiao'] == 2){
				$data[$k]['pubiao'] = '低音谱表';
			}else if($v['pubiao'] == 3){
				$data[$k]['pubiao'] = '大谱表';
			}


			// if($v['lianxi']==4){
			// 	if($v['yinfu']==1){
			// 			$data[$k]['yinfu'] = '单音--黑键';
			// 		}else if($v['yinfu']==2){
			// 			$data[$k]['yinfu'] = '单音--白键';
			// 		}else if($v['yinfu']==3){
			// 			$data[$k]['yinfu'] = '双音--旋律音程';
			// 		}else if($v['yinfu']==4){
			// 			$data[$k]['yinfu'] = '双音--和声音程';
			// 		}else if($v['yinfu']==5){
			// 			$data[$k]['yinfu'] = '三和弦';
			// 		}else if($v['yinfu']==6){
			// 			$data[$k]['yinfu'] = '七和弦';
			// 	}
			// }elseif($v['lianxi'] != 4){
				if($v['yinfu']==1){
					$data[$k]['yinfu'] = '单音';
				}else if($v['yinfu']==3){
					$data[$k]['yinfu'] = '音程';
				}
				else if($v['yinfu']==5){
					$data[$k]['yinfu'] = '三和弦';
				}elseif($v['yinfu']==6){
					$data[$k]['yinfu'] = '七和弦';
				}
			//}
			
			//音域：A2-B2，C1-B1，C-B,c-b,c1-b1,c2-b2,c3-b3,c4-b4,c5
			if($v['yinyu']==1){
				$data[$k]['yinyu'] = 'A2-B2';
			}else if($v['yinyu']==2){
				$data[$k]['yinyu'] = 'C1-B1';
			}else if($v['yinyu']==3){
				$data[$k]['yinyu'] = 'C-B';
			}else if($v['yinyu']==4){
				$data[$k]['yinyu'] = 'c-b';
			}else if($v['yinyu']==5){
				$data[$k]['yinyu'] = 'c1-b1';
			}else if($v['yinyu']==6){
				$data[$k]['yinyu'] = 'c2-b2';
			}else if($v['yinyu']==7){
				$data[$k]['yinyu'] = 'c3-b3';
			}else if($v['yinyu']==8){
				$data[$k]['yinyu'] = 'c4-b4';
			}else if($v['yinyu']==9){
				$data[$k]['yinyu'] = 'c5';
			}else if($v['yinyu']==10){
				$data[$k]['yinyu'] = '初级';
			}else if($v['yinyu']==11){
				$data[$k]['yinyu'] = '中级';
			}else if($v['yinyu']==12){
				$data[$k]['yinyu'] = '中高级';
			}
			//A,B,C,D,E,F,G,A♭,B♭,D♭,E♭,G♭
			if($v['diaohao']==1){
				$data[$k]['diaohao'] = 'A';
			}else if($v['diaohao']==2){
				$data[$k]['diaohao'] = 'B';
			}else if($v['diaohao']==3){
				$data[$k]['diaohao'] = 'C';
			}else if($v['diaohao']==4){
				$data[$k]['diaohao'] = 'D';
			}else if($v['diaohao']==5){
				$data[$k]['diaohao'] = 'E';
			}else if($v['diaohao']==6){
				$data[$k]['diaohao'] = 'F';
			}else if($v['diaohao']==7){
				$data[$k]['diaohao'] = 'G';
			}else if($v['diaohao']==8){
				$data[$k]['diaohao'] = 'A♭';
			}else if($v['diaohao']==9){
				$data[$k]['diaohao'] = 'B♭';
			}else if($v['diaohao']==10){
				$data[$k]['diaohao'] = 'D♭';
			}else if($v['diaohao']==11){
				$data[$k]['diaohao'] = 'E♭';
			}else if($v['diaohao']==12){
				$data[$k]['diaohao'] = 'G♭';
			}else if($v['diaohao']==13){
				$data[$k]['diaohao'] = 'C♭';
			}else if($v['diaohao']==14){
				$data[$k]['diaohao'] = 'F#';
			}else if($v['diaohao']==15){
				$data[$k]['diaohao'] = 'C#';
			}
			
		}
		$this->assign('page',$show);
		$this->assign('list',$data);
		$this->assign('status',$status);
		$this->assign('pages',$pages);
		$this->assign('ids',$ids);
		$this->display();
	}
	public function modify(){
		$pid = I('get.pid');
		$list = M("Pblx")->where("pid='{$pid}'")->find();
		// dump($list);
		// die;
		$this -> assign('list',$list);
		$this -> display();
	}
	public function ty_modify(){
		$pid = I('get.pid');
		$list = M("Pblx")->where("pid='{$pid}'")->find();
		// dump($list);
		// die;
		$this -> assign('list',$list);
		$this -> display();
	}
	public function timu_upd(){
		if(IS_POST){
			$pid = $_POST['pid'];
			$addstatus = $_POST['addstatus'];
			$lianxi = $_POST['lianxi'];
			$pubiao = $_POST['pubiao'];
			$nandu = $_POST['nandu'];
			$yinfu = $_POST['yinfu'];
			$yinyu = $_POST['yinyu'];
			$diaohao = $_POST['diaohao'];
			$timuurl = $_POST['timuurl'];
			$fname = $_POST['fname'];
			if($yinfu=='a'){	
					$yinfu = $_POST['yinfu1'];
			}elseif($yinfu=='b'){
					$yinfu = $_POST['yinfu2'];
			}

			if(empty($yinfu)||$yinfu =='a'||$yinfu =='b'){
				$this -> redirect('Music/timu_list');
			}
			if(empty($timuurl)){
				$this -> redirect('Music/timu_list');
			}
				
			if(empty($fname)){
				$this -> redirect('Music/timu_list');
			}
			if($addstatus == 'add'){
				if(empty($lianxi)){
				$this -> redirect('Music/timu_list');
				} 
							
				// if(empty($diaohao)){
				// 	echo '请选择调号';exit;
				// }
				
				
			}else if($addstatus == 'add1'){
				if(empty($lianxi)){
				$this -> redirect('Music/timu_list');
				} 			
				// if(empty($diaohao)){
				// 	echo '请选择调号';exit;
				// }
								
			}else if($addstatus == 'add2'){
				if(empty($lianxi)){
				
				$this -> redirect('Music/timu_list');
				} 
			}else{
				if(empty($yinyu)){
				
				$this -> redirect('Music/timu_list');
				}
			}
			$data = array(
						'fname'   => $fname,
					    'lianxi' => $lianxi,
						'pubiao' => $pubiao,
						'nandu' => $nandu,
						'yinfu' => $yinfu,
						'yinyu' =>$yinyu,
						'diaohao' => $diaohao,
						'file_url' => $timuurl
						
			        );
			
			$save = M("Pblx")->where(array('pid'=>$pid))->save($data);
			if($save){
				$this -> redirect('Music/timu_list');
			}else{
				$this -> redirect('Music/timu_list');
			}

		}
	}
	public function shanchu(){
		$id = I("ids");
		$a = M('pblx')->where("pid = '$id'")->delete();
		if($a){
			 echo 1;exit;
		}else{
			echo "删除失败";
		}

	}
	public function show_timu_add(){
		$this->display();
	}

	//新增题目
	public function timu_add(){

		if(IS_POST){
			$addstatus = $_POST['addstatus'];
			$lianxi = $_POST['lianxi'];
			$pubiao = $_POST['pubiao'];
			$nandu = $_POST['nandu'];
			$yinfu = $_POST['yinfu'];
			$yinyu = $_POST['yinyu'];
			$diaohao = $_POST['diaohao'];
			$timuurl = $_POST['timuurl'];
			$fname = $_POST['fname'];

			if($yinfu=='a'){	
					$yinfu = $_POST['yinfu1'];
			}elseif($yinfu=='b'){
					$yinfu = $_POST['yinfu2'];
			}

			if(empty($yinfu)||$yinfu =='a'||$yinfu =='b'){
				echo '请选择音符';exit;
			}
			if(empty($timuurl)){
				echo '请选择题目';exit;
			}
				
			if(empty($fname)){
				echo '名称不能为空';exit;
			}
			if($addstatus == 'add'){
				if(empty($lianxi)){
				echo '请选择练习题类型';exit;
				} 
							
				// if(empty($diaohao)){
				// 	echo '请选择调号';exit;
				// }
				
				
			}else if($addstatus == 'add1'){
				if(empty($lianxi)){
				echo '请选择练习题类型';exit;
				} 			
				// if(empty($diaohao)){
				// 	echo '请选择调号';exit;
				// }
								
			}else if($addstatus == 'add2'){
				if(empty($lianxi)){
				echo '请选择练习题类型';exit;
				} 
			}else{
				if(empty($yinyu)){
				echo '请选择音域';exit;
				}
			}
			$data = array(
						'fname'   => $fname,
					    'lianxi' => $lianxi,
						'pubiao' => $pubiao,
						'nandu' => $nandu,
						'yinfu' => $yinfu,
						'yinyu' =>$yinyu,
						'diaohao' => $diaohao,
						'file_url' => $timuurl
						
			        );
			
			$add = M("Pblx")->add($data);
			if($add){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员';exit;
			}

		}
	
	}
	
	
	//给课时添加小结
	public function xiaojie_add(){
		
		if(IS_POST){
			$cid = $_POST['cid'];
			$mcid = $_POST['mcid'];
			$name = $_POST['name'];
			if(empty($name)){
				echo '小结名称不能为空';exit;
			}
			
			$url = $_POST['url'];
		    if(empty($url)){
				echo '请选择视频资源';exit;
			}
			
			$status = $_POST['status'];
			
			$data = array(
				        'cl_cid' => $cid,
						'cl_mcid' => $mcid,
						'cl_name' => $name,
						'cl_url' => $url,
						'cl_status' => $status
			       );
			
			$add = M("Music_course_list")->add($data);
			if($add){
				echo 1;exit;
			}else{
			  echo '添加失败,请联系管理员~';exit;
			}
		}
		
		
		$cid = $_GET['cid'];//课程id
		$mcid = $_GET['mcid'];//课时id
		
		$music = M("Music_cat")->where("cid='{$cid}'")->find();
		$list = M("Music_course")->where("mc_cid='{$cid}' and mc_status='1'")->select();
		
		$this->assign('mcid',$mcid);
		$this->assign('music',$music);
		$this->assign('list',$list);
		$this->display();
	}
	//基础乐理--课程详情
	public function music_xiang(){
		$cid = $_GET['cid'];
		$music_cat = M("Music_cat")->where("cid='{$cid}'")->find();
		
		
		$list = M("Music_course")->where("mc_cid='{$cid}'")->select();
		foreach($list as $k=>$v){
			$list[$k]['jie'] = M("Music_course_list")->where("cl_mcid='{$v['mcid']}'")->select();
		}
		
		//echo '<pre/>';
		//var_dump($list);exit;
		$this->assign('list',$list);
		$this->assign('music_cat',$music_cat);
		$this->display();
	}
	//基础乐理--新增课程
	public function music_add(){
		if(IS_POST){
			$cname = trim($_POST['cname']);
			if(empty($cname)){
				echo '课程名称不能为空';exit;
			}
			
			$imgurl = trim($_POST['imgurl']);
			if($imgurl == ''){
				echo '课程封面不能为空';exit;
			}
			
			$nandu = (int)$_POST['nandu'];
			if($nandu<1 || $nandu>5){
				echo '请输入正确的难度等级：1-5';exit;
			}
			
			$tuijiandu = (int)$_POST['tuijiandu'];
			if($tuijiandu<1 || $tuijiandu>5){
				echo '请输入正确的推荐度：1-5';exit;
			}
			
			$cost = $_POST['cost'];
			$content = $_POST['content'];
			
			$tid = trim($_POST['tid']);
			if($tid == ''){
				echo '请选择主讲老师';exit;
			}
			
			$text = $_POST['text'];
			$name = $_POST['name'];
			
			foreach($name as $v){
				if($v == ''){
					echo '课时名称不能为空';exit;
				}
			}
			$status = $_POST['status'];
			
			$data = array(
				        'c_name' => $cname,
						'c_img' => $imgurl,
						'c_content' => $content,
						'c_dlevel' => $nandu,
						'c_degree' => $tuijiandu,
						'c_is_cost' => $cost,
						'c_teacher_id' => $tid,
						'c_text' => $text,
						'c_status' => $status
			        );
			
			$add = M("Music_cat")->add($data);
			if($add){
				foreach($name as $v){
					M("Music_course")->add(array(
				                         'mc_cid' => $add,
				                         'mc_name' => $v,
				                         'mc_status' => $status
					                  ));
				}
				echo 1;exit;
			}else{
				echo '添加失败,请联系管理员~';exit;
			}
			//var_dump($_POST);exit;
		}
		
		
		$teacher = M("Teacher")->where("t_status='2'")->select();
		
		$this->assign('teacher',$teacher);
		$this->display();
	}
	//小节操作
	public function music_course_list_caozuo(){
		$clid = (int)$_POST['clid'];//课程id
		$mcid = (int)$_POST['mcid'];//课时id
		$status = (int)$_POST['status'];
		
		if($status == 1){//禁用操作
			//禁用小节
			$set1 = M("Music_course_list")->where("clid='{$clid}'")->setField('cl_status',2);
		
			if($set1){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员处理~';exit;
			}
		
		}else if($status == 2){//启用操作
			//判断父级是否为禁用
			$mc_status = M("Music_course")->field('mc_status')->where("mcid='{$mcid}'")->find()['mc_status'];
			if($mc_status == 2){
				echo '该小节所属的课时已被禁用,如需开启这个小节需先启用该课时~';exit;
			}else{
				if(M("Music_course_list")->where("clid='{$clid}'")->setField('cl_status',1)){
					echo 1;exit;
				}else{
					echo '操作失败,请联系管理员处理~';exit;
				}
			}
				
		}
	}
	//课时操作
	public function music_course_caozuo(){
		$cid = (int)$_POST['cid'];//课程id
		$mcid = (int)$_POST['mcid'];//课时id
		$status = (int)$_POST['status'];
		
		if($status == 1){//禁用操作
			
			//禁用课时
			$set1 = M("Music_course")->where("mcid='{$mcid}'")->setField('mc_status',2);
			//禁用小节
			$set2 = M("Music_course_list")->where("cl_mcid='{$mcid}'")->setField('cl_status',2);
				
			if($set1){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员处理~';exit;
			}
				
		}else if($status == 2){//启用操作
			//判断父级是否为禁用
			$c_status = M("Music_cat")->field('c_status')->where("cid='{$cid}'")->find()['c_status'];
			if($c_status == 2){
				echo '该课时所属的课程已被禁用,如需开启这个课时需先启用该课程~';exit;
			}else{
				if(M("Music_course")->where("mcid='{$mcid}'")->setField('mc_status',1)){
					echo 1;exit;
				}else{
					echo '操作失败,请联系管理员处理~';exit;
				}
			}
			
		}
	}
	//课程操作
	public function music_cat_caozuo(){
		$cid = (int)$_POST['cid'];
		$status = (int)$_POST['status'];
		
		if($status == 1){//禁用操作
	        //禁用课程
			$set1 = M("Music_cat")->where("cid='{$cid}'")->setField('c_status',2);
			//禁用课时
			$set2 = M("Music_course")->where("mc_cid='{$cid}'")->setField('mc_status',2);
			//禁用小节 
			$set3 = M("Music_course_list")->where("cl_cid='{$cid}'")->setField('cl_status',2);
			
			if($set1){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员处理~';exit;
			}
			
		}else if($status == 2){//启用操作
			if(M("Music_cat")->where("cid='{$cid}'")->setField('c_status',1)){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员处理~';exit;
			}
		}
		//var_dump($_POST);exit;
	}
	//课程搜
	public function music_list_sou(){
		$where = "";
		
		$name = trim($_POST['name']);
		if($name){
			if($where){
				$where .= " and piano_music_cat.c_name = '{$name}'";
			}else{
				$where = "piano_music_cat.c_name = '{$name}'";
			}
			$this->assign('name',$name);
		}
		
		$tname = trim($_POST['tname']);
		if($tname){
			if($where){
				$where .= " and piano_teacher.t_truename = '{$tname}'";
			}else{
				$where = "piano_teacher.t_truename = '{$tname}'";
			}
			$this->assign('tname',$tname);
		}
		
		$nandu = $_POST['nandu'];
		if($nandu){
			if($where){
				$where .= " and piano_music_cat.c_dlevel = '{$nandu}'";
			}else{
				$where = "piano_music_cat.c_dlevel = '{$nandu}'";
			}
			$this->assign('nandu',$nandu);
		}
		
		$button = $_POST['button'];
		if(empty($name) && empty($tname) && empty($nandu)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['music_list_sou']){
					$where = $_SESSION['music_list_sou'];
				}
			}
		}
		$_SESSION['music_list_sou'] = $where;
		
		
		$field = "piano_teacher.t_truename,piano_music_cat.*";
		
		$join = "piano_teacher on piano_teacher.t_userid = piano_music_cat.c_teacher_id";
		
		
		$count = M("Music_cat")->field($field)->join($join)->where($where)->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("Music_cat")->field($field)->join($join)->where($where)->order("cid DESC")->select();
		
		$this->assign('list',$list);
		$this->display('music_list');
		
	}
	//课程列表
	public function music_list(){
		
		$field = "piano_teacher.t_truename,piano_music_cat.*";
		
		$join = "piano_teacher on piano_teacher.t_userid = piano_music_cat.c_teacher_id";
		
		
		$count = M("Music_cat")->field($field)->join($join)->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("Music_cat")->field($field)->join($join)->order("cid DESC")->select();
		
		$this->assign('list',$list);
		$this->display();
	}
    

    //设置页数
	public function set_page(){
		//var_dump($_POST);exit;
		$page = $_POST['page'];
		$ids = $_POST['ids'];
		$data = array(
						'page'   => $page
					    						
			        );
		$list = M("Set")->select();
		if(!$list){
			$set1 = M("Set")->add($data);
		}else{
			$set1 = M("Set")->where(array('id'=>$ids))->save($data);
		}
		
		if($set1){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员处理~';exit;
			}
		
	}
	
 public function get_file(){
	$appid = 1252612501;//'1400018152';//
	$ma = "14651978969466847155";
	$key = '331d575d3a6de3b4f2f1dbc5b61c23cb';//'0a1e278a0e048360';//

	$time = (int)time()+60;
	$sign = md5($key.$time);
	$url = "http://fcgi.video.qcloud.com/common_access?cmd=$appid&interface=Live_Tape_GetFilelist&Param.s.channel_id=$ma&t=$time&sign=$sign";
	
	//echo $url;exit;
	$result = $this->https_request($url,'');
	var_dump($result);exit;
	}
	
	public function https_request($url,$data = null){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	if (!empty($data)){
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
	} 
    
}