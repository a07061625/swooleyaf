<?php
/**
 * 渠道管理rid推广效果
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class RidReportGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class RidReportGet extends BaseTBK
{
    /**
     * 请求日期
     *
     * @var string
     */
    private $biz_date = '';
    /**
     * 关系id
     *
     * @var string
     */
    private $relation_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.rid.report.get');
        $this->reqData['search_option'] = [];
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setBizDate(string $bizDate)
    {
        if (\strlen($bizDate) > 0) {
            $this->reqData['search_option']['biz_date'] = $bizDate;
        } else {
            throw new TBKException('请求日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(string $relationId)
    {
        if (ctype_alnum($relationId)) {
            $this->reqData['search_option']['relation_id'] = $relationId;
        } else {
            throw new TBKException('关系id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['search_option']['relation_id'])) {
            throw new TBKException('关系id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
