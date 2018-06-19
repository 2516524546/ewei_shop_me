<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class FirstMarkModel extends Model{

    protected  $trueTableName = 's_first_mark';

    public function findone($where,$field=false){

        return $this->where($where)->field($field)->find();
    }

    public function findlist($where,$order='',$field=false){

        return $this->where($where)->field($field)->order($order)->select();
    }

    public function updataone($where, $data)
    {
        return $this->where($where)->setField($data);
    }






}