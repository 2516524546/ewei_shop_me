<?php
namespace Index\Controller;
use Think\Controller;
class LoginController extends CommonController {
    public function login(){

        $url = null;

        if (session('returnurl')){
            $url = session('returnurl');
        }


        $this->assign('url',$url);
        $this->display();
    }


}