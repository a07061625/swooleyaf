<?php
/**
 * 通用查询红人店报表
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Kol;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class ReportQuery
 *
 * @package SyPromotion\TBK\Kol
 */
class ReportQuery extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

    /**
     * 结束日期
     *
     * @var string
     */
    private $end = '';
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
     * 统计维度
     *
     * @var int
     */
    private $statistic_type = 0;
    /**
     * 时间跨度
     *
     * @var int
     */
    private $statistic_span = 0;
    /**
     * 报表类型id
     *
     * @var string
     */
    private $operation_type_id = '';
    /**
     * 开始日期
     *
     * @var string
     */
    private $start = '';
    /**
     * 达人pid
     *
     * @var string
     */
    private $pid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.kol.report.query');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEnd(string $end)
    {
        if ((8 == \strlen($end)) && ctype_digit($end)) {
            $this->reqData['end'] = $end;
        } else {
            throw new TBKException('结束日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStatisticType(int $statisticType)
    {
        if (\in_array($statisticType, [1, 2])) {
            $this->reqData['statistic_type'] = $statisticType;
        } else {
            throw new TBKException('统计维度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStatisticSpan(int $statisticSpan)
    {
        if (\in_array($statisticSpan, [1, 2, 3])) {
            $this->reqData['statistic_span'] = $statisticSpan;
        } else {
            throw new TBKException('时间跨度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setOperationTypeId(string $operationTypeId)
    {
        if (\strlen($operationTypeId) > 0) {
            $this->reqData['operation_type_id'] = $operationTypeId;
        } else {
            throw new TBKException('报表类型id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStart(string $start)
    {
        if ((8 == \strlen($start)) && ctype_digit($start)) {
            $this->reqData['start'] = $start;
        } else {
            throw new TBKException('开始日期不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('达人pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['operation_type_id'])) {
            throw new TBKException('报表类型id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('达人pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
