<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\ProducerBase;
use SyMessageHandler\IProducer;

/**
 * Class MiniTemplate
 * @package SyMessageHandler\Producers\Wx
 */
class MiniTemplate extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $appId = $msgData['app_id'] ?? '';
        if (!is_string($appId)) {
            return '应用ID不合法';
        } elseif (strlen($appId) == 0) {
            return '应用ID不能为空';
        }
        $openid = $msgData['openid'] ?? '';
        if (!is_string($openid)) {
            return '用户openid不合法';
        } elseif (strlen($openid) == 0) {
            return '用户openid不能为空';
        }
        $formId = $msgData['form_id'] ?? '';
        if (!is_string($formId)) {
            return '表单ID不合法';
        } elseif (strlen($formId) == 0) {
            return '表单ID不能为空';
        }
        $templateId = $msgData['template_id'] ?? '';
        if (!is_string($templateId)) {
            return '模板ID不合法';
        } elseif (strlen($templateId) == 0) {
            return '模板ID不能为空';
        }
        $templateParams = $msgData['template_params'] ?? [];
        if (!is_array($templateParams)) {
            return '模板参数不合法';
        } elseif (empty($templateParams)) {
            return '模板参数不能为空';
        }
        $redirectUrl = $msgData['redirect_url'] ?? '';
        if (!is_string($redirectUrl)) {
            return '重定向地址不合法';
        }
        $emphasisKeyword = $msgData['emphasis_keyword'] ?? '';
        if (!is_string($emphasisKeyword)) {
            return '放大关键词不合法';
        } elseif (strlen($emphasisKeyword) == 0) {
            return '放大关键词不能为空';
        }

        $this->msgData['app_id'] = $appId;
        $this->msgData['receivers'] = [
            0 => $openid,
        ];
        $this->msgData['template_id'] = $templateId;
        $this->msgData['template_params'] = $templateParams;
        $this->msgData['ext_data']['form_id'] = $formId;
        $this->msgData['ext_data']['redirect_url'] = $redirectUrl;
        $this->msgData['ext_data']['emphasis_keyword'] = $emphasisKeyword;
        return '';
    }
}
