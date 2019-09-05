<?php
/**
 * 查询分类主题列表
 * User: 姜伟
 * Date: 2019/6/27 0027
 * Time: 19:04
 */
namespace SyMessagePush\BaiDu\Topic;

use SyConstant\ErrorCode;
use SyException\MessagePush\BaiDuPushException;
use SyMessagePush\PushBaseBaiDu;

class TopicList extends PushBaseBaiDu
{
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

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri .= '/topic/query_list';
        $this->reqData['start'] = 0;
        $this->reqData['limit'] = 20;
    }

    private function __clone()
    {
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
        if (($limit > 0) && ($limit <= 20)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new BaiDuPushException('记录条数不合法', ErrorCode::MESSAGE_PUSH_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        return $this->getContent();
    }
}
