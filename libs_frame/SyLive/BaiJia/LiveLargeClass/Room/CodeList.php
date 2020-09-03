<?php
/**
 * 获取已生成的参加码列表
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 8:26
 */
namespace SyLive\BaiJia\LiveLargeClass\Room;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class CodeList
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class CodeList extends BaseBaiJia
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
     * @param int $type
     * @throws \SyException\Live\BaiJiaException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1])) {
            $this->reqData['type'] = $type;
        } else {
            throw new BaiJiaException('参加码类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\Live\BaiJiaException
     */
    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->reqData['page'] = $page;
        } else {
            throw new BaiJiaException('页数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $limit
     * @throws \SyException\Live\BaiJiaException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 1000)) {
            $this->reqData['limit'] = $limit;
        } else {
            throw new BaiJiaException('每页条数不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['room_id'])) {
            throw new BaiJiaException('房间ID不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
