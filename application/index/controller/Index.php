<?php

namespace app\index\controller;

use think\Controller;

class Index extends Controller {

    /**
    protected $beforeActionList = [
        'first',
        'second' => ['only' => 'hello'],
        'third' => ['except' => 'data, index']
    ];
     * 
     */


    /**
     * 控制器初始化
     */
    /**
    public function _initialize() {
        parent::_initialize();
        echo "initialize<br>";
    }
     * 
     * 
     * @return type
     */
    
    public function indexAction() {
        $row = \think\Config::get('database.username');
        var_dump($row);
        return $this->fetch();
    }
    
    public function helloAction($id="", $name="") {
        $request = \think\Request::instance();
        echo url("admin/console/login");
        var_dump($request->user->email);
        echo "hello $id - $name<br>";
    }
    
//    public function helloAction(\think\Request $request) {
////        $id = $request->get();
//        echo "hello $id - $name<br>";
//    }
    
    public function dataAction() {
        \think\Config::set("a", 100, "man");
        $a = \think\Config::get("", "man");
        var_dump($a);
        echo "data<br>";
    }
    
    public function first() {
        echo "first<br>";
    }
    
    public function second() {
        echo "second<br>";
    }
    
    public function third() {
        echo "third<br>";
    }

    public function _empty($a = "", $b = "") {
        var_dump($a, $b);
        echo "不存在方法的时候，调用我";
    }
}
