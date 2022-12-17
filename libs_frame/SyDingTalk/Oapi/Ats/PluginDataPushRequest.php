<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.plugin.data.push request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.02
 */
class PluginDataPushRequest extends BaseRequest
{
    /**
     * 业务唯一标识，接入前请提前沟通
     */
    private $bizCode;
    /**
     * 数据内容，接入前请提前沟通
     */
    private $content;
    /**
     * 系统自动生成
     */
    private $header;
    /**
     * 外部业务唯一ID
     */
    private $outId;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setHeader($header)
    {
        $this->header = $header;
        $this->apiParas['header'] = $header;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setOutId($outId)
    {
        $this->outId = $outId;
        $this->apiParas['out_id'] = $outId;
    }

    public function getOutId()
    {
        return $this->outId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.plugin.data.push';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->content, 'content');
        RequestCheckUtil::checkNotNull($this->outId, 'outId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
