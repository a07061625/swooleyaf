<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/8/6 0006
 * Time: 11:17
 */
class V1TestController extends CommonController {
    public function init(){
        parent::init();
    }

    public function indexAction(){
        $this->SyResult->setData([
            'msg' => 'api test',
        ]);
        $this->sendRsp();
    }
}