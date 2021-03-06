<?php
/**
 * 获取教室专注度检测详情
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
 * Class AttentionDetailExport
 * @package SyLive\BaiJia\LiveLargeClass\RoomData
 */
class AttentionDetailExport extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 关注ID
     * @var int
     */
    private $attention_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room_data/exportAttentionDetail';
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
     * @param int $attentionId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setAttentionId(int $attentionId)
    {
        if ($attentionId > 0) {
            $this->reqData['attention_id'] = $attentionId;
        } else {
            throw new BaiJiaException('关注ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['attention_id'])) {
            throw new BaiJiaException('关注ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
