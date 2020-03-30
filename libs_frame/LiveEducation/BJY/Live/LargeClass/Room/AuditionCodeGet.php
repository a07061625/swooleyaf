<?php
/**
 * 生成用户试听参加码
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
 * Class AuditionCodeGet
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class AuditionCodeGet extends BaseBJY
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 用户ID列表
     * @var array
     */
    private $user_numbers = [];
    /**
     * 用户头像
     * @var string
     */
    private $user_avatar = '';
    /**
     * 试听时长,单位为秒
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
     * @param int $userNumber
     * @throws \SyException\LiveEducation\BJYException
     */
    public function addUserNumber(int $userNumber)
    {
        if ($userNumber > 0) {
            $this->user_numbers[$userNumber] = 1;
        } else {
            throw new BJYException('用户ID不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param string $userAvatar
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setUserAvatar(string $userAvatar)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $userAvatar) > 0) {
            $this->reqData['user_avatar'] = $userAvatar;
        } else {
            throw new BJYException('用户头像不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $auditionLength
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setAuditionLength(int $auditionLength)
    {
        if (($auditionLength > 0) && ($auditionLength <= 3600)) {
            $this->reqData['audition_length'] = $auditionLength;
        } else {
            throw new BJYException('试听时长不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (empty($this->user_numbers)) {
            throw new BJYException('用户ID列表不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        $this->reqData['user_numbers'] = implode(',', array_keys($this->user_numbers));
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
