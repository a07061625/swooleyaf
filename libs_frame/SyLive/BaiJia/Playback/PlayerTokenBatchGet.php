<?php
/**
 * 批量获取回放token
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
 * Class PlayerTokenBatchGet
 * @package SyLive\BaiJia\Playback
 */
class PlayerTokenBatchGet extends BaseBaiJia
{
    /**
     * 房间ID列表
     * @var array
     */
    private $room_ids = [];
    /**
     * 过期时间,单位为秒,0则表示不过期
     * @var int
     */
    private $expires_in = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/playback/getPlayerTokenBatch';
        $this->reqData['expires_in'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param array $roomIdList
     */
    public function setRoomIdList(array $roomIdList)
    {
        $this->room_ids = [];
        foreach ($roomIdList as $eRoomId) {
            $trueId = trim($eRoomId);
            if (strlen($trueId) > 0) {
                $this->room_ids[$trueId] = 1;
            }
        }
    }

    /**
     * @param int $expiresIn
     * @throws \SyException\Live\BaiJiaException
     */
    public function setExpiresIn(int $expiresIn)
    {
        if ($expiresIn >= 0) {
            $this->reqData['expires_in'] = $expiresIn;
        } else {
            throw new BaiJiaException('过期时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->room_ids)) {
            throw new BaiJiaException('房间ID列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['room_ids'] = implode(',', array_keys($this->room_ids));
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
