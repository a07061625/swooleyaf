<?php

namespace AlibabaCloud\Cloudwf;

/**
 * @method array getGids()
 * @method string getBid()
 * @method $this withBid($value)
 */
class GetAllActiveShopByGroup extends Rpc
{
    /**
     * @return $this
     */
    public function withGids(array $gids)
    {
        $this->data['Gids'] = $gids;
        foreach ($gids as $i => $iValue) {
            $this->options['query']['Gids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
