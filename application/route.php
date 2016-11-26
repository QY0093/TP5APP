<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

think\Route::get("/", function() {
    echo "Hello World!!!";
});

//一个项目只有一个模块，可以绑定到模块，URL地址不再需要模块
//如果其他模块也在使用，则不能绑定模块
Route::bind("app", "module");

//id相当于占位符
//做了route路由后，普通路由不能使用，即index/news/read/id/256
//Route::rule('new/:id','index/News/read');
//Route::rule('new/:id','index/news/update','POST');
/**
//快捷路由
Route::post('new/:id','index/news/update');
Route::get('new/:id','index/news/read');
Route::put('new/:id','index/news/update');
Route::delete('new/:id','index/news/delete');
Route::any('new/:id','index/news/read');
 * 
 */

//批量注册
//Route::rule([
////   'new/:id/[:month]' => 'index/News/read', 
////   'new/:id/[:month]' => 'index/News/read?status=100', 
////    'blog/:id' => 'index/blog/read'
//]);

Route::get('new/:id/[:month]','index/news/read',[
    'cache' => 3600
],['__url__'=>'new\/\w+$']);

Route::get("/baidu", "http://www.baidu.com");
Route::get("/sina", function() {
//    throw new Exception("学霸");
//    die();
//    return redirect("http://www.weibo.com");
   header("Location: http://www.weibo.com");
   exit();
});

Route::get("/login", "index/index/hello");

Route::get("/demo/:var", "app\index\service\Blog@demo");
Route::get("/demo/:var$", "app\index\service\Blog@demo");

//快捷路由
//Route::controller('user','index/User');

// user 别名路由到 index/User 控制器
//Route::alias('user','index/User');
//Route::alias('user','index/User/phone');
//Route::alias('user','\app\index\Controller\User');

//路由分组
//Route::group('blog',function(){
//Route::rule(':id','blog/read','',['id'=>'\d+']);
//Route::rule(':name','blog/read','',['name'=>'\w+']);
//},['method'=>'get','ext'=>'html']);


//闭包支持
Route::get("closure/:var", function($var) {
    return "Hello " . strtoupper($var);
});

Route::rule('hello/:user_id', 'index/index/hello', 'GET', [
    'bind_model' => [
        'user' => function($param) {
//            var_dump($param);
//            return;
            $model = new \app\index\model\Users;
            $row = $model->where($param)->find();
//            var_dump($row);
            return $row;
        }
    ],
]);
    
//定义新的REST规则。将会覆盖之前rest规则
//全局规则替换
//Route::rest('create', ['GET', '/add','add']);    
//Route::rest('update', ['post', '/:id/update', 'update']); \   
//Route::rest('delete', ['get', '/:id/delete', 'delete']);

//自定义REST规则
//Route::rest([
//    'delete'=>['get', '/:id/delete', 'delete'],
//     'update'=>['post', '/:id/update', 'update']
//    ]);

Route::resource('blog','index/blog');
Route::resource('product','index/product');

Route::resource('blog.comment','index/comment');

//APP模块的RESTFUL接口
Route::resource("order", "app/order");

//绑定参数
//以下两种方式相同。key值并没有起作用
//Route::resource('blog','index/blog',['var'=>'blog_id']);
//Route::resource('blog','index/blog',['var'=>['blog'=>'blog_id']]);

//过滤
// 只允许index read edit update 四个操作
//Route::resource('blog','index/blog',['only'=>['index','read','edit','update']]);



return [
//    'item-<name>-<id>'=>['index/product/detail',[],['name'=>'\w+','id'=>'\d+']],
    ['item-<name>-<id>','index/product/detail',[],['name'=>'\w+','id'=>'\d+']],
//    'new/:id/[:month]' => 'index/News/read?status=100',
    //组合变量
    'n/:id' => ['index/news/read',['method' => 'post|put|get'], ['id' => '\d+']],
//    'n/<id>' => ['index/news/read',['method' => 'post|put|get'], ['id' => '\d+']],
    
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
//    '__alias__' => [
//        'user' => 'index/User/phone'
//    ],
    
    //最后的路由
//    '__miss__' => 'a/404',

];
