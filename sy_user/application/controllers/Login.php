<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-4-19
 * Time: 下午4:56
 */
class LoginController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 登录
     * @api {post} /Index/Login/login 用户登录
     * @apiDescription 用户登录
     * @apiGroup Login
     * @apiParam {string} login_type 登录类型 a000:手机号码 a001:邮箱 a002:账号 a100:微信静默授权 a101:微信手动授权 a102:微信扫码 a200:QQ
     * @apiParam {string} [user_phone] 用户手机号码
     * @apiParam {string} [user_pwd] 用户密码
     * @apiParam {string} [user_email] 用户邮箱
     * @apiParam {string} [user_account] 用户账号
     * @apiParam {string} [wx_code] 微信授权码
     * @apiParam {string} [redirect_url] 回跳URL地址
     * @apiParam {string} [user_qq] 用户QQ
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "login_type","explain": "登录类型","type": "string","rules": {"required": 1,"min": 4,"max": 4}}
     * @SyFilter-{"field": "user_phone","explain": "手机号码","type": "string","rules": {"phone": 1}}
     * @SyFilter-{"field": "user_pwd","explain": "密码","type": "string","rules": {"min": 1}}
     * @SyFilter-{"field": "user_email","explain": "邮箱","type": "string","rules": {"email": 1}}
     * @SyFilter-{"field": "user_account","explain": "账号","type": "string","rules": {"min": 1}}
     * @SyFilter-{"field": "wx_code","explain": "微信授权码","type": "string","rules": {"min": 1}}
     * @SyFilter-{"field": "redirect_url","explain": "回跳URL地址","type": "string","rules": {"url": 1}}
     * @SyFilter-{"field": "user_qq","explain": "QQ号码","type": "string","rules": {"regex": "/^[0-9]\d{5,11}$/"}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function loginAction()
    {
        $needParams = [
            'login_type' => (string)\Request\SyRequest::getParams('login_type'),
        ];
        $loginRes = \Dao\LoginDao::login($needParams);
        $this->SyResult->setData($loginRes);
        $this->sendRsp();
    }
}
