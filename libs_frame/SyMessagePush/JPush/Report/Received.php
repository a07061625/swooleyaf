<?php
/**
 * 送达统计
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 16:00
 */
namespace SyMessagePush\JPush\Report;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;
use SyMessagePush\JPush\ReportBase;

class Received extends ReportBase
{
    /**
     * 消息ID列表
     * @var array
     */
    private $msg_ids = [];

    public function __construct()
    {
        parent::__construct('app');
        $this->reqMethod = self::REQ_METHOD_GET;
        $this->serviceUri = '/v3/received';
    }

    private function __clone()
    {
    }

    /**
     * @param array $msgIds
     * @throws \Exception\MessagePush\JPushException
     */
    public function setMsgIds(array $msgIds)
    {
        $msgNum = count($msgIds);
        if ($msgNum == 0) {
            throw new JPushException('消息ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($msgNum > 100) {
            throw new JPushException('消息ID列表不能超过100个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        foreach ($msgIds as $eMsgId) {
            if (ctype_digit($eMsgId)) {
                $this->msg_ids[$eMsgId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (empty($this->msg_ids)) {
            throw new JPushException('消息ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['msg_ids'] = implode(',', array_keys($this->msg_ids));

        return $this->getContent();
    }
}
