<?php

namespace Index\Model;

use Think\Db;
use Think\Model;

class ItemModel extends Model{

    protected  $trueTableName = 'j_item';
    public function check_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}