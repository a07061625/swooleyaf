<?php

namespace AlibabaCloud\DomainIntl;

/**
 * @method array getOrderActivateParam()
 * @method string getPromotionNo()
 * @method $this withPromotionNo($value)
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
class SaveBatchTaskForCreatingOrderActivate extends Rpc
{
    /**
     * @return $this
     */
    public function withOrderActivateParam(array $orderActivateParam)
    {
        $this->data['OrderActivateParam'] = $orderActivateParam;
        foreach ($orderActivateParam as $depth1 => $depth1Value) {
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Country'] = $depth1Value['Country'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.SubscriptionDuration'] = $depth1Value['SubscriptionDuration'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Address'] = $depth1Value['Address'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.PermitPremiumActivation'] = $depth1Value['PermitPremiumActivation'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.TelArea'] = $depth1Value['TelArea'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.City'] = $depth1Value['City'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Dns2'] = $depth1Value['Dns2'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Dns1'] = $depth1Value['Dns1'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.DomainName'] = $depth1Value['DomainName'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.RegistrantProfileId'] = $depth1Value['RegistrantProfileId'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.RegistrantType'] = $depth1Value['RegistrantType'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Telephone'] = $depth1Value['Telephone'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.TrademarkDomainActivation'] = $depth1Value['TrademarkDomainActivation'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.AliyunDns'] = $depth1Value['AliyunDns'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.RegistrantOrganization'] = $depth1Value['RegistrantOrganization'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.TelExt'] = $depth1Value['TelExt'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Province'] = $depth1Value['Province'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.PostalCode'] = $depth1Value['PostalCode'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.EnableDomainProxy'] = $depth1Value['EnableDomainProxy'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.Email'] = $depth1Value['Email'];
            $this->options['query']['OrderActivateParam.' . ($depth1 + 1) . '.RegistrantName'] = $depth1Value['RegistrantName'];
        }

        return $this;
    }
}
