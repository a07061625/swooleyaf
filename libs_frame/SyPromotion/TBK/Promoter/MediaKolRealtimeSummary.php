<?php
/**
 * 达人实时销量汇总数据
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class MediaKolRealtimeSummary
 *
 * @package SyPromotion\TBK\Promoter
 */
class MediaKolRealtimeSummary extends BaseTBK
{
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

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.media.kol.realtime.summary');
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

    public function getDetail(): array
    {
        if (!isset($this->reqData['sub_adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sub_site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sub_pub_id'])) {
            throw new TBKException('会员ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
