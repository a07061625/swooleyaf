<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/22 0022
 * Time: 9:43
 */
namespace Constant;

use Traits\SimpleTrait;

class ProjectCode extends ErrorCode {
    use SimpleTrait;

    //用户错误,取值范围:500000-500999
    const USER_NOT_LOGIN = 500000;
    const USER_NOT_LOGIN_WX_AUTH = 500001;

    private static $projectMsgArr = [
        self::USER_NOT_LOGIN => '用户未登录',
        self::USER_NOT_LOGIN_WX_AUTH => '用户未微信授权登录',
    ];

    /**
     * 获取错误信息
     * @param int $errorCode 错误码
     * @return mixed|string
     */
    public static function getMsg(int $errorCode){
        $msgArr = array_merge(self::$projectMsgArr, self::$msgArr);
        return $msgArr[$errorCode] ?? '';
    }
}