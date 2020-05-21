<?php
/**
 * 业务处理公共控制器类
 * User: jw
 * Date: 17-4-5
 * Time: 下午8:34
 */
class CommonController extends \SyFrame\BaseController
{
    public $signStatus = true;

    public function init()
    {
        parent::init();
        $this->signStatus = true;

        $token = SyTool\SySession::getSessionId();
        $cookieKey = SyTool\SySession::getCookieKey();
        $_COOKIE[$cookieKey] = $token;
        $expireTime = SyTool\Tool::getNowTime() + 604800;
        \Response\SyResponseHttp::cookie($cookieKey, $token, $expireTime, '/', $_SERVER[\SyConstant\Project::DATA_KEY_DOMAIN_COOKIE_SERVER]);
    }
}
