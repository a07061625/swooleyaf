<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getCommodityCode()
 */
class GetInventory extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommodityCode($value)
    {
        $this->data['CommodityCode'] = $value;
        $this->options['form_params']['CommodityCode'] = $value;

        return $this;
    }
}
