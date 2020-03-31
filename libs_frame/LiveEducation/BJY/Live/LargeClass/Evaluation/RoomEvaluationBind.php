<?php
/**
 * 关联教室评价模板
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 8:21
 */
namespace LiveEducation\BJY\Live\LargeClass\Evaluation;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class RoomEvaluationBind
 * @package LiveEducation\BJY\Live\LargeClass\Evaluation
 */
class RoomEvaluationBind extends BaseBJY
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
        $this->serviceUri = '/openapi/evaluation/bindRoomEvaluation';
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
     * @param int $evaluateId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setEvaluateId(int $evaluateId)
    {
        if ($evaluateId > 0) {
            $this->reqData['evaluate_id'] = $evaluateId;
        } else {
            throw new BJYException('模板ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['evaluate_id'])) {
            throw new BJYException('模板ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
