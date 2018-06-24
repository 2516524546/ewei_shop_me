<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class FriendsModel extends Model{

    protected  $trueTableName = 'u_firends';

    const TYPE_FRIEND = 1;//好友
    const TYPE_BLACKLISTED = 2;//被拉黑
    const TYPE_DEFRIEND = 3;//拉黑
    const TYPE_MUTUALBLACK = 4;//互黑
    const TYPE_BEDELETED = 5;//被删
    const TYPE_BLACKANDDELETED = 6;//拉黑对方，对方删除我
    const TYPE_DELETED = 7;//删除对方
    const TYPE_DELETEDANDBLACK = 8;//删除对方,对方拉黑我
    const TYPE_MUTUALDELETING = 9;//互删

    public function findone($where,$field=false){

        return $this->where($where)->field($field)->find();
    }

    public function updataone($where, $data)
    {
        return $this->where($where)->setField($data);
    }

    public function findlist($where,$order='',$field=false){

        return $this->where($where)->field($field)->order($order)->select();
    }

    public function limitlist($where,$limit1,$limit2,$order='',$field=false){

        return $this->where($where)->field($field)->order($order)->limit($limit1,$limit2)->select();
    }

    public function joinonelist($where,$join1,$order,$limit1,$limit2,$jointype1='INNER',$field=false){

        return $this->join($join1,$jointype1)->field($field)->where($where)->order($order)->limit($limit1,$limit2)->select();
    }

    public function addone(array $data){
        $data['firends_updatetime'] = isset($data['firends_updatetime']) ? $data['firends_updatetime'] : date('Y-m-d H:i:s',time());
        $data['firends_createtime'] = isset($data['firends_createtime']) ? $data['firends_createtime'] : date('Y-m-d H:i:s',time());
        $data['firends_type'] = $this->_checkFriendType(self::TYPE_FRIEND,$data);
        return $this->add($data);
    }

    /**
     * 获取好友类型
     * @param int   $type
     * @param array $data
     * @return const
     */
    public function getFriendType($type,array $data){
        $firends_type = self::TYPE_FRIEND;
        $friend = $this->findone(['firends_uid'=>$data['firends_aid'],'firends_aid'=>$data['firends_uid']],'firends_type');
        if($friend){
            $firends_type = $friend['firends_type'];
        }
        switch ($firends_type){
            case self::TYPE_FRIEND:         //firend是我的好友
            case self::TYPE_BLACKLISTED:
            case self::TYPE_BEDELETED:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_DEFRIEND;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_DELETED;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_FRIEND;
                        break;
                }
                break;
            case self::TYPE_DEFRIEND:       //firend拉黑了我
            case self::TYPE_MUTUALBLACK:
            case self::TYPE_BLACKANDDELETED:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_MUTUALBLACK;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_DELETEDANDBLACK;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_BLACKLISTED;
                        break;
                }
                break;
            case self::TYPE_DELETED:        //firend删除了我
            case self::TYPE_DELETEDANDBLACK:
            case self::TYPE_MUTUALDELETING:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_BLACKANDDELETED;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_MUTUALDELETING;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_BEDELETED;
                        break;
                }
                break;
        }

        return $uid_type;
    }

    /**
     * 检查好友类型
     * @param int   $type
     * @param array $data
     * @return const
     */
    private function _checkFriendType($type,array $data){
        $firends_type = self::TYPE_FRIEND;
        $friend = $this->findone(['firends_uid'=>$data['firends_aid'],'firends_aid'=>$data['firends_uid']],'firends_type');
        if($friend){
            $firends_type = $friend['firends_type'];
        }elseif($type === self::TYPE_FRIEND){
            //如果没有记录，说明2用户第一次添加好友，互加为好友
            $friend['firends_updatetime'] = isset($data['firends_updatetime']) ? $data['firends_updatetime'] : date('Y-m-d H:i:s',time());
            $friend['firends_createtime'] = isset($data['firends_createtime']) ? $data['firends_createtime'] : date('Y-m-d H:i:s',time());
            $friend['firends_uid'] = $data['firends_aid'];
            $friend['firends_aid'] = $data['firends_uid'];
            $friend['firends_type'] = self::TYPE_FRIEND;
            $this->add($friend);

        }
        switch ($firends_type){
            case self::TYPE_FRIEND:         //firend是我的好友
            case self::TYPE_BLACKLISTED:
            case self::TYPE_BEDELETED:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_DEFRIEND;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_DELETED;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_FRIEND;
                        break;
                }
                break;
            case self::TYPE_DEFRIEND:       //firend拉黑了我
            case self::TYPE_MUTUALBLACK:
            case self::TYPE_BLACKANDDELETED:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_MUTUALBLACK;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_DELETEDANDBLACK;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_BLACKLISTED;
                        break;
                }
                break;
            case self::TYPE_DELETED:        //firend删除了我
            case self::TYPE_DELETEDANDBLACK:
            case self::TYPE_MUTUALDELETING:
                switch ($type){
                    case 2:                 //拉黑
                        $uid_type = self::TYPE_BLACKANDDELETED;
                        break;
                    case 3:                 //删除
                        $uid_type = self::TYPE_MUTUALDELETING;
                        break;
                    default:                //添加好友
                        $uid_type = self::TYPE_BEDELETED;
                        break;
                }
                break;
        }

        return $uid_type;
    }
}