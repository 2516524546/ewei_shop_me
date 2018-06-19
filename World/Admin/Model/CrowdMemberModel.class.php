<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class CrowdMemberModel extends Model{

    protected  $trueTableName = 'u_crowd_member';

    public function findone($where,$field=false){

        return $this->where($where)->field($field)->find();
    }

    public function findonejoin($where,$join,$jointype='INNER',$order='',$field=false){

        return $this->join($join,$jointype)->where($where)->field($field)->find();
    }

    public function updataone($where, $data)
    {
        return $this->where($where)->setField($data);
    }

    public function findlist($where,$join,$jointype='INNER',$order='',$field=false){

        return $this->join($join,$jointype)->where($where)->field($field)->order($order)->select();
    }

    public function findlistlimit($where,$join,$limit1,$limit2,$jointype='INNER',$order='',$field=false){

        return $this->join($join,$jointype)->where($where)->field($field)->order($order)->limit($limit1,$limit2)->select();
    }


}