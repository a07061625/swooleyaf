<?php
/**
 * 删除教室小测
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 11:39
 */
namespace LiveEducation\BJY\Setting\Quiz;

use LiveEducation\BJY\Setting\BaseSetting;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class RoomPaperBatchDelete
 * @package LiveEducation\BJY\Setting\Quiz
 */
class RoomPaperBatchDelete extends BaseSetting
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 试卷ID列表
     * @var array
     */
    private $paper_ids = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/quiz/batchDeleteRoomPaper';
    }

    private function __clone()
    {
    }

    /**
     * @param int $roomId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BJYException('房间ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param array $idList
     */
    public function setPaperIdList(array $idList)
    {
        $this->paper_ids = [];
        foreach ($idList as $eId) {
            $trueId = is_numeric($eId) ? (int)$eId : 0;
            if ($trueId > 0) {
                $this->paper_ids[$trueId] = 1;
            }
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->paper_ids)) {
            throw new BJYException('试卷ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['paper_ids'] = implode(',', array_keys($this->paper_ids));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
