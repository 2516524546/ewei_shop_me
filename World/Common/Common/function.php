<?php
/**
 * Created by PhpStorm.
 * User: hfadmin
 * Date: 2018/6/9
 * Time: 17:46
 */
if(!function_exists('addCss')){
    function addCss($css,$basePath = __ROOT__ .'/Public/Web/web/css/'){
        $result = [];
        if(is_array($css)){
            foreach($css as $c){
                $result[] = $basePath.$c.'.css';
            }
        }else{
            $result[] = $basePath.$css.'.css';
        }
        return $result;
    }
}
//公共函数，检验是否是合法的邮箱的格式
function isEmail($email){
    $pattern="/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i";
    if(preg_match($pattern,$email)){
        return true;
    } else{
        echo false;
    }
}
