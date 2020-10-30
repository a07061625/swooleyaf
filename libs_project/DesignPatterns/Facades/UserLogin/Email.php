<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/5 0005
 * Time: 16:04
 */
namespace DesignPatterns\Facades\UserLogin;

use DesignPatterns\Facades\UserLoginFacade;
use Request\SyRequest;
use SyConstant\ErrorCode;
use SyException\Common\CheckException;
use SyTrait\SimpleFacadeTrait;

class Email extends UserLoginFacade
{
    use SimpleFacadeTrait;

    protected static function checkParams(array $data) : array
    {
        $email = trim(SyRequest::getParams('user_email', ''));
        $pwd = (string)SyRequest::getParams('user_pwd', '');
        if (strlen($email) == 0) {
            throw new CheckException('邮箱不能为空', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (strlen($pwd) == 0) {
            throw new CheckException('密码不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        return [
            'user_email' => $email,
            'user_pwd' => $pwd,
        ];
    }

    protected static function login(array $data) : array
    {
        return [];
    }
}
