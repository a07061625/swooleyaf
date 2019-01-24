<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/15 0015
 * Time: 10:27
 */
namespace SyFrame;

use Constant\ErrorCode;
use Log\Log;

abstract class BaseErrorController extends BaseController {
    public function init(){
        parent::init();
    }

    public function errorAction(\Exception $e) {
        Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
        $this->SyResult->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '系统出错，请稍后重试');

        $this->sendRsp();
    }
}