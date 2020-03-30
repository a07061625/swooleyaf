<?php
/**
 * 创建分组直播参加码
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
 * Class GroupLiveCodesCreate
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class GroupLiveCodesCreate extends BaseBJY
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 分组数量
     * @var int
     */
    private $number = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/createGroupLiveCodes';
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
     * @param int $number
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setNumber(int $number)
    {
        if ($number > 0) {
            $this->reqData['number'] = $number;
        } else {
            throw new BJYException('分组数量不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        if (!isset($this->reqData['number'])) {
            throw new BJYException('分组数量不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
