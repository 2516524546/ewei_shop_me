<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
public function login(){
		if(IS_POST){
			
			if($_POST['username']){
				$data['username'] = trim($_POST['username']);
			}else{
				echo '用户名不能为空';exit;
			}
			if($_POST['password']){
				$data['pwd'] = md5(MA.trim($_POST['password']));	
			}else{
				echo '密码不能为空';exit;
			}
			if(empty($_POST['check'])) {
				echo '验证码不能为空';exit;
				exit;
			}
			 if(empty($_POST['check'])) {
				echo '验证码不能为空';exit;
				exit;
			}
			//创建验证码对象
			$verify = new \Think\Verify();
			if(!$verify->check($_POST['check'])) {
			
				echo 2;exit;
			}

			$admin = D('piano_admin');

			$list = $admin->where("username='{$data['username']}' and pwd='{$data['pwd']}'")->find();

			
			if($list){
				
				if(empty($list['m_cid'])){
					echo '账号无权限,请联系管理员~';exit;
				}
				if($list['status'] == 2){
					echo '您的账号已被禁用,请联系管理员~';exit;
				}
			
				//修改时间和ip
				$admin->where("username='{$data['username']}' and pwd='{$data['pwd']}'")->save(array('login_time'=>date('Y-m-d H:i:s',time()),'login_ip'=>$_SERVER['REMOTE_ADDR']));
				session('piano_user',$list);
				echo 1;exit;
			
			}else{
				echo '账号密码错误';exit;
			}
		}
		$this->display();
	}
	//定义verify方法实现生成验证码
	public function verify() {
		//导入命名空间，生成验证码对象
		$verify = new \Think\Verify();
		//自定义验证码属性
		//设置显示字体
		$verify->codeSet = '1234567890';
		//是否使用图片背景
		$verify->useImgBg = false;
		//是否使用混淆曲线
		$verify->useCurve = true;
		//是否使用杂点
		$verify->useNoise = false;
		//验证码位数
		$verify->length = 5;
		//设置字体
		$verify->fontttf = '4.ttf';
		//设置字体大小
		$verify->fontSize = 15;
		//兼容处理
		ob_clean();
		//生成验证码
		$verify->entry();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}