<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getType()
 * @method $this withType($value)
 * @method string getMinAvailableAddrNum()
 * @method $this withMinAvailableAddrNum($value)
 * @method string getAddrPoolId()
 * @method $this withAddrPoolId($value)
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getLang()
 * @method $this withLang($value)
 * @method array getAddr()
 */
class UpdateGtmAddressPool extends Rpc
{
    /**
     * @return $this
     */
    public function withAddr(array $addr)
    {
        $this->data['Addr'] = $addr;
        foreach ($addr as $depth1 => $depth1Value) {
            if (isset($depth1Value['Mode'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Mode'] = $depth1Value['Mode'];
            }
            if (isset($depth1Value['LbaWeight'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }
}
