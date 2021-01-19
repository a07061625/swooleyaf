<?php
/**
 * 媒体月报(媒体维度)
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
 * Class MediaMonthReport
 * @package SyPromotion\TBK\Promoter
 */
class MediaMonthReport extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

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
    /**
     * 聚合条件
     *
     * @var string
     */
    private $dimensions = '';
    /**
     * 查询条件
     *
     * @var string
     */
    private $filters = '';
    /**
     * 查询字段
     *
     * @var array
     */
    private $return_fields = [];
    /**
     * 报表名称
     *
     * @var string
     */
    private $report_type_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.media.month.report');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['return_fields'] = 'total_alipay_amt,pub_id,div_rule,settle_amount';
        $this->reqData['report_type_id'] = 'union_media_month_report';
    }

    private function __clone()
    {
    }

    /**
     * @param string $dimensions
     * @throws \SyException\Promotion\TBKException
     */
    public function setDimensions(string $dimensions)
    {
        if (\strlen($dimensions) > 0) {
            $this->reqData['dimensions'] = $dimensions;
        } else {
            throw new TBKException('聚合条件不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param string $filters
     * @throws \SyException\Promotion\TBKException
     */
    public function setFilters(string $filters)
    {
        if (\strlen($filters) > 0) {
            $this->reqData['filters'] = $filters;
        } else {
            throw new TBKException('查询条件不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['filters'])) {
            throw new TBKException('查询条件不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
