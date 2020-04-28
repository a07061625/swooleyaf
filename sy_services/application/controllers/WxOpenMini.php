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
     * @api {get} /Index/WxOpenMini/getDraftCodeList 获取草稿代码列表
     * @apiDescription 获取草稿代码列表
     * @apiGroup WxOpenMini
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getDraftCodeListAction()
    {
        SyTool\SyUser::checkStationLogin();

        $getRes = \Dao\WxOpenMiniDao::getDraftCodeList([]);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 获取模板代码列表
     * @api {get} /Index/WxOpenMini/getTemplateCodeList 获取模板代码列表
     * @apiDescription 获取模板代码列表
     * @apiGroup WxOpenMini
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getTemplateCodeListAction()
    {
        SyTool\SyUser::checkStationLogin();

        $getRes = \Dao\WxOpenMiniDao::getTemplateCodeList([]);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 添加模板代码
     * @api {post} /Index/WxOpenMini/addTemplateCode 添加模板代码
     * @apiDescription 添加模板代码
     * @apiGroup WxOpenMini
     * @apiParam {string} draft_id 草稿ID
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "draft_id","explain": "草稿ID","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function addTemplateCodeAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'draft_id' => (string)\Request\SyRequest::getParams('draft_id'),
        ];
        $addRes = \Dao\WxOpenMiniDao::addTemplateCode($needParams);
        $this->SyResult->setData($addRes);
        $this->sendRsp();
    }

    /**
     * 删除模板代码
     * @api {get} /Index/WxOpenMini/delTemplateCode 删除模板代码
     * @apiDescription 删除模板代码
     * @apiGroup WxOpenMini
     * @apiParam {string} template_id 模版ID
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "template_id","explain": "模版ID","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function delTemplateCodeAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'template_id' => (string)\Request\SyRequest::getParams('template_id'),
        ];
        $delRes = \Dao\WxOpenMiniDao::delTemplateCode($needParams);
        $this->SyResult->setData($delRes);
        $this->sendRsp();
    }

    /**
     * 修改小程序服务器域名
     * @api {post} /Index/WxOpenMini/modifyServerDomain 修改小程序服务器域名
     * @apiDescription 修改小程序服务器域名
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @apiParam {string} action_type 操作类型 add:添加 delete:删除 set:覆盖 get:获取
     * @apiParam {string} [domains] 域名,json格式
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "action_type","explain": "操作类型","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "domains","explain": "域名","type": "string","rules": {"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function modifyServerDomainAction()
    {
        SyTool\SyUser::checkStationLogin();

        $domainStr = trim(\Request\SyRequest::getParams('domains', ''));
        $domainArr = strlen($domainStr) > 0 ? SyTool\Tool::jsonDecode($domainStr) : [];
        $actionType = (string)\Request\SyRequest::getParams('action_type');
        if (!in_array($actionType, ['add','delete','set','get'], true)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '操作类型不支持');
        } elseif (($actionType != 'get') && empty($domainArr)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '域名不能为空');
        } else {
            $needParams = [
                'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
                'action_type' => $actionType,
                'domains' => $domainArr,
            ];
            $modifyRes = \Dao\WxOpenMiniDao::modifyServerDomain($needParams);
            $this->SyResult->setData($modifyRes);
        }

        $this->sendRsp();
    }

    /**
     * 设置小程序业务域名
     * @api {post} /Index/WxOpenMini/setWebViewDomain 设置小程序业务域名
     * @apiDescription 设置小程序业务域名
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @apiParam {string} action_type 操作类型 add:添加 delete:删除 set:覆盖 get:获取
     * @apiParam {string} [domains] 域名,json格式
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "action_type","explain": "操作类型","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "domains","explain": "域名","type": "string","rules": {"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function setWebViewDomainAction()
    {
        SyTool\SyUser::checkStationLogin();

        $domainStr = trim(\Request\SyRequest::getParams('domains', ''));
        $domainArr = strlen($domainStr) > 0 ? SyTool\Tool::jsonDecode($domainStr) : [];
        $actionType = (string)\Request\SyRequest::getParams('action_type');
        if (!in_array($actionType, ['add','delete','set','get'], true)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '操作类型不支持');
        } elseif (($actionType != 'get') && empty($domainArr)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '域名不能为空');
        } else {
            $needParams = [
                'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
                'action_type' => $actionType,
                'domains' => $domainArr,
            ];
            $setRes = \Dao\WxOpenMiniDao::setWebViewDomain($needParams);
            $this->SyResult->setData($setRes);
        }

        $this->sendRsp();
    }

    /**
     * 获取小程序的类目列表
     * @api {get} /Index/WxOpenMini/getMiniCategoryList 获取小程序的类目列表
     * @apiDescription 获取小程序的类目列表
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getMiniCategoryListAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
        ];
        $getRes = \Dao\WxOpenMiniDao::getMiniCategoryList($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 获取小程序的页面配置
     * @api {get} /Index/WxOpenMini/getMiniPageConfig 获取小程序的页面配置
     * @apiDescription 获取小程序的页面配置
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getMiniPageConfigAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
        ];
        $getRes = \Dao\WxOpenMiniDao::getMiniPageConfig($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 上传小程序代码
     * @api {post} /Index/WxOpenMini/uploadMiniCode 上传小程序代码
     * @apiDescription 上传小程序代码
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @apiParam {string} template_id 模版ID
     * @apiParam {string} ext_json 自定义配置,json格式
     * @apiParam {string} [user_version] 代码版本号
     * @apiParam {string} [user_desc] 代码描述
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "template_id","explain": "模版ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "ext_json","explain": "自定义配置","type": "string","rules": {"required": 1,"json": 1}}
     * @SyFilter-{"field": "user_version","explain": "代码版本号","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "user_desc","explain": "代码描述","type": "string","rules": {"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function uploadMiniCodeAction()
    {
        SyTool\SyUser::checkStationLogin();

        $extData = SyTool\Tool::jsonDecode(\Request\SyRequest::getParams('ext_json'));
        if (empty($extData)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '自定义配置不能为空');
        } else {
            $templateId = (string)\Request\SyRequest::getParams('template_id');
            $extData['tmpcode'] = $templateId;
            $needParams = [
                'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
                'template_id' => $templateId,
                'ext_json' => $extData,
                'user_version' => trim(\Request\SyRequest::getParams('user_version', '')),
                'user_desc' => trim(\Request\SyRequest::getParams('user_desc', '')),
            ];
            $uploadRes = \Dao\WxOpenMiniDao::uploadMiniCode($needParams);
            $this->SyResult->setData($uploadRes);
        }

        $this->sendRsp();
    }

    /**
     * 审核小程序代码
     * @api {post} /Index/WxOpenMini/auditMiniCode 审核小程序代码
     * @apiDescription 审核小程序代码
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @apiParam {string} audit_items 审核列表,json格式
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "audit_items","explain": "审核列表","type": "string","rules": {"required": 1,"json": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function auditMiniCodeAction()
    {
        SyTool\SyUser::checkStationLogin();

        $auditItems = SyTool\Tool::jsonDecode(\Request\SyRequest::getParams('audit_items'));
        if (empty($auditItems)) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '审核列表不能为空');
        } else {
            $needParams = [
                'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
                'audit_items' => $auditItems,
            ];
            $auditRes = \Dao\WxOpenMiniDao::auditMiniCode($needParams);
            $this->SyResult->setData($auditRes);
        }

        $this->sendRsp();
    }

    /**
     * 更新小程序的代码审核结果
     * @api {get} /Index/WxOpenMini/refreshMiniCodeAuditResult 更新小程序的代码审核结果
     * @apiDescription 更新小程序的代码审核结果
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @apiParam {string} audit_id 审核ID
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "audit_id","explain": "审核ID","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function refreshMiniCodeAuditResultAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'wxmini_appid' => trim(\Request\SyRequest::getParams('wxmini_appid')),
            'audit_id' => trim(\Request\SyRequest::getParams('audit_id')),
        ];
        $refreshRes = \Dao\WxOpenMiniDao::refreshMiniCodeAuditResult($needParams);
        $this->SyResult->setData($refreshRes);
        $this->sendRsp();
    }

    /**
     * 发布小程序代码
     * @api {post} /Index/WxOpenMini/releaseMiniCode 发布小程序代码
     * @apiDescription 发布小程序代码
     * @apiGroup WxOpenMini
     * @apiParam {string} wxmini_appid 小程序appid
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "wxmini_appid","explain": "小程序appid","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function releaseMiniCodeAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'wxmini_appid' => (string)\Request\SyRequest::getParams('wxmini_appid'),
        ];
        $releaseRes = \Dao\WxOpenMiniDao::releaseMiniCode($needParams);
        $this->SyResult->setData($releaseRes);
        $this->sendRsp();
    }

    /**
     * 自动上传小程序代码
     * @api {get} /Index/WxOpenMini/autoUploadMiniCode 自动上传小程序代码
     * @apiDescription 自动上传小程序代码
     * @apiGroup WxOpenMini
     * @apiParam {string} template_id 模版ID
     * @apiParam {string} user_version 代码版本号
     * @apiParam {string} user_desc 代码描述
     * @SyFilter-{"field": "template_id","explain": "模版ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "user_version","explain": "代码版本号","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "user_desc","explain": "代码描述","type": "string","rules": {"required": 1,"min": 1}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function autoUploadMiniCodeAction()
    {
        $templateId = trim(\Request\SyRequest::getParams('template_id'));
        $preRes = \Dao\WxOpenMiniDao::preUploadMiniCode([
            'template_id' => $templateId,
        ]);
        if (strlen($preRes['app_id']) == 0) {
            $this->SyResult->setData([
                'msg' => '上传代码成功',
            ]);
        } else {
            $needParams = [
                'wxmini_appid' => $preRes['app_id'],
                'template_id' => $templateId,
                'ext_json' => [
                    'extEnable' => true,
                    'extAppid' => $preRes['app_id'],
                    'directCommit' => true,
                    'ext' => [
                        'appid' => $preRes['app_id'],
                        'tmpcode' => $templateId,
                    ],
                ],
                'user_version' => trim(\Request\SyRequest::getParams('user_version')),
                'user_desc' => trim(\Request\SyRequest::getParams('user_desc')),
            ];
            $uploadRes = \Dao\WxOpenMiniDao::uploadMiniCode($needParams);
            $this->SyResult->setData($uploadRes);
        }

        $this->sendRsp();
    }

    /**
     * 自动审核小程序代码
     * @api {get} /Index/WxOpenMini/autoAuditMiniCode 自动审核小程序代码
     * @apiDescription 自动审核小程序代码
     * @apiGroup WxOpenMini
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function autoAuditMiniCodeAction()
    {
        $preRes = \Dao\WxOpenMiniDao::preAuditMiniCode([]);
        if (strlen($preRes['app_id']) == 0) {
            $this->SyResult->setData([
                'msg' => '提交审核成功',
            ]);
        } else {
            $needParams = [
                'wxmini_appid' => $preRes['app_id'],
                'audit_items' => $preRes['items'],
            ];
            $auditRes = \Dao\WxOpenMiniDao::auditMiniCode($needParams);
            $this->SyResult->setData($auditRes);
        }

        $this->sendRsp();
    }

    /**
     * 自动更新小程序的代码审核结果
     * @api {get} /Index/WxOpenMini/autoRefreshMiniCodeAuditResult 自动更新小程序的代码审核结果
     * @apiDescription 自动更新小程序的代码审核结果
     * @apiGroup WxOpenMini
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function autoRefreshMiniCodeAuditResultAction()
    {
        $preRes = \Dao\WxOpenMiniDao::preRefreshMiniCodeAuditResult([]);
        if (strlen($preRes['app_id']) == 0) {
            $this->SyResult->setData([
                'msg' => '更新审核结果成功',
            ]);
        } else {
            $needParams = [
                'wxmini_appid' => $preRes['app_id'],
                'audit_id' => $preRes['audit_id'],
            ];
            $refreshRes = \Dao\WxOpenMiniDao::refreshMiniCodeAuditResult($needParams);
            $this->SyResult->setData($refreshRes);
        }

        $this->sendRsp();
    }

    /**
     * 自动发布小程序代码
     * @api {get} /Index/WxOpenMini/autoReleaseMiniCode 自动发布小程序代码
     * @apiDescription 自动发布小程序代码
     * @apiGroup WxOpenMini
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function autoReleaseMiniCodeAction()
    {
        $preRes = \Dao\WxOpenMiniDao::preReleaseMiniCode([]);
        if (strlen($preRes['app_id']) == 0) {
            $this->SyResult->setData([
                'msg' => '发布代码成功',
            ]);
        } else {
            $needParams = [
                'wxmini_appid' => $preRes['app_id'],
            ];
            $releaseRes = \Dao\WxOpenMiniDao::releaseMiniCode($needParams);
            $this->SyResult->setData($releaseRes);
        }

        $this->sendRsp();
    }
}
