<?php
namespace app\app\controller;

class UserBase extends \think\Controller {
    
    protected $userid;
    
    protected function _initialize() {
        parent::_initialize();
        $this->checkSigninStatus();
    }
    
    /**
     * 检查登录状态
     */
    public function checkSigninStatus() {
//        echo "Hello World!!!";
        //1.获取SESSIONID，确保是同一个SESSION下的会话
        //2.把会话转移到当前的SESSIONID上
//        var_dump($_SERVER);
        $sessionid = !empty($_SERVER['HTTP_SESSIONID'])? $_SERVER['HTTP_SESSIONID'] : null;
        if (empty($sessionid)) {
            $message = [
                'status' => 4004,
                'message' => 'SESSIONID不存在，请重新登录',
                'data' => []
            ];
            $header = [];
            \think\Response::create($message, "json", 2000, $header)->send();
            die();
        }
//        var_dump($sessionid);
        session_id($sessionid);
        session_start();
        if(empty($_SESSION['token'])) {
            $message = [
                'status' => 4001,
                'message' => 'Token不存在，请重新登录',
                'data' => []
            ];
            $header = [];
            \think\Response::create($message, "json", 2000, $header)->send();
            die();
        }
        $request = \think\Request::instance();
        $token = $request->param("token");
//        var_dump($token);
        if(md5($_SESSION['token']) != $token) {
             $message = [
                'status' => 4002,
                'message' => 'Token错误，请重新登录',
                'data' => []
            ];
            $header = [];
            \think\Response::create($message, "json", 2000, $header)->send();
            die();
        }
        list($username, $userid) = explode("-", $_SESSION["token"]);
        //获取userid,并赋值到属性，可以在整个类或子类中传递使用
        $this->userid = $userid;
//        var_dump($_SESSION);
//        return true;
        
        //1.资源，就是URL
        $url = $request->pathinfo();
        var_dump($url);
        //2.获取用户权限
        $permission = [
            'order', 'user/index', 'user/update', 'signout'
        ];
        //3.判断资源在用户权限允许列表里
        if (in_array($url, $permission)) {
            //do nothing
        } else {
            $message = [
                'status' => 4010,
                'message' => '没有权限',
                'data' => []
            ];
            $header = [];
            \think\Response::create($message, "json", 2000, $header)->send();
            die();
        }
        
    }
}
