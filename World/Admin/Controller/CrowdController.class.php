<?php
namespace Admin\Controller;

use Index\Model\CrowdModel;
use Index\Model\FirstMarkModel;
use Index\Model\FourthMarkModel;
use Index\Model\SecondMarkModel;
use Index\Model\ThirdMarkModel;
use Think\Controller;
class CrowdController extends CommonController {


    public function crowd_list(){

        $crowdmodel = new CrowdModel();
        $where = '1=1';
        $id = '';
        $crowdname = '';
        $peoplename = '';
        $peoplephone = '';

        if (isset($_POST['id'])){
            $where .= ' and crowd_id like "%'.$_POST['id'].'%"';
            $id = $_POST['id'];
            $_SESSION['crowd_list_id'] = $_POST['id'];
        }
        if (isset($_POST['crowdname'])){
            $where .= ' and crowd_name like "%'.$_POST['crowdname'].'%"';
            $crowdname = $_POST['crowdname'];
            $_SESSION['crowd_list_crowdname'] = $_POST['crowdname'];
        }
        if (isset($_POST['peoplename'])){
            $where .= ' and user_name like "%'.$_POST['peoplename'].'%"';
            $peoplename = $_POST['peoplename'];
            $_SESSION['crowd_list_peoplename'] = $_POST['peoplename'];
        }
        if (isset($_POST['peoplephone'])){
            $where .= ' and user_mail like "%'.$_POST['peoplephone'].'%"';
            $peoplephone = $_POST['peoplephone'];
            $_SESSION['crowd_list_peoplephone'] = $_POST['peoplephone'];
        }

        if (isset($_POST['button'])){
            $_SESSION['crowd_list_where'] = $where;
        }else{
            if (isset($_GET['p'])) {
                $where = $_SESSION['crowd_list_where'];
                $id = $_SESSION['crowd_list_id'];
                $crowdname = $_SESSION['crowd_list_crowdname'];
                $peoplename = $_SESSION['crowd_list_peoplename'];
                $peoplephone = $_SESSION['crowd_list_peoplephone'];
            }
        }

        $crowdcount = $crowdmodel->findone($where,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','count(*) num')['num'];

        $Page = new \Think\Page($crowdcount,$this->pagenum);

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $Page->setConfig('theme', '%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');

        $show = $Page->show();

        $crowdlist = $crowdmodel->findlist($where,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','crowd_creattime desc','*',$Page->firstRow,$Page->listRows);

        $this->assign(array(
            'crowdlist'=>$crowdlist,
            'page' => $show,
            'id' => $id,
            'crowdname' => $crowdname,
            'peoplename' => $peoplename,
            'peoplephone' => $peoplephone,

        ));
        $this->display();
    }
	
}