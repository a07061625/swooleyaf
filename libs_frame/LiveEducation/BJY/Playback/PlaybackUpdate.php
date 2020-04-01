<?php
/**
 * 更新回放名称
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
 * Class PlaybackUpdate
 * @package LiveEducation\BJY\Playback
 */
class PlaybackUpdate extends BaseBJY
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
     * 回放名称
     * @var string
     */
    private $name = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/playback/update';
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
     * @param string $name
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setName(string $name)
    {
        $trueName = trim($name);
        if (strlen($trueName) > 0) {
            $this->reqData['name'] = $trueName;
        } else {
            throw new BJYException('回放名称不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new BJYException('回放名称不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
