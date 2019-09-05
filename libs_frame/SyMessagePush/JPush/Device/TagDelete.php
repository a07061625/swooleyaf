<?php
/**
 * 删除标签
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 8:41
 */
namespace SyMessagePush\JPush\Device;

use SyConstant\ErrorCode;
use SyException\MessagePush\JPushException;
use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;

class TagDelete extends DeviceBase
{
    /**
     * 标签名
     * @var string
     */
    private $tag_value = '';
    /**
     * 平台类型
     * @var array
     */
    private $platform = [];

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
     * @param array $platforms
     */
    public function setPlatform(array $platforms)
    {
        foreach ($platforms as $ePlatform) {
            if (isset(self::$totalPlatFormType[$ePlatform])) {
                $this->platform[$ePlatform] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->tag_value) == 0) {
            throw new JPushException('标签名不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }

        $url = $this->serviceDomain . $this->serviceUri;
        if (!empty($this->platform)) {
            $url .= '?' . http_build_query([
                'platform' => implode(',', array_keys($this->platform)),
            ]);
        }
        $this->curlConfigs[CURLOPT_URL] = $url;
        $this->curlConfigs[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        return $this->getContent();
    }
}
