<?php
/**
 * 查询设备的别名与标签
 * User: 姜伟
 * Date: 2019/6/25 0025
 * Time: 16:17
 */
namespace SyMessagePush\JPush\Device;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;

class DeviceGet extends DeviceBase
{
    /**
     * 设备ID
     * @var string
     */
    private $registration_id = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
    }

    private function __clone()
    {
    }

    /**
     * @param string $registrationId
     * @throws \SyException\MessagePush\JPushException
     */
    public function setRegistrationId(string $registrationId)
    {
        if (ctype_alnum($registrationId)) {
            $this->registration_id = $registrationId;
            $this->serviceUri = '/v3/devices/' . $registrationId;
        } else {
            throw new JPushException('设备ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->registration_id) == 0) {
            throw new JPushException('设备ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        return $this->getContent();
    }
}
