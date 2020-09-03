<?php
/**
 * 获取一段时间内教室的并发人数变化
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
 * Class RoomPeakUserGet
 * @package SyLive\BaiJia\LiveLargeClass\RoomData
 */
class RoomPeakUserGet extends BaseBaiJia
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
        $this->serviceUri = '/openapi/room_data/getRoomPeakUser';
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

    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime >= $endTime) {
            throw new BaiJiaException('开始时间必须小于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($startTime <= 1262275200) {
            throw new BaiJiaException('开始时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif (($endTime - $startTime) > 86400) {
            throw new BaiJiaException('结束时间不能超过开始时间24小时', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new BaiJiaException('开始时间不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
