<?php
/*设备管理
 * */
namespace Admin\Controller;
use Think\Controller;
class ShebeiController extends CommonController {
    //设备更换处理 
   	public function shebei_edit(){
   	   	if(IS_POST){
			$old_hao = trim($_POST['old_hao']);

			if(empty($old_hao)){
				echo '请输入旧设备号';exit;
			}else{
				$shebei = M("Piano")->where("piano_bianhao = '{$old_hao}'")->find();
				
				if(!$shebei){
					echo '您要更换的旧设备号不存在，请检查~';exit;
				}
			}

			$new_hao = trim($_POST['new_hao']);
			if(empty($new_hao)){
				echo '请输入新设备号';exit;
			}else{
				$shebei = M("Piano")->where("piano_bianhao='{$new_hao}'")->find();
				if($shebei['piano_status'] == 2){
					echo '新设备号已经出库了，请重新选择一个~';exit;
				}
			}

			//设备号更换后，shebei表和 piano表中关于shebei_hao 字段值都要修改过来  chukudan 中暂不修改
			$a = M('Shebei')->where("sb_hao='{$old_hao}'")->select();
			$b = array();
			foreach ($a as $k => $v) {
				$b[$k] = M('Shebei')->where("sb_id='$v[sb_id]'")->setField('sb_hao',$new_hao);
			}//多条记录，每个记录都要修改

			$set = M("Piano")->where("piano_bianhao='{$old_hao}'")
			                 ->limit(1)
			                 ->setField('piano_bianhao',$new_hao);
			if($set){
				
				$data['old_hao'] = $old_hao;
				$data['new_hao'] = $new_hao; 
				$data['who'] = $_SESSION['piano_user']['username'];
				$data['time'] =date('Y-m-d H-i-s',time());
				
				$c = M('Piano_record')->add($data);
				if($c){
					echo 1;exit;
				}else{
					echo '没有记录';exit;
				}
			}else{
				echo '操作失败，请联系管理员~';exit;
			}
		}
   	   	$this->display();
   		
   	}
   
   //出库单搜
   public function chukudan_list_sou(){
   	       $where = "chu_id >= 1";
   	       
   	       /* $hao = trim($_POST['hao']);
   	       if($hao){
   	       	  $shebei_id = M("Piano")->where("piano_bianhao='{$hao}' and piano_status='2'")->find()['piano_id'];
              if($shebei_id){
              	$where .= " and chu_hao like '%{$shebei_id}%'";
              }else{
              	$where .= " and chu_hao like '%--%'";
              }
   	       	  
   	       	  $this->assign('hao',$hao);
   	       } */
   	       $jx_name = trim($_POST['jx_name']);
   	       if($jx_name){
   	       	  $jxid = M("Dealers")->field('jxid')->where("jx_name like '%{$jx_name}%'")->select();
   	       	  $ids = '';
   	       	 foreach($jxid as $v){
   	       	 	$ids =$v['jxid'].',';
   	       	 }
   	       	 if($ids){
   	       	 	$ids = rtrim($ids,',');
   	       	 }else{
   	       	 	$ids = 0;
   	       	 }
   	       	  $where .= " and chu_outid in ({$ids})";
   	       	  $this->assign('jx_name',$jx_name);
   	       }
   	      
   	       $button = $_POST['button'];
   	       if(empty($jx_name)){
   	       	//如果是点击页码发起的请求，则按只保存的条件搜索
   	       	if(!$button){ 
   	       		if($_SESSION['chukudan_list_sou']){
   	       			$where = $_SESSION['chukudan_list_sou'];
   	       		}
   	       	}
   	       }
   	       $_SESSION['chukudan_list_sou'] = $where;
   	 
		   	$count = M("Chukudan")->where($where)->count();
		   	//实例化分页类
		   	$Page = new \Think\Page($count,$this->pagenum);
		   	//设置上一页与下一页
		   	$Page->setConfig('prev', '上一页');
		   	$Page->setConfig('next', '下一页');
		   	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		   	//显示分页信息
		   	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		   	$list = M("Chukudan")->where($where)->select();
		 
		   	foreach($list as $k=>$v){
		   		//出库对象
		   		$list[$k]['duixiang'] = M("Dealers")->field("jx_name")->where("jxid='{$v['chu_outid']}'")->find()["jx_name"];
		   			
		   		//操作员
		   		$list[$k]['creater'] = M("piano_Admin")->field('username')->where("aid='{$v['chu_creater']}'")->find()['username'];
		   			
		   	}
		   	
		   	$this->assign('list',$list);
		   	$this->assign('page',$show);
		   	$this->display('chukudan_list');
   }
	//出库单列表
	public function chukudan_list(){
		
		$count = M("Chukudan")->count();
		//实例化分页类
		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		$list = M("Chukudan")->limit($Page->firstRow.','.$Page->listRows)->order('chu_id desc')->select();
		
		foreach($list as $k=>$v){
			//出库对象
			$list[$k]['duixiang'] = M("Dealers")->field("jx_name")->where("jxid='{$v['chu_outid']}'")->find()["jx_name"];
			
			//操作员
			$list[$k]['creater'] = M("piano_Admin")->field('username')->where("aid='{$v['chu_creater']}'")->find()['username'];
			
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	//
	public function shebei_qindan(){
		if(IS_POST){
			$id = $_POST['id'];
			
			 $ids = M("Chukudan")->field('chu_hao')->where("chu_id='{$id}'")->find()['chu_hao'];
			
			$list = M("Piano")->field("piano_bianhao")->where("piano_id in ($ids)")->select();
			
			$str = "<thead><tr style=' font-size: 13px;'><th>设备号</th></tr></thead><tbody><tr>";
			foreach($list as $v){
				$str .= "<tr><td>".$v['piano_bianhao']."</td></tr>";	
			}
			$str .= "</tbody>" ;
		    
			echo $str;exit;
		}
			
	}
	//新增出库单
	public function shebei_chukudan_add(){
		if(IS_POST){
			if($_SESSION['piano_user']['role'] != 1){
				echo '无权限操作';exit;
			}
			$ids = $_POST['ids'];//选中的设备id
			if(empty($ids)){
				echo '请勾选需要出库的设备';exit;
			}
			$ids = implode(',',$ids);
			
		
			$jinxiao = $_POST['jinxiao'];//对应的id
			if(empty($jinxiao)){
				echo '请选择具体的机构';exit;
			}
			$lianxi = trim($_POST['lianxi']);//联系人
			if(empty($lianxi)){
				echo '请输入联系人姓名';exit;
			}
			$xiaoshou = trim($_POST['xiaoshou']);
			if(empty($xiaoshou)){
				echo '请输入销售人员姓名';exit;
			}

			$mobile = trim($_POST['mobile']);//联系电话
			if(!$this->ckeck_mobile($mobile)){
				echo '请输入有效的手机号';exit;
			}
			
			$pro = $_POST['location_p'];
			$city = $_POST['location_c'];
			$area = $_POST['location_a'];
			if($area == '请选择'){
				echo '请选择代理区域到最后一级';exit;
			}
			$address = trim($_POST['address']);
			if(empty($address)){
				echo '请输入详细的收货地址';exit;
			}
			M("Chukudan")->startTrans();
			//1.新增出库单
			$chukudan_data = array(
							    'chu_hao' => $ids,
								'chu_addtime' => date('Y-m-d H:i:s',time()),
								'chu_payer' => $xiaoshou,
								'chu_outid' => $jinxiao,
								'chu_creater' => $_SESSION['piano_user']['aid'],
								'chu_user' => $lianxi,
								'chu_mobile' => $mobile,
								'chu_pro' => $pro,
								'chu_city' => $city,
								'chu_area' => $area,
								'chu_address' => $address
			                 );
			
			$add = M("Chukudan")->add($chukudan_data);
			
			//2.修改设备流通状态
			$set_data = array(
						    'piano_status' => 2,
							'piano_outtime' => date('Y-m-d H:i:s',time()),
							'piano_outid' => $jinxiao,
					  
			            );
			
			$set = M("Piano")->where("piano_id in ($ids)")->save($set_data);
			
			if($set && $add){
				M("Chukudan")->commit();
				echo 1;exit;
			}else{
				M("Chukudan")->rollback();
				echo '操作失败,请联系管理员~';exit;
			}
 			//var_dump($_POST);exit;
		}
	}
	//设备出库
	public function shebei_chuku(){
		if($_SESSION['piano_user']['role'] != 1){
			echo '无权限操作';exit;
		}	
		//勾选设备信息
		$pid = trim($_GET['pid'],',');

		$list = M("Piano")->where("piano_id in ($pid)")->select();
		$this->assign('list',$list);
		
		//平台的出库对象
		$dealers = M("dealers")->where("jx_status='1'")->select();
		$this->assign('dealers',$dealers);
		
		$this->display();
	}
 
	public function shebei_chuku_edit(){
		$id = I('id');
		$hao  = I('hao');
		$dan = M('Chukudan')->select();
		// echo $id; echo '<br/>';
		// echo $hao;
		//  dump($dan);exit;
		foreach ($dan as $k => $v){
			if(stripos($v['chu_hao'],$id) !==false){
				$a = M('Chukudan')->where("chu_id = '$v[chu_id]'")->find();
			}
		}
		

		
		$b = M('Dealers')->where("jx_status= '1'")->select();

		$this->assign('main',$b);
		$this->assign('list',$a);
		$this->assign('hao',$hao);
		$this->display();
	}

	//设备列表
       public function shebei_list(){

       	   $status = $_REQUEST['status']?$_REQUEST['status']:1;
       	   if($status == 1){
       	   	  $where = "piano_status='1'";
       	   	  if(IS_PSOT){
       	   	  	 $hao = trim($_POST['hao']);
       	   	  	 if($hao){
       	   	  	 	$where .= " and piano_bianhao='{$hao}'";
       	   	  	 	$this->assign('hao',$hao);
       	   	  	 }
       	   	  }
       	   	
	       	  $count = M("Piano")->where($where)->count();
	       	   	//实例化分页类
	       	  $Page = new \Think\Page($count,$this->pagenum);
	       	   	//设置上一页与下一页
	       	  $Page->setConfig('prev', '上一页');
	       	  $Page->setConfig('next', '下一页');
	       	  $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
	       	  //显示分页信息
	       	  $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
       	   	
       	   	  $list = M("Piano")->where($where)
       	   	                    ->limit($Page->firstRow.','.$Page->listRows)
       	   	                    ->order("piano_id DESC")
       	   	                    ->select();  
       	   	  
       	   	  $this->assign('status',$status);
       	   	  $this->assign('page',$show);
       	   	  $this->assign('list',$list);
       	   	  $this->display('shebei_weichu');
       	   }else if($status == 2){
       	   	
	       	  $where = "piano_status='2'";
	       	  if(IS_PSOT){
	       	  	$hao = trim($_POST['hao']);
	       	  	if($hao){
	       	  		$where .= " and piano_bianhao='{$hao}'";
	       	  		$this->assign('hao',$hao);
	       	  	}
	       	  }

	       	  $count = M("Piano")->where($where)->count();
	       	   	//实例化分页类
	       	  $Page = new \Think\Page($count,$this->pagenum);
	       	   	//设置上一页与下一页
	       	  $Page->setConfig('prev', '上一页');
	       	  $Page->setConfig('next', '下一页');
	       	  $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
	       	  //显示分页信息
	       	  $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
       	   	
       	   	  $list = M("Piano")->where($where)
       	   	                    ->limit($Page->firstRow.','.$Page->listRows)
       	   	                    ->order("UNIX_TIMESTAMP(piano_bangtime) DESC,UNIX_TIMESTAMP(piano_outtime) DESC")
       	   	                    ->select();  
       	   	  
       	   	  foreach($list as $k=>$v){
       	   	  	 //出库对象
       	   	  
       	   	  	 $list[$k]['jigou'] = M("Dealers")->where("jxid='{$v['piano_outid']}'")->getField('jx_name');
       	   	  	 
       	   	  	 //是否绑定激活
       	   	  	 if($v['piano_is_bang']==2){
       	   	  	 	$list[$k]['username'] = M("Users")->field("username")->where("id='{$v['piano_bang_userid']}'")->find()['username'];
       	   	  	 }
       	   	  }
       	   	  //echo '<pre/>';
       	   	  //var_dump($list);exit;
       	   	  
       	   	  $this->assign('status',$status);
       	   	  $this->assign('page',$show);
       	   	  $this->assign('list',$list);
	       	  $this->display('shebei_chu');
       	   }
       }
       
       //已出库设备导出
       public function shebei_chu_daochu(){
	       	$where = "piano_status='2'";
	       	 	
	       	$list = M("Piano")->where($where)
						      ->order("UNIX_TIMESTAMP(piano_bangtime) DESC,UNIX_TIMESTAMP(piano_outtime) DESC")
						      ->select();
	       	
	       	foreach($list as $k=>$v){
	       		//出库对象
	       		$jigou = M("Dealers")->field('jx_name')->where("jxid='{$v['piano_outid']}'")->find()['jx_name'];
	       		//是否绑定激活
	       		if($v['piano_is_bang']==2){
	       			$username = M("Users")->field("username")->where("id='{$v['piano_bang_userid']}'")->find()['username'];
	       		}else{
	       			$username = '';
	       		}
	       		
	       		if($v['piano_main_use']==1){
	       			 $use = '教学产品';
	       		 }else{
	       		 	$use = '普通产品';
	       		 }
	       		 
	       		 if($v['piano_is_bang']==1){
	       		 	 $now = $jigou.'领取';
	       		 	 $is_jihuo = '未激活';
	       		 }else{
	       		 	$now = '用户：'.$username.'  在使用';
	       		 	$is_jihuo = '已激活';
	       		 }
	       		 if($v['piano_be']==1){
	       		 	$is_qiyong = '是';
	       		 }else{
	       		 	$is_qiyong = '否';
	       		 }
	       		$data[] = array(
	       			       'piano_id' => $v['piano_id'],
	       				   'piano_bianhao' => $v['piano_bianhao'],
	       				   'jigou' => $jigou,
	       				   'username' => $username,
	       				   'piano_main_use' => $use,
	       				   'now' => $now,
	       				   'stauts' => $is_jihuo,
	       				   'piano_outtime' => $v['piano_outtime'],
	       				   'is_qiyong' =>$is_qiyong   
	       	       	);
	       	}
	       
	       	$this->exportexcel($data,
	       			array('ID','设备序列号','所属经销商','所属最终使用账号','用途','当前状态','产品状态','激活时间','是否已启用'),
	       			$filename = '已出库明细');
       }
       
    	/******************导入设备列表*****************************/
    	public function shebie_daoru(){
    		 
    		//实例化上传类
    		$upload = new \Think\Upload();
    		//设置附件上传文件大小200Kib
    		$upload->mixSize = 2000000;
    		//设置附件上传类型
    		$upload->exts = array('xls', 'xlsx');
    		//设置附件上传目录在/Home/temp下
    		$upload->rootPath = './Public/Uploads/file/';
    		/* //保持上传文件名不变
    		 $upload->saveRule = true;
    		//存在同名文件是否是覆盖
    		$upload->uploadReplace = true; */
	
    		if(!is_dir($upload->rootPath)) {
    			mkdir($upload->rootPath, 0777, true);
    		}
    		
    		$file = $_FILES['execl'];
    		$info   =   $upload->uploadOne($file);
    		
    		if(!$info) {   //如果上传失败,提示错误信息
    			echo $upload->getError();exit;
    		} else {    //上传成功
    			$fileName= $info['savepath'].$info['savename'];
    			//重定向,把$fileName文件名传给importExcel()方法
    			//$this->redirect('Index/importExcel', array('fileName' => $file_name), 1, '上传成功！');
    			//echo $fileName;exit;
    	
    			header("content-type:text/html;charset=utf-8");
    			 
    	
    			//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
    			import("Org.Util.PHPExcel");
    	
    			//载入获取时间格式类
    			import("Org.Util.PHPExcel.Shared.Date");
    			$date =new \PHPExcel_Shared_Date();
    	
    			//创建PHPExcel对象，注意，不能少了\
    			$PHPExcel=new \PHPExcel();
    			 
    			//redirect传来的文件名
    			//$fileName = $_GET['fileName'];
    	
    			//文件路径
    			$filePath = $upload->rootPath . $fileName;
    			//截取文件的后缀名
    			list($a,$exts) = preg_split('/[.]+/is',$fileName);
    			//echo $exts;exit;
    			//如果excel文件后缀名为.xls，导入这个类
    			if($exts == 'xls'){
    				import("Org.Util.PHPExcel.Reader.Excel5");
    				$PHPReader=new \PHPExcel_Reader_Excel5();
    			}else if($exts == 'xlsx'){
    				import("Org.Util.PHPExcel.Reader.Excel2007");
    				$PHPReader=new \PHPExcel_Reader_Excel2007();
    			}
    			 
    			//读取Excel文件
    			$PHPExcel = $PHPReader->load($filePath);

    			//读取excel文件中的第一个工作表
    			$sheet = $PHPExcel->getSheet(0);

    			//取得最大的列号
    			$allColumn = $sheet->getHighestColumn();

    			//取得最大的行号
    			$allRow = $sheet->getHighestRow();
    			
    			//echo $allRow;exit;
    			//从第二行开始插入,第一行是列名
    			for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {   				
    				//获取B列的值
    				$B = $PHPExcel->getActiveSheet()->getCell("B" . $currentRow)->getValue();
		            $C = $PHPExcel->getActiveSheet()->getCell("C" . $currentRow)->getValue();
		            $data = array(
		                'piano_bianhao'=>$B,
		                'piano_addtime'=>date('Y-m-d H:i:s')
		            );

		            if($C =='教学产品'){
		              $data['piano_main_use'] =1;
		            }else{
		              $data['piano_main_use'] =2;
		            }
		            
		            if(empty($B) || empty($C)){
		            	continue;
		            }
    			
    				if(M('Piano')->where("piano_bianhao='{$B}'")->find()){
    					echo "导入失败！序列号为:".$B."的设备已经存在,请检查";exit;
    				}else{
    					$add = M('Piano')->add($data);
    				}
    				
    			}
    		    echo 1;exit;
    		}
    	}

    	/******************导入EXCEL*****************************/
    


    public  function chukudan_daochu(){

        $list = M("Chukudan")->select();

		foreach($list as $k=>$v){
			//出库对象
			
           $list[$k]['duixiang'] = M("Dealers")->field("jx_name")->where("jxid='{$v['chu_outid']}'")->find()["jx_name"];
			
			//操作员
			$list[$k]['creater'] = M("piano_Admin")->field('username')->where("aid='{$v['chu_creater']}'")->find()['username'];
		}


       	$data = array();
        foreach ($list as $k => $v) {
       		$data[$k] = array('ID'=>$v['chu_id'],'duixiang'=>$v['duixiang'],'chu_user'=>$v['chu_user'],
       			'chu_mobile'=>$v['chu_mobile'],'chu_payer'=>$v['chu_payer'],'creater'=>$v['creater'],
       			'chu_hao'=>$v['chu_hao'],'chu_num'=>count(explode(',',$v['chu_hao'])),'chu_addtime'=>$v['chu_addtime'],'chu_city'=>$v['chu_pro'].$v['chu_city'].$v['chu_area'].$v['chu_address'],);

       		$a = explode(',',$v['chu_hao']);
       		
       		$c =array();
       		foreach ($a as $key => $value) {
       			$b = M("piano")->where("piano_id = '$value'")->find()['piano_bianhao'];
       			$c[$key] = $b;
       		}

       		$d = implode(',',$c);
       		$d .=",";
       		$data[$k]['chu_hao'] = $d;
        }
        
     //dump($data);exit;
        $this->exportexcel($data,
            array('ID','出库对象(经销商)','联系人','电话','销售员','操作员','出库设备号清单','出库设备数量','出库日期',
                '发货地址'),$filename = '出单列表');
    }



    public function show_record(){
      $count = M('piano_record')->count();
         //实例化分页类
      $Page = new \Think\Page($count,$this->pagenum);
      //设置上一页与下一页
      $Page->setConfig('prev', '上一页');
      $Page->setConfig('next', '下一页');
      $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
      //显示分页信息
      $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)  


      $list = M('piano_record')->limit($Page->firstRow.','.$Page->listRows)->select();

      $this->assign('page',$show);
      $this->assign('list',$list);
      $this->display();
    }
    
//开启关闭设备
    public function change_shebei(){

        $id = I('piano_id');
        $piano_be = I('piano_be');

        $a = M('Piano')->where("piano_id = '$id'")->find();
        // dump($a);exit;
        if($a){
            $b = M('Piano')->where("piano_id = '$id'")->setField('piano_be',$piano_be);
            // var_dump($b);exit;
            if($b){
               echo 1;exit;
            }else{
               echo "更改失败，请联系管理员";exit;
            }
        }else{
          echo "没有找到设备记录";exit;
        }
      
    }

    public function shebei_jiaoxue_sou(){
          $id  = I('id');
          $jxid = I('jxid');
          $where = "piano_main_use = 1";

          if(!empty($id)){    
            $where .= " and piano_bianhao = '$id'";
            $this->assign('id',$id);
          }
          if(!empty($jxid)){ 
            $where .=" and piano_outid = '$jxid'";
            $this->assign('jxid',$jxid);
          }
          
         
          $count = M("Piano")->where($where)->count();
          
           //实例化分页类
          $Page = new \Think\Page($count,$this->pagenum);
          //设置上一页与下一页
          $Page->setConfig('prev', '上一页');
          $Page->setConfig('next', '下一页');
          $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
          //显示分页信息
          $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)  


          $button = $_POST['button'];
          if(empty($id) && empty($jxid)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
              if($_SESSION['shebei_jiaoxue_sou']){
                $where = $_SESSION['shebei_jiaoxue_sou'];
              }
            }
          }
          $_SESSION['shebei_jiaoxue_sou'] = $where;
        

          $list = M("Piano")->where($where)->limit($Page->firstRow.','.$Page->listRows)
                              ->select(); 

           foreach($list as $k=>$v){
           
            $list[$k]['jigou'] = M("Dealers")->field('jx_name')
             ->where("jxid='{$v['piano_outid']}'")->find()['jx_name'];

            $arr = M('Shebei')->where("sb_hao = '$v[piano_bianhao]'")->order('sb_addtime DESC')->limit(1)->select();  
           
              //是否绑定激活  
            if($arr){
                
                  $userid =  $arr[0]['sb_userid'];               
                  $a = M('Users')->where("id = '$userid'")->find();
                  $list[$k]['nickname'] = $a['nickname'];


                  $data['piano_is_bang'] = 2;
                  $data['piano_bang_userid'] = $arr[0]['sb_userid'];
                  $data['piano_bangtime'] = $arr[0]['sb_addtime'];
                   
                  M('Piano')->where("piano_bianhao = '$v[piano_bianhao]'")->save($data);        
             }else{
                  M('Piano')->where("piano_bianhao = '$v[piano_bianhao]'")->setField('piano_is_bang',1);
             }

          }
          


          $this->assign('page',$show);
          $this->assign('list',$list);
        
          $this->display('Shebei/shebei_jiaoxue');


    }

    public function shebei_jiaoxue(){

        $count = M("Piano")->where("piano_main_use = 1")->count();
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)     

        $list = M("Piano")->limit($Page->firstRow.','.$Page->listRows)
                        ->where("piano_main_use = 1")
                        ->limit($Page->firstRow.','.$Page->listRows)
                        ->order("UNIX_TIMESTAMP(piano_bangtime) DESC,UNIX_TIMESTAMP(piano_outtime) DESC")
                        ->select();      


        foreach($list as $k=>$v){
           
            $list[$k]['jigou'] = M("Dealers")->field('jx_name')
             ->where("jxid='{$v['piano_outid']}'")->find()['jx_name'];

            $arr = M('Shebei')->where("sb_hao = '$v[piano_bianhao]'")->order('sb_addtime DESC')->limit(1)->select();  
           
              //是否绑定激活  
            if($arr){
                
                  $userid =  $arr[0]['sb_userid'];               
                  $a = M('Users')->where("id = '$userid'")->find();
                  $list[$k]['nickname'] = $a['nickname'];


                  $data['piano_is_bang'] = 2;
                  $data['piano_bang_userid'] = $arr[0]['sb_userid'];
                  $data['piano_bangtime'] = $arr[0]['sb_addtime'];
                   
                  M('Piano')->where("piano_bianhao = '$v[piano_bianhao]'")->save($data);        
             }else{
              //如果数据全删除了，那字段 piano_bang_userid  和 piano_bangtime怎么变成空？
              //$data['piano_bang_userid'] = NULL;  ?????
              //$data['piano_bangtime'] = NULL;   ?????   这样可以吗?

                  M('Piano')->where("piano_bianhao = '$v[piano_bianhao]'")->setField('piano_is_bang',1);
             }

          }
   
          $this->assign('page',$show);
          $this->assign('list',$list);
        
          $this->display();
    }


    public function change_open(){

      $id  = I('piano_id');
   
      $list = M("Piano")->where("piano_main_use = 1 and piano_id = '$id'")->find();  
      if($list['piano_accs'] ==1){
        $a = M("Piano")->where("piano_main_use = 1 and piano_id = '$id'")->setField('piano_accs',2);
      }else{
        $a = M("Piano")->where("piano_main_use = 1 and piano_id = '$id'")->setField('piano_accs',1);
      }
      if($a){
        echo 1;exit;
      }else{
        echo '修改失败，请联系管理员';exit;
      }

    }


//删除设备已认证过的账号
  public function del_renzhen_shebei(){
    $id = I("ids");
    $hao = I('sb_hao');

      $a = array();
      foreach ($id as $k => $v) {
       
          $a[$k] = M("Shebei")->where("sb_userid = '$v' and sb_hao ='$hao'")->delete();   //删除这个记录

          $user = M("Shebei")->where("sb_userid = '$v' ")->find();   
          if(!$user){
            M('Users')->where("id = '$v'")->setField('rz_status',2);  
            //当设备记录里没有该用户后，更改认证状态
          }
              
          $b= M('Shebei')->where("sb_hao ='$hao'")->order('sb_addtime DESC')->limit(1)->select();   

          if($b){
              $data['piano_bang_userid'] = $b[0]['sb_userid'];
              $data['piano_bangtime'] = $b[0]['sb_addtime'];  
         
          }else{
              $data['piano_bang_userid'] = NULL;
              $data['piano_bangtime'] = NULL;
              $data['piano_is_bang'] = 1;
              //如果设备表里找不到该设备的记录，则判定它没有绑用户了
          }
          M('Piano')->where("piano_bianhao = '$hao'")->save($data);  //更新设备表
      }
      
      if($a){
          echo 1;exit;
      }else{
          echo "删除失败，请与管理员联系!";exit;
      }
        
  }



  public function show_shebei_bang(){
    $id = I('id');
    $list = M('Piano')->where("piano_id = '$id'")
                      ->join('piano_shebei on piano_shebei.sb_hao = piano_piano.piano_bianhao')
                      ->join('piano_users on piano_users.id = piano_shebei.sb_userid')
                      ->select();

    $bh = M('Piano')->where("piano_id = '$id'")->find()['piano_bianhao'];

   //  dump($list);exit;
    $this->assign('list',$list); 
    $this->assign('bh',$bh);
    $this->display();

  } 
   
    //已出库设备退库
    public function shebei_tuiku(){
    	if(IS_POST){
    		$piano_id = $_POST['tuiku_id'];//退库设备的id
    		$info = $_POST['info'];//退库原因
    		if($info == ''){
    			echo '退库原因不能为空';exit;
    		}
    		$cazuo_ren = $_SESSION['piano_user']['aid'];
    		
    		$find_piano = M("Piano")->where("piano_id='{$piano_id}' and piano_status='2'")->find();
    		if($find_piano){
    			if($find_piano['piano_is_bang'] == 1){
    				//未绑定:
    				M("Piano")->startTrans();
    				//1、将设备恢复为未出库,恢复为刚导入的状态
    				$set = M("Piano")->where("piano_id='{$piano_id}' and piano_status='2'")->save(array(
															    					    'piano_status' => 1,
															    						'piano_outtime'=>'',
															    						'piano_outid'=>'',
															    						'piano_be'=>1,
															    						'piano_accs'=>1
    				                                                              ));
    				//2.将出库该设备id的出库单删除该设备id   			
    				$chukudan = M("Chukudan")->where("chu_hao like '%$piano_id%'")->select();
    				$old_piano_id = ','.$piano_id.',';
    				foreach($chukudan as $v){
    					$old_piano_ids = ','.$v['chu_hao'].',';
    					if(strpos($old_piano_ids,$old_piano_id) !== false){
    						$new_piano_ids = str_replace($old_piano_id,",",$old_piano_ids);
    						$new_piano_ids = trim($new_piano_ids,',');
    						
    						if($new_piano_ids == ''){
    							//删除该出库单
    							 M("Chukudan")->where("chu_id='{$v['chu_id']}'")->limit(1)->delete();
    						}else{
    							//修改设备id
    							 M("Chukudan")->where("chu_id='{$v['chu_id']}'")->setField('chu_hao',$new_piano_ids);
    						}
    					}
    				}

    				//3、添加日志
    				$add = M('Tuiku_log')->add(array(
    					    'log_piano_id' =>$piano_id ,
    						'log_piano_hao' =>$find_piano['piano_bianhao'],
    						'log_text' =>$info,
    						'log_time' =>time(),
    						'log_adminid' =>$cazuo_ren
    				));
    				
    				if($set && $add){
    					M("Piano")->commit();
    					echo 1;exit;
    				}else{
    					echo '操作失败，请联系管理员';exit;
    				}
    			}else if($find_piano['piano_is_bang'] == 2){
    				M("Piano")->startTrans();
    				//已绑定：
    				//1、将设备恢复为未出库,恢复为刚导入的状态
    				$save_data = array(
		    						'piano_status' => 1,
		    						'piano_outtime'=>'',
		    						'piano_outid'=>'',
		    						'piano_is_bang' => 1,
		    						'piano_bang_userid' => '',
		    						'piano_bangtime' => '',
		    						'piano_be'=>1,
		    						'piano_accs'=>1
		    				    );
    				$set1 = M("Piano")->where("piano_id='{$piano_id}' and piano_status='2'")->save($save_data);
    				//2、将绑该设备的用户解绑
    				$users = M("Shebei")->field("sb_userid")->where("sb_hao='{$find_piano['piano_bianhao']}'")->select();
    				$str = '';
    				foreach($users as $v){
    					$str .= $v['sb_userid'].',';
    				}
    				$str = rtrim($str,',');
    			
    				$set2 = M("Users")->where("id in ($str)")->setField('rz_status',2);
    				//3、将跟该设备提交的认证资料删除
    				$del = M("Shebei")->field("sb_userid")->where("sb_hao='{$find_piano['piano_bianhao']}'")->delete();
    				
    			   //4.将出库该设备id的出库单删除该设备id   			
    				$chukudan = M("Chukudan")->where("chu_hao like '%$piano_id%'")->select();
    				$old_piano_id = ','.$piano_id.',';
    				foreach($chukudan as $v){
    					$old_piano_ids = ','.$v['chu_hao'].',';
    					if(strpos($old_piano_ids,$old_piano_id) !== false){
    						$new_piano_ids = str_replace($old_piano_id,",",$old_piano_ids);
    						$new_piano_ids = trim($new_piano_ids,',');
    						
    						if($new_piano_ids == ''){
    							//删除该出库单
    							 M("Chukudan")->where("chu_id='{$v['chu_id']}'")->limit(1)->delete();
    						}else{
    							//修改设备id
    							 M("Chukudan")->where("chu_id='{$v['chu_id']}'")->setField('chu_hao',$new_piano_ids);
    						}
    					}
    				}
    				//5、添加日志

    				$add = M('Tuiku_log')->add(array(
						    						'log_piano_id' =>$piano_id ,
						    						'log_piano_hao' =>$find_piano['piano_bianhao'],
						    						'log_text' =>$info,
						    						'log_time' =>time(),
						    						'log_adminid' =>$cazuo_ren
						    				));
    				
    				if($set1 && $set2 && $del && $add){
    					M("Piano")->commit();
    					echo 1;exit;
    				}else{
    					echo '操作失败，请联系管理员';exit;
    				}
    			}	
    		}else{
    			echo '该设备未出库';exit;
    		}
    		
    	}
    	
    }
    //退库列表
    public function shebei_tuiku_list(){
    	$field = "a.username,l.*";
    	$join = "piano_admin as a on a.aid = l.log_adminid";
    	
    	$count = M("Tuiku_log as l")->field($field)->join($join)->count();
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
    	$list = M("Tuiku_log as l")->field($field)->join($join)->order('l.log_time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display();
    }
    public function shebei_tuiku_list_sou(){
    	$where = 'l.log_time > 0';
    	
    	$hao = trim($_POST['hao']);
    	if($hao){
    		$where .= " and l.log_piano_hao = '{$hao}'";
    		$this->assign('hao',$hao);
    	}
    	
    	$button = $_POST['button'];
    	if(empty($hao)){
    		//如果是点击页码发起的请求，则按只保存的条件搜索
    		if(!$button){
    			if($_SESSION['shebei_tuiku_list_sou']){
    				$where = $_SESSION['shebei_tuiku_list_sou'];
    			}
    		}
    	}
    	$_SESSION['shebei_tuiku_list_sou'] = $where;
    	
    	$field = "a.username,l.*";
    	$join = "piano_admin as a on a.aid = l.log_adminid";
    	 
    	$count = M("Tuiku_log as l")->field($field)->join($join)->where($where)->count();
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
    	$list = M("Tuiku_log as l")->field($field)->join($join)->where($where)->order('l.log_time DESC')
    	                           ->limit($Page->firstRow.','.$Page->listRows)->select();
    	 
    	$this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display('shebei_tuiku_list');
    }

  public function del_weichu(){
    $pid = I("pid");

    if($_SESSION['piano_user']['role']==1){
        $a = M('piano')->where("piano_id = '$pid'")->delete();
        if($a){
          echo 1;exit;
        }else{
          echo "删除失败，请与管理员联系";exit;
        }
    }else{
      echo "无权限操作";exit;
    }

  }

  public function aaa($stime,$etime){
    $time = [];
    if($etime){
    $now = strtotime($etime);}else{$now = time();}
    if($stime){
    $num = (strtotime($etime)-strtotime($stime))/86400;}else{$num=14;}
    for($i = $num ;$i >0;$i--){
        $secondsOneDay = 60 * 60 * 24 * $i;
        $yesterday = $now - $secondsOneDay;
        $time[]= mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday));

        $time_name[] = date('d',mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday)));
    }

    $time[] = $now;
    if($etime){
        $lastoneday=strtotime($etime);
    }else{
        $lastoneday=time();
    }
    $time_name[] = date('d',$lastoneday);
    $time_name = implode(',',$time_name);

    // 当天时间0点
    $y = date("Y");
    $m = date("m");
    $d = date("d");
    $todayTime = mktime(0,0,0,$m,$d,$y);
    $arr['time'] = $time;
    $arr['time_name'] = $time_name;
    $arr['todayTime'] = $todayTime;

    return $arr;
    }

  public function shebei_sell_record(){
    $stime01=$_REQUEST['stime01'];
    $this->assign('stime01',$stime01);
    $etime01=$_REQUEST['etime01'];
    $this->assign('etime01',$etime01);
    $redata01=$this->aaa($stime01,$etime01);
    // 用户总数
    $user = M('Piano');
    
  
    foreach($redata01['time'] as $k =>$v){

        $time1 = date('Y-m-d 00:00:00',$v);
        $time2 = date('Y-m-d 23:59:59',$v);
       
        $arrall = $user->where("piano_outtime <= '$time2' and piano_outtime >= '$time1' and piano_status='2'")->count();

         //dump($arrall);exit;
        if(empty($arrall)){
            $list[] = 0;
        }else{
            $list[] = $arrall;
        }
        $begin=$v;
    }
   
    $ye = date('Y-m-d 00:00:00',strtotime("-1 day"));
    $tom = date('Y-m-d 23:59:59',strtotime("-1 day"));
   // echo $ye;exit;

    $count = $user->where("piano_outtime >= '$ye' and piano_outtime <= '$tom' and piano_status='2'")->count();
    
    $list_max = array_search(max($list), $list);
    $list_max = $list[$list_max];
    $list = implode(',',$list);
   

    $this->assign('count',$count); // 当日值
    $this->assign('list',$list);// 数值
    $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

    $this->assign('time_name',$redata01['time_name']);
  

    $this->display();
  }



  public function bbb($stime,$etime){
        $time = [];
        $now = date('m',time());

        for($i = 12 ;$i >0;$i--){
            $secondmonth = $i;
            $firstmonth = $now -  $secondmonth ;

            if($firstmonth <= 0){
                $firstmonth = 12+ $firstmonth;
            }
            $time_name[] = $firstmonth;
        }

        // $lastoneday=date('m',time());
        
        // $time_name[] = $lastoneday;
        $time_name = implode(',',$time_name);

        $arr['time_name'] = $time_name;
        return $arr;
    
  }


  public function shebei_month_record(){
     $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->bbb($stime01,$etime01);
      
        // 用户总数
        $user = M('Piano');
        $a = explode(',',$redata01['time_name']);
        foreach($a as $k => $v){
            if($v ==1){
                $stime = date('Y-01-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==2){
                $stime = date('Y-02-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==3){
                $stime = date('Y-03-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==4){
                $stime = date('Y-04-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==5){
                $stime = date('Y-05-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==6){
                $stime = date('Y-06-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==7){
                $stime = date('Y-07-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==8){
                $stime = date('Y-08-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==9){
                $stime = date('Y-09-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==10){
                $stime = date('Y-19-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==11){
                $stime = date('Y-11-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
            if($v ==12){
                $stime = date('Y-12-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:59', strtotime("$stime +1 month -1 day"));
            }
           
            $b = $user->where("piano_outtime >= '$stime' and piano_outtime <= '$etime' and piano_status='2'")
                      ->count();
                
       
            if(empty($b)){
                $list[] = 0;
            }else{
                $list[] = $b;
            }
            $begin=$v;
        }
    
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);

        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值
        $this->assign('time_name',$redata01['time_name']);
      

        $this->display('');
        
  	}


  	public function show_goods_list(){
  		
  		$status = I('status')?I('status'):1;
  		$this->assign('status',$status);

  		if($_SESSION['piano_user']['role'] != 1){
  			$id = $_SESSION['piano_user']['jx_jigou'];
  			$where = "piano_status= '2' and piano_outid = '$id' and piano_accs = '$status'";
  		}else{
  			$where ="piano_status = '2' and piano_accs = '$status'";
  		}
  		$join1 = 'piano_dealers on piano_dealers.jxid = piano_piano.piano_outid';
  		if($status == 2){
  			$join2 = 'piano_sell on piano_sell.s_hao = piano_piano.piano_bianhao';
  		}

  		$count = M('Piano')->where($where)->join($join1)->join($join2)->count();
  		//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

    	$a = M('Piano')->where($where)
    	               ->order('piano_id DESC')
    	               ->join($join1)
    	               ->join($join2)
    	               ->limit($Page->firstRow.','.$Page->listRows)
    	               ->select();
    	               // dump($a);exit;
    	$this->assign('page',$show);
    	$this->assign('list',$a);
    	if($_SESSION['piano_user']['role'] == 1){
    		$this->display('show_goods_list1');
    	}else{
    		$this->display();
    	}
    	
  	}

  	public function goods_list_sou(){
  		$status = I('status')?I('status'):1;
  		$this->assign('status',$status);

  		if($_SESSION['piano_user']['role'] != 1){
  			$id = $_SESSION['piano_user']['jx_jigou'];
  			$where = "piano_status= '2' and piano_outid = '$id' and piano_accs = '$status'";
  		}else{
  			$where ="piano_status = '2' and piano_accs = '$status'";
  		}
  		$join1 = 'piano_dealers on piano_dealers.jxid = piano_piano.piano_outid';
  		if($status == 2){
  			$join2 = 'piano_sell on piano_sell.s_hao = piano_piano.piano_bianhao';
  		}


  		$hao = trim($_POST['hao']);
    	if($hao){
    		$where .= " and piano_piano.piano_bianhao = '{$hao}'";
    		$this->assign('hao',$hao);
    	}
    	
    	$button = $_POST['button'];
    	if(empty($hao)){
    		//如果是点击页码发起的请求，则按只保存的条件搜索
    		if(!$button){
    			if($_SESSION['goods_list_sou']){
    				$where = $_SESSION['goods_list_sou'];
    			}
    		}
    	}
    	$_SESSION['goods_list_sou'] = $where;

  		$count = M('Piano')->where($where)->join($join1)->join($join2)->count();
  		//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

    	$a = M('Piano')->where($where)
    	               ->order('piano_id DESC')
    	               ->join($join1)
    	               ->join($join2)
    	               ->limit($Page->firstRow.','.$Page->listRows)
    	               ->select();
    	               // dump($a);exit;
    	$this->assign('page',$show);
    	$this->assign('list',$a);
    	if($_SESSION['piano_user']['role'] == 1){
    		$this->display('show_goods_list1');
    	}else{
    		$this->display('show_goods_list');
    	}
  	}


  	public function goods_chuku(){
  		
		//勾选设备信息
		$pid = trim(I('pid'),',');
		
		
		$list = M("Piano")->where("piano_id in ($pid)")->select();
		$this->assign('list',$list);
				
		$this->display();
  	}


  	public function add_goods(){
  		if(IS_POST){
			if($_SESSION['piano_user']['role'] == 1){
				echo '无权限操作';exit;
			}
			$ids = $_POST['ids'];//选中的设备id
			if(empty($ids)){
				echo '请勾选需要出库的设备';exit;
			}
			$ids = implode(',',$ids);
			
		
			$lianxi = trim($_POST['lianxi']);//联系人
			if(empty($lianxi)){
				echo '请输入客户姓名';exit;
			}
			$xiaoshou = trim($_POST['xiaoshou']);
			if(empty($xiaoshou)){
				echo '请输入销售人员姓名';exit;
			}

			$mobile = trim($_POST['mobile']);//联系电话
			if(!$this->ckeck_mobile($mobile)){
				echo '请输入有效的手机号';exit;
			}
			
			$pro = $_POST['location_p'];
			$city = $_POST['location_c'];
			$area = $_POST['location_a'];
			if($area == '请选择'){
				echo '请选择代理区域到最后一级';exit;
			}
			$address = trim($_POST['address']);
			if(empty($address)){
				echo '请输入详细的收货地址';exit;
			}
			
			$a = M('Piano')->where("piano_id in ($ids)")->select();

			foreach ($a as $k => $v){
				$hao = 0;
				$hao = $v['piano_bianhao'];
				
				//1.新增出库单
				$chukudan_data = array(
								    's_hao' => $hao,
									's_time' => date('Y-m-d H:i:s',time()),
									's_payer' => $xiaoshou,
									's_buyer' => $lianxi,
									's_phone' => $mobile,
									's_pro' => $pro,
									's_city' => $city,
									's_area' => $area,
									's_address' => $address
				                );
				

				M("Sell")->add($chukudan_data);
			}
			//2.修改设备流通状态	
			$set = M("Piano")->where("piano_id in ($ids)")->setField('piano_accs',2);
			
			if($set){
				echo 1;exit;
			}else{
				echo '操作失败,请联系管理员~';exit;
			}
 			//var_dump($_POST);exit;
		}
  	}


	public function sell_daochu(){
		$id = $_SESSION['piano_user']['jx_jigou'];

		$a = M('Piano')->where("piano_outid = '$id' and piano_accs = '2'")
					   ->join('piano_sell on piano_sell.s_hao = piano_piano.piano_bianhao')
		               ->select();


		foreach ($a as $k => $v) {
			if($v['piano_main_use'] == 1){
				$v['piano_main_use'] = '教学产品';
			}else{
				$v['piano_main_use'] = '普通产品';
			}


			$b[$k] = array('1'=>$v['sell_id'],'2'=>$v['s_hao'],'3'=>$v['piano_main_use'],
				           '4'=>1,'5'=>$v['s_buyer'],'6'=>$v['s_phone'],'7'=>$v['s_payer'],
				           '8'=>$v['s_pro'].$v['s_city'].$v['s_area'].$v['s_address'],
				           '9'=>$v['s_time']);
		}

		$title = array('ID','商品名称','型号','数量','客户名称','联系电话','销售员','发货地址','出库时间');
        $this->exportexcel($b,$title,$filename = '商品列表');	          
	}



	public function sell_back(){
		$hao = I('hao');
		$a = M('Sell')->where("s_hao = '$hao'")->find();

		$this->assign('list',$a);
		$this->display();
		

	}

	
	public function show_goods_back(){
		$field = "a.username,l.*";
    	$join = "piano_admin as a on a.aid = l.log_adminid";
    	$id = $_SESSION['piano_user']['aid'];
    	$count = M("Tuiku_log as l")->join($join)->where("log_adminid = '$id'")->count();
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
    	$list = M("Tuiku_log as l")->field($field)
    	                           ->join($join) 
    	                           ->where("log_adminid = '$id'")
    	                           ->order('l.log_time DESC')
    	                           ->limit($Page->firstRow.','.$Page->listRows)
    	                           ->select();
    	
    	$this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display();

	}

	public function goods_back_sou(){
		$id = $_SESSION['piano_user']['aid'];
		$where = "l.log_time > 0 and l.log_adminid = '$id'";
    	
    	$hao = trim($_POST['hao']);
    	if($hao){
    		$where .= " and l.log_piano_hao = '{$hao}'";
    		$this->assign('hao',$hao);
    	}
    	
    	$button = $_POST['button'];
    	if(empty($hao)){
    		//如果是点击页码发起的请求，则按只保存的条件搜索
    		if(!$button){
    			if($_SESSION['shebei_tuiku_list_sou']){
    				$where = $_SESSION['shebei_tuiku_list_sou'];
    			}
    		}
    	}
    	$_SESSION['shebei_tuiku_list_sou'] = $where;
    	
    	$field = "a.username,l.*";
    	$join = "piano_admin as a on a.aid = l.log_adminid";
    	 
    	$count = M("Tuiku_log as l")->field($field)->join($join)->where($where)->count();
    	//实例化分页类
    	$Page = new \Think\Page($count,$this->pagenum);
    	//设置上一页与下一页
    	$Page->setConfig('prev', '上一页');
    	$Page->setConfig('next', '下一页');
    	$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
    	//显示分页信息
    	$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
    	$list = M("Tuiku_log as l")->field($field)->join($join)->where($where)->order('l.log_time DESC')
    	                           ->limit($Page->firstRow.','.$Page->listRows)->select();
    	 
    	$this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display('shebei_tuiku_list');


	}

	public function shebei_xiugai(){
		
		$id = I('id');
		$hao = I('hao');
		$main = I('main');
		$lianxi = I('lianxi');
		$mobile = I('mobile');
		$xiaoshou = I('xiaoshou');
		$pro = I('location_p');
		$city = I('location_c');
		$area = I('location_a');
		$address = I('address');
		$jxid = I('jxid');
		if($pro == '请选择'){
			$pro ='';
		}
		if($city == '请选择'){
			$city ='';
		}
		if($area == '请选择'){
			$area ='';
		}

		$c = M('Piano')->where("piano_bianhao = '$hao'")->find(); //查该序列号对应的信息
		if($main != $c['piano_main_use']){
			$g = M('Piano')->where("piano_bianhao = '$hao'")->setField('piano_main_use',$main);
		}

		if($jxid != $c['piano_outid']){  //是否是原出库对象
			$data['chu_hao'] = $hao;
			$data['chu_addtime'] = date('Y-m-d H:i:s',time());  //给单一个号新增一个出库记录		

			$a = M('Chukudan')->where("chu_id = '$id'")->find();	//查原单的出库设备
			$b = M('Piano')->where("piano_bianhao = '$hao'")->getField('piano_id'); //序列号ID

			$result=strstr($a['chu_hao'],$b); 
			//查找$a中是否包含$b,没有的话$result=false ，有就把从$b开始到$a结尾的所有字符全部输出
			
			if($result == $b){
				$str = str_replace($b,"",$a['chu_hao']);
				$str = rtrim($str, ",");
			}else{
				$str = str_replace($b.",","",$a['chu_hao']);
				//第一个是被替换的字符，第二个是替换它的字符，第三个是从哪个语句中执行
			}         
			
			M('Chukudan')->where("chu_id = '$id'")->setField('chu_hao',$str);
			//原有的记录，把这个被更改的序列号踢掉

			$h = M('Piano')->where("piano_bianhao = '$hao'")
			               ->setField('piano_outid',$jxid);//修改出库对象
	
			$a = M('Chukudan')->where("chu_id = '$id'")->find();	

			$data['chu_hao'] = $b;   //被更改的序列号，新增一个记录
			$data['chu_user'] = $lianxi;
			$data['chu_mobile'] = $mobile;
			$data['chu_payer'] = $xiaoshou;
			$data['chu_pro'] = $pro;
			$data['chu_city'] = $city;
			$data['chu_area'] = $area;
			$data['chu_address'] = $address;
			$data['chu_creater'] = $_SESSION['piano_user']['aid'];
			$data['chu_outid'] = $jxid;
			if($data){
				if(M('Chukudan')->where("chu_hao like '%$hao%'")->find()){
					$b = M('Chukudan')->where("chu_hao = '$hao'")->save($data);
				}else{
					$b = M('Chukudan')->add($data);
				}
				
				if($b){
					echo 1;exit;
				}else{
					echo '修改失败';exit;
				}
			}else{
				echo '没有要修改的信息';exit;
			}

		}else{
			$a = M('Chukudan')->where("chu_id = '$id'")->find();	
			if($lianxi != $a['chu_user']){
				$data['chu_user'] = $lianxi;
			}
			if($mobile != $a['chu_mobile']){
				$data['chu_mobile'] = $mobile;
			}	
			if($xiaoshou != $a['chu_payer']){
				$data['chu_payer'] = $xiaoshou;
			}	
			if($pro != $a['chu_pro']){
				$data['chu_pro'] = $pro;
			}	
			if($city != $a['chu_city']){
				$data['chu_city'] = $city;
			}	
			if($area != $a['chu_area']){
				$data['chu_area'] = $area;
			}	
			if($address != $a['chu_address']){
				$data['chu_address'] = $address;
			}	
			
			if($data || $h || $g){
				$b = M('Chukudan')->where("chu_id = '$id'")->save($data);
				if($b){
					echo 1;exit;
				}else{
					echo '修改失败';exit;
				}
			}else{
				echo '没有要修改的信息';exit;
			}
		}
	}


	











}