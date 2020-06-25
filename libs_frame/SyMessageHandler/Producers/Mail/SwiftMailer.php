<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/6/25 0025
 * Time: 12:48
 */
namespace SyMessageHandler\Producers\Mail;

use DesignPatterns\Singletons\SmsConfigSingleton;
use SyConstant\Project;
use SyMessageHandler\IProducer;
use SyMessageHandler\ProducerBase;

/**
 * Class SwiftMailer
 * @package SyMessageHandler\Producers\Mail
 */
class SwiftMailer  extends ProducerBase implements IProducer
{
    public function __construct()
    {
        parent::__construct(Project::MESSAGE_HANDLER_TYPE_MAIL_SWIFT);
    }

    private function __clone()
    {
    }

    public function checkMsgData(array $msgData) : string
    {
        $node = $msgData['node'] ?? '';
        if (!is_string($node)) {
            return '节点不合法';
        } elseif (strlen($node) == 0) {
            return '节点不能为空';
        }
        $senderName = $msgData['sender_name'] ?? '';
        if (!is_string($senderName)) {
            return '发送人名称不合法';
        } elseif (strlen($senderName) == 0) {
            return '发送人名称不能为空';
        }
        $senderEmail = $msgData['sender_email'] ?? '';
        if (!is_string($senderEmail)) {
            return '发送人邮箱不合法';
        } elseif (strlen($senderEmail) == 0) {
            return '发送人邮箱不能为空';
        }
        $receivers = $msgData['receivers'] ?? [];
        if (!is_array($receivers)) {
            return '接收人不合法';
        } elseif (empty($receivers)) {
            return '接收人不能为空';
        }
        $repliers = $msgData['repliers'] ?? [];
        if (!is_array($repliers)) {
            return '回复人不合法';
        }
        $ccList = $msgData['cc_list'] ?? [];
        if (!is_array($ccList)) {
            return '抄送人不合法';
        }
        $bccList = $msgData['bcc_list'] ?? [];
        if (!is_array($bccList)) {
            return '密送人不合法';
        }
        $title = $msgData['title'] ?? '';
        if (!is_string($title)) {
            return '标题不合法';
        } elseif (strlen($title) == 0) {
            return '标题不能为空';
        }
        $body = $msgData['body'] ?? [];
        if (!is_array($body)) {
            return '内容不合法';
        }
        $altBody = $msgData['alt_body'] ?? [];
        if (!is_array($altBody)) {
            return '备用内容不合法';
        }
        $attachments = $msgData['attachments'] ?? [];
        if (!is_array($attachments)) {
            return '附件不合法';
        }

        $this->msgData['app_id'] = 'mail_swift';
        $this->msgData['senders'] = [
            'name' => $senderName,
            'email' => $senderEmail,
        ];
        $this->msgData['receivers'] = $receivers;
        $this->msgData['template_params']['title'] = $title;
        $this->msgData['template_params']['body'] = $body;
        $this->msgData['template_params']['alt_body'] = $altBody;
        $this->msgData['template_params']['attachments'] = $attachments;
        $this->msgData['ext_data']['node'] = $node;
        $this->msgData['ext_data']['repliers'] = $repliers;
        $this->msgData['ext_data']['cc_list'] = $ccList;
        $this->msgData['ext_data']['bcc_list'] = $bccList;
        return '';
    }
}
