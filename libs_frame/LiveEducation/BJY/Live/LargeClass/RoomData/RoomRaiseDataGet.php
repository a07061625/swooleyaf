<?php
/**
 * 获取教室举手连麦数据
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
 * Class RoomRaiseDataGet
 * @package LiveEducation\BJY\Live\LargeClass\RoomData
 */
class RoomRaiseDataGet extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 开始时间,格式: 2017-11-23 10:00:00
     * @var string
     */
    private $start_time = '';
    /**
     * 结束时间,格式: 2017-11-23 10:00:00
     * @var string
     */
    private $end_time = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room_data/getRoomRaiseData';
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

    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime >= $endTime) {
            throw new BJYException('开始时间必须小于结束时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } elseif ($startTime <= 1262275200) {
            throw new BJYException('开始时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new BJYException('开始时间不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
