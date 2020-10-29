<?php
/**
 * 设置设备的别名与标签
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

class DeviceSet extends DeviceBase
{
    /**
     * 设备ID
     *
     * @var string
     */
    private $registration_id = '';
    /**
     * 标签列表
     *
     * @var array
     */
    private $tags = [];
    /**
     * 设备别名
     *
     * @var string
     */
    private $alias = '';
    /**
     * 关联手机号码
     *
     * @var string
     */
    private $mobile = '';

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
     *
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

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->reqData['tags'] = empty($tags) ? '' : $tags;
    }

    /**
     * @param string $alias
     *
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAlias(string $alias)
    {
        if (strlen($alias) == 0) {
            $this->reqData['alias'] = '';
        } elseif (ctype_alnum($alias)) {
            $this->reqData['alias'] = $alias;
        } else {
            throw new JPushException('设备别名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param string $mobile
     *
     * @throws \SyException\MessagePush\JPushException
     */
    public function setMobile(string $mobile)
    {
        if (strlen($mobile) == 0) {
            $this->reqData['mobile'] = '';
        } elseif (ctype_digit($mobile) && (strlen($mobile) == 11) && ($mobile[0] == '1')) {
            $this->reqData['mobile'] = $mobile;
        } else {
            throw new JPushException('关联手机号码不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->registration_id) == 0) {
            throw new JPushException('设备ID不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['tags'])) {
            throw new JPushException('标签列表不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['alias'])) {
            throw new JPushException('设备别名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        if (!isset($this->reqData['mobile'])) {
            throw new JPushException('关联手机号码不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_POST] = true;
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);

        return $this->getContent();
    }
}
