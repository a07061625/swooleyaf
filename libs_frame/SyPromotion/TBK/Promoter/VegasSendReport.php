<?php
/**
 * 查询超级红包发放个数
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class VegasSendReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class VegasSendReport extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

    /**
     * 统计日期
     *
     * @var string
     */
    private $biz_date = '';
    /**
     * 渠道关系id
     *
     * @var int
     */
    private $relation_id = 0;
    /**
     * 活动id
     *
     * @var int
     */
    private $activity_id = 0;
    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.vegas.send.report');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setBizDate(string $bizDate)
    {
        if ((8 == \strlen($bizDate)) && ctype_digit($bizDate)) {
            $this->reqData['biz_date'] = $bizDate;
        } else {
            throw new TBKException('统计日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(int $relationId)
    {
        if ($relationId > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setActivityId(int $activityId)
    {
        if ($activityId > 0) {
            $this->reqData['activity_id'] = $activityId;
        } else {
            throw new TBKException('活动id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['biz_date'])) {
            throw new TBKException('统计日期不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['activity_id'])) {
            throw new TBKException('活动id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
