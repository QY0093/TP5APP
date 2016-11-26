<?php

/**
 * 用户接口信息
 * 
 */
namespace app\app\controller;
use app\app\model\Users;

class User extends UserBase {

    public function infoAction(\think\Request $request) {
        $id = $request->get("id");
        $UsersModel = new Users();
        $userinfo = $UsersModel->find($id)->toArray();
        $message = [
            'status' => 2000,
            'message' => '获取用户信息成功',
            'data' => $userinfo
        ];
        //输出特殊格式
//        return response($message, 2000, [], "xml");
        return \think\Response::create($message, "xml", 2000, []);
//        return $message;
        //直接打印..问题？？？？
//        \think\Response::create($message, "xml", 2000, [
//            'Content-Type' => 'text/xml; charset=utf-8'
//        ])->send();
    }
    
    /**
     * 更新用户数据
     * 
     */
    public function updateAction(\think\Request $request) {
        $id = $request->param("id");
        $email = $request->post("email");
        $UsersModel = new Users();
        $userinfo = $UsersModel->find($id);
        $userinfo->email = $email;
        $userinfo->save();
        if ($userinfo->getError()) {
            $message = [
                'status'=> 4003,
                'message' => $userinfo->getError(),
                'data' => []
            ];
        } else {
            $message = [
                'status'=> 2000,
                'message' => '更新用户信息成功',
                'data' => []
            ];
        }
        return $message;
    }

}
