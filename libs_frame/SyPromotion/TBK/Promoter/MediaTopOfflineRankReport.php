<?php
/**
 * 媒体达人分类目T+1销量榜单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class MediaTopOfflineRankReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class MediaTopOfflineRankReport extends BaseTBK
{
    use SetPageSizeTrait;

    /**
     * 广告位ID
     *
     * @var int
     */
    private $sub_adzone_id = 0;
    /**
     * 网站ID
     *
     * @var int
     */
    private $sub_site_id = 0;
    /**
     * 会员ID
     *
     * @var int
     */
    private $sub_pub_id = 0;
    /**
     * 请求游标
     *
     * @var int
     */
    private $next_cursor = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 业务时间
     *
     * @var string
     */
    private $ds = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.media.top.offline.rank.report');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSubAdzoneId(int $subAdZoneId)
    {
        if ($subAdZoneId > 0) {
            $this->reqData['sub_adzone_id'] = $subAdZoneId;
        } else {
            throw new TBKException('广告位ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSubSiteId(int $subSiteId)
    {
        if ($subSiteId > 0) {
            $this->reqData['sub_site_id'] = $subSiteId;
        } else {
            throw new TBKException('网站ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSubPubId(int $subPubId)
    {
        if ($subPubId > 0) {
            $this->reqData['sub_pub_id'] = $subPubId;
        } else {
            throw new TBKException('会员ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNextCursor(int $nextCursor)
    {
        if ($nextCursor >= 0) {
            $this->reqData['next_cursor'] = $nextCursor;
        } else {
            throw new TBKException('请求游标不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setDs(string $ds)
    {
        if ((8 == \strlen($ds)) && ctype_digit($ds)) {
            $this->reqData['ds'] = $ds;
        } else {
            throw new TBKException('业务时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['ds'])) {
            throw new TBKException('业务时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
