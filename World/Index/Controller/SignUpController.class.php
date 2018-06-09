<?php
namespace Index\Controller;
use Index\Model\UserCompanyModel;
use Index\Model\UserCountryModel;
use Index\Model\UserGroupTagModel;
use Index\Model\UserTagModel;
use Think\Controller;
class SignUpController extends Controller {
    public function register(){
        $data = array();
        if (session('register_mail')){
            $data['register_mail']= session('register_mail');
        }
        if (session('register_password')){
            $data['register_password']= session('register_password');
        }

        $this->assign($data);

        $this->display();
    }

    public function registerSecond(){

        $countrymodel = new UserCountryModel();
        $tagmodel = new UserTagModel();
        $countrylist = $countrymodel->findlist('','user_country_sort desc,user_country_name');
        $taglist = $tagmodel->findlist('','user_tag_sort desc');

        $data = array(
            'countrylist' => $countrylist,
            'taglist' => $taglist,
        );

        if (session('register_name')){
            $data['register_name']= session('register_name');
        }
        if (session('register_sex')){
            $data['register_sex']= session('register_sex');
        }
        if (session('register_tag')){
            $data['register_tag']= session('register_tag');
        }
        if (session('register_birth')){
            $data['register_birth']= session('register_birth');
        }
        if (session('register_country')){
            $data['register_country']= session('register_country');
        }
        if (session('register_city')){
            $data['register_city']= session('register_city');
        }
        if (session('register_signature')){
            $data['register_signature']= session('register_signature');
        }


        $this->assign($data);

        $this->display();
    }

    public function registerThird(){

        $grouptagmodel = new UserGroupTagModel();
        $grouptaglist = $grouptagmodel->findlist('','u_user_grouptag_sort desc');
        $this->assign(array(
            'grouptaglist' => $grouptaglist,
        ));

        $this->display();
    }

    public function forgetThePassword(){

		$this->display();
    }


}