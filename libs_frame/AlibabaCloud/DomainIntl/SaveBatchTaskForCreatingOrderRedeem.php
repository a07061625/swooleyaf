<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getPromotionNo()
 * @method $this withPromotionNo($value)
 * @method array getOrderRedeemParam()
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getCouponNo()
 * @method $this withCouponNo($value)
 * @method string getUseCoupon()
 * @method $this withUseCoupon($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getUsePromotion()
 * @method $this withUsePromotion($value)
 */
class SaveBatchTaskForCreatingOrderRedeem extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderRedeemParam(array $orderRedeemParam)
    {
        $this->data['OrderRedeemParam'] = $orderRedeemParam;
        foreach ($orderRedeemParam as $depth1 => $depth1Value) {
            $this->options['query']['OrderRedeemParam.' . ($depth1 + 1) . '.CurrentExpirationDate'] = $depth1Value['CurrentExpirationDate'];
            $this->options['query']['OrderRedeemParam.' . ($depth1 + 1) . '.DomainName'] = $depth1Value['DomainName'];
        }

        return $this;
    }
}
