<?php 
namespace Admin\Controller;
use Think\Controller;
class FileController extends Controller {
	//上传题目文件
	public function uploadTimu(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*20;// 设置附件上传大小
			$upload->exts      =     array('xml');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/Timu/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
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
	/*上传文件
	 * */
	
	public function uploadfile(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*20;// 设置附件上传大小
			$upload->exts      =     array('xml', 'mxl', 'mp3');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/Songs_file/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
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

	/**
	 * 上传琴行图片
	 * @author huajie <banhuajie@163.com>
	 */
	public function uploadDomPicture(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/dom/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
	
	
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
	/**
	 * 上传图片
	 * @author huajie <banhuajie@163.com>
	 */
	public function uploadPicture(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
	    	$upload->rootPath  =     './Public/Uploads/Songs/'; // 设置附件上传根目录

	    	if(!is_dir($upload->rootPath)) {
	    		mkdir($upload->rootPath, 0777, true);
	    	}
			$info   =   $upload->uploadOne($_FILES['download']);
				
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
				
		    
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
	/**
	 * 上基乐理材料
	 * @author huajie <banhuajie@163.com>
	 */
	public function uploadMusicCaiLiao(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*20;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg','mp4','mp3');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/m_cailiao/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
	
	
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
	
	/**
	 * 上传轮播图片
	 * @author huajie <banhuajie@163.com>
	 */
	public function uploadBanner(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/Banner/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
	
	
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
	

	/**
	 * 上传教师图片
	 * @author huajie <banhuajie@163.com>
	 */
	public function upload_teacher(){
		if($_REQUEST['sessionid']){//判断用户是否登录
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     1024*1024*5;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->saveName = time().'_'.mt_rand(10000,99999);;
			$upload->rootPath  =     './Public/Uploads/teacher/'; // 设置附件上传根目录
	
			if(!is_dir($upload->rootPath)) {
				mkdir($upload->rootPath, 0777, true);
			}
			$info   =   $upload->uploadOne($_FILES['download']);
	
			/* //获取图片的信息
			 $img =  getimagesize ('./Public/Uploads/'.$info['myphoto']['savepath'].$info['myphoto']['savename']);
			list($a,$width,$b,$height) = preg_split('/["]+/is',$img[3]);
			//像素
			if(!($width == WDH && $height==HGT)){
			//要设置宽高比
			echo 5;exit;
			} */
	
	
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