<?php
class WxConfigController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 设置配置
     */
    public function setConfigAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $setRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/WxConfig/setConfig', $data);
        $this->sendRsp($setRes);
    }

    /**
     * 刷新企业付款银行卡公钥
     */
    public function refreshSslCompanyBankAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $refreshRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/WxConfig/refreshSslCompanyBank', $data);
        $this->sendRsp($refreshRes);
    }
}
