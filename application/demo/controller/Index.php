<?php

namespace app\demo\controller;
use think\Request;
class Index extends \think\Controller {

    public function indexAction() {
       return $this->fetch();
    }

}
