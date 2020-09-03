<?php
/**
 * 直播设置插播回放
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
 * Class SpotVideoSet
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class SpotVideoSet extends BaseBaiJia
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 插播回放视频列表
     * @var array
     */
    private $video_ids = [];

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/setSpotVideo';
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
     * @param int $videoId
     * @throws \SyException\Live\BaiJiaException
     */
    public function addVideoId(int $videoId)
    {
        if(count($this->video_ids) >= 3){
            throw new BaiJiaException('插播回放视频列表不能超过3个', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if($videoId <= 0){
            throw new BaiJiaException('插播回放视频ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }

        $this->video_ids[] = $videoId;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (empty($this->video_ids)) {
            throw new BaiJiaException('插播回放视频列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['video_ids'] = implode(',', $this->video_ids);
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
