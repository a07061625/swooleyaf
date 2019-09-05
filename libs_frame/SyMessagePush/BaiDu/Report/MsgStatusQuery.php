<?php
/**
 * 查询消息的发送状态
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:57
 */
namespace SyMessagePush\BaiDu\Report;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class MsgStatusQuery extends PushBaseBaiDu
{
    /**
     * 消息ID
     * @var string
     */
    private $msg_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/report/query_msg_status';
    }

    private function __clone()
    {
    }

    /**
     * @param string $msgId
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setMsgId(string $msgId)
    {
        if (ctype_alnum($msgId)) {
            $this->reqData['msg_id'] = $msgId;
        } else {
            throw new BaiDuPushException('消息ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msg_id'])) {
            throw new BaiDuPushException('消息ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
