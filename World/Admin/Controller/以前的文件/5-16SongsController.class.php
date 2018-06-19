<?php
/*教材管理
 * */
namespace Admin\Controller;
use Think\Controller;
class SongsController extends CommonController {
	//教材排序
	public function song_sort(){
		
			$ids = M("Songs")->field('sid')->where("songs_cid ='4'")->select();
			foreach($ids as $k=>$val){
				M("Songs")->where("sid='{$val['sid']}'")->setField('songs_sort',$k+1);
			}
		
	}
	//删除曲目
	public function qumu_del(){
		if(IS_POST){
			$lid = $_POST['lid'];
			$file_url = M("Songs_list")->where("lid='{$lid}'")->find();
			$del = M("Songs_list")->where("lid='{$lid}'")->limit(1)->delete();
			if($del){
				//移除对应文件
				@unlink($file_url['list_url']);
				@unlink($file_url['list_url_music']);
				echo 1;exit;
			}else{
				echo '操作失败，请联系管理员~';exit;
			}
		}
	}

	public function qumu_save(){
		$lid = $_POST['lid'];
		$a = M("Songs_list")->where("lid='{$lid}'")->setInc('list_xiazai',1);
		if($a){
			echo 1;exit;
		}else{
			echo '操作失败';exit;
		}

	}
	//编辑曲目
	public function qumu_edit(){
			$sid = $_REQUEST['sid'];   
			$lid = $_REQUEST['lid'];   
			
		if(IS_POST){		

			$data['list_od'] = I('list_od');    //新序列号   2
			$a = M('Songs_list')->where("lid = '$lid' ")->find();   //老序列号   5

			
			if($a['list_od']>$data['list_od']){        //如果往上移  5移到2
				$b = M('Songs_list')->where(" list_sid = '$sid' and  
					list_od >='$data[list_od]'  and list_od <'$a[list_od]'") //  找到2,3,4
								->select();   
				foreach ($b as  $v) {
					M('Songs_list')->where(" lid ='$v[lid]'")->setInc('list_od',1);
					//5移到2，则2,3,4都要加1
				}
				$e = M('Songs_list')->where("lid = '$lid' ")->save($data);   //秦祖国5改2
			

			}elseif($a['list_od']<$data['list_od']){  // 如果往下移2移到5

				$b = M('Songs_list')->where(" list_sid = '$sid' and  
					list_od <='$data[list_od]'  and list_od >'$a[list_od]'") 
								->select();   
				foreach ($b as  $v) {
					M('Songs_list')->where(" lid ='$v[lid]'")->setDec('list_od',1);
				}
				$e = M('Songs_list')->where("lid = '$lid' ")->save($data);   
				
			}
			

			$songs = M("Songs")->where("sid='{$sid}'")->find();
			$qumu = M("Songs_list")->where("lid='{$lid}'")->find();
				
			$list_name = trim($_POST['list_name']);
			if(empty($list_name)){
				echo '曲目名称不能为空';exit;
			}
				

			$pdf = trim($_POST['pdf']);
			if(empty($pdf)){
				echo '请上传显示文件';exit;
			}
				
			$yingping = trim($_POST['yinping']);
//			 if(empty($yingping)){
//			echo '请上传曲谱伴奏文件';exit;
//			}
				
			$status = $_POST['status'];
		    if($status == 1){
		    	if($songs['songs_status'] != 1){
		    		echo '请先启用该曲目所属的教材';exit;
		    	}
		    }
		    //如果没有修改这提交
		    if($qumu['list_name'] == $list_name && $qumu['list_url'] == $pdf 
		    	&& $qumu['list_status'] == $status && $qumu['list_od'] == $data['list_od'] && $qumu['list_od']==$yingping){
		    	echo 1;exit;
		    }
		    
			$data = array(
					'list_cid' => $songs['songs_cid'],
					'list_sid' => $sid,
					'list_name' => $list_name,
					'list_url' => $pdf,
					'list_url_music' => $yingping,
					'list_status' => $status
			);
			
			$set = 	M("Songs_list")->where("lid='{$lid}'")->save($data);
		
			if($set || $e){
				if($qumu['list_url'] != $pdf){
					@unlink($qumu['list_url']);
				}
				echo 1;exit;
			}else{
				echo '保存失败,sql错误,请联系管理员';exit;
			}
		}
			
		$qumu = M("Songs_list")->where("lid='{$lid}'")->find();	

		$count = M("Songs_list")->where("list_sid = '$sid'")->order('list_od ASC')->select();
	
		$this->assign('count',$count); 
		$this->assign("qumu",$qumu);
		
		$sid = $_GET['sid'];
		$songs = M("Songs")->where("sid='{$sid}'")->find();
		

		$this->assign("songs",$songs);
		$this->display();
	}
	//新增曲目
	public function qumu_add(){
		if(IS_POST){
			$sid = $_POST['sid'];
			
			$songs = M("Songs")->where("sid='{$sid}'")->find();
			$num = M('Songs_list')->where("list_sid = '$sid'")->count();
		
			$list_name = trim($_POST['list_name']);
			if(empty($list_name)){
				echo '曲目名称不能为空';exit;
			}
			
			$pdf = trim($_POST['pdf']);
			if(empty($pdf)){
				echo '请上传显示文件';exit;
			}
			
		    $yingping = trim($_POST['yinping']);
//			if(empty($yingping)){
//				echo '请上传曲谱伴奏文件';exit;
//			} 	
			
			$status = $_POST['status'];
			
			$data = array(
				        'list_cid' => $songs['songs_cid'],
						'list_sid' => $sid,
						'list_name' => $list_name,
						'list_url' => $pdf,
						'list_url_music' => $yingping,
						'list_status' => $status,
						'list_od'=> $num+1
			        );
			
			if(M("Songs_list")->add($data)){
				echo 1;exit;
			}else{
				echo '添加失败,sql错误,请联系管理员';exit;
			}
		}
		$sid = $_GET['sid'];
		$songs = M("Songs")->where("sid='{$sid}'")->find();
		
		
		$this->assign("songs",$songs);
		$this->display();
	}
	//修改曲目状态
	public function edit_status(){
		$status = $_POST['status'];
		$lid = $_POST['lid'];
		$sid = $_POST['sid'];
		
		if($status == 1){//启用操作,判断上级是否被禁用
			$songs = M("Songs")->where("sid='{$sid}'")->find();
			if($songs['songs_status'] == 2){
				echo '该曲目所属的曲谱  '.$songs['songs_name'].' 已被禁用,如需启用该曲目需先启用其所属曲谱~';exit;
			}
		}
		
		if(M("Songs_list")->where("lid='{$lid}'")->setField('list_status',$status)){
			echo '1';exit;
		}else{
			echo '操作失败,sql错误，请联系管理员';exit;
		}
	}
	//曲目列表
	public function songs_list(){
		$sid = $_GET['sid'];
		$sname = M("Songs")->where("sid='{$sid}'")->find();
		
		$where = "list_sid='{$sid}'";
		$list = M("Songs_list")->where($where)->order('list_od')->select();
		
		$this->assign('list',$list);
		$this->assign('sname',$sname);
		$this->display();
	}
	//编辑曲谱
	public function songs_edit(){
		 if(IS_POST){
			$sid = $_POST['sid'];
			
			
			$where = "piano_songs.sid='{$sid}'";
			$field = "piano_songs_catgroy.c_name,piano_songs_catgroy.c_status,";
			$field .= "piano_songs.*";
			$join = "piano_songs_catgroy on piano_songs_catgroy.cid = piano_songs.songs_cid";
			$list = M("Songs")->field($field)
								->join($join)
								->where($where)
								->find();
			
			
			$songs = trim($_POST['songs']);
			if(empty($songs)){
				echo '曲谱名称不能为空';exit;
			}
				
			$imgurl = trim($_POST['imgurl']);
			if(empty($imgurl)){
				$imgurl = $list['songs_img'];
			}
				
			$status = trim($_POST['status']);
			
			//计算排序
			$sort = $_POST['sort'];
			
			if($list['songs_cid']==2 || $list['songs_cid']==3 || $list['songs_cid']==4){
				$sort_where = "songs_cid='{$list['songs_cid']}'";	
			}else{
				$sort_where = "songs_cid not in (2,3,4)";
			}
			if($sort > $list['songs_sort']){
				$sort_where .= " and songs_sort > '{$list['songs_sort']}' and songs_sort <= '{$sort}'";
				
				$set1 = M("Songs")->where($sort_where)->setDec('songs_sort',1);		
			}else if($sort < $list['songs_sort']){
				$sort_where .= " and songs_sort < '{$list['songs_sort']}' and songs_sort >= '{$sort}'";
				
				$set1 = M("Songs")->where($sort_where)->setInc('songs_sort',1);	
			}
			
			if($status == 1){//启用曲谱
				if($list['c_status'] == 2){
					M("songs_catgroy")->where("cid='{$list['songs_cid']}'")->setField('c_status',1);
				}
			}
			
			if($songs==$list['songs_name'] && $imgurl==$list['songs_img'] && $status==$list['songs_status'] && $sort==$list['songs_sort']){
				echo '1';exit;
			}
				
			$data = array(
				
					'songs_name' => $songs,
					'songs_img' => $imgurl,
					'songs_status' => $status,
					'songs_sort' => $sort,	
			);
				
			
			if(M("Songs")->where($where)->save($data)){
				
				if($imgurl != $list['songs_img']){
					@unlink($list['songs_img']);
				}
				if($status == 2){//禁用该曲谱的所有曲目
					M("Songs_list")->where("list_sid='{$sid}'")->setField("list_status",2);
				}
				echo '1';exit;
			}else{
				echo '修改失败,sql错误，请联系管理员';exit;
			}
		} 
		
		$sid = $_GET['sid'];
		$where = "piano_songs.sid='{$sid}'";
		$field = "piano_songs_catgroy.c_name,";
		$field .= "piano_songs.*";
		$join = "piano_songs_catgroy on piano_songs_catgroy.cid = piano_songs.songs_cid";
		$list = M("Songs")->field($field)
							->join($join)
							->where($where)							
							->find();
		
		$cat = M("Songs_catgroy")->where("c_status='1'")->select();
		if($list['songs_cid'] ==2 || $list['songs_cid'] ==3 || $list['songs_cid'] ==4){
			$where = "songs_cid='{$list['songs_cid']}'";
		}else{
			$where = 'songs_cid not in (2,3,4)';
		}
		$count = M("Songs")->where($where)->order('songs_sort ASC')->select();
		
		//var_dump($list);exit;
		$this->assign('count',$count);
		$this->assign('cat',$cat);
		$this->assign('list',$list);
		$this->display();
	}
	//新增曲谱
	public function songs_add(){
		if(IS_POST){
			$cid = $_POST['cid'];
			if($cid == ''){
				echo '请选择教材所属分类';exit;
			}
			
			$c_type = $_POST['c_type'];
            if($cid == 1){
            	if(empty($c_type)){
            		echo '请选择具体的专业教程';exit;
            	}
            	$cid = $c_type;
            }
			
			$songs = trim($_POST['songs']);
			if(empty($songs)){
				echo '教材名称不能为空';exit;
			}
			
			$imgurl = trim($_POST['imgurl']);
			if(empty($imgurl)){
				echo '请上传教材封面';exit;
			}
			
			$status = trim($_POST['status']);
			
			//获取当前类型最大排序
			if($cid != 1){
				$where = "songs_cid='{$cid}'";
			}else{
				$where = 'songs_cid not in (2,3,4)';
			}
			$sort = M('Songs')->field('songs_sort')->where($where)->order('songs_sort DESC')->find()['songs_sort'];
			
			
			
			$data = array(
				        'songs_cid' => $cid,
						'songs_name' => $songs,
						'songs_img' => $imgurl,
						'songs_status' => $status,
						'songs_caozuo' => $_SESSION['piano_user']['aid'],
					    'songs_sort' => $sort+1
			        );
			
			if(M("Songs")->add($data)){
				echo '1';exit;
			}else{
				echo '新增失败,sql错误，请联系管理员';exit;
			}
		}
		$cat = M("Songs_catgroy")->where("c_status='1' and c_type='0'")->select();
		$this->assign('cat',$cat);
		
		$this->display();
	}
	//专业曲谱
	public function zhuanye_cat(){
		if(IS_POST){
			
			$where = "c_status='1' and c_type='1'";
			
			$cat = M("Songs_catgroy")->where($where)
			                         ->select();
			$str = '<option value="">请选择</option>';
			foreach($cat as $v){
				$str .= '<option value="'.$v['cid'].'">'.$v['c_name'].'</option>';
			}
			echo $str;exit;
		}
	}
	//曲谱搜
	public function songs_sou(){
		
		$where = '';
		
		$name = trim($_POST['name']);
		if($name){
			if($where){
				$where .= " and piano_songs.songs_name like '%{$name}%'";
			}else{
				$where = "piano_songs.songs_name like '%{$name}%'";
			}
			$this->assign('name',$name);
		}
		
		$cid = trim($_POST['cid']);
		if($cid){
			if($where){
				$where .= " and piano_songs.songs_cid='{$cid}'";
			}else{
				$where .= "piano_songs.songs_cid='{$cid}'";
			}
			$this->assign('cid',$cid);
		}
		
		$button = $_POST['button'];
		if(empty($name) && empty($cid)){
			//如果是点击页码发起的请求，则按只保存的条件搜索
			if(!$button){
				if($_SESSION['songs_sou']){
					$where = $_SESSION['songs_sou'];
				}
			}
		}
		$_SESSION['songs_sou'] = $where;
		
		
		$field = "piano_songs_catgroy.c_name,";
		$field .= "piano_songs.*";
		$join = "piano_songs_catgroy on piano_songs_catgroy.cid = piano_songs.songs_cid";
		
		
		$count = M("Songs")->field($field)
		                   ->where($where)
		                   ->join($join)->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("Songs")->field($field)
							->join($join)
							->where($where)
							->limit($Page->firstRow.','.$Page->listRows)
							->order('piano_songs.songs_sort ASC')
							->select();
		foreach($list as $k=>$v){
			$list[$k]['count'] = M("Songs_collection")->where("sid='{$v['sid']}' and sc_status='1'")->count();
			//所属琴行
			if($v['c_type'] != 0){
				$list[$k]['d_name'] = M("Dom")->field('d_name')->where("dom_id='{$v['c_domid']}'")->find()['d_name'];
			}else{
				$list[$k]['d_name'] = '子昊总部';
			}
		}
		
		$cat = M("Songs_catgroy")->select();
		$this->assign('cat',$cat);
		
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display('songs');
	}
	//曲谱列表
	public function songs(){
		$status = $_REQUEST['status']?$_REQUEST['status']:1;
		
		$field = "piano_songs_catgroy.c_name,piano_songs_catgroy.c_type,";
		$field .= "piano_songs.*";
		$join = "piano_songs_catgroy on piano_songs_catgroy.cid = piano_songs.songs_cid";
        
		if($status != '1'){
			$where = "piano_songs.songs_cid = '{$status}'";
		}else{
			$where = "piano_songs.songs_cid != '2' and piano_songs.songs_cid != '3' and piano_songs.songs_cid != '4'";
		}
		
		
		$count = M("Songs")->field($field)
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
		
		$list = M("Songs")->field($field)
		                   ->join($join)
		                   ->where($where)
		                   ->limit($Page->firstRow.','.$Page->listRows)
		                   ->order('piano_songs.songs_sort ASC')
		                   ->select();
		foreach($list as $k=>$v){
			$list[$k]['count'] = M("Songs_list")->where("list_sid='{$v['sid']}'")->count();
		  
		}

		$this->assign('status',$status);
		$this->assign('page',$show);
		$this->assign('list',$list);
		$this->display();
	}
    //编辑教材类别
    public function songs_catgory_edit(){
    	if(IS_POST){
    		$cid = $_POST['cid'];
    		$name = trim($_POST['name']);
    		if($name == ''){
    			echo '分类名称不能为空';exit;
    		}
    		
    			
    		$status = (int)$_POST['status'];
    		
    		$old_cat = M("Songs_catgroy")->where("cid='{$cid}'")->find();
    		if($old_cat['c_name']==$name && $old_cat['c_status']==$status){//如果不做任何修改,提示修改成功
    			echo 1;exit;
    		}
    		
    		$cat = M("Songs_catgroy")->where("c_name='{$name}' and cid != '{$cid}'")->find();
    			
    		if(empty($cat)){
    			
    			if($status == 2){//需同时禁用该类别下所有曲谱、曲目
    				M("Songs_catgroy")->startTrans();
    				//禁教材
    				$set1 = M("Songs_catgroy")->where("cid='{$cid}'")->save(array(
												    						'c_name' => $name,
												    						'c_status' =>$status,
												    						'c_type' =>1
												    					
												    				)); 
    				//禁曲谱
    				$set2 = M("Songs")->where("songs_cid='{$cid}'")->setField('songs_status',2);
    				//禁曲目
    				$set3 = M("Songs_list")->where("list_cid='{$cid}'")->setField('list_status',2);
    				
    				if($set1 && $set2 && $set3){
    					M("Songs_catgroy")->commit();
    					echo 1;exit;
    				}else{
    					M("Songs_catgroy")->rollback();
    					echo '修改失败,sql错误,请联系管理员~';exit;
    				}
    			}else{//只需启用教材
    				$set = M("Songs_catgroy")->where("cid='{$cid}'")->save(array(
    						'c_name' => $name,
    						'c_status' =>$status
    				));
    				if($set){
    					echo 1;exit;
    				}else{
    					echo '修改失败,sql错误,请联系管理员~';exit;
    				}
    			}
    			
    			
    		
    			
    		}else{
    			echo '新增失败,该分类名称已经存在了~';exit;
    		}
    	}
 
    	
    	$cid = $_GET['cid'];
    	$cat = M("Songs_catgroy")->where("cid='{$cid}'")->find();
    	$this->assign('cat',$cat);
    	$this->display();
    }
	//添加教材类别
	public function songs_catgory_add(){
		if(IS_POST){
			
			$name = trim($_POST['name']);
			if($name == ''){
				echo '分类名称不能为空';exit;
			}
			
			$status = (int)$_POST['status'];
			
			$cat = M("Songs_catgroy")->where("c_name='{$name}'")->find();
			
			if(empty($cat)){
				$add = M("Songs_catgroy")->add(array(
					                          'c_name' => $name,
						                      'c_status' =>$status,
						                      'c_type' =>1,      
				                           ));
				
				if($add){
					echo 1;exit;
				}else{
					echo '新增失败,sql错误,请联系管理员~';exit;
				}
			}else{
				echo '新增失败,该分类名称已经存在了~';exit;
			}
		}
	
		$this->display();
	}
	//教材类别管理
	public function songs_catgroy(){
		$where = "piano_songs_catgroy.c_type='1'";
		
		$list = M("Songs_catgroy")->where($where)
		                          ->order("cid DESC")
		                          ->select();
		
		$this->assign('list',$list);
        $this->display();
    }
    
    
}