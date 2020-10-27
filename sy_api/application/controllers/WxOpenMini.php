<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/17 0017
 * Time: 11:06
 */
class WxOpenMiniController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 获取草稿代码列表
     */
    public function getDraftCodeListAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/getDraftCodeList', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 获取模板代码列表
     */
    public function getTemplateCodeListAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/getTemplateCodeList', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 添加模板代码
     */
    public function addTemplateCodeAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/addTemplateCode', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 删除模板代码
     */
    public function delTemplateCodeAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $delRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/delTemplateCode', $data);
        $this->sendRsp($delRes);
    }

    /**
     * 修改小程序服务器域名
     */
    public function modifyServerDomainAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $modifyRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/modifyServerDomain', $data);
        $this->sendRsp($modifyRes);
    }

    /**
     * 设置小程序业务域名
     */
    public function setWebViewDomainAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $setRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/setWebViewDomain', $data);
        $this->sendRsp($setRes);
    }

    /**
     * 获取小程序的类目列表
     */
    public function getMiniCategoryListAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/getMiniCategoryList', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 获取小程序的页面配置
     */
    public function getMiniPageConfigAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/getMiniPageConfig', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 上传小程序代码
     */
    public function uploadMiniCodeAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $uploadRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/uploadMiniCode', $data);
        $this->sendRsp($uploadRes);
    }

    /**
     * 审核小程序代码
     */
    public function auditMiniCodeAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $auditRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/auditMiniCode', $data);
        $this->sendRsp($auditRes);
    }

    /**
     * 更新小程序的代码审核结果
     */
    public function refreshMiniCodeAuditResultAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $refreshRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/refreshMiniCodeAuditResult', $data);
        $this->sendRsp($refreshRes);
    }

    /**
     * 发布小程序代码
     */
    public function releaseMiniCodeAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $releaseRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/releaseMiniCode', $data);
        $this->sendRsp($releaseRes);
    }

    /**
     * 自动上传小程序代码
     *
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function autoUploadMiniCodeAction()
    {
        $uploadRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/autoUploadMiniCode', $_GET);
        $this->sendRsp($uploadRes);
    }

    /**
     * 自动审核小程序代码
     *
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function autoAuditMiniCodeAction()
    {
        $auditRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/autoAuditMiniCode', $_GET);
        $this->sendRsp($auditRes);
    }

    /**
     * 自动更新小程序的代码审核结果
     *
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function autoRefreshMiniCodeAuditResultAction()
    {
        $refreshRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/autoRefreshMiniCodeAuditResult', $_GET);
        $this->sendRsp($refreshRes);
    }

    /**
     * 自动发布小程序代码
     *
     * @SyFilter-{"field": "__symanager","explain": "接口管理","type": "string","rules": {"sign": 0}}
     */
    public function autoReleaseMiniCodeAction()
    {
        $releaseRes = \SyModule\SyModuleService::getInstance()->sendApiReq('/Index/WxOpenMini/autoReleaseMiniCode', $_GET);
        $this->sendRsp($releaseRes);
    }
}
