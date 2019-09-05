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
use Wx\WxUtilOpenBase;

class ComponentVerifyTicket extends WxOpenNotifyWxFacade
{
    use SimpleFacadeTrait;

    protected static function handleNotify(array $data)
    {
        WxUtilOpenBase::refreshComponentAccessToken($data['ComponentVerifyTicket']);
    }
}
