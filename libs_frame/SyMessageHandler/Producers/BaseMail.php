<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/7/5 0005
 * Time: 15:19
 */
namespace SyMessageHandler\Producers;

/**
 * Class BaseMail
 * @package SyMessageHandler\Producers
 */
abstract class BaseMail extends Base
{
    public function __construct(int $handlerType)
    {
        parent::__construct($handlerType);
    }

    protected function checkNode(array $data) : string
    {
        $node = $data['node'] ?? '';
        if (!is_string($node)) {
            return '节点不合法';
        } elseif (strlen($node) == 0) {
            return '节点不能为空';
        }

        $this->msgData['ext_data']['node'] = $node;
        return '';
    }

    protected function checkReceivers(array $data) : string
    {
        $receivers = $data['receivers'] ?? [];
        if (!is_array($receivers)) {
            return '接收人不合法';
        } elseif (empty($receivers)) {
            return '接收人不能为空';
        }

        $this->msgData['receivers'] = $receivers;
        return '';
    }

    protected function checkRepliers(array $data) : string
    {
        $repliers = $data['repliers'] ?? [];
        if (!is_array($repliers)) {
            return '回复人不合法';
        }

        $this->msgData['ext_data']['repliers'] = $repliers;
        return '';
    }

    protected function checkCcList(array $data) : string
    {
        $ccList = $data['cc_list'] ?? [];
        if (!is_array($ccList)) {
            return '抄送人不合法';
        }

        $this->msgData['ext_data']['cc_list'] = $ccList;
        return '';
    }

    protected function checkBccList(array $data) : string
    {
        $bccList = $data['bcc_list'] ?? [];
        if (!is_array($bccList)) {
            return '密送人不合法';
        }

        $this->msgData['ext_data']['bcc_list'] = $bccList;
        return '';
    }

    protected function checkTitle(array $data) : string
    {
        $title = $data['title'] ?? '';
        if (!is_string($title)) {
            return '标题不合法';
        } elseif (strlen($title) == 0) {
            return '标题不能为空';
        }

        $this->msgData['template_params']['title'] = $title;
        return '';
    }

    protected function checkAttachments(array $data) : string
    {
        $attachments = $data['attachments'] ?? [];
        if (!is_array($attachments)) {
            return '附件不合法';
        }

        $this->msgData['template_params']['attachments'] = $attachments;
        return '';
    }
}
