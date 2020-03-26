<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 18-3-10
 * Time: 下午1:15
 */
namespace Dao;

use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class LoginDao
{
    use SimpleDaoTrait;

    private static $loginMap = [
        Project::LOGIN_TYPE_ACCOUNT => '\DesignPatterns\Facades\UserLogin\Account',
        Project::LOGIN_TYPE_EMAIL => '\DesignPatterns\Facades\UserLogin\Email',
        Project::LOGIN_TYPE_PHONE => '\DesignPatterns\Facades\UserLogin\Phone',
        Project::LOGIN_TYPE_QQ => '\DesignPatterns\Facades\UserLogin\QQ',
        Project::LOGIN_TYPE_WX_AUTH_BASE => '\DesignPatterns\Facades\UserLogin\WxAuthBase',
        Project::LOGIN_TYPE_WX_AUTH_USER => '\DesignPatterns\Facades\UserLogin\WxAuthUser',
        Project::LOGIN_TYPE_WX_SCAN => '\DesignPatterns\Facades\UserLogin\WxScan',
    ];

    public static function login(array $data)
    {
        $className = Tool::getArrayVal(self::$loginMap, $data['login_type'], null);
        if (is_null($className)) {
            throw new CheckException('登录类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $loginCheckRes = $className::handleCheckParams($data);
        $nowData = array_merge($data, $loginCheckRes);
        return $className::handleLogin($nowData);
    }
}
