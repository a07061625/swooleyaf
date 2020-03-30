<?php
/**
 * 生成用户参加码
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
 * Class CodeGet
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class CodeGet extends BaseBJY
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 用户ID
     * @var int
     */
    private $user_number = 0;
    /**
     * 用户头像
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
    public function setUserNumber(int $userNumber)
    {
        if ($userNumber > 0) {
            $this->reqData['user_number'] = $userNumber;
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['user_number'])) {
            throw new BJYException('用户ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
