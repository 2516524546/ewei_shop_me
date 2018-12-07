<?php
/*用户、老师、学生管理
 * */
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {

    //用户详情
    public function user_xiang(){
        $id = I('id');
        $user = M('u_user')->where("user_id = '{$id}'")->find();
        $this->assign('user',$user);
        $this->display();
    }

    public function user_del(){
        $id = I('id');
        $user = M('u_user')->where("user_id = '{$id}'")->find();
        $res=M('u_user')->where("user_id = '{$id}'")->delete();
        if ($res){
            //删除图片
            unlink("./Uploads/".$user['user_icon']);
            echo 1;
        }else{
            echo L('newworld_ajax_operation_fail');
        }
    }

    public function user_edit(){
        if (IS_POST){
              $post=$_POST;
            $where['user_id'] = $post['user_id'];
            if (!preg_match_all("/([a-z0-9_\-\.]+)@(([a-z0-9]+[_\-]?)\.)+[a-z]{2,3}/i",$post['user_mail'])){
                echo L('newworld_email_illegal');
                exit;
            }
            $result = M("u_user")->where($where)->save($post);
            if($result != false){
                echo 1;
            }else{
                echo L('newworld_ajax_operation_fail');
            }
        }else{
            $id = I('id');
            $user = M('u_user')->where("user_id = '{$id}'")->find();
            $this->assign('user',$user);
            $this->display();
        }
    }
	//搜用户
	public function user_list_sou(){
		$where = "user_logintime > '0'";
		
		$nickname = trim($_POST['nickname']);
		if($nickname){
			$where .= " and user_name like '%$nickname%'";
			$this->assign('nickname',$nickname);
		}
		
		$id = trim($_POST['id']);
		if($id){
			$where .= " and user_id like '%$id%'";
			$this->assign('id',$id);
		}
		
		$email= trim($_POST['email']);
		if($email){
            $where .= " and user_mail like '%$email%'";
			$this->assign('email',$email);
		}
		
	   /*$stime = trim($_POST['stime']);
	   if($stime){
     		$where .= " and UNIX_TIMESTAMP(add_time) >= UNIX_TIMESTAMP('$stime 00:00:00')";
     		$this->assign('stime',$stime);
     	}
     	 
     	$etime = trim($_POST['etime']);
     	if($etime){
     		$where .= " and UNIX_TIMESTAMP(add_time) <= UNIX_TIMESTAMP('$etime 23:59:59')";
     		$this->assign('etime',$etime);
     	}
		*/
     	$button = $_POST['button'];
     	if(empty($nickname) && empty($id) && empty($email)){
     		//如果是点击页码发起的请求，则按只保存的条件搜索
     		if(!$button){
     			if($_SESSION['user_list_sou']){
     				$where = $_SESSION['user_list_sou'];
     			}
     		}
     	}
     	$_SESSION['user_list_sou'] = $where;

		$count = M("u_user")->where($where)->count();
        // dump(M("Users")->getLastSql());exit;
		//实例化分页类

		$Page = new \Think\Page($count,$this->pagenum);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("u_user")->where($where)->limit($Page->firstRow.','.$Page->listRows)->order("user_id DESC")->select();

		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display('user_list');
	}
    //用户列表
	public function user_list(){
		$count = M("u_user")->count();
		//实例化分页类

		$Page = new \Think\Page($count,$this->pagenum);
      //  $Page = new \Think\Page($count,20);
		//设置上一页与下一页
		$Page->setConfig('prev', '上一页');
		$Page->setConfig('next', '下一页');
		$Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
		//显示分页信息
		$show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
		
		$list = M("u_user")->limit($Page->firstRow.','.$Page->listRows)->order("user_id DESC")->select();

		/*foreach($list as $k=>$v){
            if($v['role']==2){
                $a = M('Teacher')->field("piano_dealers.jx_name,piano_dealers.jxid")
                                 ->join('piano_dealers on piano_dealers.jxid = piano_teacher.t_jxid')
							     ->where("t_userid = '$v[id]'")
							     ->find();  //查找角色为老师的信息
                if($a){
                	$list[$k]['jxid'] = $a['jxid'];
	                $list[$k]['jx_name'] = $a['jx_name'];
                }
            }
		}*/

  
		$this->assign('list',$list);
		$this->assign('page',$show);
        $this->display();
    }


    //标签管理
    public function tag_list(){

        $count = M("s_second_mark")->join('s_first_mark f on s_second_mark.second_mark_fid = f.first_mark_id and f.first_mark_type != 0 and f.first_mark_type != 3 and f.first_mark_type != 4','INNER')->join('s_module m on f.first_mark_mid = m.module_id','INNER')->count();
        //实例化分页类

        $Page = new \Think\Page($count,$this->pagenum);
        //  $Page = new \Think\Page($count,20);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $list = M("s_second_mark")->join('s_first_mark f on s_second_mark.second_mark_fid = f.first_mark_id and f.first_mark_type != 0 and f.first_mark_type != 3 and f.first_mark_type != 4','INNER')->join('s_module m on f.first_mark_mid = m.module_id','INNER')->limit($Page->firstRow.','.$Page->listRows)->order("second_mark_istag DESC")->select();

        $this->assign(array(
            'list' => $list,
            'page' => $show,
        ));
        $this->display();

    }

    public function ajax_tag_list_set(){
        if (IS_POST) {

            if ($_POST['tagtype'] == 1){
                $count = M("s_second_mark")->where('second_mark_istag = 1')->field('count(*) num')->find()['num'];
                if($count>=10){
                    die(json_encode(array('str' => 0, 'msg' => L('Tag_list_max'))));
                }
            }else{
                $count = M("s_second_mark")->where('second_mark_istag = 1')->field('count(*) num')->find()['num'];
                if($count<=1){
                    die(json_encode(array('str' => 0, 'msg' => L('Tag_list_min'))));
                }
            }
            $data = array(
              'second_mark_istag' => $_POST['tagtype'],
            );
            $res = M("s_second_mark")->where('second_mark_id = '.$_POST['id'])->save($data);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => L('Tag_list_set_success'))));
            }else{
                die(json_encode(array('str' => 0, 'msg' => L('Tag_list_set_fail'))));
            }

        } else {

            die(json_encode(array('str' => 0, 'msg' => L('newworld_ajax_havenoing'))));
        }
    }


}

