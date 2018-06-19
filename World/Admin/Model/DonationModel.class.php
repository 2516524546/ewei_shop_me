<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class DonationModel extends Model{

    protected  $trueTableName = 'u_donation';

    public function findone($where,$field=false){

        return $this->where($where)->field($field)->find();
    }

    public function updataone($where, $data)
    {
        return $this->where($where)->setField($data);
    }

    public function donatelist($join,$where,$order,$limit1,$limit2,$field=false,$jointype='INNER')
    {
        return $this->join($join,$jointype)->field($field)->where($where)->order($order)->limit($limit1,$limit2)->select();
    }
    public function donateone($join,$where,$order,$limit1,$limit2,$field=false,$jointype='INNER ')
    {
        return $this->join($join,$jointype)->field($field)->where($where)->order($order)->limit($limit1,$limit2)->find();
    }




}