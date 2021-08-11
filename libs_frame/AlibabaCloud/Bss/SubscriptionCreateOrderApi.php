<?php

namespace AlibabaCloud\Bss;

/**
 * @method string getProductCode()
 * @method string getOwnerId()
 */
class SubscriptionCreateOrderApi extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProductCode($value)
    {
        $this->data['ProductCode'] = $value;
        $this->options['query']['productCode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOwnerId($value)
    {
        $this->data['OwnerId'] = $value;
        $this->options['query']['ownerId'] = $value;

        return $this;
    }
}
