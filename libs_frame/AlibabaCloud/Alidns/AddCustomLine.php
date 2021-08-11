<?php

namespace AlibabaCloud\Alidns;

/**
 * @method string getDomainName()
 * @method $this withDomainName($value)
 * @method array getIpSegment()
 * @method string getUserClientIp()
 * @method $this withUserClientIp($value)
 * @method string getLineName()
 * @method $this withLineName($value)
 * @method string getLang()
 * @method $this withLang($value)
 */
class AddCustomLine extends Rpc
{
    /**
     * @return $this
     */
    public function withIpSegment(array $ipSegment)
    {
        $this->data['IpSegment'] = $ipSegment;
        foreach ($ipSegment as $depth1 => $depth1Value) {
            if (isset($depth1Value['EndIp'])) {
                $this->options['query']['IpSegment.' . ($depth1 + 1) . '.EndIp'] = $depth1Value['EndIp'];
            }
            if (isset($depth1Value['StartIp'])) {
                $this->options['query']['IpSegment.' . ($depth1 + 1) . '.StartIp'] = $depth1Value['StartIp'];
            }
        }

        return $this;
    }
}
