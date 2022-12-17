<?php

namespace SyDingTalk\Oapi\OpenEncrypt;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.openencrypt.heartbeat request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.03
 */
class HeartbeatRequest extends BaseRequest
{
    /**
     * 微应用id
     */
    private $appid;
    /**
     * xxx
     */
    private $extension;

    public function setAppid($appid)
    {
        $this->appid = $appid;
        $this->apiParas['appid'] = $appid;
    }

    public function getAppid()
    {
        return $this->appid;
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.openencrypt.heartbeat';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appid, 'appid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
