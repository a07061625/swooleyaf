<?php
/**
 * 业务处理公共控制器类
 * User: jw
 * Date: 17-4-5
 * Time: 下午8:34
 */
class CommonController extends \SyFrame\BaseController
{
    public $signStatus = false;

    public function init()
    {
        parent::init();
        $this->signStatus = false;

        $token = \Tool\SySession::getSessionId();
        $_COOKIE[\SyConstant\Project::DATA_KEY_SESSION_TOKEN] = $token;
        $expireTime = \Tool\Tool::getNowTime() + 604800;
        \Response\SyResponseHttp::cookie(\SyConstant\Project::DATA_KEY_SESSION_TOKEN, $token, $expireTime, '/', $_SERVER['SY-DOMAIN']);
    }
}
