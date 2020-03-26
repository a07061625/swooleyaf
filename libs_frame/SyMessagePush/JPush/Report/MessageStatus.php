<?php
/**
 * 送达状态查询
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 11:27
 */
namespace SyMessagePush\JPush\Report;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\ReportBase;
use SyMessagePush\PushUtilJPush;
use SyTool\Tool;

class MessageStatus extends ReportBase
{
    /**
     * 消息ID
     * @var string
     */
    private $msg_id = '';
    /**
     * 设备ID列表
     * @var array
     */
    private $registration_ids = [];
    /**
     * 日期
     * @var string
     */
    private $date = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/status/message';
        $this->reqData['date'] = date('Y-m-d');
    }

    private function __clone()
    {
    }

    /**
     * @param string $msgId
     * @throws \SyException\MessagePush\JPushException
     */
    public function setMsgId(string $msgId)
    {
        if (ctype_digit($msgId)) {
            $this->reqData['msg_id'] = $msgId;
        } else {
            throw new JPushException('消息ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $registrationIds
     * @throws \SyException\MessagePush\JPushException
     */
    public function setRegistrationIds(array $registrationIds)
    {
        $needNum = count($registrationIds);
        if ($needNum == 0) {
            throw new JPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($needNum > 1000) {
            throw new JPushException('设备ID列表不能超过1000个', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        foreach ($registrationIds as $eRegistrationId) {
            if (ctype_alnum($eRegistrationId)) {
                $this->registration_ids[$eRegistrationId] = 1;
            }
        }
    }

    /**
     * @param int $dayTime
     * @throws \SyException\MessagePush\JPushException
     */
    public function setDate(int $dayTime)
    {
        if ($dayTime > 0) {
            $this->reqData['date'] = date('Y-m-d', $dayTime);
        } else {
            throw new JPushException('日期时间戳不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['msg_id'])) {
            throw new JPushException('消息ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (empty($this->registration_ids)) {
            throw new JPushException('设备ID列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->reqData['registration_ids'] = array_keys($this->registration_ids);

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
