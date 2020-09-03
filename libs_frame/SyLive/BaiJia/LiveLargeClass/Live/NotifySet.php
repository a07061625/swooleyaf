<?php
/**
 * 设置教室公告
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 10:44
 */
namespace SyLive\BaiJia\LiveLargeClass\Live;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class NotifySet
 * @package SyLive\BaiJia\LiveLargeClass\Live
 */
class NotifySet extends BaseBaiJia
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 公告信息
     * @var string
     */
    private $content = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live/setNotify';
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
     * @param string $content
     * @throws \SyException\Live\BaiJiaException
     */
    public function setContent(string $content)
    {
        $trueContent = trim($content);
        if (strlen($trueContent) > 0) {
            $this->reqData['content'] = $trueContent;
        } else {
            throw new BaiJiaException('公告信息不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['content'])) {
            throw new BaiJiaException('公告信息不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
