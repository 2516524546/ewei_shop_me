<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class ProposalModel extends Model{

    protected  $trueTableName = 's_proposal';

    public function findone($where,$field=false){

        return $this->where($where)->field($field)->find();
    }

    public function updataone($where, $data){

        return $this->where($where)->setField($data);
    }

    public function findsome($where,$field=false){

        return $this->where($where)->field($field)->select();
    }

}