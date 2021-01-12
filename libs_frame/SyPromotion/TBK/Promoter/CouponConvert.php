<?php
/**
 * 单品券高效转链
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class CouponConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class CouponConvert extends BaseTBK
{
    use SetAdZoneIdTrait;
    use SetPlatformTrait;

    /**
     * 淘客商品id
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 外部用户标识
     *
     * @var string
     */
    private $external_id = '';
    /**
     * 会员运营ID
     *
     * @var string
     */
    private $special_id = '';
    /**
     * 渠道管理ID
     *
     * @var string
     */
    private $relation_id = '';
    /**
     * 渠道合作标识
     *
     * @var string
     */
    private $xid = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.coupon.convert');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemId(int $itemId)
    {
        if ($itemId > 0) {
            $this->reqData['item_id'] = $itemId;
        } else {
            throw new TBKException('淘客商品id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setExternalId(string $externalId)
    {
        if (\strlen($externalId) > 0) {
            $this->reqData['external_id'] = $externalId;
        } else {
            throw new TBKException('外部用户标识不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpecialId(string $specialId)
    {
        if (\strlen($specialId) > 0) {
            $this->reqData['special_id'] = $specialId;
        } else {
            throw new TBKException('会员运营ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(string $relationId)
    {
        if (\strlen($relationId) > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道管理ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setXid(string $xid)
    {
        if (\strlen($xid) > 0) {
            $this->reqData['xid'] = $xid;
        } else {
            throw new TBKException('渠道合作标识不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
