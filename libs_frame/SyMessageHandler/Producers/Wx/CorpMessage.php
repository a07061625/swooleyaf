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
use SyMessageHandler\Producers\BaseWxCorp;

/**
 * Class CorpMessage
 * @package SyMessageHandler\Producers\Wx
 */
class CorpMessage extends BaseWxCorp implements IProducer
{
    public function __construct()
    {
        parent::__construct(ProjectBase::MESSAGE_HANDLER_TYPE_WX_CORP_MESSAGE);
        $this->checkMap = [
            1 => 'checkSendTime',
            2 => 'checkAppId',
            3 => 'checkAgentTag',
            4 => 'checkUserList',
            5 => 'checkPartyList',
            6 => 'checkTagList',
            7 => 'checkMessageType',
            8 => 'checkMessageData',
            9 => 'checkSafe',
        ];
    }

    private function __clone()
    {
    }

    private function checkUserList(array $data) : string
    {
        $this->msgData['receivers']['user_list'] = $data['user_list'] ?? '@all';
        return '';
    }

    private function checkPartyList(array $data) : string
    {
        $partyList = $data['party_list'] ?? [];
        if (!is_array($partyList)) {
            return '部门ID列表不合法';
        }

        $this->msgData['receivers']['party_list'] = $partyList;
        return '';
    }

    private function checkTagList(array $data) : string
    {
        $tagList = $data['tag_list'] ?? [];
        if (!is_array($tagList)) {
            return '标签ID列表不合法';
        }

        $this->msgData['receivers']['tag_list'] = $tagList;
        return '';
    }

    private function checkSafe(array $data) : string
    {
        $safe = $data['safe'] ?? 0;
        if (!is_int($safe)) {
            return '保密消息标识不合法';
        } elseif (!in_array($safe, [0, 1])) {
            return '保密消息标识不合法';
        }

        $this->msgData['ext_data']['safe'] = $safe;
        return '';
    }
}
