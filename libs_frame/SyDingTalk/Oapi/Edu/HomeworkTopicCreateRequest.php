<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.topic.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.27
 */
class HomeworkTopicCreateRequest extends BaseRequest
{
    /**
     * 题目列表
     */
    private $topicItems;

    public function setTopicItems($topicItems)
    {
        $this->topicItems = $topicItems;
        $this->apiParas['topic_items'] = $topicItems;
    }

    public function getTopicItems()
    {
        return $this->topicItems;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.topic.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
