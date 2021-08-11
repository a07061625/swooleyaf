<?php

namespace AlibabaCloud\Dyplsapi;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTrackNo()
 * @method string getPhoneNoX()
 * @method $this withPhoneNoX($value)
 */
class QueryPhoneNoAByTrackNo extends Rpc
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
