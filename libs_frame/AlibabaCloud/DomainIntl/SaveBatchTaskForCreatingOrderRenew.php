<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getPromotionNo()
 * @method $this withPromotionNo($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method array getOrderRenewParam()
 * @method string getCouponNo()
 * @method $this withCouponNo($value)
 * @method string getUseCoupon()
 * @method $this withUseCoupon($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method string getUsePromotion()
 * @method $this withUsePromotion($value)
 */
class SaveBatchTaskForCreatingOrderRenew extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderRenewParam(array $orderRenewParam)
    {
        $this->data['OrderRenewParam'] = $orderRenewParam;
        foreach ($orderRenewParam as $depth1 => $depth1Value) {
            $this->options['query']['OrderRenewParam.' . ($depth1 + 1) . '.SubscriptionDuration'] = $depth1Value['SubscriptionDuration'];
            $this->options['query']['OrderRenewParam.' . ($depth1 + 1) . '.CurrentExpirationDate'] = $depth1Value['CurrentExpirationDate'];
            $this->options['query']['OrderRenewParam.' . ($depth1 + 1) . '.DomainName'] = $depth1Value['DomainName'];
        }

        return $this;
    }
}
