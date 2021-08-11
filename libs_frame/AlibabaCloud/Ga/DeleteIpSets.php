<?php

namespace AlibabaCloud\Ga;

/**
 * @method array getIpSetIds()
 */
class DeleteIpSets extends Rpc
{
    /**
     * @return $this
     */
    public function withIpSetIds(array $ipSetIds)
    {
        $this->data['IpSetIds'] = $ipSetIds;
        foreach ($ipSetIds as $i => $iValue) {
            $this->options['query']['IpSetIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
