<?php
/**
 * 获取直播教室测验题目的学员答案信息
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:03
 */
namespace SyLive\BaiJia\LiveLargeClass\RoomData;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class QuizUserAnswerGet
 * @package SyLive\BaiJia\LiveLargeClass\RoomData
 */
class QuizUserAnswerGet extends BaseBaiJia
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
     * @param int $quizId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setQuizId(int $quizId)
    {
        if ($quizId > 0) {
            $this->reqData['quiz_id'] = $quizId;
        } else {
            throw new BaiJiaException('试卷ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['quiz_id'])) {
            throw new BaiJiaException('试卷ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
