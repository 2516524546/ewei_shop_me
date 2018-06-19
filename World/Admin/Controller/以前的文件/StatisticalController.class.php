<?php
namespace Admin\Controller;
use Think\Controller;
class StatisticalController extends CommonController
{
    protected $todayTime;
    protected $time_name;
    protected $time;

    /**
     * 后台数据统计管理
     * @access public
     * @return  Array
     */

    public function _initialize()
    {
        // 当前到前十四天的时间
        $time = [];
        $now = time();
        for($i = 14 ;$i >0;$i--){
            $secondsOneDay = 60 * 60 * 24 * $i;
            $yesterday = $now - $secondsOneDay;
            $this->time[]= mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday));

            $time_name[] = date('d',mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday)));
        }

        $this->time[] = $now;
        $time_name[] = date('d',time());
        $this->time_name = implode(',',$time_name);

        // 当天时间0点
        $y = date("Y");
        $m = date("m");
        $d = date("d");
        $this->todayTime = mktime(0,0,0,$m,$d,$y);
    }
    public function aaa($stime,$etime)
    {
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

    // 总体数据
    public function get_user()
    {
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
        // 用户总数
        $user = M('Users');
        
      
        foreach($redata01['time'] as $v){

            $arrall = $user->where("UNIX_TIMESTAMP(add_time) < {$v}")->count();
            if(empty($arrall)){
                $list[] = 0;
            }else{
                $list[] = $arrall;
            }
            $begin=$v;
        }
       
        $count = $user->count();
        
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);
        
        //饼状用户统计
        $total['total'] = M("Users")->count();
        $total['user'] = M("Users")->where("role='3'")->count();
        $total['student'] = M("Users")->where("role='1'")->count();
        $total['teacher'] = M("Users")->where("role='2'")->count();
        $this->assign('total',$total); // 当日值

        $this->assign('count',$count); // 当日值
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

        $this->assign('time_name',$redata01['time_name']);
      

        $this->display('Statistical/index1');
        
    }


// 总体数据
    public function get_student()
    {
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
        // 用户总数
        $user = M('Users');
        
      
        foreach($redata01['time'] as $v){

            $arrall = $user->where("UNIX_TIMESTAMP(add_time) < {$v} and role = 1")->count();
            // dump($arrall);exit;
            if(empty($arrall)){
                $list[] = 0;
            }else{
                $list[] = $arrall;
            }
            $begin=$v;
        }
       
        $count = $user->where("role = 1 ")->count();
        
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);
        

        $this->assign('count',$count); // 当日值
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

        $this->assign('time_name',$redata01['time_name']);
      

        $this->display('Statistical/index2');
        
    }


// 总体数据
    public function get_teacher()
    {
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
        // 用户总数
        $user = M('Users');
        
      
        foreach($redata01['time'] as $v){

            $arrall = $user->where("UNIX_TIMESTAMP(add_time) < {$v} and role = 2")->count();
            // dump($arrall);exit;
            if(empty($arrall)){
                $list[] = 0;
            }else{
                $list[] = $arrall;
            }
            $begin=$v;
        }
       
        $count = $user->where("role = 2 ")->count();
        
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);
        

        $this->assign('count',$count); // 当日值
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

        $this->assign('time_name',$redata01['time_name']);

        $this->display('Statistical/index3');
        
    }


    // 总体数据
    public function get_bang1()
    {
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
        // 用户总数
        $user = M('Users');
        
      
        foreach($redata01['time'] as $v){

            $arrall = $user->where("UNIX_TIMESTAMP(add_time) < {$v} and rz_status = 1")->count();
            // dump($arrall);exit;
            if(empty($arrall)){
                $list[] = 0;
            }else{
                $list[] = $arrall;
            }
            $begin=$v;
        }
       
        $count = $user->where("rz_status = 1 ")->count();
        
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);
        

        $this->assign('count',$count); // 当日值
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

        $this->assign('time_name',$redata01['time_name']);
      

        $this->display('Statistical/index4');
        
    }

// 绑定用户
    public function get_bang2()
    {
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
        // 用户总数
        $user = M('Users');
        
      
        foreach($redata01['time'] as $v){

            $arrall = $user->where("UNIX_TIMESTAMP(add_time) < {$v} and rz_status = 2")->count();
            // dump($arrall);exit;
            if(empty($arrall)){
                $list[] = 0;
            }else{
                $list[] = $arrall;
            }
            $begin=$v;
        }
       
        $count = $user->where("rz_status = 2 ")->count();
        
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
        $list = implode(',',$list);
        

        $this->assign('count',$count); // 当日值
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值

        $this->assign('time_name',$redata01['time_name']);
      

        $this->display('Statistical/index5');
        
    }


    public function user_daochu(){
        
        $stime = I('stime');
        if($stime){
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
        }
        $etime = I('etime');
        if($etime){
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
        }

        $a['u_num'] = M('Users')->where("add_time >= '$stime' and add_time < '$etime'")->count();
        $a['s_num'] = M('Users')->where("add_time >= '$stime' and add_time < '$etime' and role= '1'")->count();
        $a['t_num'] = M('Users')->where("add_time >= '$stime' and add_time < '$etime' and role= '2'")->count();
        $a['b_num'] = M('Users')->where("add_time >= '$stime' and add_time < '$etime' and rz_status= '1'")->count();
        $a['n_num'] = M('Users')->where("add_time >= '$stime' and add_time < '$etime' and rz_status= '2'")->count();

        $list[0] = array('1'=>$stime,'2'=>$etime,'3'=>$a['u_num'],'4'=>'用户');
        $list[1] = array('1'=>$stime,'2'=>$etime,'3'=>$a['s_num'],'4'=>'学生');
        $list[2] = array('1'=>$stime,'2'=>$etime,'3'=>$a['t_num'],'4'=>'教师');
        $list[3] = array('1'=>$stime,'2'=>$etime,'3'=>$a['b_num'],'4'=>'绑定用户');
        $list[4] = array('1'=>$stime,'2'=>$etime,'3'=>$a['n_num'],'4'=>'非绑定用户');
       // dump($list);exit;
        $title = array('起始时间','结束时间','人数','用户类型');
        // if(empty($list)){
        //     $title = iconv('utf-8','gbk',$title);
        // }
        $this->exportexcel($list,$title,$filename = '用户统计列表');
    }

   
}