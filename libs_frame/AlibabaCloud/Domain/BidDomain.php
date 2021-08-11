<?php

namespace AlibabaCloud\Domain;

/**
 * @method string getAuctionId()
 * @method string getMaxBid()
 * @method string getCurrency()
 */
class BidDomain extends Rpc
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMaxBid($value)
    {
        $this->data['MaxBid'] = $value;
        $this->options['form_params']['MaxBid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrency($value)
    {
        $this->data['Currency'] = $value;
        $this->options['form_params']['Currency'] = $value;

        return $this;
    }
}
