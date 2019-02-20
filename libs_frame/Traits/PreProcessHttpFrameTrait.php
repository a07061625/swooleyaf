<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午6:55
 */
namespace Traits;

use Constant\ErrorCode;
use Constant\ProjectBase;
use Response\Result;
use Tool\Tool;

/**
 * 框架内部HTTP服务预处理性状类
 * @package Traits
 */
trait PreProcessHttpFrameTrait {
    private $preProcessMapFrame = [
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_SERVER_INFO => 'preProcessFrameServerInfo',
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_PHP_INFO => 'preProcessFramePhpInfo',
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_HEALTH_CHECK => 'preProcessFrameHealthCheck',
        ProjectBase::PRE_PROCESS_TAG_HTTP_FRAME_REFRESH_TOKEN_EXPIRE => 'preProcessFrameRefreshTokenExpire',
    ];

    private function preProcessFrameServerInfo(\swoole_http_request $request) : string {
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        return Tool::jsonEncode($this->_server->stats());
    }

    private function preProcessFramePhpInfo(\swoole_http_request $request) : string {
        ob_start();
        phpinfo();
        $phpInfo = ob_get_contents();
        ob_end_clean();
        return $phpInfo;
    }

    private function preProcessFrameHealthCheck(\swoole_http_request $request) : string {
        return 'http server is alive';
    }

    private function preProcessFrameRefreshTokenExpire(\swoole_http_request $request) : string {
        $msg = '';
        $params = $request->get ?? [];
        $expireTime = $params['expire_time'] ?? '';
        if(!ctype_digit($expireTime)){
            $msg = '过期时间不合法';
        } else if((strlen($expireTime) > 1) && ($expireTime{0} == '0')){
            $msg = '过期时间不合法';
        }

        $refreshRes = new Result();
        if(strlen($msg) == 0){
            self::$_syServer->set(self::$_serverToken, [
                'token_etime' => (int)$expireTime,
            ]);
            $refreshRes->setData([
                'msg' => '更新令牌过期时间成功',
            ]);
        } else {
            $refreshRes->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, $msg);
        }
        return $refreshRes->getJson();
    }
}