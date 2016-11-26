<?php

namespace app\app\controller;
use app\app\model\OrderInfo;

class Order extends UserBase {
    
    /**
     * 列表
     */
    public function indexAction(\think\Request $request) {
         $OrderInfo = new OrderInfo();
         //当前
         $nowpage = $request->param("page", 1, "intval");
         //每页多少条数据
         $perpage = $request->param("perpage", 5, "intval");
         //订单总数
         $count = $OrderInfo->db()->where([
             'user_id' => $this->userid
         ])->count();
         //列表
         $list = $OrderInfo->db()->where([
             'user_id' => $this->userid
         ])->page($nowpage, $perpage)->select();
         $message = [
             'status' => 2000,
             'message' => '获取订单成功',
             'data' => [
                 'count' => $count,
                 'perpage' => $perpage,
                 'nowpage' => $nowpage,
                 'list' => $list,
             ]
         ];
         return $message;
    }
    
    /**
     * 某一个订单的详细信息
     */
    public function readAction() {
        $OrderInfo = new OrderInfo();
        $orderid = $OrderInfo->db()->where([
            'user_id' => $this->userid
        ])->select();
        var_dump($orderid);
        die();
        $OrderGoods = new \app\app\model\OrderGoods();
        $list = $OrderGoods->db()->where([
            'order_id' => $orderid->order_id
        ])->select();
        $message = [
            'status' => 2000,
            'message' => '获取详细信息成功',
            'data' => [
                'list' => $list
            ]
        ];
        return $message;
    }
    
    /**
     * 创建订单
     */
    public function createAction(\think\Request $request) {
        $ordersn = date("Ymd") . mt_rand(10000, 99999);
        $OrderInfo = new OrderInfo();
        
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
    
    /**
     * 更改订单信息
     */
    public function saveAction() {
        
    }
    /**
     * 修改订单状态
     */
    public function updateAction() {
        
    }
    
    /**
     * 删除订单
     */
    public function deleteAction() {
        
    }
}
