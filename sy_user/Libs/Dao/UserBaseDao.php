<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/10/31 0031
 * Time: 9:52
 */
namespace Dao;

use SyTool\SySession;
use SyTrait\SimpleDaoTrait;

class UserBaseDao
{
    use SimpleDaoTrait;

    public static function refreshUserSession(string $uid)
    {
        $cacheData = [
            'uid' => $uid,
            'user_account' => 111,
            'user_name' => 111,
            'user_headimage' => 111,
            'user_phone' => 111,
            'user_role' => 111,
        ];
        SySession::set($cacheData);

        return [
            'user_id' => $cacheData['uid'],
            'user_role' => $cacheData['user_role'],
        ];
    }
}
