<?php
namespace Index\Controller;
use Index\Model\ConcernsModel;
use Index\Model\FirendsModel;
use Index\Model\FriendsModel;
use Index\Model\NoteModel;
use Index\Model\ResumeModel;
use Index\Model\UserCountryModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Upload;

class UserController extends CommonController {

    protected $_checkAction = ['FollowList','personalCenter','acountSetting','resumeDetails','myPosts','myMessage','myFollowing','addressBook'
                                    ,'myGroup','feedback','virtualCurrencyRecharge','FansList','DeliveryRecord','ResumeTemplateList'
                                    ,'FollowFriend','RefuseAddFirend','AgreeAddFirend','AddFriend','ChangeConcernsName','AddGroup','SetGroup','ChangeConcernsGroupName','SetFriendAlias','DeleteFriend','mineResume','createResume','DeleteResume','DeliveryResume','ClearMessages','MessageDetails'];//需要做登录验证的action

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
        $concernsone = $concernsmodel->findone('concerns_uid = '.$this->userid.' and concerns_cuid = '.$id . ' and concerns_status=1');

        //好友请求
        $fir_message = D('Message')->where('(message_sid='.$this->userid.' AND message_uid='.$id.') OR (message_sid='.$id.' AND message_uid='.$this->userid.')')->getField('message_id'); //对方申请成为我的好友或我申请成为对方的好友

        //查找当前用户的好友分组
        $concerns_groups = D('ConcernsGroup')->where('concerns_group_uid='.$this->userid)->select();
        $this->assign('concerns_groups',$concerns_groups);
        $isme = 0;
        if ($id == $this->userid){
            $isme = 1;
        }

        $notemodel = new NoteModel();
        //$alllist = $notemodel->join('u_user u on u_note.note_uid = u.user_id','INNER')->join('u_crowd c on u_note.note_cid = c.crowd_id','INNER')->field(false)->where('note_ishide = 1 and note_uid = '.$_GET['id'])->order('note_istop desc,note_iswally desc,note_createtime desc')->limit(0,20)->select();
        $alllist = $notemodel->jointwolist('note_ishide = 1 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $allcount = $notemodel->jointwoone('note_ishide = 1 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];


        $postlist = $notemodel->jointwolist('note_ishide = 1 and note_type = 1 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $postcount = $notemodel->jointwoone('note_ishide = 1 and note_type = 1 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        $questionlist = $notemodel->jointwolist('note_ishide = 1 and note_type = 2 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $questioncount = $notemodel->jointwoone('note_ishide = 1 and note_type = 2 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        $resourcelist = $notemodel->jointwolist('note_ishide = 1 and note_type = 3 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $resourcecount = $notemodel->jointwoone('note_ishide = 1 and note_type = 3 and note_uid = '.$_GET['id'],'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        $this->assign(array(
            'userone' => $userone,
            'isme' => $isme,
            'firendone' => $firendone,
            'concernsone' => $concernsone,
            'fir_message' => $fir_message,
            'alllist' => $alllist,
            'allcount' => $allcount,
            'postlist' => $postlist,
            'postcount' => $postcount,
            'questionlist' => $questionlist,
            'questioncount' => $questioncount,
            'resourcelist' => $resourcelist,
            'resourcecount' => $resourcecount,
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
        $resume_id = I('get.resume_id','0','intval');

        $resumemodel = new ResumeModel();
        $resumeone = $resumemodel->findone('resume_id = '.$resume_id . ' AND resume_uid = '.$this->userid);

        if(!$resumeone){
            $this->error('The resume does not exist!');
        }


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


        $notemodel = new NoteModel();

        $notecount = $notemodel->jointwoone('note_ishide = 1 and note_type = 1 and note_uid = '.$this->userid,'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        $questioncount = $notemodel->jointwoone('note_ishide = 1 and note_type = 2 and note_uid = '.$this->userid,'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        $resourcecount = $notemodel->jointwoone('note_ishide = 1 and note_type = 3 and note_uid = '.$this->userid,'u_user u on u_note.note_uid = u.user_id','u_crowd c on u_note.note_cid = c.crowd_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','INNER','count(*) num')['num'];

        
        $this->assign(array(
            'notecount'=>$notecount,
            'questioncount'=>$questioncount,
            'resourcecount'=>$resourcecount,

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


        $groups = D('ConcernsGroup')->where('concerns_group_uid='.$this->userid )->select();
        $this->assign('groups',$groups);


        $count      = D('Message')->alias('m')->where(['m.message_uid'=>$this->userid])->count();
        $Page       = new \Think\Page($count,2);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $messages = D('Message')->alias('m')->field('m.*,u.user_name,u.user_icon')->join('u_user u ON u.user_id = m.message_sid','LEFT')->where(['m.message_uid'=>$this->userid])->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('messages',$messages);
        $this->assign('page',$show);

        $this->assign('title','My Message');
        $css = addCss('MyMessage');
        $this->assign('CSS',$css);
        $this->display();
    }

    public function myFollowing(){
        //My group
        $groups = D('ConcernsGroup')->where('concerns_group_uid='.$this->userid )->select();
        $this->assign('groups',$groups);


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
        $where = 'firends_uid='.$this->userid .' AND firends_type IN('.FriendsModel::TYPE_FRIEND.','. FriendsModel::TYPE_BLACKLISTED.','. FriendsModel::TYPE_BEDELETED.')';

        $k = I('get.k','','trim');
        if($k){
            $where .= ' AND (firends_mark LIKE "%'.$k.'%" OR u.user_name LIKE "%'.$k.'%")';
        }

        $count      = D('Friends')->alias('f')->join('u_user u ON u.user_id = f.firends_aid','LEFT')->where($where)->count();
        $Page       = new \Think\Page($count,2);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $show       = $Page->show();
        $myFirends = D('Friends')->alias('f')->field('f.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = f.firends_aid','LEFT')->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('myFirends',$myFirends);
        $this->assign('page',$show);

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
         $count      = D('Resume')->alias('r')->join('u_user u ON u.user_id = r.resume_uid','LEFT')->where('resume_uid='.$this->userid)->count();
         $Page       = new \Think\Page($count,10);
         $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
         $show       = $Page->show();
         $myResumes = D('Resume')->alias('r')->field('r.*,u.user_name,u.user_icon,u.user_signature')->join('u_user u ON u.user_id = r.resume_uid','LEFT')->where('resume_uid='.$this->userid)->limit($Page->firstRow.','.$Page->listRows)->select();
         $this->assign('myResumes',$myResumes);
         $this->assign('page',$show);
        $this->display();
    }

     //我的简历
     public function createResume(){
        if(IS_POST){
            $rules = array(
                array('resume_tid',array(1,2,3),'The scope of the value is not correct！',1,'in'),
                array('resume_position','require','Please select the position information！'),
                array('resume_workyear','number','Please enter the number of years of work！'),
                array('resume_id','number','Parameter error！',2),
                array('resume_workyear','require','Please enter a graduate school！'),
                array('resume_degree','require','Please enter a degree！'),
                array('resume_specialty','require','Please enter a major！'),
            );
            $Resume = D("Resume"); // 实例化User对象
            if (!$Resume->create($_POST)){ // 登录验证数据
                // 验证没有通过 输出错误提示信息
                exit($Resume->getError());
            }else{
                // 验证通过 执行登录操作
            }
        }

        $this->display('resumeDetails');
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
        $id = I('post.id',0,'intval');
        $uid = I('post.uid',0,'intval');
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
        $id = I('post.id',0,'intval');
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
        $id = I('post.id',0,'intval');
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
        $concerns_id = I('post.concerns_id',0,'intval');
        $concerns_name = I('post.concerns_name','','trim');
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

    public function ChangeConcernsGroupName(){
        $concerns_group_id = I('post.concerns_group_id',0,'intval');
        $concerns_group_name = I('post.concerns_group_name','','trim');
        if(($concerns_group_id <= 0 || empty($concerns_group_name)) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($concerns_group_id <= 0 || empty($concerns_group_name)){
            $this->error('Parameter error！');
        }

        if(strlen($concerns_group_name)>80){
            $this->error('concerns_group_name can\'t exceed 80 characters！');
        }

        if(D('ConcernsGroup')->where('concerns_group_id = '.$concerns_group_id)->setField(['concerns_group_name'=>$concerns_group_name])){
            die(json_encode(['status'=>1,'msg'=>'ChangName success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'ChangName failed!']));
        }
    }


    public function DeleteConcernsGroup(){
        $concerns_group_id = I('post.concerns_group_id',0,'intval');
        if($concerns_group_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($concerns_group_id <= 0){
            $this->error('Parameter error！');
        }

        if(D('ConcernsGroup')->where('concerns_group_id='.$concerns_group_id)->delete()){
            die(json_encode(['status'=>1,'msg'=>'Delete success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delete failed!']));
        }
    }

    public function AddGroup(){
        $group_name = I('post.group_name','','trim');

        if(empty($group_name) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(empty($group_name)){
            $this->error('Parameter error！');
        }

        if(strlen($group_name)>80){
            $this->error('concerns_group_name can\'t exceed 80 characters！');
        }

        if(D('ConcernsGroup')->add(['concerns_group_uid'=>$this->userid,'concerns_group_name'=>$group_name])){
            die(json_encode(['status'=>1,'msg'=>'Create group success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Create group failed!']));
        }
    }

    public function SetGroup(){
        $concerns_group_id = I('post.group_id',0,'intval');
        $concerns_group_uid = I('post.uid',0,'intval');
        if(($concerns_group_id <= 0 || $concerns_group_uid <= 0) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($concerns_group_id <= 0 || $concerns_group_uid <= 0)){
            $this->error('Parameter error！');
        }

        if(D('Concerns')->updataone('concerns_uid = '.$this->userid.' and concerns_cuid='.$concerns_group_uid,['concerns_gid'=>$concerns_group_id])){
            die(json_encode(['status'=>1,'msg'=>'ChangName success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'ChangName failed!']));
        }
    }

    public function SetFriendAlias(){
        $friends_id = I('post.friends_id',0,'intval');
        $firends_mark = I('post.firends_mark','','trim');
        if(($friends_id <= 0 || empty($firends_mark)) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($friends_id <= 0 || empty($firends_mark))){
            $this->error('Parameter error！');
        }

        if(strlen($firends_mark)>80){
            $this->error('firends_mark can\'t exceed 80 characters！');
        }

        if(D('Friends')->updataone('friends_id = '.$friends_id,['firends_mark'=>$firends_mark])){
            die(json_encode(['status'=>1,'msg'=>'Set Alias success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Set Alias failed!']));
        }
    }

    public function DeleteFriend(){
        $firends_uid = I('post.firends_uid',0,'intval');
        $firends_aid = I('post.firends_aid',0,'intval');
        if(($firends_uid <= 0 || $firends_aid <= 0) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($firends_uid <= 0 || $firends_aid <= 0)){
            $this->error('Parameter error！');
        }
        if($firends_uid != $this->userid){
            $this->error('Parameter error！');
        }

        $firends_type = D('Friends')->getFriendType(3,['firends_uid'=>$firends_uid,'firends_aid'=>$firends_aid]);
        if(D('Friends')->updataone('firends_uid = '.$firends_uid . ' AND firends_aid=' . $firends_aid,['firends_type'=>$firends_type])){
            die(json_encode(['status'=>1,'msg'=>'Delete success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delete failed!']));
        }
    }

    public function DeleteResume(){
        $resume_id = I('post.resume_id',0,'intval');
        if($resume_id <= 0 && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif($resume_id <= 0){
            $this->error('Parameter error！');
        }

        if(D('Resume')->where('resume_id='.$resume_id . ' AND resume_uid='.$this->userid)->delete()){
            die(json_encode(['status'=>1,'msg'=>'Delete success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delete failed!']));
        }
    }

    public function DeliveryResume(){
        $interest = I('post.interest',0,'intval');
        $works_id = I('post.works_id',0,'intval');
        if(($interest <= 0 || $works_id <= 0) && IS_AJAX){
            die(json_encode(['status'=>0,'msg'=>'Parameter error！']));
        }elseif(($interest <= 0 || $works_id <= 0)){
            $this->error('Parameter error！');
        }

        //查询该简历是否已经投递到职位下
        $myDelivery = D('ResumeDelivery')->where('resume_id='.$interest.' AND user_id='.$this->userid.' AND works_id='.$works_id)->find();
        if($myDelivery){
            die(json_encode(['status'=>0,'msg'=>'Please do not repeat delivery！']));
        }

        if(D('ResumeDelivery')->add(['resume_id'=>$interest,'user_id'=>$this->userid,'works_id'=>$works_id,'delivery_createtime'=>date('Y-m-d H:i:s',time())])){
            die(json_encode(['status'=>1,'msg'=>'Delivery success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Delivery failed!']));
        }
    }

    public function ClearMessages(){
        if(D('Message')->where('message_uid='.$this->userid)->delete()){
            die(json_encode(['status'=>1,'msg'=>'Clear Messages success!']));
        }else{
            die(json_encode(['status'=>0,'msg'=>'Clear Messages failed!']));
        }
    }

    public function MessageDetails(){
        $message_id = I('get.message_id',0,'intval');
        $myMessage = D('Message')->findone('message_id='.$message_id);
        $this->assign('myMessage',$myMessage);

        //更新阅读时间，和是否阅读
        $myMessage = D('Message')->updataone('message_id='.$message_id,['message_delivertime'=>date('Y-m-d',time()),'message_isread'=>1]);

        $this->assign('title','Message details');
        $css = addCss('MessageDetails');
        $this->assign('CSS',$css);
        $this->display();
    }
}