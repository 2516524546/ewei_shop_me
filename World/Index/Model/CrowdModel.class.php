<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class CrowdModel extends Model{

    protected  $trueTableName = 'u_crowd';

    public function findone($where,$join,$jointype = 'INNER',$field=false){

        return $this->join($join,$jointype)->where($where)->field($field)->find();
    }

    public function updataone($where, $data)
    {
        return $this->where($where)->setField($data);
    }

    public function findlist($where,$join,$jointype = 'INNER',$order='',$field=false,$limit1 = 0,$limit2 = 10){

        return $this->join($join,$jointype)->where($where)->field($field)->order($order)->limit($limit1,$limit2)->select();
    }


}