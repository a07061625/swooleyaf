<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 9:56
 */
namespace DesignPatterns\Facades\WxOpenNotifyAuthorizer;

use DesignPatterns\Facades\WxOpenNotifyAuthorizerFacade;
use SyTrait\SimpleFacadeTrait;

class TextDefault extends WxOpenNotifyAuthorizerFacade
{
    use SimpleFacadeTrait;

    protected static function responseNotify(array $data) : array
    {
        return [
            'ToUserName' => $data['FromUserName'],
            'FromUserName' => $data['ToUserName'],
            'CreateTime' => $data['CreateTime'],
            'MsgType' => 'text',
            'Content' => '',
        ];
    }
}
