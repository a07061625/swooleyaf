<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method string getPromotionNo()
 * @method $this withPromotionNo($value)
 * @method array getOrderTransferParam()
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
class SaveBatchTaskForCreatingOrderTransfer extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderTransferParam(array $orderTransferParam)
    {
        $this->data['OrderTransferParam'] = $orderTransferParam;
        foreach ($orderTransferParam as $depth1 => $depth1Value) {
            $this->options['query']['OrderTransferParam.' . ($depth1 + 1) . '.PermitPremiumTransfer'] = $depth1Value['PermitPremiumTransfer'];
            $this->options['query']['OrderTransferParam.' . ($depth1 + 1) . '.AuthorizationCode'] = $depth1Value['AuthorizationCode'];
            $this->options['query']['OrderTransferParam.' . ($depth1 + 1) . '.DomainName'] = $depth1Value['DomainName'];
            $this->options['query']['OrderTransferParam.' . ($depth1 + 1) . '.RegistrantProfileId'] = $depth1Value['RegistrantProfileId'];
        }

        return $this;
    }
}
