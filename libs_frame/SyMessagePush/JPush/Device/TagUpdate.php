<?php
/**
 * 更新标签
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

class TagUpdate extends DeviceBase
{
    /**
     * 标签名
     * @var string
     */
    private $tag_value = '';
    /**
     * 设备列表
     * @var array
     */
    private $registration_ids = [];

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
     * @throws \SyException\MessagePush\JPushException
     */
    public function setTagValue(string $tagValue)
    {
        if (ctype_alnum($tagValue)) {
            $this->tag_value = $tagValue;
            $this->serviceUri = '/v3/tags/' . $tagValue;
        } else {
            throw new JPushException('标签名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param array $registrationIds
     * @throws \SyException\MessagePush\JPushException
     */
    public function setRegistrationIds(array $registrationIds)
    {
        if (empty($registrationIds)) {
            throw new JPushException('设备列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->reqData['registration_ids'] = $registrationIds;
    }

    public function getDetail() : array
    {
        if (strlen($this->tag_value) == 0) {
            throw new JPushException('标签名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        return $this->getContent();
    }
}
