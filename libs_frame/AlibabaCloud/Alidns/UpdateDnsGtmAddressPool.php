<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getLbaStrategy()
 * @method $this withLbaStrategy($value)
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
class UpdateDnsGtmAddressPool extends Rpc
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
            if (isset($depth1Value['AttributeInfo'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.AttributeInfo'] = $depth1Value['AttributeInfo'];
            }
            if (isset($depth1Value['Remark'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Remark'] = $depth1Value['Remark'];
            }
            if (isset($depth1Value['Addr'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.Addr'] = $depth1Value['Addr'];
            }
            if (isset($depth1Value['LbaWeight'])) {
                $this->options['query']['Addr.' . ($depth1 + 1) . '.LbaWeight'] = $depth1Value['LbaWeight'];
            }
        }

        return $this;
    }
}
