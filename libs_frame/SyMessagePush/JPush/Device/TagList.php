<?php
/**
 * 查询标签列表
 * User: 姜伟
 * Date: 2019/6/26 0026
 * Time: 8:41
 */
namespace SyMessagePush\JPush\Device;

use SyMessagePush\JPush\DeviceBase;
use SyMessagePush\PushUtilJPush;

class TagList extends DeviceBase
{
    public function __construct(string $key)
    {
        parent::__construct($key);
        $this->reqHeader['Authorization'] = PushUtilJPush::getReqAuth($key, 'app');
        $this->serviceUri = '/v3/tags';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . $this->serviceUri;
        return $this->getContent();
    }
}
