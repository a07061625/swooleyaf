<?php
/**
 * 查询指定分类主题的发送记录
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 18:57
 */
namespace SyMessagePush\BaiDu\Report;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class TopicRecordsQuery extends PushBaseBaiDu
{
    /**
     * 分类主题标识
     * @var string
     */
    private $topic_id = '';
    /**
     * 起始索引位置
     * @var int
     */
    private $start = 0;
    /**
     * 记录条数
     * @var int
     */
    private $limit = 0;
    /**
     * 起始时间戳
     * @var int
     */
    private $range_start = 0;
    /**
     * 截止时间戳
     * @var int
     */
    private $range_end = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/report/query_topic_records';
        $this->reqData['start'] = 0;
        $this->reqData['limit'] = 100;
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

    /**
     * @param int $start
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setStart(int $start)
    {
        if ($start >= 0) {
            $this->reqData['start'] = $start;
        } else {
            throw new BaiDuPushException('起始索引位置不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 100)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new BaiDuPushException('记录条数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    /**
     * @param int $rangeStart
     * @param int $rangeEnd
     * @throws \SyException\MessagePush\BaiDuPushException
     */
    public function setRangeStartAndEnd(int $rangeStart, int $rangeEnd)
    {
        if ($rangeStart < 0) {
            throw new BaiDuPushException('起始时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        } elseif ($rangeEnd < 0) {
            throw new BaiDuPushException('截止时间不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
        unset($this->reqData['range_start'], $this->reqData['range_end']);

        if (($rangeStart > 0) && ($rangeEnd > 0)) {
            if ($rangeStart > $rangeEnd) {
                throw new BaiDuPushException('起始时间不能大于截止时间', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
            }
            $this->reqData['range_start'] = $rangeStart;
            $this->reqData['range_end'] = $rangeEnd;
        } elseif ($rangeStart > 0) {
            $this->reqData['range_start'] = $rangeStart;
        } elseif ($rangeEnd > 0) {
            $this->reqData['range_end'] = $rangeEnd;
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
