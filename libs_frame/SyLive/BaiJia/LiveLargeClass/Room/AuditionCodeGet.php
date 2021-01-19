<?php
/**
 * 生成用户试听参加码
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
 * Class AuditionCodeGet
 *
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class AuditionCodeGet extends BaseBaiJia
{
    /**
     * 房间id
     *
     * @var int
     */
    private $room_id = 0;
    /**
     * 用户ID列表
     *
     * @var array
     */
    private $user_numbers = [];
    /**
     * 用户头像
     *
     * @var string
     */
    private $user_avatar = '';
    /**
     * 试听时长,单位为秒
     *
     * @var int
     */
    private $audition_length = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/getAuditionCode';
        $this->reqData['audition_length'] = 3600;
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
    public function addUserNumber(int $userNumber)
    {
        if ($userNumber > 0) {
            $this->user_numbers[$userNumber] = 1;
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

    /**
     * @throws \SyException\Live\BaiJiaException
     */
    public function setAuditionLength(int $auditionLength)
    {
        if (($auditionLength > 0) && ($auditionLength <= 3600)) {
            $this->reqData['audition_length'] = $auditionLength;
        } else {
            throw new BaiJiaException('试听时长不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        if (empty($this->user_numbers)) {
            throw new BaiJiaException('用户ID列表不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['user_numbers'] = implode(',', array_keys($this->user_numbers));
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
