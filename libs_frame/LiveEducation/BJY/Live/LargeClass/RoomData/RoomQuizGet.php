<?php
/**
 * 获取直播教室测验的试题信息
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
 * Class RoomQuizGet
 * @package LiveEducation\BJY\Live\LargeClass\RoomData
 */
class RoomQuizGet extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room_data/getRoomQuiz';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
