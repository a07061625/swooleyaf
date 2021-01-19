<?php
/**
 * 生成用户参加码
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */

namespace SyLive\BaiJia\LiveLargeClass\Room;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Live\BaiJiaException;
use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;

/**
 * Class CodeGet
 *
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class CodeGet extends BaseBaiJia
{
    /**
     * 房间id
     *
     * @var int
     */
    private $room_id = 0;
    /**
     * 用户ID
     *
     * @var int
     */
    private $user_number = 0;
    /**
     * 用户头像
     *
     * @var string
     */
    private $user_avatar = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/getcode';
    }

    private function __clone()
    {
    }

    /**
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
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserNumber(int $userNumber)
    {
        if ($userNumber > 0) {
            $this->reqData['user_number'] = $userNumber;
        } else {
            throw new BaiJiaException('用户ID不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setUserAvatar(string $userAvatar)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $userAvatar) > 0) {
            $this->reqData['user_avatar'] = $userAvatar;
        } else {
            throw new BaiJiaException('用户头像不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_number'])) {
            throw new BaiJiaException('用户ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
