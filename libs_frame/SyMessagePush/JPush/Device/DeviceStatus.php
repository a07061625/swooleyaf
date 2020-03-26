<?php
/**
 * 获取用户在线状态
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 8:41
 */
namespace SyMessagePush\JPush\Device;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;
use SyTool\Tool;

class DeviceStatus extends DeviceBase
{
    /**
     * 设备ID列表
     * @var array
     */
    private $registration_ids = [];

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/devices/status';
    }

    private function __clone()
    {
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

    public function getDetail() : array
    {
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
