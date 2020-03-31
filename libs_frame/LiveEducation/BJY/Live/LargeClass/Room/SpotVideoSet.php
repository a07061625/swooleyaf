<?php
/**
 * 直播设置插播回放
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */
namespace LiveEducation\BJY\Live\LargeClass\Room;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class SpotVideoSet
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class SpotVideoSet extends BaseBJY
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
     * @param int $videoId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function addVideoId(int $videoId)
    {
        if(count($this->video_ids) >= 3){
            throw new BJYException('插播回放视频列表不能超过3个', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if($videoId <= 0){
            throw new BJYException('插播回放视频ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->video_ids[] = $videoId;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->video_ids)) {
            throw new BJYException('插播回放视频列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['video_ids'] = implode(',', $this->video_ids);
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
