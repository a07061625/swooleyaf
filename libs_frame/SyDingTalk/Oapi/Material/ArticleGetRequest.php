<?php

namespace SyDingTalk\Oapi\Material;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.material.article.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.06.28
 */
class ArticleGetRequest extends BaseRequest
{
    /**
     * 文章id
     */
    private $articleId;
    /**
     * 服务号的unionid
     */
    private $unionid;

    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
        $this->apiParas['article_id'] = $articleId;
    }

    public function getArticleId()
    {
        return $this->articleId;
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
        return 'dingtalk.oapi.material.article.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->articleId, 'articleId');
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
