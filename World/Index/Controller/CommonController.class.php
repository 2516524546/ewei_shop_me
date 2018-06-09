<?php

namespace Index\Controller;

use Index\Model\MessageModel;
use Index\Model\UserModel;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Think\Controller;

session_set_cookie_params(86400);
session_start();

class CommonController extends Controller
{

    public $userid;
    public $clientId;
    public $clientSecret;
    public $apiContext;
    public $usercontent;
    public $havemessage;

    public function _initialize()
    {

        $this->userid = session('userid');
        if ($this->userid){
            $usermodel = new UserModel();
            $this->usercontent = $usermodel->findone('user_id = '.$this->userid);

            $messagemodel = new MessageModel();
            $this->havemessage = $messagemodel->findone('message_uid = '.$this->userid.' and message_isread = 0');

        }
        //apiContext
        $this->clientId = 'AeruLT2FlpxVJoFS12M3a56-VVwgbrYHICRtVoX4FyiA2DvsQaeIa2Voj2n-9KxP6NWCldGFJSrqU_yY';
        $this->clientSecret = 'ENCl_G9VE59B6NELxW7iMHUS-ixopiu6emyYnhILERpCTq1QO0DL91YCJqleEPKzm81jTCpEILoSRFaW';
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $this->clientId, $this->clientSecret
            )
        );
        $this->apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../ayPal.log',
                'log.LogLevel' => 'DEBUG',
                'cache.enabled' => true
            )
        );
        $this->assign(array(
            'userid' => $this->userid,
            'usercontent' => $this->usercontent,
            'havemessage' => $this->havemessage,
        ));
    }

    //post判断
    public function post($string, $a = 0)
    {
        $name = $a ? $string : (isset($_POST[$string]) ? $_POST[$string] : null);
        if (is_null($name)) return null;
        if (!is_array($name)) {
            return htmlspecialchars(trim($name));
        }
        foreach ($name as $key => $value) {
            $post_array[$key] = self::post($value, 1);
        }
        return $post_array;
    }

    //get判断
    public function geturl($string)
    {
        $name = isset($_GET[$string]) ? $_GET[$string] : null;
        if (!is_array($name)) {

            return htmlspecialchars(trim($name));
        }
        return null;
    }

    //根据二维数组字段转化数字为两位小数
    public function array_set_float2($data = null, $key, $static = "*", $multiple)
    {

        //判断是否为数组，不是数组返回原来的数据
        if (is_array($data)) {

            foreach ($data as $k => $v) {
                if ($static == "/") {
                    $v[$key] = $v[$key] / $multiple;
                } else {
                    $v[$key] = $v[$key] * $multiple;
                }
                $data[$k][$key] = sprintf("%.2f", $v[$key]);
            }
            return $data;
        } else {
            return $data;
        }
    }

    //根据二维数组字段转化时间之保留年月日
    public function array_set_dateYMD($data = null, $key)
    {

        //判断是否为数组，不是数组返回原来的数据
        if (is_array($data)) {

            foreach ($data as $k => $v) {

                $data[$k][$key] = date('Y-m-d', strtotime($v[$key]));
            }
            return $data;
        } else {
            return $data;
        }
    }

    //定义verify方法实现生成验证码
    public function verify()
    {
        //导入命名空间，生成验证码对象
        $verify = new \Think\Verify();
        //自定义验证码属性
        //设置显示字体
        $verify->codeSet = '1234567890';
        //是否使用图片背景
        $verify->useImgBg = false;
        //是否使用混淆曲线
        $verify->useCurve = true;
        //是否使用杂点
        $verify->useNoise = false;
        //验证码位数
        $verify->length = 5;
        //设置字体
        $verify->fontttf = '4.ttf';
        //设置字体大小
        $verify->fontSize = 16;
        //兼容处理
        ob_clean();
        //生成验证码
        $verify->entry();
    }
    /*PayPal----------------------start---------------------------*/
    #Common
    //浏览器的友好输出
    public function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else
            return $output;
    }

    /**
     * ### getBaseUrl function
     * // utility function that returns base url for
     * // determining return/cancel urls
     *
     * @return string
     */
    public function getBaseUrl()
    {
        if (PHP_SAPI == 'cli') {
            $trace = debug_backtrace();
            $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
            echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
            return "http://localhost" . $relativePath;
        }
        $protocol = 'http';
        if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
            $protocol .= 's';
        }
        $host = $_SERVER['HTTP_HOST'];
        $request = $_SERVER['PHP_SELF'];
        return dirname($protocol . '://' . $host . $request);
    }


}