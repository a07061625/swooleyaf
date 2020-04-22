<?php
class WxOpenController extends CommonController
{
    public $signStatus = false;

    public function init()
    {
        parent::init();
        $this->signStatus = false;
    }

    /**
     * 处理微信服务器消息通知
     */
    public function handleWxNotifyAction()
    {
        $data = \Request\SyRequest::getParams();
        $data['wx_xml'] = SyTool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        $handleRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpen/handleWxNotify', $data);
        $resData = SyTool\Tool::jsonDecode($handleRes);
        if (is_array($resData) && isset($resData['code']) && ($resData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
            $this->sendRsp($resData['data']['result']);
        } else {
            $this->sendRsp('fail');
        }
    }

    /**
     * 处理授权者公众号消息
     */
    public function handleAuthorizerNotifyAction()
    {
        $result = 'fail';
        $uriArr = explode('/', $this->getRequest()->getRequestUri());
        if (isset($uriArr[4]) && ctype_alnum($uriArr[4])) {
            $data = \Request\SyRequest::getParams();
            $data['appid'] = $uriArr[4];
            $data['wx_xml'] = SyTool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
            $handleRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpen/handleAuthorizerNotify', $data);
            $resData = SyTool\Tool::jsonDecode($handleRes);
            if (is_array($resData) && isset($resData['code']) && ($resData['code'] == \SyConstant\ErrorCode::COMMON_SUCCESS)) {
                $result = $resData['data']['result'];
            }
        }

        $this->sendRsp($result);
    }

    /**
     * 获取开放平台授权地址
     * @api {get} /Index/WxOpen/getComponentAuthUrl 获取开放平台授权地址
     * @apiDescription 获取开放平台授权地址
     * @apiGroup ServiceWxOpen
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getComponentAuthUrlAction()
    {
        $authorizerUrl = new \Wx\OpenCommon\AuthorizerUrl();
        $detail = $authorizerUrl->getDetail();
        unset($authorizerUrl);
        if (strlen($detail['url']) > 0) {
            $this->SyResult->setData($detail);
        } else {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '获取授权地址失败');
        }

        $this->sendRsp();
    }
}
