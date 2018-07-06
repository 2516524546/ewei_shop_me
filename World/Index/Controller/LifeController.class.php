<?php
namespace Index\Controller;
use Index\Model\AdvertisingModel;
use Index\Model\CommodityModel;
use Index\Model\CrowdMemberModel;
use Index\Model\CrowdModel;
use Index\Model\CrowdTabModel;
use Index\Model\FirstMarkModel;
use Index\Model\ModuleModel;
use Index\Model\NewsModel;
use Index\Model\NoteCommentModel;
use Index\Model\NoteModel;
use Index\Model\NoteVIModel;
use Index\Model\QuestionModel;
use Index\Model\ResourceModel;
use Index\Model\SecondMarkModel;
use Index\Model\UserModel;
use Think\Controller;
use Think\Exception;

class LifeController extends CommonController {
    public $modeleid = 5;

    //生活{:L('newworld_home')}
    public function life(){

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

        $commoditymodel = new CommodityModel();
        $commoditylist = $commoditymodel->joinonelist('commodity_status = 1','u_user u on l_commodity.commodity_uid = u.user_id','commodity_updatetime desc',0,2);
        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();
        $crodmodel = new CrowdModel();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
        $data = array();
        foreach ($firstlist as $firthkey =>$first){

            $data[$firthkey] = $first;
            $secondlist = $secondmodel->findlist('second_mark_fid = '.$first['first_mark_id'],'second_mark_sort');
            $data[$firthkey]['message'] = $secondlist;
        }

        $crodlist = $crodmodel->findlist('crowd_mid = '.$this->modeleid,'u_user u on u_crowd.crowd_uid = u.user_id','INNER','crowd_creattime desc','u.user_name,u_crowd.*');

        $crowdcount = $crodmodel->findone('crowd_mid = '.$this->modeleid,'','','count(*) num')['num'];
        $modulemodel = new ModuleModel();
        $moduleone = $modulemodel->findone('module_id = '.$this->modeleid);

        $now = date("Y-m-d H:i:s", time());
        $advertisingmodel = new AdvertisingModel();
        $advertisinglist = $advertisingmodel->findlist('advertising_for = 1 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'"');

        $this->assign(array(
            'moduleone' => $moduleone,
            'advertisinglist' => $advertisinglist,
            'commoditylist' => $commoditylist,
            'data' =>$data,
            'crodlist'=>$crodlist,
            'crowdcount' => $crowdcount,

        ));

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
        $commoditylist = $commoditymodel->joinonelist('commodity_status = 1','u_user u on l_commodity.commodity_uid = u.user_id','commodity_updatetime desc',0,10,'LEFT');

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

    //我发布的商品
    public function mineProduct(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $comoditymodel = new CommodityModel();

        $comditycount = $comoditymodel->findone('commodity_uid = '.$this->userid.' and commodity_status != 0','count(*) num')['num'];

        $this->assign(array(
            'comditycount' => $comditycount,
        ));

        $this->display();
    }

    function good_detail(){
        $id=$_GET['id'];
        $commodity=M('l_commodity')->where("commodity_id={$id}")->find();
        if ($commodity){
            die(json_encode(array('str' => 1, 'msg' => $commodity)));
        }else{
            die(json_encode(array('str' => 2, 'msg' => '查询失败')));
        }
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
        $this->userid;
          $id=$_GET['cid'];
        $commoditymodel = new CommodityModel();
        $commodity=$commoditymodel->findoneJoin("commodity_id=$id",'u_user u on l_commodity.commodity_uid = u.user_id','LEFT');
        $id=$commodity['commodity_id'];
        $commentCount=M('l_commodity_comment')->where("commodity_comment_cid=$id")->count();
        $this->assign("commentCount",$commentCount);
        $this->assign("commodity",$commodity);
        $this->assign("cid",$id);
        $this->display();
    }

    //删除商品
    function ajax_del_good(){
         $cid=$_POST['cid'];
         $res=M('l_commodity')->where("commodity_id={$cid}")->delete();
         if ($res){
             die(json_encode(array('str' => 1, 'msg' => '删除成功')));
         }else{
             die(json_encode(array('str' => 2, 'msg' => '删除失败')));
         }
    }
    //更新我发布的商品
    function good_update(){
        $cid=$_POST['commodity_id'];
        $res=M('l_commodity')->where("commodity_id={$cid}")->save($_POST);
        if ($res){
            die(json_encode(array('str' => 1, 'msg' => '更新成功')));
        }else{
            die(json_encode(array('str' => 2, 'msg' => '更新失败')));
        }
    }


//分页加载评论列表
    public function ajax_commentList()
    {
        $cid=$_POST['cid'];
        $limit1=$_POST['limit1'];
        $limit2=$_POST['limit2'];
        $commentlist=M('l_commodity_comment')->where("commodity_comment_cid=$cid")->join('u_user u on commodity_comment_uid = u.user_id','LEFT')->limit($limit1,$limit2)->select();
        if ($commentlist) {
            die(json_encode(array('str' => 1, 'msg' => $commentlist)));
        } else {
            die(json_encode(array('str' => 2, 'msg' => '商品评论暂无数据')));
        }
    }
    //点赞
    function comment_zan(){
        $id=$_POST['cid'];
        $uid=$this->userid;
        //判断是否点赞过
        $comment=M('l_commodity_comment')->where("commodity_comment_id={$id}")->find();
        $uidlist = explode(',',$comment['commodity_comment_zaner']);
        if (in_array($uid,$uidlist)){
            //取消点赞
             //从数组中移除该元素
            foreach($uidlist as $k=>$v) {
                if($uid == $v)
                {
                    unset($uidlist[$k]);
                    break;
                }
            }
            $zaner=implode(",", $uidlist);
            $post['commodity_comment_zans']=$comment['commodity_comment_zans']-1;
            $post['commodity_comment_zaner']=$zaner;
            $res=M('l_commodity_comment')->where("commodity_comment_id={$id}")->save($post);
            if ($res){
                die(json_encode(array('str' => 3, 'msg' => '取消点赞成功')));
            }else{
                die(json_encode(array('str' => 2, 'msg' => '取消点赞失败')));
            }
        }else{
             //点赞
             $post['commodity_comment_zans']=$comment['commodity_comment_zans']+1;
             if (!empty($comment['commodity_comment_zaner'])){
                 $post['commodity_comment_zaner']=$comment['commodity_comment_zaner'].",".$uid;
             }else{
                 $post['commodity_comment_zaner']=$uid;
             }

             $res=M('l_commodity_comment')->where("commodity_comment_id={$id}")->save($post);
             if ($res){
                 die(json_encode(array('str' => 1, 'msg' => '点赞成功')));
             }else{
                 die(json_encode(array('str' => 2, 'msg' => '点赞失败')));
             }
            //
        }
    }
    //发表商品评论
    public function post_good_comment(){
        try{
            $post['commodity_comment_cid']=$_POST['cid'];
            $post['commodity_comment_uid']=$this->userid;
            $post['commodity_comment_content']=$_POST['content'];
            $post['commodity_comment_zans']=0;
            $post['commodity_comment_createtime']=date("Y-m-d H:i:s",time());
            $res=M('l_commodity_comment')->add($post);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => '发表成功')));
            }else{
                die(json_encode(array('str' => 2, 'msg' => '发表失败')));
            }
        }catch (Exception $e){
            die(json_encode(array('str' => 2, 'msg' => $e->getMessage())));
        }
    }




    //创建生活群
    public function createLife(){

        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $data = array();

        $firstmodel = new FirstMarkModel();
        $secondmodel = new SecondMarkModel();
        $firstlist = $firstmodel->findlist('first_mark_mid = '.$this->modeleid.' and first_mark_type = 1','firsth_mark_sort');
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

    //发送回复
    function comment_reply(){
        $rid=$_POST['rid'];
        $post['commodity_comment_reply']=$_POST['content'];
        $res=M('l_commodity_comment')->where("commodity_comment_id={$rid}")->save($post);
        if ($res){
            die(json_encode(array('str' => 1, 'msg' => '回复成功')));
        }else{
            die(json_encode(array('str' => 2, 'msg' => '回复失败')));
        }


    }

    //收藏商品
    function collect_goods(){
          //var_dump($_POST['id']);
        $cid=$_POST['id'];
        $uid=$this->userid;
        $have=M("l_commodity_collect")->where("commodity_collect_uid={$uid} and commodity_collect_cid={$cid}")->find();
        if ($have){
            die(json_encode(array('str' => 2, 'msg' => '你已经收藏过了')));
        }else{
            //添加数据
            $post['commodity_collect_cid']=$_POST['id'];
            $post['commodity_collect_uid']=$uid;
            $post['commodity_collect_createtime']=date("Y-m-d H:i:s", time());
            $res=M("l_commodity_collect")->add($post);
            if ($res){
                die(json_encode(array('str' => 1, 'msg' => '收藏成功')));
            }else{
                die(json_encode(array('str' => 2, 'msg' => '收藏失败')));
            }
        }

    }


    //生活群详情
    public function lifeDetails(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Life/life'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'u_user u on u_crowd.crowd_uid = u.user_id','INNER','u_crowd.*,u.user_name');
        if (!$crowdone){
            Header("Location:".U('Index/Life/life'));
            exit();
        }

        if ($crowdone['crowd_mid']!=$this->modeleid){
            if ($crowdone['crowd_mid']==1){
                Header("Location:".U('Index/Index/index'));
                exit();
            }
            if ($crowdone['crowd_mid']==2){
                Header("Location:".U('Index/Rnterst/interest'));
                exit();
            }
            if ($crowdone['crowd_mid']==3){
                Header("Location:".U('Index/Academic/academic'));
                exit();
            }
            if ($crowdone['crowd_mid']==4){
                Header("Location:".U('Index/Jobs/work'));
                exit();
            }
            if ($crowdone['crowd_mid']==5){
                Header("Location:".U('Index/Life/life'));
                exit();
            }
        }

        $crowdmembermodel = new CrowdMemberModel();
        $join_in = 0;
        if ($this->userid){

            $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);

            if ($memberone){
                $join_in = 1;
            }
        }
        $adminlist = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'].' and crowd_member_status !=0','u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,4,'INNER','crowd_member_status desc','u_crowd_member.*,u.user_icon');
        $memberlist = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'].' and crowd_member_status =0','u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,8,'INNER','crowd_member_status desc,crowd_member_logintime desc','u_crowd_member.*,u.user_icon');

        $notemodel = new NoteModel();
        $questionmodel = new QuestionModel();
        $resourcemodel = new ResourceModel();

        $notelist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 1','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);
        $notecount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 1','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        /*$questionlist = $questionmodel->joinonelist('question_cid = '.$_GET['cid'].' and question_ishide = 1','u_user u on u_question.question_uid = u.user_id','question_istop desc,question_iswally desc,question_createtime desc',0,20);

        $questioncount = $questionmodel->joinone('question_cid = '.$_GET['cid'].' and question_ishide = 1','u_user u on u_question.question_uid = u.user_id','question_istop desc,question_iswally desc,question_createtime desc','INNER','count(*) num')['num'];*/
        $questionlist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $questioncount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 2','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        /*$resourcelist = $resourcemodel->joinonelist('resource_cid = '.$_GET['cid'].' and resource_ishide = 1','u_user u on u_resource.resource_uid = u.user_id','resource_istop desc,resource_iswally desc,resource_createtime desc',0,20);

        $resourcecount = $resourcemodel->joinone('resource_cid = '.$_GET['cid'].' and resource_ishide = 1','u_user u on u_resource.resource_uid = u.user_id','resource_istop desc,resource_iswally desc,resource_createtime desc','INNER','count(*) num')['num'];*/
        $resourcelist = $notemodel->joinonelist('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc',0,20);

        $resourcecount = $notemodel->joinone('note_cid = '.$_GET['cid'].' and note_ishide = 1 and note_type = 3','u_user u on u_note.note_uid = u.user_id','note_istop desc,note_iswally desc,note_createtime desc','INNER','count(*) num')['num'];

        $now = date("Y-m-d H:i:s", time());

        $newsmodel = new NewsModel();
        $newslist = $newsmodel->findlist('news_static = 1 and news_for = 2 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'" and news_crowdid = '.$_GET['cid'],'news_sort desc');
        if (!$newslist){
            $newslist = $newsmodel->findlist('news_static = 1 and news_for = 2 and news_mid = '.$this->modeleid.' and news_endtime > "'.$now.'" and news_crowdid = 0','news_sort desc');
        }
        $advertisingmodel = new AdvertisingModel();
        $advertisinglist = $advertisingmodel->findlist('advertising_for = 2 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'" and advertising_crowdid = '.$_GET['cid']);
        if (!$advertisinglist){
            $advertisinglist = $advertisingmodel->findlist('advertising_for = 2 and advertising_mid = '.$this->modeleid.' and advertising_finishtime > "'.$now.'" and advertising_crowdid = 0');
        }

        session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        $this->assign(array(
            'newslist' => $newslist,
            'advertisinglist' => $advertisinglist,
            'crowone' => $crowdone,
            'join_in' => $join_in,
            'adminlist' => $adminlist,
            'memberlist' => $memberlist,
            'cid' => $_GET['cid'],
            'notelist' => $notelist,
            'notecount' => $notecount,
            'questionlist' => $questionlist,
            'questioncount' => $questioncount,
            'resourcelist' => $resourcelist,
            'resourcecount' => $resourcecount,

        ));

        $this->display();

    }

    //新闻详情
    public function crowdnews(){

        $newsmodel = new NewsModel();
        $newsone = $newsmodel->findone('news_id = '.$_GET['nid']);

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $this->assign(array(
            'newsone' => $newsone,
            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
        ));
        $this->display();
    }


    //帖子发布
    public function groupDetailsRelease(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Life/life'));
            exit();
        }
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        $crowdmodel = new CrowdModel();
        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid'],'');

        if (!$crowdone){
            Header("Location:".U('Index/Life/life'));
            exit();
        }

        if ($crowdone['crowd_mid']!=$this->modeleid){
            if ($crowdone['crowd_mid']==1){
                Header("Location:".U('Index/Index/index'));
                exit();
            }
            if ($crowdone['crowd_mid']==2){
                Header("Location:".U('Index/Rnterst/interest'));
                exit();
            }
            if ($crowdone['crowd_mid']==3){
                Header("Location:".U('Index/Academic/academic'));
                exit();
            }
            if ($crowdone['crowd_mid']==4){
                Header("Location:".U('Index/Jobs/work'));
                exit();
            }
            if ($crowdone['crowd_mid']==5){
                Header("Location:".U('Index/Life/life'));
                exit();
            }
        }

        $crowdmembermodel = new CrowdMemberModel();
        $memberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid);
        if (!$memberone){
            Header("Location:".U('Index/Life/lifeDetails').'&cid = '.$_GET['cid']);
            exit();
        }

        $crowdtabmodel = new CrowdTabModel();
        $tablist = $crowdtabmodel->findlist('','crowd_tab_sort');
        $this->assign(array(
            'tablist' => $tablist,
            'cid' => $_GET['cid'],
            'crowdone' => $crowdone,
        ));

        $this->display();
    }

    /*
    生活帖子详情
     */
    public function postDetails(){
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }

        if (!isset($_GET['cid'])||$_GET['cid']==''){
            Header("Location:".U('Index/Life/life'));
            exit();
        }
        if (!isset($_GET['nid'])||$_GET['nid']==''){
            Header("Location:".U('Index/Life/lifeDetails')."&cid=".$_GET['cid']);
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();
        $notemodel = new NoteModel();
        $notevimodel = new NoteVIModel();
        $notecommentmodel = new NoteCommentModel();
        $usermodel = new UserModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        if ($crowdone['crowd_mid']!=$this->modeleid){
            if ($crowdone['crowd_mid']==1){
                Header("Location:".U('Index/Index/index'));
                exit();
            }
            if ($crowdone['crowd_mid']==2){
                Header("Location:".U('Index/Rnterst/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==3){
                Header("Location:".U('Index/Academic/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==4){
                Header("Location:".U('Index/Jobs/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
            if ($crowdone['crowd_mid']==5){
                Header("Location:".U('Index/Life/postDetails').'&cid='.$_GET['cid'].'&nid='.$_GET['nid']);
                exit();
            }
        }

        $crowdmemberone = $crowdmembermodel->findone('crowd_member_cid = '.$_GET['cid'].' and crowd_member_uid = '.$this->userid.' and crowd_member_status != -1');
        $noteone = $notemodel->findone('note_id = '.$_GET['nid']);
        if ($noteone['note_cid']!=$_GET['cid']){
            Header("Location:".U('Index/Life/lifeDetails')."&cid=".$_GET['cid']);
            exit();
        }
        $vilist = $notevimodel->findlist('note_vi_nid = '.$_GET['nid'],'note_vi_sort desc');
        $commentlist = $notecommentmodel->joinonelist('note_comment_nid = '.$_GET['nid'],'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_isanswer desc,note_comment_zans desc,note_comment_createtime desc',0,10);
        foreach ($commentlist as $key => $comment){
            $uidlist = explode(',',$comment['note_comment_zaner']);
            if (in_array($this->userid,$uidlist)){

                $commentlist[$key]['iszan'] = 1;
            }else{

                $commentlist[$key]['iszan'] = 0;
            }
        }
        $commentcount = $notecommentmodel->joinone('note_comment_nid = '.$_GET['nid'],'u_user u on u_note_comment.note_comment_uid = u.user_id','note_comment_zans desc,note_comment_createtime desc','INNER','count(*) num')['num'];
        $noteuser = $usermodel->findone('user_id = '.$noteone['note_uid']);

        $isjoin = 0;
        $ishave = 0;
        if ($crowdmemberone){
            $isjoin = 1;
        }
        if ($noteone['note_uid']==$this->userid){
            $ishave = 1;
        }

        $isdown = 0;
        $downloadlist = explode(',',$noteone['note_downloadmember']);
        if (in_array($this->userid, $downloadlist)){
            $isdown=1;
        }

        $this->assign(array(
            'crowdone' => $crowdone,
            'isjoin' => $isjoin,
            'crowdmemberone' => $crowdmemberone,
            'noteone' => $noteone,
            'cid' => $_GET['cid'],
            'noteuser' => $noteuser,
            'ishave' => $ishave,
            'vilist' => $vilist,
            'isdown' => $isdown,
            'commentlist' => $commentlist,
            'commentcount' => $commentcount

        ));


        $this->display();
    }


    /*
    更多成员
     */
    public function moreMembers(){

        if (!isset($_GET['cid'])){
            Header("Location:".U('Index/Life/life'));
            exit();
        }
        if (!$this->userid){
            session('returnurl', $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            Header("Location:".U('Index/Login/login'));
            exit();
        }
        $crowdmodel = new CrowdModel();
        $crowdmembermodel = new CrowdMemberModel();

        $crowdone = $crowdmodel->findone('crowd_id = '.$_GET['cid']);

        $list = $crowdmembermodel->findlistlimit('crowd_member_cid = '.$_GET['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id',0,10,'INNER','crowd_member_status desc,crowd_member_logintime desc','u_crowd_member.*,u.user_icon,u.user_name');
        $listcount =$crowdmembermodel->findonejoin('crowd_member_cid = '.$_GET['cid'],'u_user u on u_crowd_member.crowd_member_uid = u.user_id','INNER','crowd_member_status desc,crowd_member_logintime desc','count(*) num')['num'];

        $adminlist = array();
        $memberlist = array();
        foreach ($list as $l){
            if ($l['crowd_member_status']!=0){
                $adminlist[]=$l;
            }else if ($l['crowd_member_status']==0){
                $memberlist[]=$l;
            }
        }

        $this->assign(array(
            'crowdone'=>$crowdone,
            'cid' => $_GET['cid'],
            'adminlist' => $adminlist,
            'memberlist' => $memberlist,
            'listcount' => $listcount,

        ));

        $this->display();
    }

}