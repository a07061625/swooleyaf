<?php

namespace AlibabaCloud\Pvtz;

/**
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getVpcs()
 */
class BindZoneVpc extends Rpc
{
    /**
     * @return $this
     */
    public function withVpcs(array $vpcs)
    {
        $this->data['Vpcs'] = $vpcs;
        foreach ($vpcs as $depth1 => $depth1Value) {
            if (isset($depth1Value['RegionId'])) {
                $this->options['query']['Vpcs.' . ($depth1 + 1) . '.RegionId'] = $depth1Value['RegionId'];
            }
            if (isset($depth1Value['VpcId'])) {
                $this->options['query']['Vpcs.' . ($depth1 + 1) . '.VpcId'] = $depth1Value['VpcId'];
            }
        }

        return $this;
    }
}
