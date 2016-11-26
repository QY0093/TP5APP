<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Users;

class User extends Controller {

    public function indexAction() {
        /**
          $User = new Users();
          $all = $User->all();
          //        var_dump($all);
          $row = $User->get(22);
          var_dump($row);
         * 
         */
        $query = new \think\db\Query();
        $query->name('users')->where('user_id', 32);
        \think\Db::find($query);
        $row = \think\Db::select($query);
        var_dump($row);
    }

    /**
     * 增加
     */
    public function addAction() {
        
          $User = new Users();
          $User->email = "lisi@163.com";
          $User->user_name = "lisi" . rand(1000, 9999);
          $User->password = md5("123456");
          $User->save();
        
        /**
        $data = [
            ['user_name' => '测试106', 'password' => md5('123456')],
            ['user_name' => '测试107', 'password' => md5('123456')],
            ['user_name' => '测试108', 'password' => md5('123456')]
        ];
        \think\Db::name('users')->insertAll($data);
        $id = \think\Db::getLastInsID();
        var_dump($id);
         * 
         */
    }

    /**
     * 更新
     */
    public function updateAction() {
        $User = new Users();
        $U = $User->get([
            'user_name' => 'lisi7769'
        ]);
//        var_dump($U);
        $U->email = "lisi7769@126.com";
        $U->password = md5("654321");
        $U->save();
    }

    /**
     * 删除
     */
    public function deleteAction() {
        $User = new Users();
//        $U = $User::get([
//            'user_name' => 'wangwu'
//        ]);
//        $U->delete();
//        $User::destroy(20);
//        $User::destroy(['email' => '123456@126.com']);
        $User::where('id', '>', 27)->delete();
    }

    public function sqlAction() {
        $User = new Users();
//        $U = $User->where([
//            'user_name' => 'lisi7769'
//        ])->select();
        $U = $User->db()->where([
                    'user_name' => 'lisi7769'
                ])->select();
        var_dump($U);
    }

    /**
     * 动态查询
     * 如果继承的类中没有这个方法却还能实现，则调用__call方法实现
     */
    public function fieldAction() {
        $User = Users::getByUser_name("lisi7769@126.com");
        var_dump($User);
    }

}
