<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 12:16
 */
namespace SyTool;

use SyConstant\ProjectCode;
use SyException\User\LoginException;
use SyTrait\SimpleTrait;

/**
 * Class SyUser
 *
 * @package SyTool
 */
class SyUser extends SyUserJwt
{
    use SimpleTrait;

    /**
     * 检查是否已登录
     *
     * @throws \SyException\User\LoginException
     */
    public static function checkLogin()
    {
        if (empty(self::getUserInfo())) {
            throw new LoginException('请先登录', ProjectCode::USER_NOT_LOGIN);
        }
    }

    /**
     * 获取用户ID
     *
     * @return string
     */
    public static function getUid() : string
    {
        $userInfo = self::getUserInfo();

        return is_array($userInfo) ? Tool::getArrayVal($userInfo, 'uid', '') : '';
    }

    /**
     * 获取用户openid
     *
     * @return string
     */
    public static function getOpenId() : string
    {
        $userInfo = self::getUserInfo();

        return is_array($userInfo) ? Tool::getArrayVal($userInfo, 'user_openid', '') : '';
    }
}
