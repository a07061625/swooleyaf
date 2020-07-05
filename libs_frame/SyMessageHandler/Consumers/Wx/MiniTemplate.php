<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/23 0023
 * Time: 15:07
 */
namespace SyMessageHandler\Consumers\Wx;

use SyConstant\ProjectBase;
use SyMessageHandler\Consumers\Base;
use SyMessageHandler\IConsumer;
use Wx\Mini\MsgTemplateSend;

/**
 * Class MiniTemplate
 * @package SyMessageHandler\Consumers\Wx
 */
class MiniTemplate extends Base implements IConsumer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_MINI_TEMPLATE);
    }

    private function __clone()
    {
    }

    public function handleMsgData(array $msgData) : array
    {
        $handleRes = [
            'code' => 0,
        ];

        $messageTemplate = new MsgTemplateSend($msgData['app_id']);
        $messageTemplate->setOpenid($msgData['receivers'][0]);
        $messageTemplate->setFormId($msgData['ext_data']['form_id']);
        $messageTemplate->setTemplateId($msgData['template_id']);
        $messageTemplate->setData($msgData['template_params']);
        if (strlen($msgData['ext_data']['redirect_url']) > 0) {
            $messageTemplate->setRedirectUrl($msgData['ext_data']['redirect_url']);
        }
        if (strlen($msgData['ext_data']['emphasis_keyword']) > 0) {
            $messageTemplate->setEmphasisKeyword($msgData['ext_data']['emphasis_keyword']);
        }
        $sendRes = $messageTemplate->getDetail();
        if ($sendRes['code'] > 0) {
            $handleRes['code'] = $sendRes['code'];
            $handleRes['msg'] = $sendRes['message'];
        } else {
            $handleRes['data'] = $sendRes['data'];
        }

        return $handleRes;
    }
}
