<?php

namespace SyDingTalk\Oapi\Platform;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.platform.translate request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.04
 */
class TranslateRequest extends BaseRequest
{
    /**
     * 翻译源文字符串
     */
    private $query;
    /**
     * 翻译源语言类型
     */
    private $sourceLanguage;
    /**
     * 翻译目标语言类型
     */
    private $targetLanguage;

    public function setQuery($query)
    {
        $this->query = $query;
        $this->apiParas['query'] = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setSourceLanguage($sourceLanguage)
    {
        $this->sourceLanguage = $sourceLanguage;
        $this->apiParas['source_language'] = $sourceLanguage;
    }

    public function getSourceLanguage()
    {
        return $this->sourceLanguage;
    }

    public function setTargetLanguage($targetLanguage)
    {
        $this->targetLanguage = $targetLanguage;
        $this->apiParas['target_language'] = $targetLanguage;
    }

    public function getTargetLanguage()
    {
        return $this->targetLanguage;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.platform.translate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->query, 'query');
        RequestCheckUtil::checkNotNull($this->sourceLanguage, 'sourceLanguage');
        RequestCheckUtil::checkNotNull($this->targetLanguage, 'targetLanguage');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
