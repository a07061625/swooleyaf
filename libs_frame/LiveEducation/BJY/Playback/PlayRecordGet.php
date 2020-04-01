<?php
/**
 * 获取指定回放视频观看记录
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 10:16
 */
namespace LiveEducation\BJY\Playback;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class PlayRecordGet
 * @package LiveEducation\BJY\Playback
 */
class PlayRecordGet extends BaseBJY
{
    /**
     * 房间ID
     * @var int
     */
    private $room_id = 0;
    /**
     * 序列号(针对长期房间才会用到)
     * @var int
     */
    private $session_id = 0;
    /**
     * 起始时间
     * @var string
     */
    private $start_time = '';
    /**
     * 结束时间
     * @var string
     */
    private $end_time = '';
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $page_size = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/video_data/getPlaybackPlayRecord';
        $this->reqData['page'] = 1;
        $this->reqData['page_size'] = 100;
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
     * @param int $sessionId
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setSessionId(int $sessionId)
    {
        if ($sessionId > 0) {
            $this->reqData['session_id'] = $sessionId;
        } else {
            throw new BJYException('序列号不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BJYException('起始时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } else if ($endTime <= 0) {
            throw new BJYException('结束时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } else if ($startTime > $endTime) {
            throw new BJYException('起始时间不能大于结束时间', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        } else if (($endTime - $startTime) > 86400) {
            throw new BJYException('结束时间不能大于起始时间24小时', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }

        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    /**
     * @param int $page
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BJYException('页数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 1000)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BJYException('每页条数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new BJYException('起始时间不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
