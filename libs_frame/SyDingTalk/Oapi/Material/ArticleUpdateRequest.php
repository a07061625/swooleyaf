<?php

namespace SyDingTalk\Oapi\Material;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.material.article.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.06.28
 */
class ArticleUpdateRequest extends BaseRequest
{
    /**
     * 文章对象
     */
    private $article;
    /**
     * 服务号的unionid
     */
    private $unionid;

    public function setArticle($article)
    {
        $this->article = $article;
        $this->apiParas['article'] = $article;
    }

    public function getArticle()
    {
        return $this->article;
    }

    public function setUnionid($unionid)
    {
        $this->unionid = $unionid;
        $this->apiParas['unionid'] = $unionid;
    }

    public function getUnionid()
    {
        return $this->unionid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.material.article.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
