<?php
/**
 * 消息统计
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 11:27
 */
namespace SyMessagePush\JPush\Report;

use Constant\ErrorCode;
use Exception\MessagePush\JPushException;
use SyMessagePush\JPush\ReportBase;
use SyMessagePush\PushUtilJPush;

class MessageStat extends ReportBase
{
    /**
     * 消息ID列表
     * @var array
     */
    private $msg_ids = [];

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/messages';
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

        $url = $this->serviceDomain . $this->serviceUri . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_URL] = $url;
        return $this->getContent();
    }
}
