<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.card.user.post.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.23
 */
class CardUserPostUpdateRequest extends BaseRequest
{
    /**
     * 打卡动态修改入参
     */
    private $updatePostParam;

    public function setUpdatePostParam($updatePostParam)
    {
        $this->updatePostParam = $updatePostParam;
        $this->apiParas['update_post_param'] = $updatePostParam;
    }

    public function getUpdatePostParam()
    {
        return $this->updatePostParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.card.user.post.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
