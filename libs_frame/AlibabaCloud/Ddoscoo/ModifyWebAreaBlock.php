<?php

namespace AlibabaCloud\Ddoscoo;

/**
 * @method array getRegions()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSourceIp()
 * @method $this withSourceIp($value)
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class ModifyWebAreaBlock extends Rpc
{
    /**
     * @return $this
     */
    public function withRegions(array $regions)
    {
        $this->data['Regions'] = $regions;
        foreach ($regions as $i => $iValue) {
            $this->options['query']['Regions.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
