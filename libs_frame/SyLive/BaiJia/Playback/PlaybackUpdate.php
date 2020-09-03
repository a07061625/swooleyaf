<?php
/**
 * 更新回放名称
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 10:16
 */
namespace SyLive\BaiJia\Playback;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class PlaybackUpdate
 * @package SyLive\BaiJia\Playback
 */
class PlaybackUpdate extends BaseBaiJia
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
     * @param int $sessionId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSessionId(int $sessionId)
    {
        if ($sessionId > 0) {
            $this->reqData['session_id'] = $sessionId;
        } else {
            throw new BaiJiaException('序列号不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param string $name
     * @throws \SyException\Live\BaiJiaException
     */
    public function setName(string $name)
    {
        $trueName = trim($name);
        if (strlen($trueName) > 0) {
            $this->reqData['name'] = $trueName;
        } else {
            throw new BaiJiaException('回放名称不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['name'])) {
            throw new BaiJiaException('回放名称不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
