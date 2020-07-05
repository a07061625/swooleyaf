<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Producers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseWx;

/**
 * Class MiniTemplate
 * @package SyMessageHandler\Producers\Wx
 */
class MiniTemplate extends BaseWx implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkOpenid',
            4 => 'checkFormId',
            5 => 'checkTemplateId',
            6 => 'checkTemplateParams',
            7 => 'checkRedirectUrl',
            8 => 'checkEmphasisKeyword',
        ];
    }

    private function __clone()
    {
    }

    private function checkOpenid(array $data) : string
    {
        $openid = $data['openid'] ?? '';
        if (!is_string($openid)) {
            return '用户openid不合法';
        } elseif (strlen($openid) == 0) {
            return '用户openid不能为空';
        }

        $this->msgData['receivers'] = [
            0 => $openid,
        ];
        return '';
    }

    private function checkFormId(array $data) : string
    {
        $formId = $data['form_id'] ?? '';
        if (!is_string($formId)) {
            return '表单ID不合法';
        } elseif (strlen($formId) == 0) {
            return '表单ID不能为空';
        }

        $this->msgData['ext_data']['form_id'] = $formId;
        return '';
    }

    private function checkRedirectUrl(array $data) : string
    {
        $redirectUrl = $data['redirect_url'] ?? '';
        if (!is_string($redirectUrl)) {
            return '重定向地址不合法';
        }

        $this->msgData['ext_data']['redirect_url'] = $redirectUrl;
        return '';
    }

    private function checkEmphasisKeyword(array $data) : string
    {
        $emphasisKeyword = $data['emphasis_keyword'] ?? '';
        if (!is_string($emphasisKeyword)) {
            return '放大关键词不合法';
        } elseif (strlen($emphasisKeyword) == 0) {
            return '放大关键词不能为空';
        }

        $this->msgData['ext_data']['emphasis_keyword'] = $emphasisKeyword;
        return '';
    }
}
