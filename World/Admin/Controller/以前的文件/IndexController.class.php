<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {

	public function index(){

        $this->display('frame');
    }
    public function top(){
    	$this->display();
    }
    public function right(){
    	$this->display('user_list');
    }
    public function left(){
    	
    	$m_pids = explode(',',$_SESSION['piano_user']['m_pid']);  //session里存有用户的父级权限字段
        $m_cid = $_SESSION['piano_user']['m_cid'];   //全部权限字段
        
    	foreach($m_pids as $k=>$val){
    		$menus[$k]['m_name'] = M('piano_admin_menu')->where("mid='{$val}'")->find()['m_name'];	//找出字段的名字
    		$menus[$k]['child'] = M('piano_admin_menu')->where("m_parentid='{$val}' and mid in ({$m_cid})")->select();
    	}
    	
    	
    	$this->assign('menus',$menus);
    	
    	$this->display();
    }
    public function shouye(){
    	$this->display();
    }
   
    
    
    
    
    //退出登录
    public function log_out(){
    	//清楚session
    	session('piano_user',null);
    	session_unset();
    	 //销毁所有session
    	session_destroy();
    	$this->redirect('Admin/Login/login');
    
    }

     public function del_reply(){
        $eid = I('get.eid');
        $list = M("Songs_error")->order('e_addtime DESC')
                                ->limit($Page->firstRow.','.$Page->listRows)
                                ->join("piano_songs_list on piano_songs_list.lid = piano_songs_error.e_lid")
                                ->join('piano_songs on piano_songs.sid = piano_songs_list.list_sid')
                                ->where(array('piano_songs_error.eid'=>$eid))
                                ->select();
        $this -> assign("list",$list);
        $this -> display();
    }

    public function tuisong(){
        $value = session();
        $eid = I('get.eid');
        M('Room')->startTrans();//开启事物
        $data = I('post.');
        $content = $data['x_content'];
        $data['x_tuisong'] = $value['piano_user']['aid'];//推送方ID
        $data['x_time'] = date('Y-m-d H:i:s',time());//推送时间
        $data['x_type'] = 6;
        $c = M('Token')->where("t_userid = '$data[x_userid]'")->find();//预约者登录token信息
        $d = M('User_xiaoxi')->add($data);
        if($c['t_shebei'] && $c['t_leixin']){
            if($c['t_leixin'] == 2){
                
                $f= $this->ios_msg_send($content,$c['t_shebei'],$data['x_userid']);
                
            }else{
                $f = $this->message_tuisong($content,$c['t_shebei'],$c['t_leixin'],$data['x_userid']);
            }
            
        }   
        if($d){
            M('Room')->commit();
            M('Songs_error')->where("eid = '$eid'")->setField('e_type',1);
           $this -> redirect('Index/show_wrong_songs');
        }else{
            M('Room')->rollback();
                       $this -> redirect('Index/show_wrong_songs');
        }
    }


    public function show_wrong_songs(){
        $status = I('status');
        $this->assign('status',$status);
       
        if($status == 1){
            $where = "e_type != '4'";
        }elseif($status == 2){
            $where = "e_type = '1'";
        }else{
            $where = "e_type = '0'";
        }

        $count = M("Songs_error")->where($where)->count();

        $Page = new \Think\Page($count,$this->pagenum);
  
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $show = $Page->show();



        $list = M("Songs_error")->order('e_addtime DESC')
                                ->limit($Page->firstRow.','.$Page->listRows)
                                ->where($where)
                                ->join("piano_songs_list on piano_songs_list.lid = piano_songs_error.e_lid")
                                ->join('piano_songs on piano_songs.sid = piano_songs_list.list_sid')
                                ->select();

        $this->assign('list',$list);
        $this->assign('page',$show);
        $this->display();
    }
    


    public function del_wrong_songs(){
        $id = I("ids");
      
        if(is_array($id)){
            $a = array();
            foreach ($id as $k => $v) {
                $a[$k] = M("Songs_error")->where("eid  = '$v'")->delete();
            }
            if($a){
                echo 1;exit;
            }else{
                echo "wrong!";exit;
            }
        }else{
           
            $a = M("Songs_error")->where("eid  = '$id'")->delete();
            if($a){
                echo 1;exit;
            }else{
                echo "wrong!";exit;
            }

        }
        
       
    }





}