<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:37
 */
namespace DesignPatterns\Facades\WxOpenNotifyWx;

use DesignPatterns\Facades\WxOpenNotifyWxFacade;
use SyTrait\SimpleFacadeTrait;
use Wx\OpenCommon\ComponentAccessToken;

class ComponentVerifyTicket extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        $accessToken = new ComponentAccessToken();
        $accessToken->setVerifyTicket($data['ComponentVerifyTicket']);
        $accessToken->getDetail();
        unset($accessToken);
    }
}
