<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:54
 */
namespace DesignPatterns\Facades\WxOpenNotifyAuthorizer;

use DesignPatterns\Facades\WxOpenNotifyAuthorizerFacade;
use SyTrait\SimpleFacadeTrait;

class EventDefault extends WxOpenNotifyAuthorizerFacade
{
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array
    {
        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => $data['Event'] . 'from_callback',
        ];
    }
}
