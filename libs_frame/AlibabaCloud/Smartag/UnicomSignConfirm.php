<?php

namespace AlibabaCloud\Smartag;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method array getTmsOrder()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class UnicomSignConfirm extends Rpc
{
    /**
     * @return $this
     */
    public function withTmsOrder(array $tmsOrder)
    {
        $this->data['TmsOrder'] = $tmsOrder;
        foreach ($tmsOrder as $depth1 => $depth1Value) {
            if (isset($depth1Value['TmsCode'])) {
                $this->options['query']['TmsOrder.' . ($depth1 + 1) . '.TmsCode'] = $depth1Value['TmsCode'];
            }
            if (isset($depth1Value['SigningTime'])) {
                $this->options['query']['TmsOrder.' . ($depth1 + 1) . '.SigningTime'] = $depth1Value['SigningTime'];
            }
            if (isset($depth1Value['TmsOrderCode'])) {
                $this->options['query']['TmsOrder.' . ($depth1 + 1) . '.TmsOrderCode'] = $depth1Value['TmsOrderCode'];
            }
            if (isset($depth1Value['TradeId'])) {
                $this->options['query']['TmsOrder.' . ($depth1 + 1) . '.TradeId'] = $depth1Value['TradeId'];
            }
        }

        return $this;
    }
}
