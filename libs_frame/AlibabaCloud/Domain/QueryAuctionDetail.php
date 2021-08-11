<?php

namespace AlibabaCloud\Domain;

/**
 * @method string getAuctionId()
 */
class QueryAuctionDetail extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAuctionId($value)
    {
        $this->data['AuctionId'] = $value;
        $this->options['form_params']['AuctionId'] = $value;

        return $this;
    }
}
