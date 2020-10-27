<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 18-3-10
 * Time: 下午1:10
 */
class LoginController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 登录
     *
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"jwt": 1}}
     */
    public function loginAction()
    {
        $data = \Request\SyRequest::getParams();
        $data['session_id'] = SyTool\SySession::getSessionId();
        $applyRes = \SyModule\SyModuleUser::getInstance()->sendApiReq('/Index/Login/login', $data);
        $this->sendRsp($applyRes);
    }

    /**
     * 退出登录
     *
     * @api {get} /Index/Login/logout 退出登录
     * @apiDescription 退出登录
     * @apiGroup Login
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function logoutAction()
    {
        $userInfo = SyTool\SyUser::getUserInfo();
        if (!empty($userInfo)) {
            SyTool\SySession::del('');
        }

        $this->SyResult->setData([
            'msg' => '退出登录成功',
        ]);
        $this->sendRsp();
    }
}
