<?php
/**
 * 创建分组直播参加码
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */
namespace SyLive\BaiJia\LiveLargeClass\Room;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class GroupLiveCodesCreate
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class GroupLiveCodesCreate extends BaseBaiJia
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 分组数量
     * @var int
     */
    private $number = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/createGroupLiveCodes';
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
     * @param int $number
     * @throws \SyException\Live\BaiJiaException
     */
    public function setNumber(int $number)
    {
        if ($number > 0) {
            $this->reqData['number'] = $number;
        } else {
            throw new BaiJiaException('分组数量不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['number'])) {
            throw new BaiJiaException('分组数量不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
