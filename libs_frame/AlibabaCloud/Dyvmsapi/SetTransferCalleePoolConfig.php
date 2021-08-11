<?php

namespace AlibabaCloud\Dyvmsapi;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPhoneNumber()
 * @method $this withPhoneNumber($value)
 * @method array getDetails()
 * @method string getCalledRouteMode()
 * @method $this withCalledRouteMode($value)
 * @method string getQualificationId()
 * @method $this withQualificationId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class SetTransferCalleePoolConfig extends Rpc
{
    /**
     * @return $this
     */
    public function withDetails(array $details)
    {
        $this->data['Details'] = $details;
        foreach ($details as $depth1 => $depth1Value) {
            if (isset($depth1Value['Caller'])) {
                $this->options['query']['Details.' . ($depth1 + 1) . '.Caller'] = $depth1Value['Caller'];
            }
            if (isset($depth1Value['Called'])) {
                $this->options['query']['Details.' . ($depth1 + 1) . '.Called'] = $depth1Value['Called'];
            }
        }

        return $this;
    }
}
