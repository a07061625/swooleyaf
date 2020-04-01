<?php
/**
 * 查询直播回放信息
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
 * Class BasicInfoGet
 * @package LiveEducation\BJY\Playback
 */
class BasicInfoGet extends BaseBJY
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

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/playback/getBasicInfo';
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
