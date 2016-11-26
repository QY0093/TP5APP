<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Error extends Controller {

    public function indexAction(Request $request) {
        /**
        echo "error/index";
        echo "<br>";
//        var_dump($request);
        // 获取当前域名
        echo 'domain: ' . $request->domain() . '<br/>';
        // 获取当前入口文件
        echo 'file: ' . $request->baseFile() . '<br/>';
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        // 获取包含域名的完整URL地址
        echo 'url with domain: ' . $request->url(true) . '<br/>';
        // 获取当前URL地址 不含QUERY_STRING
        echo 'url without query: ' . $request->baseUrl() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的PATH_INFO信息 不含后缀
        echo 'pathinfo: ' . $request->path() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';

        $a = $request->get("a", "0", "intval");
        var_dump($a);

        echo "当前模块名称是" . $request->module();
        echo "当前控制器名称是" . $request->controller();
        echo "当前操作名称是" . $request->action();

        echo '路由信息：';
        dump($request->route());
        echo '调度信息：';
        dump($request->dispatch());
        
         * 
         */
        var_dump($request->has("a", "get"));
        var_dump($request->param("b"));
        var_dump($request->param());
        var_dump($request->get());
        var_dump($request->post());
//        var_dump($request->request());
//        var_dump($_SERVER);
//        var_dump($request->server("HTTP_COOKIE"));
        
//        var_dump($request->param("b","", "strip_tags,strtolower"));
        
        var_dump($request->header());
    }

}
