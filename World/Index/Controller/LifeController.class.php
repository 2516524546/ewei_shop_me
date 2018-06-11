<?php
namespace Index\Controller;
use Index\Model\CommodityModel;
use Index\Model\FirstMarkModel;
use Index\Model\SecondMarkModel;
use Think\Controller;
class LifeController extends CommonController {
    public $modeleid = 5;

    //生活首页
    public function life(){


        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);


        $this->display();
    }

    //商品列表
    public function lSecondHandMarket(){

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();

        $static = $secondmodel->findlist('second_mark_fid = 8','second_mark_sort');
        $money = $secondmodel->findlist('second_mark_fid = 9','second_mark_sort');
        $state = $secondmodel->findlist('second_mark_fid = 10','second_mark_sort');
        $city = $secondmodel->findlist('second_mark_fid = 11','second_mark_sort');
        $university = $secondmodel->findlist('second_mark_fid = 12','second_mark_sort');

        $commoditymodel = new CommodityModel();
        $commoditylist = $commoditymodel->joinonelist('commodity_status = 1','u_user u on l_commodity.commodity_uid = u.user_id','commodity_updatetime desc',0,10);

        $crowdcount = $commoditymodel->findone('commodity_status = 1','count(*) num')['num'];


        $this->assign(array(
            'static' => $static,
            'money' => $money,
            'state' => $state,
            'city' => $city,
            'university' => $university,
            'commoditylist' => $commoditylist,
            'crowdcount' => $crowdcount,

        ));

        $this->display();
    }

    //
    public function mineProduct(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->display();
    }

    //发布商品
    public function postProduct(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();

        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 4','firsth_mark_sort');

        foreach ($firstlist as $firthkey =>$first){

            $data[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');

            $data[$firthkey]['message'] = $secondlist;

        }

        $this->assign(array(
            'data' => $data,

        ));

        $this->display();
    }

    //商品详情
    public function lifeProductDetails(){

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

        

        $this->display();
    }

    public function createLife(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $this->display();

    }

    public function lifeDetails(){


        $this->display();

    }



}