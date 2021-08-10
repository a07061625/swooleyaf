<?php

namespace AlibabaCloud\Dyplsapi;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSubsId()
 * @method $this withSubsId($value)
 * @method string getPhoneNoX()
 * @method $this withPhoneNoX($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTrackNo()
 * @method string getPoolKey()
 * @method $this withPoolKey($value)
 */
class AddAxnTrackNo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTrackNo($value)
    {
        $this->data['TrackNo'] = $value;
        $this->options['query']['trackNo'] = $value;

        return $this;
    }
}
