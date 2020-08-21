<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/19 0019
 * Time: 17:37
 */
namespace SyPay\Union\Channels\Order;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyPay\Union\Channels\BaseOrder;
use SyPay\Union\Channels\Traits\AccessTypeTrait;
use SyPay\Union\Channels\Traits\AcqInsCodeTrait;
use SyPay\Union\Channels\Traits\CertIdTrait;
use SyPay\Union\Channels\Traits\DiscountIdTrait;
use SyPay\Union\Channels\Traits\MerInfoTrait;
use SyPay\Union\Channels\Traits\OrderIdTrait;
use SyPay\UtilUnionChannels;

/**
 * 营销活动余额查询接口
 * 目前Apple Pay做营销时,为避免造成用户支付时页面上显示有优惠,实际上支付没有享受到优惠
 * 通过此接口可以知道活动剩余名额,当该营销活动还有优惠时,商户APP需要自动的展示当面优惠活动,从而引导用户使用Apple Pay进行远程支付
 * 建议查询间隔时间至少1分钟
 *
 * @package SyPay\Union\Channels\Order
 */
class RemainingQuotaQuery extends BaseOrder
{
    use AccessTypeTrait;
    use OrderIdTrait;
    use DiscountIdTrait;
    use MerInfoTrait;
    use AcqInsCodeTrait;
    use CertIdTrait;

    public function __construct(string $merId, string $envType)
    {
        parent::__construct($merId, $envType);
        $this->reqDomain .= '/gateway/api/backTransReq.do';
        $this->reqData['bizType'] = '000000';
        $this->reqData['txnType'] = '70';
        $this->reqData['txnSubType'] = '02';
        $this->reqData['accessType'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @return array
     *
     * @throws \SyException\Pay\UnionException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['orderId'])) {
            throw new UnionException('商户订单号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        if (!isset($this->reqData['discountId'])) {
            throw new UnionException('营销活动编号不能为空', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        UtilUnionChannels::createSign($this->reqData['merId'], $this->reqData);

        return $this->getChannelsContent();
    }
}
