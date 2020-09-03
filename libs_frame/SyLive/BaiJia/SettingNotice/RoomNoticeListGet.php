<?php
/**
 * 查看教室公告
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 11:39
 */
namespace SyLive\BaiJia\SettingNotice;

use SyLive\BaseBaiJiaSetting;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class RoomNoticeListGet
 * @package SyLive\BaiJia\SettingNotice
 */
class RoomNoticeListGet extends BaseBaiJiaSetting
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/notice/getRoomNoticeList';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
