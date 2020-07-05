<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 12:48
 */
namespace SyMessageHandler\Producers\Mail;

use SyConstant\ProjectBase;
use SyMessageHandler\IProducer;
use SyMessageHandler\Producers\BaseMail;

/**
 * Class SwiftMailer
 * @package SyMessageHandler\Producers\Mail
 */
class SwiftMailer  extends BaseMail implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_MAIL_SWIFT);
        $this->msgData['app_id'] = 'mail_swift';
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkNode',
            3 => 'checkSender',
            4 => 'checkReceivers',
            5 => 'checkRepliers',
            6 => 'checkCcList',
            7 => 'checkBccList',
            8 => 'checkTitle',
            9 => 'checkBody',
            10 => 'checkAltBody',
            11 => 'checkAttachments',
        ];
    }

    private function __clone()
    {
    }

    private function checkSender(array $data) : string
    {
        $senderName = $data['sender_name'] ?? '';
        if (!is_string($senderName)) {
            return '发送人名称不合法';
        } elseif (strlen($senderName) == 0) {
            return '发送人名称不能为空';
        }
        $senderEmail = $data['sender_email'] ?? '';
        if (!is_string($senderEmail)) {
            return '发送人邮箱不合法';
        } elseif (strlen($senderEmail) == 0) {
            return '发送人邮箱不能为空';
        }

        $this->msgData['senders'] = [
            'name' => $senderName,
            'email' => $senderEmail,
        ];
        return '';
    }

    private function checkBody(array $data) : string
    {
        $body = $data['body'] ?? [];
        if (!is_array($body)) {
            return '内容不合法';
        }

        $this->msgData['template_params']['body'] = $body;
        return '';
    }

    private function checkAltBody(array $data) : string
    {
        $altBody = $data['alt_body'] ?? [];
        if (!is_array($altBody)) {
            return '备用内容不合法';
        }

        $this->msgData['template_params']['alt_body'] = $altBody;
        return '';
    }
}
