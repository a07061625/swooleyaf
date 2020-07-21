<?php
class WxConfigController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 设置配置
     * @api {post} /Index/WxConfig/setConfig 设置配置
     * @apiDescription 设置配置
     * @apiGroup WxConfig
     * @apiParam {string} app_id 公众号ID
     * @apiParam {string} app_secret 公众号密钥
     * @apiParam {string} app_templates 消息模板列表
     * @apiParam {string} origin_id 原始ID
     * @apiParam {string} pay_mchid 商户号
     * @apiParam {string} pay_key 支付密钥
     * @apiParam {string} payssl_cert 商户证书内容
     * @apiParam {string} payssl_key 商户密钥内容
     * @apiParam {string} [merchant_appid] 服务商微信号
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "app_id","explain": "公众号ID","type": "string","rules": {"required": 1,"alnum": 1,"min": 18,"max": 18}}
     * @SyFilter-{"field": "app_secret","explain": "公众号密钥","type": "string","rules": {"alnum": 0,"max": 32}}
     * @SyFilter-{"field": "app_templates","explain": "消息模板列表","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "origin_id","explain": "原始ID","type": "string","rules": {"alnum": 0,"max": 32}}
     * @SyFilter-{"field": "pay_mchid","explain": "商户号","type": "string","rules": {"digit": 0,"max": 18}}
     * @SyFilter-{"field": "pay_key","explain": "支付密钥","type": "string","rules": {"alnum": 0,"max": 32}}
     * @SyFilter-{"field": "payssl_cert","explain": "商户证书内容","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "payssl_key","explain": "商户密钥内容","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "merchant_appid","explain": "服务商微信号","type": "string","rules": {"alnum": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function setConfigAction()
    {
        SyTool\SyUser::checkLogin();

        $templateStr = trim(\Request\SyRequest::getParams('app_templates', ''));
        $templates = explode(',', $templateStr);
        $templateList = [];
        foreach ($templates as $eTemplateId) {
            $trueId = trim($eTemplateId);
            if (strlen($trueId) > 0) {
                $templateList[] = $trueId;
            }
        }
        unset($templates);
        array_unique($templateList);

        $needParams = [
            'app_id' => (string)\Request\SyRequest::getParams('app_id'),
            'app_secret' => (string)\Request\SyRequest::getParams('app_secret', ''),
            'app_templates' => SyTool\Tool::jsonEncode($templateList, JSON_UNESCAPED_UNICODE),
            'origin_id' => (string)\Request\SyRequest::getParams('origin_id', ''),
            'pay_mchid' => (string)\Request\SyRequest::getParams('pay_mchid', ''),
            'pay_key' => (string)\Request\SyRequest::getParams('pay_key', ''),
            'payssl_cert' => trim(\Request\SyRequest::getParams('payssl_cert', '')),
            'payssl_key' => trim(\Request\SyRequest::getParams('payssl_key', '')),
            'merchant_appid' => (string)\Request\SyRequest::getParams('merchant_appid', ''),
        ];
        $setRes = \Dao\WxConfigDao::setConfig($needParams);
        $this->SyResult->setData($setRes);
        $this->sendRsp();
    }

    /**
     * 刷新企业付款银行卡公钥
     * @api {get} /Index/WxConfig/refreshSslCompanyBank 刷新企业付款银行卡公钥
     * @apiDescription 刷新企业付款银行卡公钥
     * @apiGroup WxConfig
     * @apiParam {string} app_id 公众号ID
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "app_id","explain": "公众号ID","type": "string","rules": {"required": 1,"alnum": 1,"min": 18,"max": 18}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function refreshSslCompanyBankAction()
    {
        SyTool\SyUser::checkLogin();

        $needParams = [
            'app_id' => (string)\Request\SyRequest::getParams('app_id'),
        ];
        $refreshRes = \Dao\WxConfigDao::refreshSslCompanyBank($needParams);
        $this->SyResult->setData($refreshRes);
        $this->sendRsp();
    }
}
