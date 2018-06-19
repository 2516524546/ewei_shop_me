<?php
namespace Index\Controller;
use Index\Model\ConcernsModel;
use Index\Model\FirendsModel;
use Index\Model\FriendsModel;
use Index\Model\ResumeModel;
use Index\Model\UserCountryModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Upload;

class UserController extends CommonController {

    protected $_checkAction = ['FollowList','personalCenter','acountSetting','resumeDetails','myPosts','myMessage','myFollowing','addressBook'
                                    ,'myGroup','feedback','virtualCurrencyRecharge','FansList','DeliveryRecord','ResumeTemplateList'
                                    ,'FollowFriend','RefuseAddFirend','AgreeAddFirend','AddFriend','ChangeConcernsName'];//需要做登录验证的action

    public function _initialize()
    {
        parent::_initialize();
        if(in_array(ACTION_NAME,$this->_checkAction)){
            if (!$this->userid && !IS_AJAX){
                session('returnurl', __SELF__);
                $this->redirect(U('Index/Login/login'));
            }elseif(!$this->userid){
                $this->error('The user has not landed！');
            }
        }
    }

    public function personalCenter(){
        $id = I('get.id','trim');

        if(!is_numeric($id)){
            $this->error('Parameter error！');
        }

        $usermodel = new UserModel();
        $userone = $usermodel->findone('user_id = '.$id);

        if(!$userone){
            $this->error('The user does not exist！');
        }

        if ($userone['user_concerns']>10000){
            $userone['user_concerns'] = floor($userone['user_concerns']/10000).'m';
        }
        if ($userone['user_fans']>10000){
            $userone['user_fans'] = floor($userone['user_fans']/10000).'m';
        }

        $firendsmodel = new FirendsModel();
        $firendone = $firendsmodel->findone('firends_uid = '.$id.' and firends_aid = '.$this->userid.' and firends_type IN('. FriendsModel::TYPE_FRIEND.','. FriendsModel::TYPE_BLACKLISTED.','. FriendsModel::TYPE_BEDELETED .')');

        $concernsmodel = new ConcernsModel();
        $concernsone = $concernsmodel->where('concerns_uid = '.$this->userid.' and concerns_cuid = '.$id)->getField('concerns_status');

        //好友请求
        $fir_message = D('Message')->where('(message_sid='.$this->userid.' AND message_uid='.$id.') OR (message_sid='.$id.' AND message_uid='.$this->userid.')')->getField('message_id'); //对方申请成为我的好友或我申请成为对方的好友


        $this->assign(array(
            'userone' => $userone,
            'firendone' => $firendone,
            'concernsone' => $concernsone,
            'fir_message' => $fir_message
        ));
        $this->display();

    }

    public function acountSetting(){

        $countrymodel = new UserCountryModel();
        $countrylist = $countrymodel->findlist('','user_country_sort desc,user_country_name');

        $this->assign(array(
            'countrylist' =>$countrylist,

        ));
        $this->display();
    }

    public function resumeDetails(){

        $goindex = 1;
        if (isset($_GET['gourl'])){
            $goindex = 0;
        }

        $resumemodel = new ResumeModel();
        $resumeone = $resumemodel->findone('resume_uid = '.$this->userid);


        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,
            'goindex' => $goindex,
            'resumeone' => $resumeone,
        ));
        $this->display();
    }

    public function myPosts(){
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->assign('title','My Posts');
        $css = addCss('myPosts');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function myMessage(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,
        ));

        //获取消息列表
        $messages = D('Message')->alias('m')->field('m.*,u.user_name,u.user_icon')->join('u_user u ON u.user_id = m.message_sid','LEFT')->where(['m.message_uid'=>$this->userid])->limit(10)->select();
        $this->assign('messages',$messages);

        $this->assign('title','My Message');
        $css = addCss('MyMessage');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function myFollowing(){
        $count      = D('Concerns')->where('concerns_uid='.$this->userid .' AND concerns_status=1')->count();
        $Page       = new \Think\Page($count,2);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $myFollows = D('Concerns')->alias('c')->field('c.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = c.concerns_cuid','LEFT')->where('c.concerns_uid='.$this->userid .' AND c.concerns_status=1')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('myFollows',$myFollows);
        $this->assign('page',$show);
        $this->display();
    }

    public function addressBook(){

        $this->display();
    }

    public function myGroup(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->assign('title','My Group');
        $css = addCss('MyGroup');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function feedback(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $this->display();
    }

    public function virtualCurrencyRecharge(){

        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $css = addCss('VCR');
        $this->assign('title','Virtual Currency Recharge');
        $this->assign('CSS',$css);
        $this->display();
    }

    /**
     * 我的关注列表
     * @return mixed
     */
    public function FollowList(){
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $css = addCss('FollowList');
        $this->assign('title','Follow List');
        $this->assign('CSS',$css);
        $this->display();
    }

    //帮助
    public function helpCenter(){

        $this->display();
    }

    //告诉我们 
    public function contactUs(){

        $this->display();
    }

     //我的简历
     public function mineResume(){

        $this->display();
    }

     //我的简历
     public function createResume(){

        $this->display();
    }
    /**
     * 我的投递记录
     * @return mixed
     */
    public function DeliveryRecord(){
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $css = addCss('DeliveryRecord');
        $this->assign('title','Resume Details');
        $this->assign('CSS',$css);
        $this->display();
    }

    /**
     * 简历模板
     * @return mixed
     */
    public function ResumeTemplateList(){
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' =>$this->usercontent,
            'havemessage' => $this->havemessage,

        ));
        $css = addCss('ResumeTemplateList');
        $this->assign('title','Resume Template List');
        $this->assign('CSS',$css);
        $this->display();
    }

    /**
     * 添加好友
     */
    public function AddFriend(){
        $uid = I('post.id/d');
        if(IS_AJAX){

            if(D('Message')->findone(['message_uid'=>$uid,'message_sid'=>$this->userid])){
                echo json_encode(['status'=>1,'msg'=>'Submit success, wait for the other party to review!']);
                exit;
            }

            $data = ['message_uid'=>$uid,'message_sid'=>$this->userid,'message_title'=>'User:'.$this->usercontent['user_name'].' applies to be your friend','message_content'=>'User:'.$this->username.' applies to be your friend','message_type'=>1];

            if(D('Message')->addone($data)){
                echo json_encode(['status'=>1,'msg'=>'Submit success, wait for the other party to review!']);
                exit;
            }else{
                echo json_encode(['status'=>0,'msg'=>'Submit failed!']);
                exit;
            }
        }else{
            $this->error('Illegal operations!');
        }
    }

    public function AgreeAddFirend(){
        $id = I('post.id','intval');
        $uid = I('post.uid','intval');
        if($id <= 0 || $uid <= 0){
            $this->error('Parameter error！');
        }

        if(D('Friends')->addone(['firends_uid'=>$this->userid,'firends_aid'=>$uid])){
            if(D('Message')->updataone('message_id='.$id,['message_isread'=>'1'])){//同意后状态改为已读
                die(json_encode(['status'=>1,'msg'=>'Submit success!']));
            }else{
                die(json_encode(['status'=>0,'msg'=>'Submit failed!']));
            }
        }else{
            die(json_encode(['status'=>0,'msg'=>'Submit failed!']));
        }
    }

    public function RefuseAddFirend(){
        $id = I('post.id','intval');
        if($id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($id <= 0){
            $this->error('Parameter error！');
        }

        if(D('Message')->updataone('message_id='.$id,['message_isread'=>'2'])){//拒绝好友
            die(json_encode(['status'=>1,'msg'=>'Submit success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Submit failed!']));
        }
    }

    public function FollowFriend(){
        $id = I('post.id','intval');
        if($id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($id <= 0){
            $this->error('Parameter error！');
        }

        $concern = D('Concerns')->where('concerns_uid = '.$this->userid.' and concerns_cuid = '.$id)->getField('concerns_status');

        if(is_null($concern)){
            $is_handle = D('Concerns')->add(['concerns_uid'=>$this->userid,'concerns_cuid'=>$id,'concerns_gid'=>0,'concerns_time'=>date('Y-m-d H:i:s',time())]);
        }else{
            $concern = abs($concern - 1);
            $is_handle = D('Concerns')->updataone('concerns_cuid='.$id.' AND concerns_uid='.$this->userid,['concerns_status'=>$concern]);
        }
        if($is_handle){
            die(json_encode(['status'=>1,'msg'=>'Submit success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Submit failed!']));
        }
    }

    public function ChangeConcernsName(){
        $concerns_id = I('post.concerns_id','intval');
        $concerns_name = I('post.concerns_name','trim');
        if(($concerns_id <= 0 || empty($concerns_name)) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($concerns_id <= 0 || empty($concerns_name)){
            $this->error('Parameter error！');
        }

        if(strlen($concerns_name)>80){
            $this->error('Concerns_name can\'t exceed 80 characters！');
        }

        if(D('Concerns')->updataone('concerns_id='.$concerns_id,['concerns_name'=>$concerns_name])){
            die(json_encode(['status'=>1,'msg'=>'ChangName success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'ChangName failed!']));
        }
    }
}