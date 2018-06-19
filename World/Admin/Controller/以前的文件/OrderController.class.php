<?php 
namespace Admin\Controller;
use Think\Controller;
class OrderController extends IndexController {

    public function show_tixian_list(){  //提现审核

        
        $mod = I('mod')?I('mod'):3; 

        if($mod == 1){
            $where = "xf_type = '3' and xf_status = '1'";
            $kind = 1;
        }
        if($mod == 2){
            $where = "xf_type = '3' and xf_status = '2'";
            $kind = 2;
        }
        if($mod == 3){
            $where = "xf_type = '3' and xf_status = '3'";
            $kind = 3;
        }
       
        if($_SESSION['piano_users']['role'] == 1){
            
        }//6月，客户提出代理也能看到该列表，所以要加上代理商的视角，能看到属于代理商的部分

        $this->assign('kind',$kind);
        $this->assign('mod',$mod);
            
        $count = M("Xnb_record")->where($where)
                                ->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $join = 'piano_users on piano_users.id = piano_xnb_record.xf_userid';
        $a = M('Xnb_record')->where($where)
                            ->join($join)
                            ->order('xf_time DESC')
                            ->limit($Page->firstRow.','.$Page->listRows)
                            ->select();
                            // dump($a);
                            // die;
        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display();
    }

    
    public function tixian_list_sou(){
        $where = "xf_type = '3'";
        $kind = I('kind');
        
        if($kind){
            $where .=" and xf_status = '$kind'";
            $this->assign('kind',$kind);
            $this->assign('mod',$kind);
        }

        $name = $_POST['name'];
        if($name){    
            $where .=" and xf_turename like '%$name%'";
            $this->assign('name',$name);
        }
        
        $orderSn = trim($_POST['orderSn']);
        if($orderSn){
            $where .= " and xf_num = '$orderSn'";
            $this->assign('hao',$orderSn);
        }
        
        $stime = trim($_POST['stime']);
        if($stime){
            $this->assign('stime',$stime);
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
            $where .= " and xf_time >= '$stime'";
            
        }
        $etime = trim($_POST['etime']);
        if($etime){
            $this->assign('etime',$etime);
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= " and xf_time < '$etime'";
            
        }
    

        $button = $_POST['button'];
        if(empty($name) && empty($orderSn) && empty($stime) && empty($etime) && empty($kind)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['tixian_list_sou']){
                    $where = $_SESSION['tixian_list_sou'];
                }
            }
        }
        $_SESSION['tixian_list_sou'] = $where;
        $join = 'piano_users on piano_users.id = piano_xnb_record.xf_userid';

        $count = M("Xnb_record")->where($where)
                                ->join($join)
                                ->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

   
        $a = M('Xnb_record')->where($where)
                            ->join($join)
                            ->order('xf_time DESC')
                            ->limit($Page->firstRow.','.$Page->listRows)
                            ->select();

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display('show_tixian_list');
    }

//提现审核不通过
    public function show_up_tixian(){
        $id = I('id');
        $a = M('Xnb_record')->where("xf_id = '$id'")->find();

        $this->assign('user',$a);
        $this->display();
    }
//不通过，加原因

    public function up_tixian(){
        $id = I('id'); 
        $data['xf_text'] = I('text');
        $data['xf_status'] = 1;
        $orderSn = I('orderSn');
      
        M('Xnb_record')->startTrans();
        $a = M('Xnb_record')->where("xf_num = '$orderSn'")->save($data);
      
        $b = M('Xnb_record')->where("xf_num = '$orderSn'")->find();
        $c =  M('Users')->where("id = '$b[xf_userid]'")->getField('money');
        $max = bcadd($c, $b['xf_point']);
       
        $d = M('Users')->where("id = '$b[xf_userid]'")->setField('money',$max);
    
        if($a && $d){
            M('Xnb_record')->commit();
            echo 1;exit;
        }else{
            M('Xnb_record')->rollback();
            echo "操作失败，SQL错误";exit;
        }
    }

//提现审核
    public function tixian_shenhe(){
        $id = I('id');
        $a = M('Xnb_record')->where("xf_id = '$id'")->setField('xf_status',2);
            //然后后面的步骤 ，就是由财务人员手动去给用户打钱.....
        
        if($a){
            echo 1;exit;
        }else{
            echo "操作失败，请联系管理员";exit;
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

//充值记录列表
    public function show_chongzhi_list(){
        $mod = I('mod')?I('mod'):2;
        $this->assign('mod',$mod);

        $where = "xf_type = 1 and xf_status = '$mod'";
        $join = 'piano_users on piano_users.id = piano_xnb_record.xf_userid';

        $count = M("Xnb_record")->where($where)
                                ->join($join)
                                ->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        
        $a = M('Xnb_record')->where($where) 
                            ->join($join)
                            ->order('xf_time DESC')
                            ->limit($Page->firstRow.','.$Page->listRows)
                            ->select();

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display();
    }



    public function chongzhi_list_sou(){
        $mod = I('mod');
        $this->assign('mod',$mod);

        $where = "xf_type = 1 and xf_status = '$mod'";

        $name = I('name');
        if($name){    
            $where .=" and xf_turename like '%$name%'";
            $this->assign('name',$name);
        }
        
        $orderSn = trim($_POST['orderSn']);
        if($orderSn){
            $where .= " and xf_num = '$orderSn'";
            $this->assign('orderSn',$orderSn);
        }
        
        $stime = trim($_POST['stime']);
        if($stime){
            $this->assign('stime',$stime);
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
            $where .= " and xf_time >= '$stime'";
            
        }
        $etime = trim($_POST['etime']);
        if($etime){
            $this->assign('etime',$etime);
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= " and xf_time < '$etime'";
            
        }

    

        $button = $_POST['button'];
        if(empty($jxid) && empty($name) && empty($username) 
        && empty($stime) && empty($etime)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['chongzhi_list_sou']){
                    $where = $_SESSION['chongzhi_list_sou'];
                }
            }
        }
        $_SESSION['chongzhi_list_sou'] = $where;
        $join = 'piano_users on piano_users.id = piano_xnb_record.xf_userid';


        $count = M("Xnb_record")->where($where)
                                ->join($join)
                                ->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
   
        $a = M('Xnb_record')->where($where)
                            ->join($join)
                            ->order('xf_time DESC')
                            ->limit($Page->firstRow.','.$Page->listRows)
                            ->select();

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display('show_chongzhi_list');

    }

    public function show_chongzhi_add(){
        $this->display();     
    }

    public function new_order_num(){
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn = $yCode[(intval(date('Y')) - 2000)%10] .$_SESSION['piano_user']['id'].substr(time(), -5).
                           strtoupper(dechex(date('m'))) .date('d') .dechex(date('ym')). 
                           rand(100,999). substr(microtime(),2,5) . 
                           sprintf('%02d', rand(10, 99));
        $a = M('Xnb_record')->where("xf_num = '$orderSn'")->find();
        if($a){
            $this->new_order_num();
        }
        return $orderSn;exit;
    }


//新增充值记录
    public function add_record(){
        $phone = I('phone');
        $data['xf_turename'] = I('nickname');
        $data['xf_phone'] = I('phone');
        $data['xf_userid'] = I('id');
        $data['xf_num'] = $this->new_order_num();
        $data['xf_status'] = 2;
        $data['xf_money'] = I('money');
        $a = M('Convert')->where("c_money <= '$data[xf_money]'")->order('convert_id DESC')->find();
        $b = bcdiv($data['xf_money'],$a['c_money'],2);
        $data['xf_point'] = bcmul($b,$a['c_point'],1);       
        $data['xf_time'] = date('Y-m-d H:i:s',time());
        $data['xf_acc'] = I('acc');
        $data['xf_kind'] =I('kind');
        $data['xf_text'] = I('text').'|| 后台操作:'.$_SESSION['piano_user']['username'];

        if($data['xf_money'] && $data['xf_acc'] &&  $data['xf_kind']){
            $b = M('Xnb_record')->add($data);
            $money = M('Users')->where("id = '$data[xf_userid]'")->getField('money');
            $newmoney = bcadd($money,$data['xf_point'],1);
            M('Users')->where("id = '$data[xf_userid]'")->setField('money',$newmoney);//用户乐币增加
            if($b){
                echo 1;exit;
            }else{
                echo "记录失败，SQL错误";exit;
            }
        }else{
            echo "缺少参数";exit;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
 
    public function show_order_add(){

        $orderSn = $this->new_order_num();
        $this->assign('orderSn',$orderSn);
        $this->display();
    }


    public function add_order(){
       //  var_dump($_POST);
        $data['go_username'] = I('turename');
        $data['go_phone'] = I('phone');
        $data['go_name'] = I('good_name');           
        $data['go_number'] = I('num');
        $data['go_price'] = I('price');        //单价
        $data['go_type'] = 1;                  //购买商品
        $data['go_money'] = I('money');        //总金额
        $data['go_kind'] = I('kind');          //1 现金  2非现金
        $data['go_status'] = 2;                //这种记录，默认是已付款
        $data['go_num'] = I('orderSn');
        $data['go_time'] = I('time');
        $data['go_waiter'] = $_SESSION['piano_user']['fzr_name'];
        $data['go_text'] = I('text').'|'.date('Y-m-d',time()).'，后台'.
                           $_SESSION['piano_user']['username'].'添加';
        if(!I('turename') || !I('good_name') || !I('money') || !I('kind')){
            echo '缺少必填参数';exit;
        }
       //var_dump($data);exit;
        $a = M('Goods_order')->add($data);
        if($a){
            echo 1;exit;
        }else{
            echo "记录添加失败，SQL错误";exit;
        }
    }

//订单售课列表
    public function show_order_list1(){
        if($_SESSION['piano_users']['role'] ==1){
            $where ="go_type = '1'";
        
            $count = M("Goods_order")->where($where)->count();
        
            //实例化分页类
            $Page = new \Think\Page($count,$this->pagenum);
            //设置上一页与下一页
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
            //显示分页信息
            $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

           
            $a = M('Goods_order')->order('go_time DESC')
                                 ->where($where)
                                 ->limit($Page->firstRow.','.$Page->listRows)
                                 ->select();

        }else{
             

        }

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display();
        }

    public function order_list_sou1(){
        $where = "go_type = '1'";
        $name = trim($_POST['name']);
        if($name){    
            $where .=" and go_turename like '%$name%'";
            $this->assign('name',$name);
        }
        
        $orderSn = trim($_POST['orderSn']);
        if($orderSn){
            $where .= " and go_num = '$orderSn'";
            $this->assign('orderSn',$orderSn);
        }
        
        $stime = trim($_POST['stime']);
        if($stime){
            $this->assign('stime',$stime);
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
           
            $where .= " and go_time >= '$stime'";
            
        }
        $etime = trim($_POST['etime']);
        if($etime){
            $this->assign('etime',$etime);
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= " and go_time < '$etime'";
            
        }
        $status = I('status');
        if($status){
            $where .=" and go_status = '$status'";
            $this->assign('status',$status);
        }

        $button = $_POST['button'];
        if(empty($name) && empty($username) 
        && empty($stime) && empty($etime) && empty($status)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['order_list_sou1']){
                    $where = $_SESSION['order_list_sou1'];
                }
            }
        }
        $_SESSION['order_list_sou1'] = $where;

      

        $count = M("Goods_order")->where($where)->count();
       
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

       
        $a = M('Goods_order')->where($where)
                             ->order('go_time DESC')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();

      
        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display('show_order_list1');

    }

    //订单售课列表
    public function show_order_list2(){
       
        $where ="go_type = '2'";
        $count = M("Goods_order")->where($where)->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

       
        $a = M('Goods_order')->order('go_time DESC')
                             ->where($where)
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display();
        }

    public function order_list_sou2(){
        $where = "go_type = '2'";
       
        $stime = trim($_POST['stime']);
        if($stime){
            $this->assign('stime',$stime);
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
            $where .= " and go_time >= '$stime'";
            
        }
        $etime = trim($_POST['etime']);
        if($etime){
            $this->assign('etime',$etime);
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= " and go_time < '$etime'";
           
        }
   
        $button = $_POST['button'];
        if(empty($stime) && empty($etime)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['order_list_sou2']){
                    $where = $_SESSION['order_list_sou2'];
                }
            }
        }
        $_SESSION['order_list_sou2'] = $where;
       
        $count = M("Goods_order")->where($where)->count();
       // dump(M('Goods_order')->getLastSql());exit;
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)
 
        $a = M('Goods_order')->where($where)
                             ->order('go_time DESC')
                             ->limit($Page->firstRow.','.$Page->listRows)
                             ->select();

        $this->assign('list',$a);
        $this->assign('page',$show);
        $this->display('show_order_list2');

    }

    public function show_waiter_add(){
        $this->display();
    }



    public function add_waiter(){
        $data['go_username'] = I('nickname');
        $data['go_phone'] = I('phone');
        $data['go_adress'] = I('adress');
        $data['go_name'] = I('name');
        $data['go_time'] = I('time');
        $data['go_type'] = 2;
        $data['go_waiter'] = I('waiter');
        $data['go_money'] = I('money');
        $data['go_status'] = I('status');
       
        if($data['status'] == 1){
            $data['go_text'] = I('text').'| 收款情况由'.$_SESSION['piano_user']['username'].'确认并添加';
        }else{
            $data['go_text'] = I('text');
        }

        if(!I('nickname') || !I('adress') ||!I('money') || !I('adress') ||!I('status') || !I('text')){
            echo '缺少必填参数';exit;
        }

        // var_dump($data);exit;
        $a = M('Goods_order')->add($data);
        if($a){
            echo 1;exit;
        }else{
            echo '添加失败';exit;
        }
    }

    public function show_save_waiter(){
        $id = I('id');
        $a = M('Goods_order')->where("oid = '$id'")->find();
        $this->assign('list',$a);
        $this->display();  
    }

    public function save_waiter(){
        $id = I('id');

        if(I('nickname'))$data['go_username'] = I('nickname');
        if(I('phone'))$data['go_phone'] = I('phone');
        if(I('adress'))$data['go_adress'] = I('adress');
        if(I('name'))$data['go_name'] = I('name');
        if(I('time'))$data['go_time'] = I('time');
        if(I('waiter'))$data['go_waiter'] = I('waiter');
        if(I('money'))$data['go_money'] = I('money');
        if(I('text'))$data['go_text'] = I('text');

        // var_dump($data);exit;
        $a = M('Goods_order')->where("oid = '$id'")->save($data);
              if($a){
            echo 1;exit;
        }else{
            echo '修改失败';exit;
        }
    }

    public function save_pay(){
        $id = I('id');
        $a = M('Goods_order')->where("oid = '$id'")->getField('go_text');

        $data['go_status'] = 2;
        $data['go_text'] = $a.'|收款情况由'.$_SESSION['piano_user']['username'].'确定并修改';
        $b = M('Goods_order')->where("oid = '$id'")->save($data);
        if($b){
            echo 1;exit;
        }else{
            echo '修改失败';exit;
        }
    }



///////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////

//展示充值兑换率
    public function show_convert(){
        $status = I('status')?I('status'):1;
        $this->assign('status',$status);
        $list = M('Convert')->where("c_type = '1'")->select();

        $this->assign('list',$list);
        $this->display();
    }

    public function show_tixian_convert(){
        $status = I('status')?I('status'):1;
        $this->assign('status',$status);
        $list = M('Convert')->where("c_type = '2'")->select();
        $this->assign('list',$list);
        $this->display();
    }


    public function up_convert(){
        if(I('money') && I('point')){
            $data['c_money'] = I('money');
            $data['c_point'] = I('point');
            $data['c_type'] = 1;
            M('Convert')->add($data);
        }
        
        $val = I('value');
        $a = array();
        foreach($val as $k => $v){
            $num =  $k+2;
            $a[$k] = M('Convert')->where("convert_id = '$num'")->setField('c_point',$v);
           
        }
        if($a){
            echo 1;exit;
        }else{
            echo '修改失败，ＳＱＬ错误';exit;
        }
    }

    public function up_tixian_convert(){
        $val = I('value');
        $a = M('Convert')->where("c_type = '2'")->setField('c_point',$val);
        if($a){
            echo 1;exit;
        }else{
            echo '修改失败，ＳＱＬ错误';exit;
        }
    }

/////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

    public function get_money(){
        $id = I('id');
        $stime = I('stime');
        $etime = I('etime');

        $a['ke1'] = $ke->where("cl_tid = '$id' and cl_stime >= '$stime' and 
                                cl_etime < '$etime' and cl_kind = '1'")
                       ->count();
        $a['ke2'] = $ke->where("cl_tid = '$id' and cl_stime >= '$stime' and 
                                cl_etime < '$etime' and cl_kind = '2'")
                       ->count();
        $a['ke3'] = $ke->where("cl_tid = '$id' and cl_stime >= '$stime' and 
                                cl_etime < '$etime' and cl_kind = '3'")
                       ->count();
        $a['ke4'] = $ke->where("cl_tid = '$id' and cl_stime >= '$stime' and 
                                cl_etime < '$etime' and cl_kind = '4'")
                       ->count();

       
    }

    public function show_salary_list(){
         
        if($_SESSION['piano_user']['role'] != 1){
            $jxid = $_SESSION['piano_user']['jx_jigou'];
            $where = "t_jxid = '$jxid' and t_status = '2'";
        }else{
            $where = "t_status = '2'";
        }
        $lm = date('m',time())-1;   //上个月
        if($lm == 0){
            $lm = 12;
        }
        $this->assign('lm',$lm);
        $this->assign('kind',$lm);

        $time1 = strtotime(date('Y-m-01 00:00:00',strtotime('-1 month')));
        $time2 = strtotime(date('Y-m-t 23:59:59',strtotime('-1 month')));
      
        
        $join = 'piano_teacher on piano_teacher.t_userid = piano_salary.sa_userid';

        $count = M("Salary")->where($where)->join($join)->count();
    
        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

        $a = M('Salary')->where($where)
                        ->join($join)
                        ->order('sa_time DESC')
                        ->limit($Page->firstRow.','.$Page->listRows)
                        ->select();  //查找老师
        
       
       
        foreach ($a as $k => $v){
            $ke = M('Course_list');
            $a[$k]['ke1'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '1' and cl_status = '2'")
                               ->count();
            $a[$k]['ke1_money'] = bcmul($a[$k]['ke1'],$v['sa_ke1'],2);
                            
            $a[$k]['ke2'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '2' and cl_status = '2'")
                               ->count();
            $a[$k]['ke2_money'] = bcmul($a[$k]['ke2'],$v['sa_ke2'],2);

            $a[$k]['ke3'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '3' and cl_status = '2'")
                               ->count();
            $a[$k]['ke3_money'] = bcmul($a[$k]['ke3'],$v['sa_ke3'],2);

            $a[$k]['ke4'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '4' and cl_status = '2'")
                               ->count();
            $a[$k]['ke4_money'] = bcmul($a[$k]['ke4'],$v['sa_ke4'],2);

            $a[$k]['ke_total'] = $a[$k]['ke1']+$a[$k]['ke2']+$a[$k]['ke3']+$a[$k]['ke4'];


            $a[$k]['total_money'] = bcadd(bcadd($a[$k]['ke1_money'],$a[$k]['ke2_money'],2)
                                    ,bcadd($a[$k]['ke3_money'],$a[$k]['ke4_money'],2),2);  
                                    //正常收入
            
                                  
            //读取上个月其他收入
            $time  = date('m', strtotime('-1 month'));
            switch ($time){
                case 1:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('January');
                    break;
                case 2:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('February');
                    break;
                case 3:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('March');
                    break;
                case 4:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('April');
                    break; 
                case 5:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('May');
                    break;
                case 6:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('June');
                    break;
                case 7:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('July');
                    break;
                case 8:
                     $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('August');
                    break; 
                case 9:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('September');
                    break;
                case 10:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('October');
                    break;
                case 11:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('November');
                    break;
                case 12:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('December');
                    break;      
            }

            $a[$k]['all_money'] = bcadd(bcadd($a[$k]['sa_money'],$a[$k]['total_money'],2),$a[$k]['sa_ke5'],2);
            //总收入
        }      
        $this->assign('page',$show);
        $this->assign('list',$a);
        $this->display();
    }

      public function salary_list_sou(){
        if($_SESSION['piano_user']['role'] != 1){
            $jxid = $_SESSION['piano_user']['jx_jigou'];
            $where = "t_jxid = '$jxid' and t_status = '2'";
        }else{
            $where = "t_status = '2'";
        }

       
        $name = trim($_POST['name']);
        if($name){
            $where .= " and t_truename like '%$name%'";
            $this->assign('name',$name);
        }
        $phone = I('phone');
        if($phone){
            $where .=" and t_userid like '%$phone%'";
            $this->assign('phone',$phone);
        }
        
        $month = date('m',time())+0;
        $kind = I('kind');
        $this->assign('kind',$kind);
        $this->assign('lm',$kind);
        if($month <= $kind){
            $now = date('Y-m-d H:i:s',time());
            $where .=" and sa_time >= '$now'";
        }
        if($kind < 10){
            $time1 = date('Y').'-0'.$kind.'-01 00:00:00';
            $time2 = date('Y-m-t 23:59:59',strtotime($time1));     
        }else{
            $time1 = date('Y').'-'.$kind.'-01 00:00:00';
            $time2 = date('Y-m-t 23:59:59',strtotime($time1));
        }      
              
        $time1 = strtotime($time1);
        $time2 = strtotime($time2);
       
        $button = $_POST['button'];
        if(empty($name) && empty($phone) && empty($kind)){
            //如果是点击页码发起的请求，则按只保存的条件搜索
            if(!$button){
                if($_SESSION['salary_list_sou']){
                    $where = $_SESSION['salary_list_sou'];
                }
            }
        }
        $_SESSION['salary_list_sou'] = $where;
        $join = 'piano_teacher on piano_teacher.t_userid = piano_salary.sa_userid';

        $count = M("Salary")->where($where)->join($join)->count();

        //实例化分页类
        $Page = new \Think\Page($count,$this->pagenum);
        //设置上一页与下一页
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        //显示分页信息
        $show = $Page->show();// 分页显示输出 ->limit($Page->firstRow.','.$Page->listRows)

      
        $a = M('Salary')->where($where)
                        ->join($join)
                        ->limit($Page->firstRow.','.$Page->listRows)
                        ->select();  //查找老师
       
        foreach ($a as $k => $v){
            $ke = M('Course_list');

            $a[$k]['ke1'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '1' and cl_status = '2'")
                               ->count();
              //  dump(M('Course_list')->getLastSql());exit;               
                               // echo $a[$k]['ke1'];exit;
            $a[$k]['ke1_money'] = bcmul($a[$k]['ke1'],$v['sa_ke1'],2);
                            
            $a[$k]['ke2'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '2' and cl_status = '2'")
                               ->count();
            $a[$k]['ke2_money'] = bcmul($a[$k]['ke2'],$v['sa_ke2'],2);

            $a[$k]['ke3'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '3' and cl_status = '2'")
                               ->count();
            $a[$k]['ke3_money'] = bcmul($a[$k]['ke3'],$v['sa_ke3'],2);

            $a[$k]['ke4'] = $ke->where("cl_tid = '$v[t_userid]' and cl_stime >= '$time1' and 
                                        cl_etime < '$time2' and cl_kind = '4' and cl_status = '2'")
                               ->count();
            $a[$k]['ke4_money'] = bcmul($a[$k]['ke4'],$v['sa_ke4'],2);

            $a[$k]['ke_total'] = $a[$k]['ke1']+$a[$k]['ke2']+$a[$k]['ke3']+$a[$k]['ke4'];

            
            $a[$k]['total_money'] = bcadd(bcadd($a[$k]['ke1_money'],$a[$k]['ke2_money'],2)
                                    ,bcadd($a[$k]['ke3_money'],$a[$k]['ke4_money'],2),2);  
                                    //正常收入
            
            
            switch ($kind){
                case 1:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('January');
                    break;
                case 2:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('February');
                    break;
                case 3:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('March');
                    break;
                case 4:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('April');
                    break; 
                case 5:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('May');
                    break;
                case 6:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('June');
                    break;
                case 7:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('July');
                    break;
                case 8:
                     $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('August');
                    break; 
                case 9:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('September');
                    break;
                case 10:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('October');
                    break;
                case 11:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('November');
                    break;
                case 12:
                    $a[$k]['ke5'] = M('Salary')->where("sa_userid = '$v[t_userid]'")
                                               ->getField('December');
                    break;      
            }
            if(empty($a[$k]['ke5'])){$a[$k]['ke5'] = '0.00';}

            $a[$k]['all_money'] = bcadd(bcadd($a[$k]['sa_money'],$a[$k]['total_money'],2)
                                             ,$a[$k]['ke5'],2);//总收入
 
        }   
        
        $this->assign('page',$show);
        $this->assign('list',$a);
        $this->display('show_salary_list');
    }


    public function show_up_salary(){

        $id = I('id');
        $join1 = 'piano_users on piano_users.id = piano_salary.sa_userid';
        $join2 = 'piano_teacher on piano_teacher.t_userid = piano_salary.sa_userid';
       
        $a = M('Salary')->where("sa_userid = '$id'")
                        ->join($join1)
                        ->join($join2)
                        ->find();

        $this->assign('user',$a);
        $this->display();
    }

//这个是线状图
    public function show_salary_xiang(){
        $stime01=I('stime01');
            $this->assign('stime01',$stime01);
        $etime01=I('etime01');
            $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);

        $id = I('id');
        $a = M('Salary')->where("sa_userid = '$id'")->find();
     
        $list = array($a['january'],$a['february'],$a['march'],$a['april'],$a['may'],$a['june'],
                      $a['july'],$a['august'],$a['september'],$a['october'],$a['november'],$a['december']);
 
        $list_max = array_search(max($list), $list);
        $list_max = $list[$list_max];
       
        $b=$redata01['time_name'];
        $b = explode(',',$b);
           foreach ($b as $k => $v) {
            if($v == 1){$list[$k] = $a['january'];}
            if($v == 2){$list[$k] = $a['february'];}
            if($v == 3){ $list[$k] = $a['march'];}
            if($v == 4){$list[$k] = $a['april'];}
            if($v == 5){ $list[$k] = $a['may'];}
            if($v == 6){ $list[$k] = $a['june'];}
            if($v == 7){ $list[$k] = $a['july'];}
            if($v == 8){ $list[$k] = $a['august'];}
            if($v == 9){ $list[$k] = $a['september'];}
            if($v == 10){ $list[$k] = $a['october'];}
            if($v == 11){ $list[$k] = $a['november'];}
            if($v == 12){ $list[$k] = $a['december'];}
        }
        $list = implode(',',$list);
         // dump($list);
        $this->assign('list',$list);// 数值
        $this->assign('list_max',$list_max+ceil($list_max*0.3));//最大值
        $this->assign('time_name',$redata01['time_name']);
 
        $this->display();
    }


    protected $time_name;
    protected $time;

    /**
     * 后台数据统计管理
     * @access public
     * @return  Array
     */

    public function _initialize()
    {
       
        $time = [];
        $now = date('m',time());
        for($i = 12 ;$i >0;$i--){
            $secondmonth = $i;
            $firstmonth = $now -  $secondmonth ;
            if($firstmonth <= 0){
                $firstmonth = 12+ $firstmonth;
            }
            $this->time[]= $firstmonth;
            $time_name[] = $firstmonth;
        }

        // $this->time[] = $now;
        $this->time_name = implode(',',$time_name);
    }

    public function aaa($stime,$etime){
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

    public function up_salary(){
        $id = I('id');
        if(I('money'))$data['sa_money'] = I('money');
        if(I('tichen'))$data['sa_ke5'] = I('tichen');
        if(I('ke1'))$data['sa_ke1'] = I('ke1');
        if(I('ke2'))$data['sa_ke2'] = I('ke2');
        if(I('ke3'))$data['sa_ke3'] = I('ke3');
        if(I('ke4'))$data['sa_ke4'] = I('ke4');

        $a = M('Salary')->where("sa_userid = '$id'")->save($data);

        $month = date('m',strtotime('-1 month'))+0;

        switch ($month) {
            case 1:
                M('Salary')->where("sa_userid = '$id'")->setField('January',$data['sa_ke5']);
                break;
            case 2:
                M('Salary')->where("sa_userid = '$id'")->setField('February',$data['sa_ke5']);
                break;
            case 3:
                M('Salary')->where("sa_userid = '$id'")->setField('March',$data['sa_ke5']);
                break;
            case 4:
                M('Salary')->where("sa_userid = '$id'")->setField('April',$data['sa_ke5']);
                break;
            case 5:
                M('Salary')->where("sa_userid = '$id'")->setField('May',$data['sa_ke5']);
                break;
            case 6:
                M('Salary')->where("sa_userid = '$id'")->setField('June',$data['sa_ke5']);
                break;
            case 7:
                M('Salary')->where("sa_userid = '$id'")->setField('July',$data['sa_ke5']);
                break;
            case 8:
                M('Salary')->where("sa_userid = '$id'")->setField('August',$data['sa_ke5']);
                break;
            case 9:
                M('Salary')->where("sa_userid = '$id'")->setField('September',$data['sa_ke5']);
                break;
            case 10:
                M('Salary')->where("sa_userid = '$id'")->setField('October',$data['sa_ke5']);
                break;
            case 11:
                M('Salary')->where("sa_userid = '$id'")->setField('November',$data['sa_ke5']);
                break;
            case 12:
                M('Salary')->where("sa_userid = '$id'")->setField('December',$data['sa_ke5']);
                break;
            
            default:
                # code...
                break;
        }
        if($a){
            echo 1;exit;
        }else{
            echo "操作失败，SQL错误";exit;
        }
    }
    public function show_salary_add(){
        $this->display();
    }
    public function show_name(){
        $id = I('id');
        $a = M('Teacher')->where("t_userid = '$id' and t_status = '2'")->getField('t_truename');
        
        echo $a;exit;
    }

    public function add_salary(){
        $id = I('id');
          
        $a = M('Teacher')->where("t_userid = '$id' and t_status = '2'")->find();
        if(!$a){
            echo '不是老师，不能添加';exit;
        }
        
        $b = M('Salary')->where("sa_userid = '$id'")->find();
        if($b){
            echo '该老师已存在';exit;
        }
     
        if($id && I('name') && I('money')){
            
            $data['sa_userid'] = $id;
            $data['sa_name'] = I('name');
            $data['sa_phone'] = $a['t_mobile'];
            $data['sa_money'] = I('money');
            $data['sa_ke1'] = I('ke1');
            $data['sa_ke2'] = I('ke2');
            $data['sa_ke3'] = I('ke3');
            $data['sa_ke4'] = I('ke4');         //四种不同课的收费标准
            // $data['sa_ke5'] = I('ke5');
            $data['sa_time'] = $time;
            $data['sa_time'] = date('Y-m-d',time());

            $a = M('Salary')->add($data);
              
            if($a){
                echo 1;exit;
            }else{
                echo '添加失败，SQL错误';exit;
            }
            
        }else{
            echo '添加失败，缺少参数';exit;
        }
    }

    public function bbb($stime,$etime){
        $time = [];
        if($etime){
        $now = strtotime(date('Y-m-d 00:00:00',$etime));}else{$now = strtotime(date('Y-m-d 00:00:00',time()));}
        if($stime){
        $num = (strtotime($etime)-strtotime($stime))/86400;}else{$num=14;}
        for($i = $num ;$i >0;$i--){
            $secondsOneDay = 60 * 60 * 24 * $i;
            $yesterday = $now - $secondsOneDay;
            $time[]= mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday));
            $time_name[] = date('d+1',mktime(23, 59, 59, date("n", $yesterday), date("j", $yesterday), date("Y", $yesterday)));
        }

        $time[] = $now;
        if($etime){
            $lastoneday=strtotime($etime);
        }else{
            $lastoneday=strtotime(date('Y-m-d 23:59:59',time()));
        }
        $time_name[] = date('d',$lastoneday);
        $time_name = implode(',',$time_name);

        // 当天时间0点
        $y = date("Y");
        $m = date("m");
        $d = date("d");
        $todayTime = mktime(23,59,59,$m,$d,$y);
        $arr['time'] = $time;
        $arr['time_name'] = $time_name;
        $arr['todayTime'] = $todayTime;

        return $arr;
    }


// 总体数据
    public function show_chongzhi_xiang(){
        $id = I('id');
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->bbb($stime01,$etime01);
           
        // 用户总数
        $user = M('Xnb_record');
        foreach($redata01['time'] as $k => $v){
            $time2 = $redata01['time'][$k+1];
            if(empty($time2)){
                $time = strtotime(date('Y-m-d 23:59:59',time()));
            }
            $b = $user->where("xf_userid = '$id' and xf_type = '1'and xf_status = '2' and 
                              UNIX_TIMESTAMP(xf_time) >='$v' and UNIX_TIMESTAMP(xf_time) <='$time2'")
                      ->select();
                     
           // 每天的充值总数
            $c = 0;
            foreach($b as  $v){
                $c += $v['xf_money'];
            }
            $d[$k] = $c;
            if(empty($d)){
                $list[] = 0;
            }else{
                $list[] = $d[$k];
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

 public function show_chongzhi_total(){
    
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
      
        // 用户总数
        $user = M('Xnb_record');
        $a = explode(',',$redata01['time_name']);
        foreach($a as $k => $v){
            if($v ==1){
                $stime = date('Y-01-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==2){
                $stime = date('Y-02-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==3){
                $stime = date('Y-03-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==4){
                $stime = date('Y-04-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==5){
                $stime = date('Y-05-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==6){
                $stime = date('Y-06-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==7){
                $stime = date('Y-07-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==8){
                $stime = date('Y-08-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==9){
                $stime = date('Y-09-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==10){
                $stime = date('Y-19-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==11){
                $stime = date('Y-11-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==12){
                $stime = date('Y-12-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
           
            $b = $user->where("xf_type = '1'and xf_status = '2' and 
                               xf_time >='$stime' and xf_time < '$etime'")
                      ->select();
                
           // 每个月的充值总数
            $c = 0;
            foreach($b as  $v){
                $c += $v['xf_money'];
            }
            $d[$k] = $c;
            if(empty($d)){
                $list[] = 0;
            }else{
                $list[] = $d[$k];
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

    public function show_order_total(){
        $stime01=$_REQUEST['stime01'];
        $this->assign('stime01',$stime01);
        $etime01=$_REQUEST['etime01'];
        $this->assign('etime01',$etime01);
        $redata01=$this->aaa($stime01,$etime01);
      
        // 用户总数
        $user = M('Goods_order');
        $a = explode(',',$redata01['time_name']);
        foreach($a as $k => $v){
            if($v ==1){
                $stime = date('Y-01-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==2){
                $stime = date('Y-02-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==3){
                $stime = date('Y-03-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==4){
                $stime = date('Y-04-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==5){
                $stime = date('Y-05-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==6){
                $stime = date('Y-06-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==7){
                $stime = date('Y-07-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==8){
                $stime = date('Y-08-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==9){
                $stime = date('Y-09-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==10){
                $stime = date('Y-19-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==11){
                $stime = date('Y-11-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
            if($v ==12){
                $stime = date('Y-12-01 00:00:00',time());
                $etime = date('Y-m-d 23:59:50', strtotime("$stime +1 month -1 day"));
            }
           
            $b = $user->where("go_type = '1'and go_status = '2' and 
                               go_time >='$stime' and go_time < '$etime'")
                      ->select();
                
           // 每个月的充值总数
            $c = 0;
            foreach($b as  $v){
                $c += $v['go_money'];
            }
            $d[$k] = $c;
            if(empty($d)){
                $list[] = 0;
            }else{
                $list[] = $d[$k];
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


    public function money_daochu(){
        $kind = I('kind');
        
        $where = "xf_type = '1' and xf_status = '$kind'";
       
        $stime = I('stime');
        if($stime){
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
            $where .= " and xf_time >= '$stime'";
        }

        $etime = I('etime');
        if($etime){
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= "and xf_time  < '$etime'";
        }
     

        $a = M('Xnb_record')->where($where)
                            ->join('piano_users on piano_users.id = piano_xnb_record.xf_userid')
                            ->order('xf_time DESC')
                            ->select();

           

        foreach ($a as $k=>$v) {
            if($v['xf_status']==1){
                $v['xf_status'] = '充值失败';
                           
            }elseif ($v['xf_status']==2) {
                $v['xf_status'] = '充值成功';
                
            }
            //如何把地址转成图片还要导到xls文件里?     
            if($v['role']== 1){
                $v['role'] = '学生';
            }elseif($v['role']== 2){
                $v['role'] = '老师';
            }else{
                $v['role'] = '普通用户';
            }

            $data[$k] = array('1'=>$v['id'],'2'=>$v['xf_turename'],'3'=>$v['xf_phone'],
                              '4'=>$v['role'],'5'=>$v['xf_num'],'6'=>$v['xf_money'],
                              '7'=>$v['xf_time'],'8'=>$v['xf_status'],'9'=>$v['xf_text'],);

        }
       
        if($kind == 1){
            $today = '充值失败列表'.date('Y-m-d',time());
        }else{
            $today = '充值成功列表'.date('Y-m-d',time());
        }
        $title = array('用户ID','用户姓名','手机号','角色','订单号','充值金额','充值时间','充值状态','备注');
        $this->exportexcel($data,$title,$filename = $today);

    }



    public function tixian_daochu(){
        $kind = I('kind');
       
        $where = "xf_type = '3' and xf_status = '$kind'";
       
        $stime = I('stime');
        if($stime){
            $stime = date('Y-m-d 00:00:00',strtotime($stime));
            $where .= " and xf_time >= '$stime'";
        }

        $etime = I('etime');
        if($etime){
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= "and xf_time < '$etime'";
        }
       
        $a = M('Xnb_record')->where($where)
                            ->join('piano_users on piano_users.id = piano_xnb_record.xf_userid')
                            ->order('xf_time DESC')
                            ->select();
    
        foreach ($a as $k=>$v) {
            if($v['xf_status']==1){
                $v['xf_status'] = '提现失败';
                           
            }elseif ($v['xf_status']==2) {
                $v['xf_status'] = '提现成功';
                
            }else{
                $v['xf_status'] = '申请中'; 
            }
            //如何把地址转成图片还要导到xls文件里?     
            if($v['xf_kind']== 1){
                $v['xf_acc'] = $v['xf_acc'];
            }else{
                $v['xf_acc'] = '';
            }   
           
            $data[$k] = array('1'=>$v['id'],'2'=>$v['xf_turename'],'3'=>$v['xf_acc'],'4'=>$v['xf_turename'],
                              '5'=>$v['username'],'6'=>$v['xf_num'],'7'=>$v['xf_money'],
                              '8'=>$v['xf_point'],'9'=>$v['xf_time'],
                              '10'=>$v['xf_status'],'11'=>$v['xf_text']);
         
        }
      // dump($data);exit;
        if($kind == 1){
            $today = '提现失败列表'.date('Y-m-d',time());
        }elseif($kind == 2){
            $today = '提现成功列表'.date('Y-m-d',time());
        }else{
            $today = '提现申请列表'.date('Y-m-d',time());
        }       
        
        $title = array('用户ID','用户姓名','支付宝账号','持卡人姓名','手机号','订单号','提现金额','乐币点数','申请时间','提现状态','备注');
        $this->exportexcel($data,$title,$filename = $today);
    }
 

    public function order_daochu(){
        $where = "go_type = '1'";

        $stime = I('stime');
        if($stime){         
            $stime = date('Y-m-d 00:00:00',strtotime($stime));  
            $where .= " and go_time >= '$stime'";
        }

        $etime = I('etime');
        if($etime){
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= "and go_time < '$etime'";
        }
        
        $a = M('Goods_order')->where($where)->select();
      
        foreach ($a as $k => $v){
            if($v['go_kind'] == 1){
                $v['go_kind'] = '现金';
            }else{
                $v['go_kind'] = '非现金';
            }
        

        $data[$k] = array('1'=>$v['go_username'],'2'=>$v['go_phone'],'3'=>$v['go_num'],'4'=>$v['go_name'],
                          '5'=>$v['go_number'],'6'=>$v['go_price'],'7'=>$v['go_money'],
                          '8'=>$v['go_waiter'],'9'=>$v['go_time'],'10'=>$v['go_kind'],'11'=>$v['go_text']);

        }
        $title = array('客户名称','手机号','订单号','商品名称','数量','单价','金额','服务员','购买时间',
                       '交易方式','备注');

        $today = '销售列表'.date('Y-m-d',time());
        $this->exportexcel($data,$title,$filename = $today);

    }


    public function shouhou_daochu(){
        // dump($_REQUEST);exit;

        $where = "go_type = '2'";

        $stime = I('stime');
        if($stime){   

            $stime = date('Y-m-d 00:00:00',strtotime($stime));        
            $where .= " and go_time >= '$stime'";
        }

        $etime = I('etime');
        if($etime){
            $etime = date('Y-m-d 23:59:59',strtotime($etime));
            $where .= " and go_time  < '$etime'";
        }
      
        $a = M('Goods_order')->where($where)->select();

        foreach ($a as $k => $v){
            if($v['go_status'] == 1){
                $v['go_status'] = '未付款';
            }else{
                $v['go_status'] = '已付款';
            }
        
       
            $data[$k] = array('1'=>$v['go_username'],'2'=>$v['go_phone'],'3'=>$v['go_adress'],
                              '4'=>$v['go_name'],'5'=>$v['go_time'],'6'=>$v['go_waiter'],
                              '7'=>$v['go_money'],'8'=>$v['go_status'],'9'=>$v['go_text']);
        }
        
        $today = '售后服务列表'.date('Y-m-d',time());
        $title = array('客户名称','联系电话','地址','服务内容','服务时间','服务员','金额','是否付款','备注');
        $this->exportexcel($data,$title,$filename = $today);


    }

























}
?>