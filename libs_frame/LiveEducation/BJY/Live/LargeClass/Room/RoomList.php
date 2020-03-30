<?php
/**
 * 获取房间列表
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
 * Class RoomList
 * @package LiveEducation\BJY\Live\LargeClass\Room
 */
class RoomList extends BaseBJY
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
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
