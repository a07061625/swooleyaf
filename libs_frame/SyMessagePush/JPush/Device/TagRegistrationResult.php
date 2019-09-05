<?php
/**
 * 判断设备与标签绑定关系
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 8:41
 */
namespace SyMessagePush\JPush\Device;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;

class TagRegistrationResult extends DeviceBase
{
    /**
     * 标签名
     * @var string
     */
    private $tag_value = '';
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
     * @param string $tagValue
     * @param string $registrationId
     * @throws \SyException\MessagePush\JPushException
     */
    public function setTagAndRegistration(string $tagValue, string $registrationId)
    {
        if (!ctype_alnum($tagValue)) {
            throw new JPushException('标签名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!ctype_alnum($registrationId)) {
            throw new JPushException('设备ID不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        $this->tag_value = $tagValue;
        $this->registration_id = $registrationId;
        $this->serviceUri = '/v3/tags/' . $tagValue . '/registration_ids/' . $registrationId;
    }

    public function getDetail() : array
    {
        if (strlen($this->tag_value) == 0) {
            throw new JPushException('标签名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        return $this->getContent();
    }
}
