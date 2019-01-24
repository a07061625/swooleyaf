<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/15 0015
 * Time: 10:29
 */
class ErrorController extends \SyFrame\BaseErrorController {
    public function init(){
        parent::init();
    }

    public function errorAction(\Exception $e) {
        \Log\Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
        \Response\SyResponseHttp::header('Content-Type', 'application/json; charset=utf-8');
        $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_SERVER_ERROR, '系统出错，请稍后重试');

        $this->sendRsp();
    }
}