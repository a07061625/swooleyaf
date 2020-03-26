<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午6:55
 */
namespace SyTrait\Server;

use SyConstant\ProjectBase;
use SyTool\Tool;

/**
 * 框架内部RPC服务预处理性状类
 * @package SyTrait\Server
 */
trait FramePreProcessRpcTrait
{
    private $preProcessMapFrame = [
        ProjectBase::PRE_PROCESS_TAG_RPC_FRAME_SERVER_INFO => 'preProcessFrameServerInfo',
    ];

    private function preProcessFrameServerInfo(array $data) : string
    {
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        return Tool::jsonEncode($this->_server->stats());
    }
}
