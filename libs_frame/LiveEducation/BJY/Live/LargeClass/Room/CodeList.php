<?php
/**
 * 获取已生成的参加码列表
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
 * Class CodeList
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class CodeList extends BaseBJY
{
    /**
     * 房间id
     * @var int
     */
    private $room_id = 0;
    /**
     * 参加码类型 0:普通参加码 1:试听参加码
     * @var int
     */
    private $type = 0;
    /**
     * 页数
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $limit = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/listcode';
        $this->reqData['type'] = 0;
        $this->reqData['page'] = 1;
        $this->reqData['limit'] = 100;
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
     * @param int $type
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BJYException('参加码类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BJYException('页数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 1000)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new BJYException('每页条数不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BJYException('房间ID不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
