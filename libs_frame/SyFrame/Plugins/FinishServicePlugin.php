<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-6-29
 * Time: 下午11:07
 */
namespace SyFrame\Plugins;

use Constant\Server;
use Response\Result;
use Response\SyResponseHttp;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class FinishServicePlugin extends Plugin_Abstract {
    public function __construct() {
    }

    private function __clone() {
    }

    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response) {
        $errorCode = Registry::get(Server::REGISTRY_NAME_SERVICE_ERROR);
        if ($errorCode) {
            SyResponseHttp::header('Content-Type', 'application/json; charset=utf-8');
            $result = new Result();
            $result->setCodeMsg($errorCode, '服务出错');
            $response->setBody($result->getJson());
        }
    }
}