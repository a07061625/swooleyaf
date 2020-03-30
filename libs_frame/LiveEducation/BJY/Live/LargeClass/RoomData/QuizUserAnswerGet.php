<?php
/**
 * 获取直播教室测验题目的学员答案信息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:03
 */
namespace LiveEducation\BJY\Live\LargeClass\RoomData;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class QuizUserAnswerGet
 * @package LiveEducation\BJY\Live\LargeClass\RoomData
 */
class QuizUserAnswerGet extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 试卷ID
     * @var int
     */
    private $quiz_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room_data/getQuizUserAnswer';
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
     * @param int $quizId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setQuizId(int $quizId)
    {
        if ($quizId > 0) {
            $this->reqData['quiz_id'] = $quizId;
        } else {
            throw new BJYException('试卷ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['quiz_id'])) {
            throw new BJYException('试卷ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
