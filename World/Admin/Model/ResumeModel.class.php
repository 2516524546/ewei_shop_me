<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class ResumeModel extends Model{

    protected  $trueTableName = 'u_resume';

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




}