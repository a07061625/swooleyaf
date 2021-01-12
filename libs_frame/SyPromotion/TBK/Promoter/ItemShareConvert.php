<?php
/**
 * 转换商品三方分成链接
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDxTrait;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetNumIidsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;
use SyPromotion\TBK\Traits\SetSubPidTrait;

/**
 * Class ItemShareConvert
 *
 * @package SyPromotion\TBK\Promoter
 */
class ItemShareConvert extends BaseTBK
{
    use SetFieldsTrait;
    use SetNumIidsTrait;
    use SetSubPidTrait;
    use SetPlatformTrait;
    use SetAdZoneIdTrait;
    use SetDxTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $num_iids = [];
    /**
     * 三方pid
     *
     * @var string
     */
    private $sub_pid = '';
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 计划链接
     *
     * @var string
     */
    private $dx = '';
    /**
     * 券id
     *
     * @var string
     */
    private $coupon_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.item.share.convert');
        $this->reqData['platform'] = 1;
        $this->reqData['dx'] = '1';
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCouponId(string $couponId)
    {
        if (ctype_alnum($couponId)) {
            $this->reqData['coupon_id'] = $couponId;
        } else {
            throw new TBKException('券id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['num_iids'])) {
            throw new TBKException('商品ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['sub_pid'])) {
            throw new TBKException('三方pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
