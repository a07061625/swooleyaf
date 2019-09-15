<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-20
 * Time: 下午7:20
 */
namespace SyTrait\Server;

use SyConstant\Project;

/**
 * 项目HTTP服务预处理性状类
 * @package SyTrait\Server
 */
trait ProjectPreProcessHttpTrait
{
    private $preProcessMapProject = [
        Project::PRE_PROCESS_TAG_HTTP_PROJECT_REFRESH_TOKEN_EXPIRE => 'preProcessProjectRefreshTokenExpire',
    ];

    private function preProcessProjectRefreshTokenExpire(\swoole_http_request $request) : string
    {
        self::$_syServer->set(self::$_serverToken, [
            'token_etime' => $this->getTokenExpireTime(),
        ]);
        return 'refresh token expire time success';
    }
}
