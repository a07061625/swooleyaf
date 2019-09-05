<?php
/**
 * 查询分类主题统计信息
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:57
 */
namespace SyMessagePush\BaiDu\Report;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class StatisticTopic extends PushBaseBaiDu
{
    /**
     * 分类主题标识
     * @var string
     */
    private $topic_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/report/statistic_topic';
    }

    private function __clone()
    {
    }

    /**
     * @param string $topicId
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setTopicId(string $topicId)
    {
        if (ctype_alnum($topicId) && (strlen($topicId) <= 128)) {
            $this->reqData['topic_id'] = $topicId;
        } else {
            throw new BaiDuPushException('分类主题标识不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['topic_id'])) {
            throw new BaiDuPushException('分类主题标识不能为空', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        return $this->getContent();
    }
}
