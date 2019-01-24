<?php
class WxOpenController extends CommonController {
    public $signStatus = false;

    public function init() {
        parent::init();
        $this->signStatus = false;
    }

    /**
     * 处理微信服务器消息通知
     */
    public function handleWxNotifyAction() {
        $data = \Request\SyRequest::getParams();
        $data['wx_xml'] = \Tool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        $handleRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpen/handleWxNotify', $data);
        $resData = \Tool\Tool::jsonDecode($handleRes);
        if (is_array($resData) && isset($resData['code']) && ($resData['code'] == \Constant\ErrorCode::COMMON_SUCCESS)) {
            $this->sendRsp($resData['data']['result']);
        } else {
            $this->sendRsp('fail');
        }
    }

    /**
     * 处理授权者公众号消息
     */
    public function handleAuthorizerNotifyAction() {
        $data = \Request\SyRequest::getParams();
        $data['wx_xml'] = \Tool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        $handleRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpen/handleAuthorizerNotify', $data);
        $resData = \Tool\Tool::jsonDecode($handleRes);
        if (is_array($resData) && isset($resData['code']) && ($resData['code'] == \Constant\ErrorCode::COMMON_SUCCESS)) {
            $this->sendRsp($resData['data']['result']);
        } else {
            $this->sendRsp('fail');
        }
    }

    /**
     * 获取开放平台授权地址
     * @api {get} /Index/WxOpen/getComponentAuthUrl 获取开放平台授权地址
     * @apiDescription 获取开放平台授权地址
     * @apiGroup ServiceWxOpen
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function getComponentAuthUrlAction() {
        $authorizerUrl = new \Wx\OpenCommon\AuthorizerUrl();
        $detail = $authorizerUrl->getDetail();
        unset($authorizerUrl);
        if(strlen($detail['url']) > 0){
            $this->SyResult->setData($detail);
        } else {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '获取授权地址失败');
        }

        $this->sendRsp();
    }
}