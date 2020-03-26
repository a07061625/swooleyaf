<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午6:55
 */
namespace SyTrait\Server;

use Swoole\Http\Request;
use SyConstant\ProjectBase;
use SyTool\Tool;

/**
 * 框架内部HTTP服务预处理性状类
 * @package SyTrait\Server
 */
trait FramePreProcessHttpTrait
{
    private $preProcessMapFrame = [
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_SERVER_INFO => 'preProcessFrameServerInfo',
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_PHP_INFO => 'preProcessFramePhpInfo',
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_HEALTH_CHECK => 'preProcessFrameHealthCheck',
    ];

    private function preProcessFrameServerInfo(Request $request) : string
    {
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        return Tool::jsonEncode($this->_server->stats());
    }

    private function preProcessFramePhpInfo(Request $request) : string
    {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_contents();
        ob_end_clean();
        return $phpInfo;
    }

    private function preProcessFrameHealthCheck(Request $request) : string
    {
        return 'http server is alive';
    }
}
