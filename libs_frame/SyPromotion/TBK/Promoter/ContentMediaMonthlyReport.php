<?php
/**
 * 微博月报(达人维度)
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
 * Class ContentMediaMonthlyReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class ContentMediaMonthlyReport extends BaseTBK
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
        $this->setMethod('taobao.tbk.dg.content.media.monthly.report');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['return_fields'] = 'pub_id,sub_pub_id,sub_site_id,sub_adzone_id,div_rule,total_alipay_amt,settle_amount,union_pv,union_uv';
        $this->reqData['report_type_id'] = 'union_content_media_monthly_report';
    }

    private function __clone()
    {
    }

    /**
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

    public function getDetail(): array
    {
        if (!isset($this->reqData['filters'])) {
            throw new TBKException('查询条件不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
