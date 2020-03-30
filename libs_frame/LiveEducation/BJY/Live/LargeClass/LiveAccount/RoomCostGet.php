<?php
/**
 * 查询直播账号指定日期中各教室使用的人次
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */
namespace LiveEducation\BJY\Live\LargeClass\LiveAccount;

use LiveEducation\BaseBJY;
use LiveEducation\UtilBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class RoomCostGet
 * @package LiveEducation\BJY\Live\LargeClass\LiveAccount
 */
class RoomCostGet extends BaseBJY
{
    /**
     * 产品类型 1:教育直播
     * @var int
     */
    private $product_type = 0;
    /**
     * 日期
     * @var string
     */
    private $date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/getAllRoomCost';
        $this->reqData['product_type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $dateTime
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setDate(int $dateTime)
    {
        if ($dateTime > 0) {
            $this->reqData['date'] = date('Y-m-d', $dateTime);
        } else {
            throw new BJYException('日期不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['date'])) {
            throw new BJYException('日期不能为空', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
        UtilBJY::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
