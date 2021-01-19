<?php
/**
 * 达人实时销量榜单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class MediaTopRankReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class MediaTopRankReport extends BaseTBK
{
    /**
     * 达人榜单范围起点
     *
     * @var int
     */
    private $rank_start = 0;
    /**
     * 达人榜单范围终点
     *
     * @var int
     */
    private $rank_end = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.media.top.rank.report');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRank(int $rankStart, int $rankEnd)
    {
        if ($rankStart <= 0) {
            throw new TBKException('达人榜单范围起点不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($rankEnd <= 0) {
            throw new TBKException('达人榜单范围终点不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($rankEnd < $rankStart) {
            throw new TBKException('达人榜单范围终点不能小于起点', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['rank_start'] = $rankStart;
        $this->reqData['rank_end'] = $rankEnd;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['rank_start'])) {
            throw new TBKException('达人榜单范围起点不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
