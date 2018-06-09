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