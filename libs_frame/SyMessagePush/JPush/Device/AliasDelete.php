<?php
/**
 * 删除别名
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 8:41
 */
namespace SyMessagePush\JPush\Device;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;

class AliasDelete extends DeviceBase
{
    /**
     * 别名
     * @var string
     */
    private $alias_value = '';

    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
    }

    private function __clone()
    {
    }

    /**
     * @param string $aliasValue
     * @throws \SyException\MessagePush\JPushException
     */
    public function setAliasValue(string $aliasValue)
    {
        if (ctype_alnum($aliasValue)) {
            $this->alias_value = $aliasValue;
            $this->serviceUri = '/v3/aliases/' . $aliasValue;
        } else {
            throw new JPushException('别名不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->alias_value) == 0) {
            throw new JPushException('别名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        return $this->getContent();
    }
}
