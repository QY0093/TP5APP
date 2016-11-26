<?php

namespace app\demo\controller;
use think\Request;
class Blog extends \think\Controller {
    //自动注入，架构方法注入
//    protected $request;
//    public function __construct(Request $request = null) {
//        parent::__construct($request);
//    }
    
    public function helloAction(Request $request) {
        return 'Hello,'.$request->param('name').'!';
    }


    public function readAction($id=0) {
        return 'id='.$id;
    }
    
    public function archiveAction($year='2016', $month='01') {
        return 'year='.$year.'month='.$month;
    }
}
