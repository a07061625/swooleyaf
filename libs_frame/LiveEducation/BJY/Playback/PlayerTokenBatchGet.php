<?php
/**
 * 批量获取回放token
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
 * Class PlayerTokenBatchGet
 * @package LiveEducation\BJY\Playback
 */
class PlayerTokenBatchGet extends BaseBJY
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
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setExpiresIn(int $expiresIn)
    {
        if ($expiresIn >= 0) {
            $this->reqData['expires_in'] = $expiresIn;
        } else {
            throw new BJYException('过期时间不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->room_ids)) {
            throw new BJYException('房间ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['room_ids'] = implode(',', array_keys($this->room_ids));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
