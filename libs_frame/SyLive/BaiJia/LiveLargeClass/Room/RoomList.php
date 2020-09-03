<?php
/**
 * 获取房间列表
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
 * Class RoomList
 * @package SyLive\BaiJia\LiveLargeClass\Room
 */
class RoomList extends BaseBaiJia
{
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
    /**
     * 产品类型 1:教育直播
     * @var int
     */
    private $product_type = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/room/list';
        $this->reqData['page'] = 1;
        $this->reqData['limit'] = 100;
        $this->reqData['product_type'] = 1;
    }

    private function __clone()
    {
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
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
