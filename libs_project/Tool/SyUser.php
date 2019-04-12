<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/23 0023
 * Time: 12:16
 */
namespace Tool;

use Constant\ProjectCode;
use Exception\User\LoginException;
use Traits\SimpleTrait;

/**
 * Class SyUser
 * 如果会话类型为缓存,继承\Tool\SyUserBase类
 * 如果会话类型为JWT,继承\Tool\SyUserJwt类
 * 会话类型为JWT时,会话中数据变动(用户数据,角色权限等)时需要设置REDIS缓存中以\Constant\Project::REDIS_PREFIX_SESSION_JWT_REFRESH为前缀的键名
 * 其值为新的更新标识字符串
 * @package Tool
 */
class SyUser extends SyUserBase {
    use SimpleTrait;

    /**
     * 检查是否已登录
     * @throws \Exception\User\LoginException
     */
    public static function checkLogin(){
        if(empty(self::getUserInfo())){
            throw new LoginException('请先登录', ProjectCode::USER_NOT_LOGIN);
        }
    }

    /**
     * 获取用户ID
     * @return string
     */
    public static function getUid() : string {
        $userInfo = self::getUserInfo();
        return is_array($userInfo) ? Tool::getArrayVal($userInfo, 'user_id', '') : '';
    }

    /**
     * 获取用户openid
     * @return string
     */
    public static function getOpenId() : string {
        $userInfo = self::getUserInfo();
        return is_array($userInfo) ? Tool::getArrayVal($userInfo, 'user_openid', '') : '';
    }
}