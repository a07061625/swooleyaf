<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 16:13
 */
namespace DesignPatterns\Facades\UserLogin;

use DesignPatterns\Facades\UserLoginFacade;
use Request\SyRequest;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyTrait\SimpleFacadeTrait;

class QQ extends UserLoginFacade
{
    use SimpleFacadeTrait;

    protected static function checkParams(array $data) : array
    {
        $qq = trim(SyRequest::getParams('user_qq', ''));
        $pwd = (string)SyRequest::getParams('user_pwd', '');
        if (strlen($qq) == 0) {
            throw new CheckException('QQ号码不能为空', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (strlen($pwd) == 0) {
            throw new CheckException('密码不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'user_qq' => $qq,
            'user_pwd' => $pwd,
        ];
    }

    protected static function login(array $data) : array
    {
        return [];
    }
}
