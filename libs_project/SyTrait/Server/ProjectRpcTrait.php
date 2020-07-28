<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:10
 */
namespace SyTrait\Server;

use Response\Result;
use Yaf\Request\Http;

trait ProjectRpcTrait
{
    /**
     * 处理应用Rpc请求
     *
     * @param array $params
     *
     * @return string
     */
    protected function handleAppReqRpc(array $params) : string
    {
        $httpObj = new Http($params['api_uri']);
        $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
        unset($httpObj);

        return $result;
    }
    private function checkServerRpcTrait()
    {
    }

    private function initTableRpcTrait()
    {
    }

    private function handleReqExceptionByProject(\Throwable $e): Result
    {
    }
}
