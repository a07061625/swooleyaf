<?php
/**
 * 替换回放
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
 * Class PlaybackReplace
 * @package SyLive\BaiJia\Playback
 */
class PlaybackReplace extends BaseBaiJia
{
    /**
     * 类型 1:替换 2:新增
     * @var int
     */
    private $type = 0;
    /**
     * 源房间ID
     * @var int
     */
    private $source_room_id = 0;
    /**
     * 源序列号(针对长期房间才会用到)
     * @var int
     */
    private $source_session_id = 0;
    /**
     * 目标房间ID
     * @var int
     */
    private $target_room_id = 0;
    /**
     * 目标序列号(针对长期房间才会用到)
     * @var int
     */
    private $target_session_id = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/playback/replacePlayback';
    }

    private function __clone()
    {
    }

    /**
     * @param int $type
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(int $type)
    {
        if (in_array($type, [1, 2])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $sourceRoomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSourceRoomId(int $sourceRoomId)
    {
        if ($sourceRoomId > 0) {
            $this->reqData['source_room_id'] = $sourceRoomId;
        } else {
            throw new BaiJiaException('源房间ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $sourceSessionId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setSourceSessionId(int $sourceSessionId)
    {
        if ($sourceSessionId > 0) {
            $this->reqData['source_session_id'] = $sourceSessionId;
        } else {
            throw new BaiJiaException('源序列号不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $targetRoomId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTargetRoomId(int $targetRoomId)
    {
        if ($targetRoomId > 0) {
            $this->reqData['target_room_id'] = $targetRoomId;
        } else {
            throw new BaiJiaException('目标房间ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $targetSessionId
     * @throws \SyException\Live\BaiJiaException
     */
    public function setTargetSessionId(int $targetSessionId)
    {
        if ($targetSessionId > 0) {
            $this->reqData['target_session_id'] = $targetSessionId;
        } else {
            throw new BaiJiaException('目标序列号不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new BaiJiaException('类型不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['source_room_id'])) {
            throw new BaiJiaException('源房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['target_room_id'])) {
            throw new BaiJiaException('目标房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
