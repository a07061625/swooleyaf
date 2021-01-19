<?php
/**
 * 权益物料精选
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */
namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class PromotionOptimus
 * @package SyPromotion\TBK\Provider
 */
class PromotionOptimus extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetSiteIdTrait;

    /**
     * 页数
     *
     * @var int
     */
    private $page_num = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 权益物料ID
     *
     * @var int
     */
    private $promotion_id = 0;
    /**
     * 网站ID
     *
     * @var int
     */
    private $site_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.optimus.promotion');
        $this->reqData['page_num'] = 1;
        $this->reqData['page_size'] = 10;
    }

    private function __clone()
    {
    }

    /**
     * @param int $pageNum
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum > 0) {
            $this->reqData['page_num'] = $pageNum;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 10)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $promotionId
     * @throws \SyException\Promotion\TBKException
     */
    public function setPromotionId(int $promotionId)
    {
        if ($promotionId > 0) {
            $this->reqData['promotion_id'] = $promotionId;
        } else {
            throw new TBKException('权益物料ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['promotion_id'])) {
            throw new TBKException('权益物料ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['site_id'])) {
            throw new TBKException('网站ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
