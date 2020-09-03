<?php
/**
 * 更换教室评价模板
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:21
 */
namespace SyLive\BaiJia\LiveLargeClass\Evaluation;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class RoomEvaluationUpdate
 * @package SyLive\BaiJia\LiveLargeClass\Evaluation
 */
class RoomEvaluationUpdate extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 模板ID
     * @var int
     */
    private $evaluate_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/evaluation/updateRoomEvaluation';
    }

    private function __clone()
    {
    }

    /**
     * @param int $roomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setRoomId(int $roomId)
    {
        if ($roomId > 0) {
            $this->reqData['room_id'] = $roomId;
        } else {
            throw new BaiJiaException('房间ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $evaluateId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setEvaluateId(int $evaluateId)
    {
        if ($evaluateId > 0) {
            $this->reqData['evaluate_id'] = $evaluateId;
        } else {
            throw new BaiJiaException('模板ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['evaluate_id'])) {
            throw new BaiJiaException('模板ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
